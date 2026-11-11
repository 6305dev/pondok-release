<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan seeder database aplikasi.
     */
    public function run(): void
    {
        $this->call([
            PersyaratanUmumSeeder::class,
            SlideSeeder::class,
        ]);
    }
}
