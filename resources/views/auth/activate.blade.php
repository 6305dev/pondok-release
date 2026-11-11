@extends('layouts.app')

@section('content')
<div class="background-image-container min-h-screen pt-20 flex items-start justify-center font-sans">
    <div class="w-full max-w-sm bg-white/30 backdrop-blur-sm rounded-xl shadow-xl p-8 transform transition-transform duration-300">
        
        <div class="text-center mb-6">
            <div class="w-24 h-24 mx-auto mb-4">
                <img src="{{ asset('icon/login5.webp') }}" alt="Ikon Aktivasi Akun" class="w-full h-full object-contain">
            </div>
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Aktivasi Akun</h2>
            <p class="text-sm text-gray-700">Masukkan NIK dan kode OTP 6-digit yang dikirimkan ke alamat email Anda.</p>
        </div>

        {{-- Form Aktivasi --}}
        <form method="POST" action="{{ route('activate.confirm') }}" class="space-y-6">
            @csrf

            <div>
                <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">Masukan NIK Anda</label>
                <input id="nik" type="text" name="nik" value="{{ old('nik', $nik) }}" required autofocus 
                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" 
                    placeholder="Masukkan 16 digit NIK" 
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nik') border-red-500 @enderror">
                
                @error('nik')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="otp" class="block text-gray-700 text-sm font-bold mb-2">Kode OTP Email</label>
                <input id="otp" type="text" name="otp" required 
                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,6)" 
                    placeholder="Masukkan 6 digit OTP" 
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight text-center tracking-widest text-lg font-bold focus:ring-2 focus:ring-blue-500 focus:outline-none @error('otp') border-red-500 @enderror">
                
                @error('otp')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-4 mt-6">
                <button type="submit" class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 shadow-md transform hover:scale-105">
                    Aktifkan Akun
                </button>

                <div class="text-center">
                    <p class="text-xs text-gray-700">
                        Tidak menerima kode OTP? 
                        <a href="#" onclick="event.preventDefault(); document.getElementById('resend-nik').value = document.getElementById('nik').value; document.getElementById('resend-form').submit();" class="text-blue-700 hover:text-blue-900 font-bold transition-colors duration-200">
                            Kirim Ulang OTP
                        </a>
                    </p>
                </div>

                <a href="{{ route('login') }}" class="text-center font-bold text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200 mt-2">
                    Kembali ke Login
                </a>
            </div>
        </form>

        {{-- Form Hidden untuk Kirim Ulang OTP --}}
        <form id="resend-form" method="POST" action="{{ route('activate.resend') }}" class="hidden">
            @csrf
            <input type="hidden" name="nik" id="resend-nik" value="{{ old('nik', $nik) }}">
        </form>
    </div>
</div>

@push('scripts')
@if(session('swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: "{{ session('swal')['title'] ?? 'Pesan' }}",
            text: "{{ session('swal')['text'] ?? '' }}",
            icon: "{{ session('swal')['icon'] ?? 'info' }}",
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
@endpush
@endsection
