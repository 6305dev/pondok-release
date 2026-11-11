@extends('layouts.app')

@section('content')
<div class="background-image-container min-h-screen pt-20 flex items-start justify-center font-sans">
    <div class="w-full max-w-sm bg-white/30 backdrop-blur-sm rounded-xl shadow-xl p-8 transform transition-transform duration-300">
        
        <div class="text-center mb-6">
            <div class="w-24 h-24 mx-auto mb-4">
                {{-- Menggunakan ikon yang sama dengan login --}}
                <img src="{{ asset('icon/login5.webp') }}" alt="Ikon Reset Password" class="w-full h-full object-contain">
            </div>
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Lupa Password</h2>
            <p class="text-sm text-gray-700">Masukkan NIK Anda untuk menerima link reset via Email.</p>
        </div>

        {{-- Form diarahkan ke route pengiriman Email --}}
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">Masukan NIK Anda</label>
                <input id="nik" type="text" name="nik" value="{{ old('nik') }}" required autofocus 
                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" 
                    placeholder="Masukkan 16 digit NIK" 
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nik') border-red-500 @enderror">
                
                @error('nik')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-4 mt-6">
                <button type="submit" class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 shadow-md transform hover:scale-105">
                    {{-- Ikon Email / Amplop --}}
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Kirim Link ke Email
                </button>

                <a href="{{ route('login') }}" class="text-center font-bold text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
@if(session('swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: "{{ session('swal')['title'] }}",
            text: "{{ session('swal')['text'] }}",
            icon: "{{ session('swal')['icon'] }}",
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
@endpush
@endsection