<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MigrateStoragePrivate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:migrate-private';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate all existing uploaded files from storage/app/public to storage/app/private';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceDir = storage_path('app/public');
        $targetDir = storage_path('app/private');

        if (!File::exists($sourceDir)) {
            $this->error("Folder storage/app/public tidak ditemukan.");
            return Command::FAILURE;
        }

        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true, true);
        }

        $this->info("Memulai proses migrasi file dari storage/app/public ke storage/app/private...");

        // Ambil semua file secara rekursif
        $files = File::allFiles($sourceDir);
        $count = 0;

        foreach ($files as $file) {
            $relativePath = $file->getRelativePathname();
            
            // Skip file bawaan jika ada, misal .gitignore
            if ($relativePath === '.gitignore') {
                continue;
            }

            $sourceFile = $file->getRealPath();
            $targetFile = $targetDir . '/' . $relativePath;

            // Buat direktori tujuan jika belum ada
            $directory = dirname($targetFile);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            // Copy file ke target
            File::copy($sourceFile, $targetFile);
            $this->line("Menyalin: public/{$relativePath} -> private/{$relativePath}");
            $count++;
        }

        $this->info("Migrasi selesai! Berhasil menyalin {$count} file.");
        $this->comment("Catatan: File di storage/app/public tidak dihapus secara otomatis demi keamanan. Anda dapat menghapusnya secara manual jika sudah memastikan semuanya berjalan dengan baik.");

        return Command::SUCCESS;
    }
}
