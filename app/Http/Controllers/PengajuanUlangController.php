<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaksi;
use App\Models\UserSyarat;
use Exception;

class PengajuanUlangController extends Controller
{
    /**
     * Submit pengajuan ulang
     */
    public function submitForm(Request $request)
    {
        DB::beginTransaction();
        try {
            // ✅ Validasi sesuai field yang dikirim Blade
            $request->validate([
                'nik'                => 'required|string|size:16',
                'kk'                 => 'required|string|size:16',
                'nama'               => 'required|string|max:255',
                'trx_id'             => 'required|string',
                'mode'               => 'required|in:edit',
                'jenis_layanan'      => 'required|array|min:1',
                'jenis_layanan.*'    => 'required|string',
                'pengambilan_id'     => 'required|exists:pengambilan,id',
                'isi_informasi'      => 'required|string',
                'file'               => 'nullable|array',
                'file.*'             => 'file|mimes:jpg,jpeg,png|max:2048',
                'existing_files'     => 'nullable|array',
                'existing_files.*'   => 'string',
                'file_selfie'        => 'nullable|string', // base64 atau path
                'signature'          => 'nullable|string', // base64 atau path
            ]);

            // ✅ Cari transaksi
            $transaksi = Transaksi::where('id_trx', $request->trx_id)
                ->where('status', 5)
                ->firstOrFail();

            // ✅ Decode id_dokumen jika JSON string
            $selectedLayanan = $request->jenis_layanan; // array dari checkbox

            // ✅ Update data transaksi
            $transaksi->update([
                'nik'               => $request->nik,
                'kk'                => $request->kk,
                'nama'              => $request->nama,
                'id_dokumen'        => json_encode(array_map('strval', $selectedLayanan)), // simpan sebagai JSON array
                'pengambilan_id'    => $request->pengambilan_id,
                'keterangan'        => $request->keterangan ?? $request->isi_informasi,
                'keterangan_user'   => $request->isi_informasi,
                'status'            => 6, // Status: Diajukan Ulang
                'tgl'               => now(),
            ]);

            // ============================================
            // ✅ HANDLE FILE LAMPIRAN (PERSYARATAN)
            // ============================================
            $existingFiles = $request->existing_files ?? [];
            $oldFiles = $transaksi->files; // relasi files

            // 1. Hapus file lama yang TIDAK ada di existing_files (artinya dihapus user)
            foreach ($oldFiles as $oldFile) {
                if (!in_array($oldFile->file, $existingFiles)) {
                    // Hapus file fisik
                    Storage::disk('local')->delete($oldFile->file);
                    // Hapus record database
                    $oldFile->delete();
                }
            }

            // 2. Simpan file BARU yang di-upload
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $path = $file->store('uploads/persyaratan', 'local');
                    
                    UserSyarat::create([
                        'id_trx' => $transaksi->id_trx,
                        'file'   => $path,
                        'kategori' => 'persyaratan', // jika ada kolom kategori
                    ]);
                }
            }

            // ============================================
            // ✅ HANDLE SELFIE
            // ============================================
            if ($request->filled('file_selfie')) {
                $selfieData = $request->file_selfie;
                
                // Jika base64 (dari kamera), simpan sebagai file
                if (str_starts_with($selfieData, 'data:image')) {
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $selfieData));
                    $selfiePath = 'uploads/selfie/' . $transaksi->id_trx . '_' . time() . '.jpg';
                    Storage::disk('local')->put($selfiePath, $imageData);
                    $transaksi->update(['selfie_path' => $selfiePath]);
                }
                // Jika path lama (tidak berubah), biarkan
            }

            // ============================================
            // ✅ HANDLE SIGNATURE
            // ============================================
            if ($request->filled('signature')) {
                $sigData = $request->signature;
                
                // Jika base64 (dari canvas), simpan sebagai file
                if (str_starts_with($sigData, 'data:image')) {
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $sigData));
                    $sigPath = 'uploads/signature/' . $transaksi->id_trx . '_' . time() . '.png';
                    Storage::disk('local')->put($sigPath, $imageData);
                    $transaksi->update(['signature_path' => $sigPath]);
                }
            }

            DB::commit();

            // ✅ Response JSON sesuai ekspektasi Blade
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan ulang berhasil dikirim. Silakan tunggu proses verifikasi.',
                'id_trx'  => $transaksi->id_trx,
            ]);

        } catch (Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'errors'  => method_exists($e, 'errors') ? $e->errors() : null,
            ], 500);
        }
    }

    /**
     * Hapus file (opsional - jika ingin hapus via AJAX)
     */
    public function hapusFile($id)
    {
        try {
            $file = UserSyarat::findOrFail($id);

            // Hanya pemilik transaksi atau staf yang boleh menghapus berkas
            $user = Auth::user();
            $isStaff = in_array($user->role_id, [1, 3, 4]);
            $transaksi = Transaksi::where('id_trx', $file->id_trx)->first();
            $isOwner = $transaksi && (int) $transaksi->id_user === (int) $user->id;

            if (! $isStaff && ! $isOwner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki hak akses untuk berkas ini.'
                ], 403);
            }

            // Hapus file fisik
            Storage::disk('local')->delete($file->file);

            // Hapus dari database
            $file->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'File berhasil dihapus.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus file.'
            ], 500);
        }
    }
}