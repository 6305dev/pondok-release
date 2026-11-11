@extends('layouts.app')
@section('content')

<!-- Header Navbar Full Width & Sticky -->
<!-- Header Navbar Full Width & Sticky -->
<header role="banner" class="sticky top-0 z-50 w-full bg-white/90 backdrop-blur-md shadow-md border-b border-gray-200/50 px-4 md:px-8 py-3">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
        <!-- Logo & Brand (Kiri) -->
        <div class="flex items-center space-x-3">
            <a href="/" aria-label="Halaman Utama Disdukcapil Tapin" class="focus:outline-none focus:ring-2 focus:ring-blue-600 rounded-lg p-1 flex items-center space-x-2">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo Kabupaten Tapin" class="h-10 md:h-12 w-auto object-contain">
                <img src="{{ asset('icon/jargon2.webp') }}" alt="Logo Disdukcapil Kabupaten Tapin" class="h-10 md:h-12 w-auto object-contain">
            </a>
        </div>

        <!-- Tombol Pasang Aplikasi (Kanan) -->
        <div id="install-pwa-container" class="hidden">
            <button id="install-pwa-btn" type="button" aria-label="Pasang Aplikasi PWA" class="inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2 px-4 md:py-2.5 md:px-5 rounded-full shadow-lg transform transition duration-200 hover:scale-105 active:scale-95 text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5 animate-bounce">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Install Aplikasi</span>
            </button>
        </div>
    </div>
</header>

<main id="main-content" class="max-w-6xl mx-auto px-4 py-6">

    <!-- Skeleton Loading State (WCAG Accessible Placeholder) -->
    <div id="home-skeleton" class="space-y-6 animate-pulse" aria-busy="true" aria-live="polite" aria-label="Memuat Konten Beranda">
        <span class="sr-only">Sedang memuat konten halaman utama...</span>
        
        <!-- Slider Skeleton -->
        <div class="w-full h-48 sm:h-64 md:h-72 bg-gray-300/80 rounded-2xl shadow-lg"></div>
        
        <!-- Grid Menu Skeleton -->
        <div class="bg-white/20 backdrop-blur-md rounded-2xl shadow-md border border-white/20 p-4 md:p-6">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                @for($i = 0; $i < 6; $i++)
                <div class="flex flex-col items-center justify-center p-4 bg-white/10 rounded-xl space-y-3">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-300/50 rounded-full"></div>
                    <div class="h-4 w-20 bg-gray-300/50 rounded-md"></div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Banner Identitas Instansi Skeleton -->
        <div class="p-6 flex flex-col items-center space-y-3">
            <div class="h-8 w-48 bg-gray-300/50 rounded-md"></div>
            <div class="h-4 w-64 bg-gray-300/50 rounded-md"></div>
        </div>
    </div>

    <!-- Main Real Content Container -->
    <div id="home-real-content" class="hidden transition-opacity duration-300">
        @if(isset($slides) && $slides->count() > 0)
        <section aria-label="Galeri Informasi" class="mb-6">
            <div class="swiper mySwiper rounded-2xl shadow-xl overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($slides as $slide)
                    <div class="swiper-slide flex justify-center">
                        <a href="{{ asset('images/' . $slide->filename) }}" data-src="{{ asset('images/' . $slide->filename) }}" aria-label="Lihat foto {{ $slide->judul }}" class="lightbox-link relative w-full h-full block focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <img src="{{ asset('images/' . $slide->filename) }}" class="w-full h-full object-cover" alt="{{ $slide->judul ?? 'Informasi Disdukcapil Tapin' }}" onerror="this.closest('.swiper-slide').remove(); if(typeof swiper !== 'undefined') swiper.update();">
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        @endif

        <section aria-label="Menu Utama Layanan" class="mt-6 bg-white/20 backdrop-blur-sm rounded-2xl shadow-sm border border-white/50 p-4 md:p-6">
            <h2 class="sr-only">Menu Utama Layanan</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                {{-- Layanan Online --}}
                <a href="{{ route('layanan.index') }}" id="layanan-online-link" class="flex flex-col items-center justify-center p-4 bg-white/70 rounded-xl shadow hover:shadow-sm transform transition duration-200 hover:scale-105 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <img src="{{ asset('icon/online2.webp') }}" alt="" aria-hidden="true" class="h-12 w-12 md:h-14 md:w-14 object-contain mb-2">
                    <span class="text-sm font-bold text-center text-gray-900">Layanan</span>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-1 text-center whitespace-nowrap">Pengajuan Permohonan</p>
                </a>

                {{-- Formulir --}}
                <a href="/formulir" class="flex flex-col items-center justify-center p-4 bg-white/70 rounded-xl shadow hover:shadow-sm transform transition duration-200 hover:scale-105 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <img src="{{ asset('icon/formulir.webp') }}" alt="" aria-hidden="true" class="h-12 w-12 md:h-14 md:w-14 object-contain mb-2">
                    <span class="text-sm font-bold text-center text-gray-900">Formulir</span>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-1 text-center whitespace-nowrap">Formulir Layanan</p>
                </a>

                {{-- Persyaratan --}}
                <a href="/persyaratan" class="flex flex-col items-center justify-center p-4 bg-white/70 rounded-xl shadow hover:shadow-sm transform transition duration-200 hover:scale-105 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <img src="{{ asset('icon/syarat1.webp') }}" alt="" aria-hidden="true" class="h-12 w-12 md:h-14 md:w-14 object-contain mb-2">
                    <span class="text-sm font-bold text-center text-gray-900">Persyaratan</span>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-1 text-center whitespace-nowrap">Syarat dan Ketentuan</p>
                </a>

                {{-- Tutorial --}}
                <button id="tutorial-btn" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="video-modal" class="flex flex-col items-center justify-center p-4 bg-white/70 rounded-xl shadow hover:shadow-sm transform transition duration-200 hover:scale-105 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <img src="{{ asset('icon/Tutorial1.webp') }}" alt="" aria-hidden="true" class="h-12 w-12 md:h-14 md:w-14 object-contain mb-2">
                    <span class="text-sm font-bold text-center text-gray-900">Tutorial</span>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-1 text-center whitespace-nowrap">Video Penggunaan</p>
                </button>

                {{-- SKM --}}
                <a href="https://skm.go.id/share/instansi/98445cc2-e8f5-445f-b27d-036005f06e3d/1" target="_blank" rel="noopener noreferrer" aria-label="Survei Kepuasan Masyarakat (SKM) - Buka di tab baru" class="flex flex-col items-center justify-center p-4 bg-white/70 rounded-xl shadow hover:shadow-sm transform transition duration-200 hover:scale-105 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <img src="{{ asset('icon/konsultasi.webp') }}" alt="" aria-hidden="true" class="h-12 w-12 md:h-14 md:w-14 object-contain mb-2">
                    <span class="text-sm font-bold text-center text-gray-900">SKM</span>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-1 text-center whitespace-nowrap">Penilaian</p>
                </a>

                {{-- Login / Logout --}}
                @auth
                <a href="{{ route('logout') }}" aria-label="Keluar Akun" class="flex flex-col items-center justify-center p-4 bg-white/70 rounded-xl shadow hover:shadow-sm transform transition duration-200 hover:scale-105 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('icon/Logout1.webp') }}" alt="" aria-hidden="true" class="h-12 w-12 md:h-14 md:w-14 object-contain mb-2">
                    <span class="text-sm font-bold text-center text-gray-900">Logout</span>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-1 text-center whitespace-nowrap">Masuk/Daftar</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" aria-label="Masuk Akun" class="flex flex-col items-center justify-center p-4 bg-white/70 rounded-xl shadow hover:shadow-sm transform transition duration-200 hover:scale-105 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <img src="{{ asset('icon/login.webp') }}" alt="" aria-hidden="true" class="h-12 w-12 md:h-14 md:w-14 object-contain mb-2">
                    <span class="text-sm font-bold text-center text-gray-900">Login</span>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-1 text-center whitespace-nowrap">Masuk/Daftar</p>
                </a>
                @endauth
            </div>
        </section>

        <section aria-label="Identitas Instansi" class="mt-6 text-center p-5 md:p-8">
            <style>
                .merah {
                    color: #1d4ed8; /* WCAG compliant blue contrast >= 4.5:1 */
                    font-weight: bold;
                }

                .biru {
                    color: #15803d; /* WCAG compliant green contrast >= 4.5:1 */
                    font-weight: bold;
                }

                .hijau {
                    color: #c2410c; /* WCAG compliant dark orange contrast >= 4.5:1 */
                    font-weight: bold;
                }

                .kuning {
                    color: #b91c1c; /* WCAG compliant red contrast >= 4.5:1 */
                    font-weight: bold;
                }
            </style>
            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold leading-tight tracking-wide">
                    <span class="merah">DIS</span><span class="biru">DUK</span><span class="hijau">CA</span><span class="kuning">PIL</span>
                </h1>
                <p class="text-xs sm:text-sm md:text-base text-gray-800 font-semibold mt-2 leading-relaxed">
                    <span class="merah">P</span>elayanan <span class="biru">On</span>line
                    <span class="hijau">Do</span>kumen <span class="kuning">K</span>ependudukan
                </p>
            </div>
        </section>
    </div>
</main>

{{-- HTML MODAL VIDEO TUTORIAL --}}
<div id="video-modal" role="dialog" aria-modal="true" aria-labelledby="video-modal-title" class="fixed inset-0 z-[100] overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-full p-4 text-center">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-40" id="video-modal-bg"></div>
        <div class="inline-block align-middle bg-white rounded-lg overflow-hidden shadow-xl 
                    transform transition-all sm:my-8 sm:align-middle w-[92%] max-w-[380px] relative z-50">
            <!-- Header Modal -->
            <div class="bg-gray-50 px-4 py-3 flex justify-between items-center border-b">
                <h3 id="video-modal-title" class="text-md font-bold text-gray-900">Video Tutorial Penggunaan</h3>
                <button type="button" id="close-video-modal-btn" aria-label="Tutup modal video" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600 rounded text-2xl font-bold p-1">&times;</button>
            </div>
            <!-- Area Video (Iframe YouTube) -->
            <div class="relative pb-[177.78%] h-0 bg-black">
                <iframe id="video-iframe" title="Video Tutorial Penggunaan Layanan Disdukcapil" class="absolute top-0 left-0 w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Skeleton Loader off and reveal real content
        const homeSkeleton = document.getElementById('home-skeleton');
        const homeRealContent = document.getElementById('home-real-content');
        if (homeSkeleton && homeRealContent) {
            homeSkeleton.classList.add('hidden');
            homeRealContent.classList.remove('hidden');
        }

        // Variabel untuk modal video
        const videoModal = document.getElementById('video-modal');
        const tutorialBtn = document.getElementById('tutorial-btn');
        const closeVideoModalBtn = document.getElementById('close-video-modal-btn');
        const videoModalBg = document.getElementById('video-modal-bg');
        const videoIframe = document.getElementById('video-iframe');

        // Event listener untuk modal video tutorial
        if (tutorialBtn && videoModal && videoIframe && closeVideoModalBtn && videoModalBg) {
            tutorialBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // Set source iframe ke link embed YouTube
                videoIframe.src = "https://www.youtube.com/embed/CseWVG2NQjQ?autoplay=1&rel=0";
                videoModal.classList.remove('hidden');
            });

            function hideVideoModal() {
                videoModal.classList.add('hidden');
                videoIframe.src = ""; // Stop video play on close
            }

            closeVideoModalBtn.addEventListener('click', hideVideoModal);
            videoModalBg.addEventListener('click', hideVideoModal);
        }

        // PWA Install Prompt Logic
        let deferredPrompt;
        const installContainer = document.getElementById('install-pwa-container');
        const installBtn = document.getElementById('install-pwa-btn');

        // Detect if device is iOS
        const isIos = () => {
            const userAgent = window.navigator.userAgent.toLowerCase();
            return /iphone|ipad|ipod/.test(userAgent);
        }
        // Detect if app is in standalone mode (already installed)
        const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

        // A. Handle Android/Chrome/Edge standard PWA prompt
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent the mini-infobar from appearing on mobile
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
            // Update UI to show the install button
            if (installContainer) {
                installContainer.classList.remove('hidden');
            }
        });

        if (installBtn) {
            installBtn.addEventListener('click', async () => {
                if (isIos() && !isInStandaloneMode()) {
                    // Show iOS specific instructions using SweetAlert
                    Swal.fire({
                        title: 'Instal Aplikasi',
                        html: `<div class="text-left text-sm space-y-3 leading-relaxed text-gray-600">
                                <p>Untuk memasang aplikasi di smartphone Anda:</p>
                                <ol class="list-decimal list-inside space-y-2">
                                    <li>Tekan tombol <strong>Bagikan (Share)</strong> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline w-5 h-5 text-blue-600"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" /></svg> di bagian bawah layar browser Anda.</li>
                                    <li>Gulir menu ke bawah lalu pilih opsi <strong>Tambahkan ke Layar Utama (Add to Home Screen)</strong>.</li>
                                    <li>Klik tombol <strong>Tambah (Add)</strong> di pojok kanan atas untuk menyelesaikan.</li>
                                </ol>
                               </div>`,
                        icon: 'info',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                if (!deferredPrompt) return;
                // Show the install prompt
                deferredPrompt.prompt();
                // Wait for the user to respond to the prompt
                const { outcome } = await deferredPrompt.userChoice;
                console.log(`User response to the install prompt: ${outcome}`);
                // We've used the prompt, and can't use it again, discard it
                deferredPrompt = null;
                // Hide the install button
                if (installContainer) {
                    installContainer.classList.add('hidden');
                }
            });
        }

        window.addEventListener('appinstalled', (event) => {
            // Clear the deferredPrompt so it can be garbage collected
            deferredPrompt = null;
            // Hide the install button
            if (installContainer) {
                installContainer.classList.add('hidden');
            }
            console.log('PWA was installed successfully');
        });

        // B. Handle iOS display manually if not standalone
        if (isIos() && !isInStandaloneMode()) {
            if (installContainer) {
                installContainer.classList.remove('hidden');
            }
        }
    });

</script>

{{-- SCRIPT LIGHTBOX UNTUK GAMBAR SLIDER --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan semua link yang memiliki kelas lightbox-link
        const lightboxLinks = document.querySelectorAll('.lightbox-link');

        lightboxLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah browser membuka link

                // Mendapatkan URL gambar dari atribut href
                const imageUrl = this.getAttribute('href');

                // Membuat overlay untuk lightbox
                const overlay = document.createElement('div');
                overlay.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50';

                // Membuat elemen gambar untuk ditampilkan di dalam overlay
                const imgElement = document.createElement('img');
                imgElement.src = imageUrl;
                imgElement.className = 'max-w-full max-h-full';

                overlay.appendChild(imgElement);
                document.body.appendChild(overlay);

                // Menutup lightbox saat overlay diklik
                overlay.addEventListener('click', function() {
                    document.body.removeChild(overlay);
                });
            });
        });
    });

</script>

    <style>
        .material-symbols-outlined {
            font-size: 72px;
            color: blue;
            font-variation-settings:
                'FILL'1,
                'wght'400,
                'GRAD'0,
                'opsz'48;
        }

        /* Kode CSS untuk animasi bounce yang lebih baik */
        @keyframes bounce-up {
            0% {
                opacity: 0;
                /* Dimulai dari bawah dengan jarak yang lebih jauh */
                transform: translateY(200px);
            }

            60% {
                /* Memantul ke atas dan sedikit overshoot */
                transform: translateY(-10px);
            }

            80% {
                /* Memantul ke bawah sedikit sebelum berhenti */
                transform: translateY(7px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-bounce-up {
            animation: bounce-up 0.7s ease-out;
            animation-fill-mode: backwards;
        }

        .animate-bounce-up-delay {
            animation: bounce-up 0.7s ease-out 0.7s;
            animation-fill-mode: backwards;
        }
    </style>

@endsection

@push('scripts')

@if(isset($isClosed) && $isClosed)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!sessionStorage.getItem('closed_schedule_alert_shown')) {
            Swal.fire({
                title: 'Informasi Layanan',
                text: {!! json_encode($pesanTutup) !!},
                icon: 'info',
                confirmButtonText: 'Saya Mengerti',
                confirmButtonColor: '#3b82f6',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
            sessionStorage.setItem('closed_schedule_alert_shown', 'true');
        }
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: 'Berhasil!'
        , text: 'Silahkan akses menu layanan dan ajukan permohonan.'
        , showConfirmButton: false
        , timer: 1500
    });

</script>
@endif

{{-- Logic SweetAlert untuk menangkap pesan error dari Controller --}}
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Akses Ditolak!',
        text: "{{ session('error') }}",
        confirmButtonText: 'Saya Mengerti',
        confirmButtonColor: '#3085d6',
        // footer: '<span style="color: #d33">Khusus Petugas Desa & Admin</span>',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
</script>
@endif
@endpush

