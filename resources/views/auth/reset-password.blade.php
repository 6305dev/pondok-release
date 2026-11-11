@extends('layouts.app')

@section('content')
<div class="background-image-container min-h-screen pt-20 flex items-start justify-center font-sans">
    <div class="w-full max-w-sm bg-white/30 backdrop-blur-sm rounded-xl shadow-xl p-8">
        <!-- <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Buat Password Baru</h2> -->

        <div class="text-center mb-6">
            <div class="w-24 h-24 mx-auto mb-4">
                {{-- Menggunakan ikon yang sama dengan login --}}
                <img src="{{ asset('icon/user2.webp') }}" alt="Ikon Reset Password" class="w-full h-full object-contain">
            </div>
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Buat Password Baru</h2>
            <p class="text-sm text-gray-700">Buat password/sandi dengan kombinasi hurup dan angka, jangan kurang dari 8 karakter.</p>
        </div>

        <form method="POST" action="{{ route('password.update.post') }}">
            @csrf
            {{-- Hidden input untuk membawa data dari URL --}}
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="nik" value="{{ request()->nik }}">

            {{-- Password Baru --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required 
                           class="shadow appearance-none border rounded-lg w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <button type="button" onclick="togglePassword('password', 'eye-open-1', 'eye-closed-1')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                        <svg id="eye-open-1" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.5C7.029 4.5 2.768 7.378 0 12c2.768 4.622 7.029 7.5 12 7.5s9.232-2.878 12-7.5c-2.768-4.622-7.029-7.5-12-7.5zm0 13a5.5 5.5 0 110-11 5.5 5.5 0 010 11zm0-9a3.5 3.5 0 100 7 3.5 3.5 0 000-7z" />
                        </svg>
                        <svg id="eye-closed-1" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required 
                           class="shadow appearance-none border rounded-lg w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <button type="button" onclick="togglePassword('password_confirmation', 'eye-open-2', 'eye-closed-2')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                        <svg id="eye-open-2" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.5C7.029 4.5 2.768 7.378 0 12c2.768 4.622 7.029 7.5 12 7.5s9.232-2.878 12-7.5c-2.768-4.622-7.029-7.5-12-7.5zm0 13a5.5 5.5 0 110-11 5.5 5.5 0 010 11zm0-9a3.5 3.5 0 100 7 3.5 3.5 0 000-7z" />
                        </svg>
                        <svg id="eye-closed-2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition duration-200 shadow-md transform hover:scale-105">
                Simpan Password Baru
            </button>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId, openIconId, closedIconId) {
        const passwordInput = document.getElementById(inputId);
        const eyeOpenIcon = document.getElementById(openIconId);
        const eyeClosedIcon = document.getElementById(closedIconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpenIcon.classList.add('hidden');
            eyeClosedIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeOpenIcon.classList.remove('hidden');
            eyeClosedIcon.classList.add('hidden');
        }
    }
</script>
@endsection