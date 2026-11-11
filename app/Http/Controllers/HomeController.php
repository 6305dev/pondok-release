<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi; // ✅ Pastikan ini ada
use App\Models\Jadwal;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Cek status buka/tutup pelayanan
        Carbon::setLocale('id');
        $hariIni = Carbon::now()->isoFormat('dddd');
        $jadwalHariIni = Jadwal::where('hari', $hariIni)->first();

        $isClosed = !jadwal_buka();
        $pesanTutup = '';

        if ($isClosed) {
            $pesanTutup = ($jadwalHariIni && !empty($jadwalHariIni->pesan_tutup))
                ? $jadwalHariIni->pesan_tutup
                : 'Mohon maaf saat ini kami sedang di luar jam layanan, namun Anda tetap dapat melakukan pengajuan layanan.';
        }
        
        if (Auth::check()) {
            // Hitung jumlah transaksi yang belum selesai
            $unreadCount = Transaksi::where('id_user', Auth::user()->id)
                ->where('status', '!=', Transaksi::STATUS_SELESAI)
                ->count();

            // Simpan jumlah ke session
            session(['unread_count' => $unreadCount]);
        } else {
            session(['unread_count' => 0]);
        }

        // Ambil slide yang aktif (tabel & seeder dikelola oleh migrasi/seeder)
        $slides = \App\Models\Slide::where('aktif', 'Y')->orderBy('id', 'asc')->get();

        return view('home', compact('slides', 'isClosed', 'pesanTutup'));
    }
}