<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Transaksi;
use App\Models\UserSyarat;
use App\Models\JenisPelayanan;
use App\Models\Pengambilan;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;

class PengajuanController extends Controller
{
    /**
     * Tampilkan formulir pengajuan.
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('form_pengajuan');
    }

    /**
     * Ambil jenis layanan berdasarkan filter 'keterangan' menggunakan Eloquent.
     * @param string $keteranganFilter
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJenisLayananByKeterangan($keteranganFilter)
    {
        $jenisPelayanan = JenisPelayanan::where('keterangan', $keteranganFilter)
                                        ->orWhereIn('keterangan', ['KK', 'KTP'])
                                        ->orderBy('id', 'asc')
                                        ->get();

        return response()->json($jenisPelayanan);
    }

    /**
     * Ambil opsi pengambilan dokumen menggunakan Eloquent.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPengambilanDokumen()
    {
        $data = Pengambilan::select('id', 'nama')
                            ->orderBy('nama', 'asc')
                            ->get();

        return response()->json($data);
    }

    /**
     * Proses data yang dikirim dari formulir.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitForm(Request $request)
    {
        DB::beginTransaction();

        // Normalisasi input jenis_layanan jika dikirim berupa string tunggal
        if ($request->has('jenis_layanan') && !is_array($request->jenis_layanan)) {
            $request->merge([
                'jenis_layanan' => [$request->jenis_layanan]
            ]);
        }

        // Validasi input dasar
        $request->validate([
            'nik' => 'required|digits:16',
            'kk'  => 'required|digits:16',
            'nama' => 'required',
            'jenis_layanan' => 'required|array', 
            'pengambilan_id' => 'required|exists:pengambilan,id',
        ]);

        try {
            $user = Auth::user();
            $userId = $user ? $user->id : null;

            if ($request->nik === $request->kk) {
                return response()->json([
                    'success' => false,
                    'message' => 'NIK dan Nomor KK tidak boleh sama!'
                ], 422);
            }

            $pengambilanId = $request->input('pengambilan_id', $request->input('pengambilan'));

            $selfiePath = null;
            $signaturePath = null;

            // Jika mode EDIT, ambil path lama terlebih dahulu
            if ($request->filled('mode') && $request->mode === 'edit' && $request->filled('trx_id')) {
                $transaksiLama = Transaksi::where('id_trx', $request->trx_id)->where('status', 5)->first();
                if ($transaksiLama) {
                    $selfiePath = $transaksiLama->selfie_path;
                    $signaturePath = $transaksiLama->signature_path;
                }
            }

            // 2. Proses Base64 untuk File Selfie
            if ($request->filled('file_selfie') && (!str_contains($request->file_selfie, 'http') || str_contains($request->file_selfie, 'base64'))) {
                $base64 = $request->file_selfie;
                if (preg_match('/^data:image\/(\w+);base64,/', $base64, $matches)) {
                    $extension = $matches[1];
                    $data = substr($base64, strpos($base64, ',') + 1);
                    $decoded = base64_decode($data);
                    if ($decoded !== false) {
                        if (isset($transaksiLama) && $transaksiLama && $transaksiLama->selfie_path) {
                            Storage::disk('local')->delete($transaksiLama->selfie_path);
                        }
                        $filename = 'selfie_' . Str::uuid() . '.' . $extension;
                        $selfiePath = 'selfie/' . $filename; 
                        Storage::disk('local')->put($selfiePath, $decoded);
                    }
                }
            }

            // 3. Proses Base64 untuk File Signature
            if ($request->filled('signature') && (!str_contains($request->signature, 'http') || str_contains($request->signature, 'base64'))) {
                $base64 = $request->signature;
                if (preg_match('/^data:image\/png;base64,/', $base64)) {
                    $data = substr($base64, strpos($base64, ',') + 1);
                    $decoded = base64_decode($data);
                    if ($decoded !== false) {
                        if (isset($transaksiLama) && $transaksiLama && $transaksiLama->signature_path) {
                            Storage::disk('local')->delete($transaksiLama->signature_path);
                        }
                        $filename = 'signature_' . Str::uuid() . '.png';
                        $signaturePath = 'signature/' . $filename; 
                        Storage::disk('local')->put($signaturePath, $decoded);
                    }
                }
            }

            // 🌟 STEP 1: GENERATE ID TRX (HANYA SATU KALI Saja di luar loop)
            $idTrx = (new Transaksi())->generateIdTrx();

            // 🌟 STEP 2: UBAH ARRAY KE JSON STRING UNTUK FIELD ID_DOKUMEN
            // Hasilnya akan berupa string JSON murni: ["2","4"]
            $idDokumenJson = json_encode($request->jenis_layanan);

            if ($request->filled('mode') && $request->mode === 'edit' && $request->filled('trx_id')) {
                // --- MODE EDIT ---
                $transaksi = Transaksi::where('id_trx', $request->trx_id)->where('status', 5)->first();
                if ($transaksi) {
                    $transaksi->update([
                        'nik'            => $request->nik,
                        'kk'             => $request->kk,
                        'nama'           => $request->nama,
                        'keterangan'     => $request->isi_informasi,
                        'id_dokumen'     => $idDokumenJson, // Simpan format JSON array murni
                        'pengambilan_id' => $pengambilanId,
                        'selfie_path'    => $selfiePath ?? $transaksi->selfie_path,
                        'signature_path' => $signaturePath ?? $transaksi->signature_path,
                        'status'         => 6, 
                        'tgl'            => now(), 
                    ]);
                    $finalIdTrx = $transaksi->id_trx;

                    // Hapus file lama yang TIDAK ada di existing_files (artinya dihapus oleh user)
                    $existingFiles = $request->input('existing_files', []);
                    
                    $oldFiles = UserSyarat::where('id_trx', $finalIdTrx)
                                          ->where('file', 'not like', 'selfie/%')
                                          ->where('file', 'not like', 'signature/%')
                                          ->get();

                    foreach ($oldFiles as $oldFile) {
                        if (!in_array($oldFile->file, $existingFiles)) {
                            Storage::disk('local')->delete($oldFile->file);
                            $oldFile->delete();
                        }
                    }
                }
            } else {
                // --- MODE BARU (Hanya membuat 1 Record tunggal) ---
                $transaksi = Transaksi::create([
                    'id_trx'         => $idTrx,
                    'id_user'        => $userId,
                    'nik'            => $request->nik,
                    'kk'             => $request->kk,
                    'nama'           => $request->nama,
                    'id_dokumen'     => $idDokumenJson, // Simpan format JSON array murni
                    'keterangan'     => $request->isi_informasi,
                    'id_kec'         => $user->id_kec ?? null,
                    'id_kel'         => $user->kode_desa ?? null,
                    'pengambilan_id' => $pengambilanId,
                    'selfie_path'    => $selfiePath,
                    'signature_path' => $signaturePath,
                    'tgl'            => now(),
                    'status'         => 1,
                ]);
                $finalIdTrx = $idTrx;
            }

            // --- 4. SIMPAN FILE BERKAS PERSYARATAN (Hanya diproses sekali) ---
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    if ($uploadedFile && $uploadedFile->isValid()) {
                        $path = $uploadedFile->store('uploads', 'local');
                        UserSyarat::create([
                            'id_trx' => $finalIdTrx,
                            'file'   => $path,
                        ]);
                    }
                }
            }

            // Simpan log Selfie ke UserSyarat
            if ($selfiePath) {
                UserSyarat::where('id_trx', $finalIdTrx)->where('file', 'like', 'selfie/%')->delete();
                UserSyarat::create([
                    'id_trx' => $finalIdTrx,
                    'file'   => $selfiePath,
                ]);
            }

            // Simpan log Tanda Tangan ke UserSyarat
            if ($signaturePath) {
                UserSyarat::where('id_trx', $finalIdTrx)->where('file', 'like', 'signature/%')->delete();
                UserSyarat::create([
                    'id_trx' => $finalIdTrx,
                    'file'   => $signaturePath,
                ]);
            }

            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Permohonan berhasil disimpan.',
                'id_trx'  => $finalIdTrx, 
            ]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error('Gagal simpan transaksi Pedes:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showBukti($id_trx)
    {
        $transaksi = Transaksi::with(['dokumen', 'pengambilan'])->findOrFail($id_trx);

        // Hanya pemilik transaksi atau staf (Admin 1, Verifikator 3, Operator 4)
        // yang boleh melihat berkas — sebelumnya kondisinya terbalik sehingga
        // user biasa (role 2) bisa membuka bukti transaksi siapa pun.
        if (Auth::id() !== $transaksi->id_user && !in_array(Auth::user()?->role_id, [1, 3, 4])) {
            abort(403);
        }

        // Mengambil data file murni berkas persyaratan murni
        $files = UserSyarat::where('id_trx', $id_trx)
                            ->where('file', 'not like', 'selfie/%')
                            ->where('file', 'not like', 'signature/%')
                            ->get();

        return view('bukti', compact('transaksi', 'files'));
    }

    public function showEditForm($id_trx)
    {
        $transaksi = Transaksi::with(['files', 'dokumen', 'pengambilan'])
            ->where('id_trx', $id_trx)
            ->firstOrFail();

        if ($transaksi->status != 5) {
            abort(403, 'Hanya transaksi yang ditolak yang bisa diajukan ulang.');
        }

        // Decode id_dokumen to determine the category code
        $rawLayanan = $transaksi->id_dokumen;
        $ids = is_array($rawLayanan) ? $rawLayanan : json_decode($rawLayanan, true);
        if (!is_array($ids)) {
            $ids = ($ids !== null && $ids !== '') ? [$ids] : [];
        }

        // Map main service ID to category code
        $category = 'KTP'; // default fallback
        if (in_array('6', $ids)) $category = 'ALH';
        elseif (in_array('7', $ids)) $category = 'AMT';
        elseif (in_array('5', $ids)) $category = 'DTG';
        elseif (in_array('4', $ids)) $category = 'PDH';
        elseif (in_array('8', $ids)) $category = 'AKW';
        elseif (in_array('9', $ids)) $category = 'ACR';
        elseif (in_array('3', $ids)) $category = 'KIA';
        elseif (in_array('2', $ids)) $category = 'KTP';
        elseif (in_array('1', $ids)) $category = 'KK';

        $layanan = JenisPelayanan::where('keterangan', $category)->get();
        $pengambilan = Pengambilan::all();

        return view('pengajuan_ulang', compact('transaksi', 'layanan', 'pengambilan', 'category'));
    }

    public function getPersyaratanUmum()
    {
        $data = DB::table('persyaratan_umum')->get();
        return response()->json($data);
    }
}