<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersyaratanUmumSeeder extends Seeder
{
    /**
     * Data persyaratan umum per layanan.
     * Sebelumnya diseed runtime oleh PengajuanController::ensurePersyaratanUmumTableExists().
     */
    public function run(): void
    {
        if (DB::table('persyaratan_umum')->count() > 0) {
            return;
        }

        $now = now();
        $rows = [
            ['layanan' => 'Kartu Keluarga', 'deskripsi_syarat' => "1. KK Lama/Rusak (Untuk Perubahan Data)\n2. Buku Nikah / Kutipan Akta Perkawinan\n3. Surat Keterangan Pindah (Untuk Pendatang)\n4. Dokumen Pendukung Elemen Data (Ijazah, Akta Lahir, dll)", 'deskripsi_output' => "1. Kartu Keluarga (KK) Baru\n2. KTP/KIA jika ada perubahan data dalam Kartu Keluarga"],
            ['layanan' => 'KTP', 'deskripsi_syarat' => "1. Kartu Keluarga (KK)\n2. KTP Lama/Rusak (Untuk Perubahan/Rusak)\n3. Surat Keterangan Hilang Kepolisian (Jika Hilang)\n4. Sudah melakukan perekaman KTP-el", 'deskripsi_output' => "1. KTP-el Baru\n2. Kartu Keluarga (KK) Baru jika ada perubahan data"],
            ['layanan' => 'KIA', 'deskripsi_syarat' => "1. Kartu Keluarga (KK)\n2. Akta Kelahiran Anak\n3. Foto Anak ukuran 3x4 (Untuk anak usia 5-17 tahun)", 'deskripsi_output' => "1. KIA (Kartu Identitas Anak) Baru\n2. Kartu Keluarga (KK) Baru jika ada perubahan data"],
            ['layanan' => 'Pindah', 'deskripsi_syarat' => "1. Kartu Keluarga (KK)\n2. KTP-el Pemohon\n3. Alamat tujuan pindah yang jelas", 'deskripsi_output' => "1. Surat Keterangan Pindah WNI (SKPWNI)\n2. Kartu Keluarga (KK) Baru bagi anggota keluarga yang tinggal"],
            ['layanan' => 'Datang', 'deskripsi_syarat' => "1. Surat Keterangan Pindah WNI (SKPWNI) dari daerah asal\n2. KTP-el daerah asal\n3. Surat Pernyataan Domisili/Menumpang KK", 'deskripsi_output' => "1. Kartu Keluarga (KK) Baru\n2. KTP-el Baru dengan alamat baru\n3. KIA Baru dengan alamat baru"],
            ['layanan' => 'Akta Kelahiran', 'deskripsi_syarat' => "1. Surat Keterangan Lahir dari Bidan/Rumah Sakit\n2. Kartu Keluarga (KK)\n3. Buku Nikah/Kutipan Akta Perkawinan Orang Tua\n4. KTP-el Orang Tua", 'deskripsi_output' => "1. Akta Kelahiran\n2. Kartu Keluarga (KK) Baru dengan penambahan anak\n3. KIA Baru bagi anak baru lahir"],
            ['layanan' => 'Akta Kematian', 'deskripsi_syarat' => "1. Surat Keterangan Kematian dari Dokter/Kepala Desa\n2. Kartu Keluarga (KK) Jenazah\n3. KTP-el Jenazah (Jika ada)\n4. KTP-el Pelapor", 'deskripsi_output' => "1. Akta Kematian\n2. Kartu Keluarga (KK) Baru dengan penghapusan anggota yang meninggal\n3. KTP dengan status Baru bagi suami/istri yang ditinggalkan"],
            ['layanan' => 'Akta Perkawinan', 'deskripsi_syarat' => "1. Surat Keterangan Kawin dari Pemuka Agama\n2. Akta Kelahiran Suami & Istri\n3. Kartu Keluarga (KK) & KTP-el Suami & Istri\n4. Pas Foto Berdampingan", 'deskripsi_output' => "1. Kutipan Akta Perkawinan\n2. Kartu Keluarga (KK) & KTP-el Baru dengan status Kawin"],
            ['layanan' => 'Akta Perceraian', 'deskripsi_syarat' => "1. Putusan Pengadilan Negeri/Kepaniteraan Pengadilan\n2. Akta Perkawinan Asli\n3. Kartu Keluarga (KK) & KTP-el", 'deskripsi_output' => "1. Kutipan Akta Perceraian\n2. Kartu Keluarga (KK) & KTP-el Baru dengan status Cerai Hidup"],
        ];

        foreach ($rows as $row) {
            DB::table('persyaratan_umum')->insert(array_merge($row, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
