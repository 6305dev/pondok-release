<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SinkronisasiController extends Controller
{
    public function transaksi()
    {
        // Cari NIK yang memiliki lebih dari 1 transaksi
        $duplicateNiks = Transaksi::select('nik')
            ->groupBy('nik')
            ->havingRaw('count(*) > 1')
            ->pluck('nik');

        // Tarik detail transaksinya
        $transaksi = Transaksi::whereIn('nik', $duplicateNiks)
            ->with(['user', 'kecamatan', 'desa'])
            ->orderBy('nik')
            ->orderBy('tgl', 'desc')
            ->paginate(10);

        return view('admin.sinkronisasi.transaksi', compact('transaksi'));
    }

    public function hapusTransaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Ambil atribut mentah
        $data = $transaksi->getAttributes();

        // Tambah field deleted_at
        $data['deleted_at'] = now();

        // Pastikan model transaksi_backup siap diisi
        // Gunakan Query Builder agar kompatibel langsung dengan getAttributes()
        DB::table('transaksi_backup')->insert($data);

        // Hapus dari tabel transaksi utama
        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus dan dipindahkan ke Riwayat Hapus.');
    }

    public function wilayah()
    {
        // Cari user yang id_kec-nya kosong/null (bukan admin)
        $users = User::where(function($query) {
                $query->whereNull('id_kec')
                      ->orWhere('id_kec', '');
            })
            ->where('role_id', '!=', 1) // Kecualikan administrator utama
            ->orderBy('name')
            ->paginate(10);

        return view('admin.sinkronisasi.wilayah', compact('users'));
    }

    public function riwayat()
    {
        // Ambil data transaksi_backup
        $backups = DB::table('transaksi_backup')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('admin.sinkronisasi.riwayat', compact('backups'));
    }

    public function restoreTransaksi($id)
    {
        $backup = DB::table('transaksi_backup')->where('id_trx', $id)->first();
        if (!$backup) {
            return redirect()->back()->with('error', 'Data backup transaksi tidak ditemukan.');
        }

        // Konversi objek ke array
        $data = (array)$backup;

        // Buang field deleted_at
        unset($data['deleted_at']);

        // Kembalikan ke tabel utama
        DB::table('transaksi')->insert($data);

        // Hapus dari tabel backup
        DB::table('transaksi_backup')->where('id_trx', $id)->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dikembalikan ke tabel utama.');
    }
}
