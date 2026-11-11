@extends('layouts.app')
@section('content')

<main id="main-content" class="min-h-screen bg-transparent pt-6 pb-20 flex items-start justify-center">
    <div class="w-full max-w-4xl mx-auto p-4">

        <div class="bg-gray-100/10 backdrop-blur-md rounded-2xl shadow-xl border border-white/20 p-5 md:p-8 relative">
            <!-- Tombol Kembali -->
            <a href="{{ url('/') }}" aria-label="Kembali ke Halaman Utama" class="absolute top-5 left-5 text-gray-800 hover:text-blue-700 hover:bg-white/30 p-2 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <!-- Logo dan Judul -->
            <div class="flex flex-col items-center mt-6 mb-8">
                <div class="w-20 h-20 md:w-24 md:h-24 mb-4 drop-shadow-md hover:scale-105 transition duration-300">
                    <img src="{{ asset('icon/online.webp') }}" alt="Ikon Formulir Layanan" class="w-full h-full object-contain">
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Daftar Formulir</h1>
                <p class="text-xs md:text-sm text-gray-800 font-semibold mt-1">Unduh formulir persyaratan administrasi kependudukan Anda</p>
            </div>

            <!-- Tampilan Card untuk Mobile (Sangat Responsif & Transparan) -->
            <div class="block md:hidden space-y-4">
                @foreach ($formulirs as $index => $formulir)
                <div class="bg-white/40 backdrop-blur-sm border border-white/30 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <span class="bg-blue-100 text-blue-900 text-[10px] font-bold px-2 py-0.5 rounded-md border border-blue-300">
                            No. {{ $index + 1 }}
                        </span>
                    </div>
                    <div class="space-y-1 mb-4">
                        <h2 class="text-xs sm:text-sm font-extrabold text-gray-900 uppercase tracking-wide leading-snug">
                            {{ $formulir->jenis_formulir }}
                        </h2>
                        <p class="text-[11px] sm:text-xs text-gray-800 font-semibold leading-relaxed">
                            {{ $formulir->ket }}
                        </p>
                    </div>
                    <a href="{{ route('formulir.download', $formulir->dokumen) }}" 
                       aria-label="Unduh {{ $formulir->jenis_formulir }} - {{ $formulir->ket }}"
                       class="w-full text-center bg-blue-700 hover:bg-blue-800 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition-all duration-200 flex items-center justify-center gap-1.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                        <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg>
                        Unduh Formulir
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Tampilan Tabel untuk Desktop (md ke atas & Transparan) -->
            <div class="hidden md:block overflow-hidden border border-white/30 rounded-xl shadow-sm">
                <table class="w-full border-collapse text-left text-sm text-gray-900">
                    <caption class="sr-only">Daftar Formulir Persyaratan Administrasi Kependudukan</caption>
                    <thead class="bg-white/50 text-gray-900 font-bold uppercase tracking-wider text-xs border-b border-white/30">
                        <tr>
                            <th scope="col" class="py-4 px-4 text-center w-14 border-r border-white/20">No</th>
                            <th scope="col" class="py-4 px-6 border-r border-white/20">Jenis Formulir</th>
                            <th scope="col" class="py-4 px-6 border-r border-white/20">Keterangan</th>
                            <th scope="col" class="py-4 px-6 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/20 bg-white/20">
                        @foreach ($formulirs as $index => $formulir)
                        <tr class="hover:bg-white/30 transition-colors duration-150">
                            <td class="py-4 px-4 text-center font-bold text-gray-900 border-r border-white/20">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 font-extrabold text-gray-900 uppercase tracking-wide text-xs md:text-sm leading-snug border-r border-white/20">{{ $formulir->jenis_formulir }}</td>
                            <td class="py-4 px-6 text-gray-800 font-semibold text-xs md:text-sm leading-relaxed border-r border-white/20">{{ $formulir->ket }}</td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('formulir.download', $formulir->dokumen) }}" 
                                   aria-label="Unduh {{ $formulir->jenis_formulir }}"
                                   class="inline-flex items-center gap-1 bg-blue-700 hover:bg-blue-800 text-white font-bold py-1.5 px-3.5 rounded-lg transition duration-200 text-xs focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    <svg aria-hidden="true" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg>
                                    Unduh
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</main>
@endsection