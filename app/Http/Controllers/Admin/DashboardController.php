<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\JenisPelayanan; // ⬅️ DITAMBAH: Pastikan Model JenisPelayanan di-import
use Illuminate\Http\Request;
use Carbon\Carbon; // ⬅️ DITAMBAH: Gunakan alias untuk Carbon
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// class DashboardController extends Controller
class DashboardController extends \App\Http\Controllers\Controller
{
    /**
     * Menampilkan Dashboard Utama (Ringkasan/Statistik).
     * Logika filtering yang lama dipindahkan ke transaksiIndex.
     */
    public function index(Request $request)
    {

        // Jumlah transaksi baru (status = 1) — seperti sebelumnya
        $transaksiBaruCount = Transaksi::where('status', 1)->count();

        $transaksiVerifikasi = Transaksi::where('status', 2)->count();

        // 🔥 Jumlah transaksi hari ini (new orders) menggunakan kolom tgl lokal
        $newOrdersToday = Transaksi::whereDate('tgl', now()->toDateString())->count();

        // Jumlah transaksi proses (status = 3) — seperti sebelumnya
        $transaksiProses = Transaksi::where('status', 3)->count();

        // Jumlah transaksi selesai (status = 4) — seperti sebelumnya
        $transaksiSelesai = Transaksi::where('status', 4)->count();

        // Jumlah transaksi ditolak (status = 5) — seperti sebelumnya
        $transaksiTolak = Transaksi::where('status', 5)->count();

        // Jumlah transaksi ulang (status = 6) — seperti sebelumnya
        $transaksiUlang = Transaksi::where('status', 6)->count();

        // Jumlah transaksi komplain (status = 7) — seperti sebelumnya
        $transaksiKomplain = Transaksi::where('status', 7)->count();

        // Jumlah transaksi dibatalkan (status = 8) — seperti sebelumnya
        $transaksiDibatalkan = Transaksi::where('status', 8)->count();

        // Jumlah user (aktif) — seperti sebelumnya
        $pengguna = User::where('active', 1)->count();

        $data = DB::table('transaksi')
            ->join('jenis_pelayanan', 'transaksi.id_dokumen', '=', 'jenis_pelayanan.id')
            ->select('jenis_pelayanan.keterangan', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis_pelayanan.keterangan')
            ->get();

        // Ambil 8 anggota terbaru untuk widget Latest Members
        $latestMembers = User::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Hitung jumlah pendaftar baru dalam 7 hari terakhir
        $newMembersCount = User::where('created_at', '>=', now()->subDays(7))->count();

        // Cukup tampilkan view Dashboard standar
        return view('admin.dashboard', compact('transaksiBaruCount', 'transaksiVerifikasi', 'newOrdersToday', 'transaksiProses', 'transaksiSelesai', 'transaksiTolak', 'transaksiUlang', 'transaksiKomplain', 'transaksiDibatalkan', 'pengguna', 'data', 'latestMembers', 'newMembersCount'));

    }
    
    // --- 🚨 START PERBAIKAN UTAMA UNTUK MENU TRANSAKSI (BadMethodCallException) ---
    
    /**
     * Menampilkan Daftar Transaksi dengan Filtering (Dipanggil oleh route admin/transaksi).
     */
    public function transaksiIndex(Request $request)
    {
        // 1. Ambil data pendukung
        $jenisPelayanans = JenisPelayanan::all(); // Menggunakan alias yang sudah di-import
        $filterGroups = $this->getFilterGroups();
        
        // 2. Inisialisasi query dengan eager loading
        $query = Transaksi::with('jenisPelayanan', 'pengambilan');

        // 3. Aplikasikan Filter
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan id trasaksi
        if ($request->filled('id_trx')) {
            $query->where('id_trx', $request->id_trx);
        }

        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // Filter berdasarkan jenis dokumen (ID Dokumen)
        if ($request->filled('id_dokumen')) {
             // Pastikan id_dokumen adalah kolom yang benar untuk filtering
            $query->where('id_dokumen', $request->id_dokumen);
        }

        // Filter berdasarkan grup (misal: KIA → cari semua yang nama-nya mengandung KIA)
        if ($request->filled('filter_jenis')) {
            $selectedGroup = $request->filter_jenis;
            
            // Definisikan pemetaan dari grup filter ke ID format baru dan kode keterangan format lama
            $groupMap = [
                'Kartu Keluarga' => ['new' => '1', 'legacy' => 'KK'],
                'KTP'            => ['new' => '2', 'legacy' => 'KTP'],
                'KIA'            => ['new' => '3', 'legacy' => 'KIA'],
                'Pindah'         => ['new' => '4', 'legacy' => 'PDH'],
                'Datang'         => ['new' => '5', 'legacy' => 'DTG'],
                'Akta Kelahiran' => ['new' => '6', 'legacy' => 'ALH'],
                'Akta Kematian'  => ['new' => '7', 'legacy' => 'AMT'],
                'Akta Perkawinan' => ['new' => '8', 'legacy' => 'AKW'],
                'Akta Perceraian'=> ['new' => '9', 'legacy' => 'ACR'],
            ];

            if (isset($groupMap[$selectedGroup])) {
                $map = $groupMap[$selectedGroup];
                $newId = $map['new'];
                $legacyCode = $map['legacy'];

                $query->where(function ($q) use ($newId, $legacyCode) {
                    // 1. Format Baru: JSON array mengandung ID baru (misal: ["9"] atau ["9","8"])
                    $q->where('id_dokumen', 'like', '%"' . $newId . '"%')
                      ->orWhere('id_dokumen', 'like', '%[' . $newId . ']%')
                      ->orWhere('id_dokumen', 'like', '%,' . $newId . ',%')
                      ->orWhere('id_dokumen', 'like', '%[' . $newId . ',%')
                      ->orWhere('id_dokumen', 'like', '%,' . $newId . ']%')
                      // 2. Format Lama: id_dokumen adalah integer ID relasi ke jenis_pelayanan
                      ->orWhere(function ($subQ) use ($legacyCode) {
                          $subQ->whereNot('id_dokumen', 'like', '%[%') // bukan format JSON
                               ->whereHas('jenisPelayanan', function ($jpQ) use ($legacyCode) {
                                   $jpQ->where('keterangan', $legacyCode);
                               });
                      });
                });
            } else {
                // Fallback pencarian nama jika tidak ada di pemetaan
                if (isset($filterGroups[$selectedGroup])) {
                    $keyword = $filterGroups[$selectedGroup];
                    $query->whereHas('jenisPelayanan', function ($q) use ($keyword) {
                        $q->where('nama', 'like', "%{$keyword}%");
                    });
                }
            }
        }
        
        // Filter berdasarkan rentang tanggal
        if ($request->filled('tgl_dari')) {
            // Menggunakan whereDate untuk membandingkan hanya tanggal, menghindari masalah waktu
            $query->whereDate('tgl', '>=', $request->tgl_dari);
        }
        if ($request->filled('tgl_sampai')) {
            $query->whereDate('tgl', '<=', $request->tgl_sampai);
        }
        
        // 4. Eksekusi query
        $transaksis = $query->orderBy('created_at', 'desc')->paginate(10);

        // 5. Return view transaksi
        return view('admin.transaksi', compact('transaksis', 'jenisPelayanans', 'filterGroups'));
    }

    // --- 🚨 END PERBAIKAN UTAMA UNTUK MENU TRANSAKSI ---

    /**
     * Menampilkan Detail Transaksi dan Timeline.
     */
    public function show($idTrx)
    {
        $transaksi = Transaksi::with([
            'user', 'jenisPelayanan', 'pengambilan', 'files', 'userDokumen', 'kecamatan', 'desa'
        ])->where('id_trx', $idTrx)->firstOrFail();

        $timeline = [];
        $prevDatetime = null;

        // Gunakan Carbon::parse() untuk semua tanggal agar lebih konsisten

        // 1. Status "Baru"
        if ($transaksi->tgl) {
            $timeline[] = [
                'label' => 'Baru',
                'icon' => 'clipboard-list',
                'color' => 'warning',
                'status_text' => 'Dibuat',
                'datetime' => $transaksi->tgl,
                'duration' => null,
            ];
            $prevDatetime = Carbon::parse($transaksi->tgl);
        }

        // 2. Status "Verifikasi"
        if ($transaksi->tgl_respon) {
            $currentDatetime = Carbon::parse($transaksi->tgl_respon);
            $timeline[] = [
                'label' => 'Verifikasi Dokumen', // ⬅️ Diperjelas
                'icon' => 'search',
                'color' => 'secondary',
                'status_text' => 'Selesai',
                'datetime' => $transaksi->tgl_respon,
                'duration' => $prevDatetime ? $prevDatetime->diffInMinutes($currentDatetime) : null,
            ];
            $prevDatetime = $currentDatetime;
        }

        // 3. Status "Proses"
        if ($transaksi->tgl_proses) {
            $currentDatetime = Carbon::parse($transaksi->tgl_proses);
            $timeline[] = [
                'label' => 'Proses Cetak/Pembuatan', // ⬅️ Diperjelas
                'icon' => 'cog',
                'color' => 'primary',
                'status_text' => 'Selesai',
                'datetime' => $transaksi->tgl_proses,
                'duration' => $prevDatetime ? $prevDatetime->diffInMinutes($currentDatetime) : null,
            ];
            $prevDatetime = $currentDatetime;
        }

        // 4. Status "Selesai" (Siap Diambil)
        if ($transaksi->tgl_selesai) {
            $currentDatetime = Carbon::parse($transaksi->tgl_selesai);
            $timeline[] = [
                'label' => 'Selesai (Siap Diambil)', // ⬅️ Diperjelas
                'icon' => 'check',
                'color' => 'success',
                'status_text' => 'Selesai',
                'datetime' => $transaksi->tgl_selesai,
                'duration' => $prevDatetime ? $prevDatetime->diffInMinutes($currentDatetime) : null,
            ];
            // Tidak perlu update $prevDatetime, proses selesai di sini
        }

        // 5. Status Non-Lurus (Ditolak / Pengajuan Ulang / Komplain)
        $currentStatus = $transaksi->status;
        $statusDates = [
            Transaksi::STATUS_DITOLAK => 'updated_at', // ⬅️ Asumsi ada kolom ini
            Transaksi::STATUS_AJUKAN_ULANG => 'updated_at', // ⬅️ Asumsi ada kolom ini
            Transaksi::STATUS_KOMPLAIN => 'updated_at', // ⬅️ Asumsi ada kolom ini
            Transaksi::STATUS_DIBATALKAN => 'updated_at', // ⬅️ Asumsi ada kolom ini untuk pembatalan
        ];
        
        $statusKey = array_search($currentStatus, array_keys($statusDates));

        if ($statusKey !== false) {
             $statusColumn = $statusDates[$currentStatus];
             // Pastikan kolom tanggal terkait terisi dan status ini belum Selesai
             if ($transaksi->$statusColumn && $transaksi->status !== Transaksi::STATUS_SELESAI) {
                
                $labelMap = [
                    Transaksi::STATUS_DITOLAK => 'Ditolak',
                    Transaksi::STATUS_AJUKAN_ULANG => 'Pengajuan Ulang',
                    Transaksi::STATUS_KOMPLAIN => 'Komplain',
                    transaksi::STATUS_DIBATALKAN => 'Dibatalkan',
                ];
                $iconMap = [
                    Transaksi::STATUS_DITOLAK => 'times',
                    Transaksi::STATUS_AJUKAN_ULANG => 'undo',
                    Transaksi::STATUS_KOMPLAIN => 'exclamation-triangle',
                    Transaksi::STATUS_DIBATALKAN => 'ban',
                ];
                $colorMap = [
                    Transaksi::STATUS_DITOLAK => 'danger',
                    Transaksi::STATUS_AJUKAN_ULANG => 'danger',
                    Transaksi::STATUS_KOMPLAIN => 'danger',
                    Transaksi::STATUS_DIBATALKAN => 'danger',
                ];
                
                $currentDatetime = Carbon::parse($transaksi->$statusColumn);
                $duration = $prevDatetime ? $prevDatetime->diffInMinutes($currentDatetime) : null;
                
                $timeline[] = [
                    'label' => $labelMap[$currentStatus],
                    'icon' => $iconMap[$currentStatus],
                    'color' => $colorMap[$currentStatus],
                    'status_text' => 'Dilakukan',
                    'datetime' => $currentDatetime,
                    'duration' => $duration,
                ];
            }
        }


        return view('admin.detail', compact('transaksi', 'timeline'));
    }

    /**
     * Memperbarui Status Transaksi.
     */
    public function updateStatus(Request $request, $idTrx)
    {
        $rules = [
            'status' => 'required|integer|in:1,2,3,4,5,6,7,8',
        ];
        
        // Hanya validasi pesan_penolakan untuk status 5 (Ditolak)
        if ($request->status == 5) {
            $rules['pesan_penolakan'] = 'required|string|max:1000';
        }
        if ($request->status == 8) {
            $rules['pesan_batal'] = 'required|string|max:1000';
        }
        if ($request->status == 4) {
            $rules['pesan_selesai'] = 'nullable|string|max:1000';
        }

        $request->validate($rules);

        $transaksi = Transaksi::where('id_trx', $idTrx)->firstOrFail();

        $oldStatus = $transaksi->status;
        $newStatus = $request->status;

        $transaksi->status = $newStatus;

        // Atur tanggal berdasarkan status
        if ($newStatus == 2) { // Verifikasi
            $transaksi->tgl_respon = now();
        } elseif ($newStatus == 3) { // Proses
            $transaksi->tgl_proses = now();
        } elseif ($newStatus == 4) { // Selesai
            $transaksi->tgl_selesai = now();
            $transaksi->pesan = $request->pesan_selesai;
        } elseif ($newStatus == 5) { // Ditolak
            $transaksi->updated_at = now();
            $transaksi->pesan = $request->pesan_penolakan;
        } elseif ($newStatus == 8) { // Dibatalkan
            $transaksi->updated_at = now();
            $transaksi->pesan = $request->pesan_batal;
        }

        $transaksi->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Helper: Menentukan grup filter.
     */
    private function getFilterGroups()
    {
        return [
            'KIA' => 'KIA',
            'KTP' => 'KTP',
            // 'KK'  => 'KK',
            'Kartu Keluarga' => 'Perubahan Data KK',
            'Pindah' => 'Pindah',
            'Datang' => 'Datang',
            'Akta Kelahiran' => 'Akta Kelahiran',
            'Akta Kematian' => 'Akta Kematian',
            'Akta Perkawinan' => 'Akta Perkawinan',
            'Akta Perceraian' => 'Akta Perceraian',
            // tambahkan grup lain jika perlu
        ];
    }
}

