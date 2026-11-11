<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Proxy Terpercaya
    |--------------------------------------------------------------------------
    |
    | Saat aplikasi berjalan di balik reverse proxy (nginx, Apache, load
    | balancer dsb.), isi TRUSTED_PROXIES agar Laravel memercayai header
    | X-Forwarded-* dan rate limiter (login, OTP) mengenali IP asli
    | pengunjung — bukan IP proxy yang dipakai bersama semua pengunjung.
    |
    | Gunakan daftar IP proxy (mis. '127.0.0.1,10.0.0.5') atau '*' bila
    | seluruh trafik dipastikan melewati proxy terpercaya. Kosongkan
    | bila aplikasi terpapar langsung ke internet.
    |
    */

    'proxies' => env('TRUSTED_PROXIES') ?: null,

];
