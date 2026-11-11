<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'jam_buka',
        'jam_tutup',
        'aktif',
        'pesan_tutup'
    ];

    // Format jam buka/tutup
    public function getJamBukaAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getJamTutupAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    // Cek apakah sekarang sedang buka
    public static function isBuka()
    {
        $now = now();
        $hariIni = $now->isoFormat('dddd'); // Senin, Selasa, dst.

        $jadwalHariIni = self::where('hari', $hariIni)->where('aktif', true)->first();

        if (!$jadwalHariIni) {
            return false; // Hari ini tidak aktif
        }

        $jamSekarang = $now->format('H:i');
        $jamBuka = $jadwalHariIni->jam_buka;
        $jamTutup = $jadwalHariIni->jam_tutup;

        return $jamSekarang >= $jamBuka && $jamSekarang < $jamTutup;
    }

    // Hitung waktu sampai buka kembali (jika tutup)
    public static function waktuBukaKembali()
    {
        $now = now();
        $hariIni = $now->isoFormat('dddd');

        // Cari jadwal hari ini
        $jadwalHariIni = self::where('hari', $hariIni)->where('aktif', true)->first();

        if ($jadwalHariIni && $now->format('H:i') < $jadwalHariIni->jam_buka) {
            // Masih belum buka hari ini
            $waktuBuka = \Carbon\Carbon::createFromTimeString($jadwalHariIni->jam_buka);
            $waktuBuka->setDate($now->year, $now->month, $now->day);
            return $now->diff($waktuBuka);
        }

        // Cari hari berikutnya yang aktif
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $indexHariIni = array_search($hariIni, $hari);

        for ($i = 1; $i <= 7; $i++) {
            $index = ($indexHariIni + $i) % 7;
            $hariBerikutnya = $hari[$index];
            $jadwalBerikutnya = self::where('hari', $hariBerikutnya)->where('aktif', true)->first();

            if ($jadwalBerikutnya) {
                $waktuBuka = \Carbon\Carbon::createFromTimeString($jadwalBerikutnya->jam_buka);
                $waktuBuka->setDate($now->year, $now->month, $now->day + $i);
                return $now->diff($waktuBuka);
            }
        }

        return null; // Tidak ada hari aktif
    }
}