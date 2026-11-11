<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <title>Pondok Dukcapil Tapin</title>
    <link rel="icon" type="image/png" href="{{ asset('icon/logo4_192.webp') }}?v=5">
    
    <!-- PWA Settings -->
    <link rel="manifest" href="{{ asset('manifest.json') }}?v=5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="{{ asset('icon/logo4_192.webp') }}?v=5">
    <meta name="theme-color" content="#3b82f6">

    <!-- WCAG Standard Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (build statis, sebelumnya CDN runtime) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.min.css" integrity="sha512-xtV3HfYNbQXS/1R1jP53KbFcU9WXiSA1RFKzl5hRlJgdOJm4OxHCWYpskm6lN0xp0XtKGpAfVShpbvlFH3MDAA==" crossorigin="anonymous" referrerpolicy="no-refer rer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12.0.3/swiper-bundle.min.css" />
    <style>
        /* WCAG Standard Font Stack */
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        /* Pastikan container swiper tidak overflow */
        .swiper {
            width: 100%;
            height: auto;
        }

        /* Batasi ukuran slide */
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            aspect-ratio: 16 / 9;
            /* Opsional: jaga rasio gambar */
            max-height: 300px;
            /* Sesuaikan sesuai kebutuhan */
        }

        /* Jika slide berisi gambar */
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Penting: agar gambar tidak stretch */
            display: block;
        }

        /* Pagination styling (opsional) */
        .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
            background-color: #9ca3af;
            /* Warna abu-abu muda */
            opacity: 0.8;
            /* Transparansi */
            border-radius: 50%;
            /* Bulat sempurna */
            margin: 0 4px;
            /* Jarak antar titik */
        }

        /* Pagination Aktif */
        .swiper-pagination-bullet-active {
            background-color: #3b82f6;
            /* Biru (warna primary) */
            opacity: 1;
            transform: scale(1.2);
            /* Sedikit lebih besar saat aktif */
        }

    </style>

    @stack('styles')
</head>

<body class="bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/bg.webp') }}');">
    <div class="min-h-screen">
        @yield('content')
    </div>

    @include('layouts.partials.footer-nav')
    @include('layouts.partials.accessibility_widget')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12.0.3/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true
            , slidesPerView: 1
            , spaceBetween: 15
            , breakpoints: {
                640: {
                    slidesPerView: 2
                    , spaceBetween: 30
                }
            }
            , autoplay: {
                delay: 3000
                , disableOnInteraction: false
            , }
            , pagination: {
                el: ".swiper-pagination"
                , clickable: true
            , }
        });

        // Register Service Worker for PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register("{{ asset('sw.js') }}?v=5")
                    .then(reg => console.log('Service Worker registered', reg))
                    .catch(err => console.error('Service Worker registration failed', err));
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
