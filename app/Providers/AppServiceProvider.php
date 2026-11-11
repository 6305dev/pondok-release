<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiters();
    }

    /**
     * Rate limiter bernama untuk endpoint yang rawan brute force.
     *
     * Catatan: throttle anonim (`throttle:5,1`) berbagi satu bucket per-IP
     * lintas endpoint karena key-nya hanya domain|ip. Limiter bernama
     * memberi bucket terpisah per endpoint sehingga batasnya presisi.
     */
    protected function configureRateLimiters(): void
    {
        // Login: 10 percobaan/menit per IP — pertahanan berlapis di balik
        // Turnstile (Turnstile otomatis nonaktif di lingkungan development).
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        // Form aktivasi OTP (POST): 5 percobaan/menit per IP.
        RateLimiter::for('activation', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Kirim ulang OTP: 3 permintaan/menit per IP.
        RateLimiter::for('otp-resend', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        // Tautan aktivasi dari email (GET, OTP ada di URL): 10 kali/menit
        // per IP — cukup untuk klik ulang wajar, terlalu sedikit untuk menebak.
        RateLimiter::for('activation-link', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });
    }
}
