@extends('layouts.app')
@section('content')

<div class="min-h-screen pt-0 flex items-start justify-center">
    <div class="w-full max-w-xl bg-white/50 backdrop-blur-sm rounded-xl shadow-xl p-8 transform transition-transform duration-500 ease-in-out">
        <a href="{{ url('/') }}" class="absolute top-4 left-4 text-gray-600 hover:text-blue-600 transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
        </a>
        <div class="text-center mb-6">
            <div class="w-24 h-24 mx-auto mb-4">
                <img src="{{ asset('icon/daftar.webp') }}" alt="Ikon Layanan Online" class="w-full h-full object-contain" id="service-icon">
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Daftar Akun</h2>
            <p class="text-gray-600 mt-2">Silakan isi data dengan lengkap, dan klik simpan</p>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Input NIK --}}
            <div>
                <input id="nik" type="text" name="nik" placeholder="Masukkan Nomor NIK" value="{{ old('nik') }}" required autofocus oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md @error('nik') @enderror">
                @error('nik')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input No KK --}}
            <div>
                <input id="kk" type="text" name="kk" placeholder="Masukkan Nomor KK" value="{{ old('kk') }}" required oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md @error('kk') @enderror">
                @error('kk')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Nama Lengkap --}}
            <div>
                <input id="name" type="text" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required autocomplete="name" oninput="this.value = this.value.toUpperCase()" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md @error('name') @enderror">
                @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>



            {{-- Input Email --}}
            <div>
                <input id="email" type="email" name="email" placeholder="Masukkan e-Mail" value="{{ old('email') }}" required autocomplete="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md @error('email') @enderror">
                @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input No HP --}}
            <div>
                <input id="phone" type="text" name="phone" placeholder="Masukkan Nomor WhatsApp" value="{{ old('phone') }}" required oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md @error('phone') @enderror">
                @error('phone')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div>
                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="Password Minimal 8 Digit" required autocomplete="new-password" class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md @error('password') @enderror">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                        <svg id="eye-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                            <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                            <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                        </svg>
                        <svg id="eye-closed" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @error('password')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Konfirmasi Password --}}
            <div>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password" class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md">
                    <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                        <svg id="eye-open-confirm" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                            <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                            <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                        </svg>
                        <svg id="eye-closed-confirm" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-size="flexible"></div>
            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

            {{-- Tombol Simpan --}}
            <div class="flex items-center justify-between mt-6 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                    </svg>
                    Simpan
                </button>
                <button type="reset" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2.5 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Reset
                </button>
            </div>

            <div class="text-center mt-4 text-sm text-gray-600">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">Login di sini</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- TOGGLE PASSWORD ---
        const togglePassword = () => {
            const input = document.getElementById('password');
            const open = document.getElementById('eye-open');
            const closed = document.getElementById('eye-closed');
            if (input.type === 'password') {
                input.type = 'text';
                open.classList.add('hidden');
                closed.classList.remove('hidden');
            } else {
                input.type = 'password';
                open.classList.remove('hidden');
                closed.classList.add('hidden');
            }
        };

        const toggleConfirmPassword = () => {
            const input = document.getElementById('password_confirmation');
            const open = document.getElementById('eye-open-confirm');
            const closed = document.getElementById('eye-closed-confirm');
            if (input.type === 'password') {
                input.type = 'text';
                open.classList.add('hidden');
                closed.classList.remove('hidden');
            } else {
                input.type = 'password';
                open.classList.remove('hidden');
                closed.classList.add('hidden');
            }
        };

        document.getElementById('togglePassword').addEventListener('click', togglePassword);
        document.getElementById('toggleConfirmPassword').addEventListener('click', toggleConfirmPassword);
    });
</script>

@endsection
