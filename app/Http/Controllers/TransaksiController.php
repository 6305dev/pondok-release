<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi milik pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $query = Transaksi::with('user', 'dokumen', 'pengambilan')->latest();

        // User biasa hanya melihat transaksinya sendiri —
        // sebelumnya seluruh transaksi pengguna lain ikut tampil.
        $user = Auth::user();
        if (! in_array($user->role_id, [1, 3, 4])) {
            $query->where('id_user', $user->id);
        }

        // View tracking/index memakai $orders + $isPedes — sebelumnya hanya
        // $transaksi yang dikirim sehingga halaman selalu error 500.
        $orders = $query->paginate(10);
        $isPedes = false;

        return view('tracking.index', compact('orders', 'isPedes'));
    }

    /**
     * Update status transaksi (opsional).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $idTrx
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $idTrx)
    {
        $request->validate([
            'status' => 'required|integer|in:1,2,3,4,5,6,7,8',
            'pesan_penolakan' => 'nullable|string|max:1000',
            'pesan_batal' => 'nullable|string|max:1000',
        ]);

        // ✅ Cari berdasarkan id_trx (bukan id)
        $transaksi = Transaksi::where('id_trx', $idTrx)->firstOrFail();

        $oldStatus = $transaksi->status;
        $newStatus = $request->status;

        $transaksi->status = $newStatus;

        // ✅ Sesuaikan logika dengan penjelasan Anda
        if ($newStatus == 2) { // Verifikasi
            $transaksi->tgl_respon = now();
        } elseif ($newStatus == 3) { // Proses
            $transaksi->tgl_proses = now();
        } elseif ($newStatus == 4) { // Selesai
            $transaksi->tgl_selesai = now();
        } elseif ($newStatus == 5 || $newStatus == 6 || $newStatus == 7) { // Ditolak, Pengajuan Ulang, Komplain
            if ($newStatus == 5 && $request->filled('pesan_penolakan')) {
                $transaksi->pesan = $request->pesan_penolakan;
            }
        } elseif ($newStatus == 8) { // Dibatalkan
            $transaksi->deleted_at = now(); // Soft delete
            if ($request->filled('pesan_batal')) {
                $transaksi->pesan = $request->pesan_batal;
            }
        }

        $transaksi->save(); // ✅ Ini akan memicu observer → simpan log

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function konfirmasi(Request $request, $id)
    {
        // Cari transaksi berdasarkan id_trx (bukan ID primary key!)
        $transaksi = Transaksi::where('id_trx', $id)->first();

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan.'
            ], 404);
        }

        // Endpoint ini publik — batasi hanya untuk transaksi selesai yang
        // belum dikonfirmasi agar tidak bisa dipicu untuk transaksi orang lain
        // pada status yang tidak semestinya.
        if ((int) $transaksi->status !== Transaksi::STATUS_SELESAI) {
            return response()->json([
                'success' => false,
                'message' => 'Konfirmasi hanya dapat dilakukan untuk transaksi yang sudah selesai.'
            ], 422);
        }

        if ($transaksi->konfirmasi === 'Y') {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi ini sudah dikonfirmasi sebelumnya.'
            ], 422);
        }

        // Update data
        $updated = $transaksi->update([
            'konfirmasi' => 'Y',
            'tgl_konfirmasi' => now(),
        ]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Konfirmasi berhasil disimpan.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan konfirmasi. Tidak ada perubahan data.'
            ], 500);
        }
    }

    public function submitRating(Request $request, $id_trx)
    {
        try {
            // Cari transaksi berdasarkan id_trx (bukan ID primary key!)
            $transaksi = Transaksi::where('id_trx', $id_trx)->first();

            if (!$transaksi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan.'
                ], 404);
            }

            // Endpoint ini publik — rating hanya untuk transaksi selesai dan
            // hanya boleh sekali.
            if ((int) $transaksi->status !== Transaksi::STATUS_SELESAI) {
                return response()->json([
                    'success' => false,
                    'message' => 'Penilaian hanya dapat dilakukan untuk transaksi yang sudah selesai.'
                ], 422);
            }

            if ($transaksi->rating !== null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi ini sudah dinilai sebelumnya.'
                ], 422);
            }

            // Update data rating
            $transaksi->update([
                'rating' => $request->input('rating'), // 1,2,3,4
                'komentar_rating' => $request->input('comment') ?? null,
                'tgl_rating' => now(), // simpan tanggal penilaian
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Penilaian berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error submit rating: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan penilaian: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cekStatus(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|digits:16',
            'id_trx' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Format NIK atau ID Transaksi tidak valid.'
            ], 422);
        }

        // Cari data transaksi (bisa dicari berdasarkan NIK pemohon, KK, atau NIK akun pembuat transaksi)
        $transaksi = Transaksi::with('dokumen')
            ->where('id_trx', $request->id_trx)
            ->where(function ($query) use ($request) {
                $query->where('nik', $request->nik)
                    ->orWhere('kk', $request->nik)
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('nik', $request->nik);
                    });
            })
            ->first();

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Data permohonan tidak ditemukan. Pastikan NIK dan Nomor Transaksi benar.'
            ]);
        }

        $rawLayanan = $transaksi->id_dokumen;
        $ids = is_array($rawLayanan) ? $rawLayanan : json_decode($rawLayanan, true);
        if (!is_array($ids)) {
            $ids = ($ids !== null && $ids !== '') ? [$ids] : [];
        }

        $layananMap = [
            '1' => 'Kartu Keluarga',
            '2' => 'KTP',
            '3' => 'KIA',
            '4' => 'Pindah Keluar',
            '5' => 'Pindah Datang',
            '6' => 'Akta Kelahiran',
            '7' => 'Akta Kematian',
            '8' => 'Akta Perkawinan',
            '9' => 'Akta Perceraian'
        ];

        $names = [];
        foreach ($ids as $id) {
            $cleanId = trim((string)$id);
            if (isset($layananMap[$cleanId])) {
                $names[] = $layananMap[$cleanId];
            } else {
                $names[] = "Layanan ID: $cleanId";
            }
        }
        $namaLayanan = implode(', ', $names);

        $responseData = [
            'nik' => $transaksi->nik,
            'id_trx' => $transaksi->id_trx,
            'nama_layanan' => $namaLayanan,
            'status' => $transaksi->status,
            'created_at' => $transaksi->created_at,
            'tgl_selesai' => $transaksi->tgl_selesai,
            'tgl_proses' => $transaksi->tgl_proses,
            'pesan' => $transaksi->pesan,
        ];

        // Jika ditemukan, kembalikan data
        return response()->json([
            'success' => true,
            'transaksi' => $responseData
        ]);
    }
}
