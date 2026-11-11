@extends('layouts.app')
@section('content')

<div class="background-image-container min-h-screen pt-20 flex items-start justify-center font-sans">
    <div class="w-full max-w-sm bg-white/30 backdrop-blur-sm rounded-xl shadow-xl p-8 transform transition-transform duration-300">
        <div class="text-center mb-6">
            <div class="w-24 h-24 mx-auto mb-4">
                <img src="{{ asset('icon/login5.webp') }}" alt="Ikon Layanan Online" class="w-full h-full object-contain" id="service-icon">
            </div>
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Login</h2>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- HONEYPOT FIELD (WAJIB DIISI OLEH BOT) --}}
            <div style="display: none;">
                <label for="username" class="sr-only">Username</label>
                <input type="text" id="username" name="username" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">Masukan NIK Anda</label>
                <input id="nik" type="text" name="nik" value="{{ old('nik') }}" required autofocus oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" placeholder="Masukkan NIK" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nik') border-red-500 @enderror">
                @error('nik')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukan Password Anda" class="shadow appearance-none border rounded-lg w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:ring-2 focus:ring-blue-500 focus:outline-none @error('password') border-red-500 @enderror">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                        {{-- Ikon mata buka/tutup sebagai SVG --}}
                        <svg id="eye-open" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.5C7.029 4.5 2.768 7.378 0 12c2.768 4.622 7.029 7.5 12 7.5s9.232-2.878 12-7.5c-2.768-4.622-7.029-7.5-12-7.5zm0 13a5.5 5.5 0 110-11 5.5 5.5 0 010 11zm0-9a3.5 3.5 0 100 7 3.5 3.5 0 000-7z" />
                        </svg>
                        <svg id="eye-closed" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.5C7.029 4.5 2.768 7.378 0 12c2.768 4.622 7.029 7.5 12 7.5s9.232-2.878 12-7.5c-2.768-4.622-7.029-7.5-12-7.5zm0 13a5.5 5.5 0 110-11 5.5 5.5 0 010 11zm0-9a3.5 3.5 0 100 7 3.5 3.5 0 000-7z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <line x1="18" y1="6" x2="6" y2="18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                @error('password')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-size="flexible"></div>
            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

            <div class="flex flex-col sm:flex-row items-center justify-between mt-6">
                <button type="submit" class="w-full sm:w-auto flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 shadow-md transform hover:scale-105">
                    {{-- Ikon Kunci sebagai SVG --}}
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 10h-1V7c0-2.76-2.24-5-5-5S7 4.24 7 7v3H6c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-8c0-1.1-.9-2-2-2zm-5 8h-2v-2h2v2zm-2-4v-1h2v1c0 .55.45 1 1 1s1-.45 1-1V7c0-1.657-1.343-3-3-3s-3 1.343-3 3v3h1v-1c0-.55.45-1 1-1s1 .45 1 1v1h2v-1z" />
                    </svg>
                    Login
                </button>
                <div class="text-right mt-4 sm:mt-0">
                    <a href="{{ route('password.request') }}" class="inline-block align-baseline font-bold text-sm text-red-600 hover:text-red-800 transition-colors duration-200">
                        Lupa Password ?
                    </a>
                    <br>
                    <a href="/register" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800 mt-2 transition-colors duration-200">
                        Daftar/Registrasi
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const eyeOpenIcon = document.getElementById('eye-open');
        const eyeClosedIcon = document.getElementById('eye-closed');

        togglePasswordBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Mengubah tampilan ikon
            eyeOpenIcon.classList.toggle('hidden');
            eyeClosedIcon.classList.toggle('hidden');
        });
    });

</script>

@push('scripts')
@if(session('swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: "{{ session('swal')['title'] ?? 'Pesan' }}"
            , text: "{{ session('swal')['text'] ?? '' }}"
            , icon: "{{ session('swal')['icon'] ?? 'info' }}"
            , confirmButtonText: 'OK'
        });
    });

</script>
@endif
@endpush
@endsection
