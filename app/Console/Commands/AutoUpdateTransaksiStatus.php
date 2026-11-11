<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoUpdateTransaksiStatus extends Command
{
    /**
     * Auto-update status transaksi dari Baru (1) ke Verifikasi (2)
     * jika sudah lewat 1 menit sejak diajukan.
     *
     * Sebelumnya logika ini berjalan di Transaksi::booted() pada
     * setiap request GET (full-scan tabel di setiap page load).
     */
    protected $signature = 'transaksi:auto-update-status';

    protected $description = 'Update otomatis status transaksi Baru (1) menjadi Verifikasi (2) setelah 1 menit';

    public function handle(): int
    {
        $expiredIds = DB::table('transaksi')
            ->where('status', 1)
            ->where('tgl', '<=', now()->subMinute())
            ->pluck('id_trx');

        if ($expiredIds->isEmpty()) {
            return self::SUCCESS;
        }

        DB::table('transaksi')
            ->whereIn('id_trx', $expiredIds)
            ->update([
                'status' => 2,
                'tgl_respon' => now(),
            ]);

        // Catat perubahan status secara massal
        $now = now();
        $logs = $expiredIds->map(fn ($idTrx) => [
            'transaksi_id' => $idTrx,
            'status_sebelumnya' => 1,
            'status_baru' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ])->all();

        DB::table('status_logs')->insert($logs);

        $this->info("{$expiredIds->count()} transaksi diperbarui ke status Verifikasi (2).");

        return self::SUCCESS;
    }
}
