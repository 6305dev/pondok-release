<?php

use App\Models\Jadwal;
use Carbon\Carbon;

if (!function_exists('jadwal_buka')) {
    function jadwal_buka()
    {
        $user = auth()->user();
        // Admin dan operator selalu bisa akses
        if ($user && in_array($user->role_id, [1, 4])) {
            return true;
        }

        Carbon::setLocale('id');
        $hariIni = Carbon::now()->isoFormat('dddd');
        $jadwal = Jadwal::where('hari', $hariIni)->where('aktif', true)->first();

        if (!$jadwal) {
            return false;
        }

        $jamSekarang = Carbon::now()->format('H:i');
        return $jamSekarang >= $jadwal->jam_buka && $jamSekarang < $jadwal->jam_tutup;
    }
}
