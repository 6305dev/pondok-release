<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\PengajuanUlangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserBaruController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\KomplainController;
use App\Models\SetupKel;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\FormulirController as AdminFormulirController;
use App\Http\Controllers\Admin\PersyaratanController as AdminPersyaratanController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ForgotPasswordController;

// 1. Halaman minta reset (Tampilan input NIK)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// 2. Proses kirim link reset password ke Email
Route::post('/forgot-password/email', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::post('/forgot-password/whatsapp', [ForgotPasswordController::class, 'sendResetLink'])->name('password.wa');

// 3. Halaman form password baru (saat klik link dari WA)
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// 4. Proses update password ke database
Route::post('/password/reset', [ForgotPasswordController::class, 'updatePassword'])->name('password.update.post');

// === 1. ROUTE YANG SELALU BISA DIAKSES (MESKI JADWAL TUTUP) ===
Route::get('/formulir', [FormulirController::class, 'index'])->name('formulir.index');
Route::get('/formulir/download/{filename}', [FormulirController::class, 'download'])->name('formulir.download');
Route::get('/persyaratan', [PersyaratanController::class, 'index'])->name('persyaratan.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
// Rate limit login: pertahanan berlapis di balik Turnstile (Turnstile otomatis
// nonaktif di lingkungan development, jadi throttle ini satu-satunya penjaga).
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware(['guest', 'turnstile', 'throttle:login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register')->middleware(['guest', 'turnstile']);

// Rute Aktivasi Mandiri via WhatsApp OTP
Route::get('/activate', [\App\Http\Controllers\Auth\ActivationController::class, 'showForm'])->name('activate.form');
// OTP hanya 6 digit — throttle per-IP mencegah brute force massal lewat form
Route::post('/activate', [\App\Http\Controllers\Auth\ActivationController::class, 'activate'])->middleware('throttle:activation')->name('activate.confirm');
Route::post('/activate/resend', [\App\Http\Controllers\Auth\ActivationController::class, 'resend'])->middleware('throttle:otp-resend')->name('activate.resend');
// Link berisi OTP di URL juga bisa di-brute force — batasi percobaan per-IP
Route::get('/activate/link/{nik}/{otp}', [\App\Http\Controllers\Auth\ActivationController::class, 'directActivate'])->middleware('throttle:activation-link')->name('activate.link');

Route::get('/desa', [LocationController::class, 'getDesa'])->name('get.desa');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::post('/cek-status', [TransaksiController::class, 'cekStatus'])->name('cek.status');
Route::get('/api/persyaratan-umum', [PengajuanController::class, 'getPersyaratanUmum'])->name('api.persyaratan.umum');
Route::get('/api/formulir-aktif', function() {
    return response()->json(
        \App\Models\Formulir::where('aktif', 'Y')->get(['jenis_formulir', 'ket', 'dokumen'])
    );
})->name('api.formulir.aktif');

// === 2. ROUTE YANG DILINDUNGI JADWAL ===
// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
// Rute yang memerlukan login
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account/avatar', [AccountController::class, 'updateAvatar'])->name('account.updateAvatar');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    
    Route::get('/form_pengajuan', [PengajuanController::class, 'showForm'])->name('form.pengajuan');
    Route::post('/pengajuan/submit', [PengajuanController::class, 'submitForm'])->name('pengajuan.submit');
    Route::get('/api/jenis-layanan/filter/{keterangan}', [PengajuanController::class, 'getJenisLayananByKeterangan']);
    Route::get('/api/pengambilan-dokumen', [PengajuanController::class, 'getPengambilanDokumen'])->name('api.pengambilan.dokumen');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/{id_trx}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
    Route::get('/tracking/{id_trx}', [TrackingController::class, 'show'])->name('tracking.show');
    Route::get('/pengajuan-ulang/{id_trx}', [PengajuanController::class, 'showEditForm'])->name('pengajuan.ulang.form');

    Route::post('/pengajuan-ulang/{id_trx}', [PengajuanUlangController::class, 'submitForm'])->name('pengajuan.ulang.submit');
    Route::delete('/api/hapus-file/{id}', [PengajuanUlangController::class, 'hapusFile'])->name('pengajuan.ulang.hapus.file');
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('/bukti/{id_trx}', [PengajuanController::class, 'showBukti'])->name('bukti');

    // Chat internal (tersimpan di database, tanpa realtime).
    // Throttle menjaga endpoint polling dari flood; 120 req/menit jauh
    // di atas konsumsi normal (12-18 req/menit per tab aktif).
    Route::middleware('throttle:120,1')->group(function () {
        Route::get('/chat-proxy/conversation/{peerId?}', [ChatController::class, 'conversation'])->name('chat.conversation');
        Route::get('/chat-proxy/admin-conversations', [ChatController::class, 'adminConversations'])->name('chat.proxy.admin');
        Route::get('/chat-proxy/unread-count', [ChatController::class, 'unreadCount'])->name('chat.unread');
        Route::post('/chat-proxy/send', [ChatController::class, 'send'])->name('chat.send');
        Route::get('/chat/attachments/{path}', [ChatController::class, 'image'])->name('chat.image');
    });
});

// Rute publik yang dilindungi jadwal (tidak perlu login)
Route::post('/submit-pengajuan', [PengajuanController::class, 'submitForm']);
Route::post('/konfirmasi/{id}', [TransaksiController::class, 'konfirmasi'])->name('api.konfirmasi');
Route::post('/api/nilai/{id}', [TransaksiController::class, 'submitRating'])->name('api.nilai');
Route::post('/api/komplain/{id_trx}', [KomplainController::class, 'store'])->name('komplain.store');

// === 3. RUTE ADMIN (TIDAK TERKENA JADWAL) ===
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware([\App\Http\Middleware\AdminOperatorMiddleware::class])->group(function () {
    Route::get('/pesan', [PesanController::class, 'admin'])->name('admin.pesan.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/transaksi', [DashboardController::class, 'transaksiIndex'])->name('admin.transaksi.index');
    Route::get('/transaksi/{id_trx}', [DashboardController::class, 'show'])->name('admin.transaksi.show');
    Route::post('/transaksi/{id}/update-status', [DashboardController::class, 'updateStatus'])->name('admin.transaksi.update-status');
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('admin.profile.show');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/profile/avatar', [App\Http\Controllers\Admin\ProfileController::class, 'updateAvatar'])->name('admin.profile.updateAvatar');
    Route::get('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'showPasswordForm'])->name('admin.profile.password');
    Route::put('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('admin.profile.updatePassword');
    Route::get('/user-baru', [UserBaruController::class, 'index'])->name('user_baru.index');
    Route::post('/dokumen/upload/{id_trx}', [DokumenController::class, 'upload'])->name('admin.dokumen.upload');
    Route::delete('/dokumen/delete/{id}', [DokumenController::class, 'delete'])->name('admin.dokumen.delete');
    Route::post('/user-baru/action/{id}', [UserBaruController::class, 'action'])->name('user_baru.action');
    Route::post('/user-baru/reset-otp/{id}', [UserBaruController::class, 'resetOtp'])->name('user_baru.reset_otp');
    Route::get('/desa', function (Request $request) {
        $kecamatanId = $request->query('kecamatan_id');
        if (!$kecamatanId) {
            return response()->json([]);
        }
        return response()->json(
            SetupKel::where('kecamatan_id', $kecamatanId)
                ->get(['kode_desa', 'nama'])
        );
    })->name('admin.desa');

        Route::middleware(['admin.only'])->group(function () {
            // Rute Sinkronisasi
            Route::get('/sinkronisasi/transaksi', [\App\Http\Controllers\Admin\SinkronisasiController::class, 'transaksi'])->name('admin.sinkronisasi.transaksi');
            Route::post('/sinkronisasi/transaksi/{id}/hapus', [\App\Http\Controllers\Admin\SinkronisasiController::class, 'hapusTransaksi'])->name('admin.sinkronisasi.transaksi.hapus');
            Route::get('/sinkronisasi/wilayah', [\App\Http\Controllers\Admin\SinkronisasiController::class, 'wilayah'])->name('admin.sinkronisasi.wilayah');
            Route::get('/sinkronisasi/riwayat', [\App\Http\Controllers\Admin\SinkronisasiController::class, 'riwayat'])->name('admin.sinkronisasi.riwayat');
            Route::post('/sinkronisasi/riwayat/{id}/restore', [\App\Http\Controllers\Admin\SinkronisasiController::class, 'restoreTransaksi'])->name('admin.sinkronisasi.riwayat.restore');

            Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::patch('/user/{id}/blokir', [App\Http\Controllers\UserController::class, 'blokir'])->name('admin.user.blokir');
            Route::post('/user/{id}/reset-password', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('admin.user.resetPassword');
            Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');

            Route::get('/jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'index'])->name('admin.jadwal.index');
            Route::get('/jadwal/{id}/edit', [App\Http\Controllers\Admin\JadwalController::class, 'edit'])->name('admin.jadwal.edit');
            Route::put('/jadwal/{id}', [App\Http\Controllers\Admin\JadwalController::class, 'update'])->name('admin.jadwal.update');

            Route::get('/formulir', [AdminFormulirController::class, 'index'])->name('admin.formulir.index');
            Route::get('/formulir/create', [AdminFormulirController::class, 'create'])->name('admin.formulir.create');
            Route::post('/formulir', [AdminFormulirController::class, 'store'])->name('admin.formulir.store');
            Route::get('/formulir/{formulir}/edit', [AdminFormulirController::class, 'edit'])->name('admin.formulir.edit');
            Route::put('/formulir/{formulir}', [AdminFormulirController::class, 'update'])->name('admin.formulir.update');
            Route::delete('/formulir/{formulir}', [AdminFormulirController::class, 'destroy'])->name('admin.formulir.destroy');

            Route::get('/persyaratan', [AdminPersyaratanController::class, 'index'])->name('admin.persyaratan.index');
            Route::get('/persyaratan/create', [AdminPersyaratanController::class, 'create'])->name('admin.persyaratan.create');
            Route::post('/persyaratan', [AdminPersyaratanController::class, 'store'])->name('admin.persyaratan.store');
            Route::get('/persyaratan/{id}/edit', [AdminPersyaratanController::class, 'edit'])->name('admin.persyaratan.edit');
            Route::put('/persyaratan/{id}', [AdminPersyaratanController::class, 'update'])->name('admin.persyaratan.update');
            Route::delete('/persyaratan/{id}', [AdminPersyaratanController::class, 'destroy'])->name('admin.persyaratan.destroy');

            Route::get('/slide', [App\Http\Controllers\Admin\SlideController::class, 'index'])->name('admin.slide.index');
            Route::put('/slide/{id}', [App\Http\Controllers\Admin\SlideController::class, 'update'])->name('admin.slide.update');
        });
    });
});

// === 4. ROUTE DOKUMEN (DIAMANKAN) ===
Route::get('/dokumen/{path}', function ($path) {
    // 1. Cek folder publik (dok_formulir)
    $isPublicForm = str_starts_with($path, 'dok_formulir/');
    
    if (!$isPublicForm) {
        // Wajib login untuk selain formulir publik
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu untuk mengakses file ini.');
        }
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $userId = $user->id;
        $roleId = $user->role_id;
        $hasAccess = false;
        
        // Admin (1), Verifikator (3), dan Operator (4) punya akses penuh
        if (in_array($roleId, [1, 3, 4])) {
            $hasAccess = true;
        } else {
            // User biasa (2)
            if (str_starts_with($path, 'photos/')) {
                // Semua user login bisa melihat foto profil / avatar
                $hasAccess = true;
            } else {
                // Cari relasi transaksi untuk berkas persyaratan (UserSyarat)
                $userSyarat = \App\Models\UserSyarat::where('file', $path)->first();
                if ($userSyarat) {
                    $transaksi = \App\Models\Transaksi::where('id_trx', $userSyarat->id_trx)->first();
                    if ($transaksi && $transaksi->id_user == $userId) {
                        $hasAccess = true;
                    }
                }
                
                // Cari relasi transaksi untuk dokumen hasil (UserDokumen)
                if (!$hasAccess) {
                    $userDokumen = \App\Models\UserDokumen::where('file_path', $path)->first();
                    if ($userDokumen) {
                        $transaksi = \App\Models\Transaksi::where('id_trx', $userDokumen->id_trx)->first();
                        if ($transaksi && $transaksi->id_user == $userId) {
                            $hasAccess = true;
                        }
                    }
                }
                
                // Cari relasi transaksi langsung (Selfie & Signature)
                if (!$hasAccess) {
                    $transaksi = \App\Models\Transaksi::where('selfie_path', $path)
                        ->orWhere('signature_path', $path)
                        ->first();
                    if ($transaksi && $transaksi->id_user == $userId) {
                        $hasAccess = true;
                    }
                }
            }
        }
        
        if (!$hasAccess) {
            abort(403, 'Anda tidak memiliki hak akses untuk dokumen ini.');
        }
    }

    $filePath = storage_path('app/private/' . $path);
    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }
    
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $allowedExtensions = ['pdf', 'jpeg', 'jpg', 'png', 'gif'];
    if (!in_array($extension, $allowedExtensions)) {
        abort(403, 'Format file tidak didukung.');
    }
    
    $disposition = request()->has('download') ? 'attachment' : 'inline';
    
    return response()->file($filePath, [
        'Content-Disposition' => $disposition . '; filename="' . basename($filePath) . '"'
    ]);
})->where('path', '.*')->name('dokumen.show');







