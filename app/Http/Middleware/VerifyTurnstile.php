<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyTurnstile
{
    public function handle(Request $request, Closure $next)
    {
        // Lewati verifikasi di environment development (juga local/testing)
        // atau ketika secret key belum dikonfigurasi
        if (app()->environment('development', 'local', 'testing') || empty(config('services.turnstile.secret_key'))) {
            return $next($request);
        }

        $token = $request->input('cf-turnstile-response');

        if (!$token) {
            return back()->withErrors(['captcha' => 'Captcha tidak ditemukan.']);
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('services.turnstile.secret_key'),
            'response' => $token,
            'remoteip' => $request->ip(),
        ]);

        if (!($response->json('success') ?? false)) {
            return back()->withErrors(['captcha' => 'Verifikasi captcha gagal.']);
        }

        return $next($request);
    }
}
