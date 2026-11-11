<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Slide default halaman depan.
     * Sebelumnya diseed runtime oleh SlideController::ensureSlidesTableExists().
     */
    public function run(): void
    {
        if (Slide::count() > 0) {
            return;
        }

        for ($i = 1; $i <= 4; $i++) {
            Slide::create([
                'id' => $i,
                'filename' => $i . '.jpg',
                'judul' => 'Maklumat ' . $i,
                'aktif' => 'Y',
            ]);
        }
    }
}
