<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Auto-update status transaksi Baru (1) -> Verifikasi (2) setiap menit.
// Jalankan scheduler di server produksi melalui cron:
// * * * * * cd /path-ke-proyek && php artisan schedule:run >> /dev/null 2>&1
Schedule::command('transaksi:auto-update-status')->everyMinute();
