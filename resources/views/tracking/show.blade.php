@extends('layouts.app')
@section('content')

<main id="main-content" class="relative max-w-4xl mx-auto p-4 pb-20">
    <a href="{{ route('tracking.index') }}" 
       aria-label="Kembali ke Daftar Permohonan"
       class="inline-flex items-center gap-1 mb-4 text-gray-800 hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 rounded-lg p-1.5 transition">
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
        </svg>
        <span class="text-sm font-bold">Kembali</span>
    </a>

    <h1 class="text-2xl font-bold mb-6 text-center text-gray-900">Tracking Permohonan</h1>

    {{-- Menampilkan ID Pesanan yang sedang dilacak --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 text-center shadow-sm flex flex-wrap items-center justify-center gap-3">
        <span class="font-extrabold text-blue-900 text-lg">ID : {{ $transaksi->id_trx }}</span>
        @if($transaksi->konfirmasi == 'Y')
            <span class="inline-block px-3 py-1 text-xs font-bold bg-green-100 text-green-900 border border-green-300 rounded-full uppercase">
                Ter-Konfirmasi
            </span>
        @endif
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200">
        {{-- Cek apakah ada data transaksi --}}
        @if ($transaksi)
            {{-- STATUS BARU (1) --}}
            <div class="flex items-start mb-4">
                <div class="flex flex-col items-center mr-4" aria-hidden="true">
                    <div class="w-4 h-4 rounded-full {{ $transaksi->status >= 1 ? 'bg-orange-600' : 'bg-gray-400' }}"></div>
                    <div class="w-0.5 h-12 bg-gray-300"></div>
                </div>
                <div class="flex-grow">
                    <h2 class="{{ $transaksi->status >= 1 ? 'font-bold text-orange-700 text-base' : 'font-semibold text-gray-800 text-base' }}">Baru</h2>
                    @if ($transaksi->status >= 1)
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            {{ \Carbon\Carbon::parse($transaksi->tgl)->translatedFormat('l, d F Y') }}
                        </p>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            Pukul {{ \Carbon\Carbon::parse($transaksi->tgl)->translatedFormat('H:i') }} WIB
                        </p>
                    @endif
                </div>
            </div>
            {{-- STATUS VERIFIKASI (2) --}}
            <div class="flex items-start mb-4">
                <div class="flex flex-col items-center mr-4" aria-hidden="true">
                    <div class="w-4 h-4 rounded-full {{ $transaksi->status >= 2 ? 'bg-gray-700' : 'bg-gray-400' }}"></div>
                    <div class="w-0.5 h-12 bg-gray-300"></div>
                </div>
                <div class="flex-grow">
                    <h2 class="{{ $transaksi->status >= 2 ? 'font-bold text-gray-900 text-base' : 'font-semibold text-gray-800 text-base' }}">Verifikasi Dokumen</h2>
                    @if ($transaksi->status >= 2)
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            {{ \Carbon\Carbon::parse($transaksi->tgl_respon ?? now())->translatedFormat('l, d F Y') }}
                        </p>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            Pukul {{ \Carbon\Carbon::parse($transaksi->tgl_respon ?? now())->translatedFormat('H:i') }} WIB
                        </p>
                    @endif
                </div>
            </div>
            {{-- STATUS DITOLAK (5) --}}
            @if($transaksi->status == 5)
                <div class="flex items-start mb-4">
                    <div class="flex flex-col items-center mr-4" aria-hidden="true">
                        <div class="w-4 h-4 rounded-full bg-red-700"></div>
                        <div class="w-0.5 h-12 bg-gray-300"></div>
                    </div>
                    <div class="flex-grow">
                        <h2 class="font-bold text-red-800 text-base">Ditolak</h2>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y') }}
                        </p>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            Pukul {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('H:i') }} WIB
                        </p>
                        {{-- ✅ Tampilkan Pesan Penolakan Jika Ada --}}
                        @if($transaksi->pesan)
                            <div class="mt-2 p-4 bg-red-100 border border-red-300 rounded-xl shadow-sm">
                                <strong class="text-red-900 font-bold">Pesan Petugas :</strong>
                                <p class="text-gray-900 font-medium mt-1 mb-0">{{ $transaksi->pesan }}</p>
                            </div>
                        @endif
                        {{-- ✅ Tombol Ajukan Ulang --}}
                        <div class="mt-3">
                            <a href="{{ route('pengajuan.ulang.form', $transaksi->id_trx) }}" 
                               aria-label="Ajukan Ulang Permohonan {{ $transaksi->id_trx }}"
                               class="inline-flex items-center justify-center bg-purple-700 hover:bg-purple-800 text-white font-bold py-2.5 px-4 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">
                                <svg class="w-5 h-5 mr-2 text-white flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                                </svg>
                                <span class="whitespace-nowrap">Ajukan Ulang</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            {{-- STATUS DIBATALKAN (8) --}}
            @if($transaksi->status == 8)
                <div class="flex items-start mb-4">
                    <div class="flex flex-col items-center mr-4" aria-hidden="true">
                        <div class="w-4 h-4 rounded-full bg-red-700"></div>
                        <div class="w-0.5 h-12 bg-gray-300"></div>
                    </div>
                    <div class="flex-grow">
                        <h2 class="font-bold text-red-800 text-base">Dibatalkan</h2>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y') }}
                        </p>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            Pukul {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('H:i') }} WIB
                        </p>
                        {{-- ✅ Tampilkan Pesan Pembatalan Jika Ada --}}
                        @if($transaksi->pesan)
                            <div class="mt-2 p-4 bg-red-100 border border-red-300 rounded-xl shadow-sm">
                                <strong class="text-red-900 font-bold">Pesan Petugas :</strong>
                                <p class="text-gray-900 font-medium mt-1 mb-0">{{ $transaksi->pesan }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            {{-- STATUS PENGAJUAN ULANG (6) --}}
            @if($transaksi->status == 6)
                <div class="flex items-start mb-4">
                    <div class="flex flex-col items-center mr-4" aria-hidden="true">
                        <div class="w-4 h-4 rounded-full bg-red-700"></div>
                        <div class="w-0.5 h-12 bg-gray-300"></div>
                    </div>
                    <div class="flex-grow">
                        <h2 class="font-bold text-red-800 text-base">Pengajuan Ulang</h2>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y') }}
                        </p>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            Pukul {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('H:i') }} WIB
                        </p>
                    </div>
                </div>
            @endif
            {{-- STATUS PROSES (3) --}}
            @if($transaksi->status >= 3 && $transaksi->status != 5 && $transaksi->status != 6 && $transaksi->status != 8)
                <div class="flex items-start mb-4">
                    <div class="flex flex-col items-center mr-4" aria-hidden="true">
                        <div class="w-4 h-4 rounded-full {{ $transaksi->status >= 3 ? 'bg-blue-700' : 'bg-gray-400' }}"></div>
                        <div class="w-0.5 h-12 bg-gray-300"></div>
                    </div>
                    <div class="flex-grow">
                        <h2 class="{{ $transaksi->status >= 3 ? 'font-bold text-blue-900 text-base' : 'font-semibold text-gray-800 text-base' }}">Diproses</h2>
                        @if ($transaksi->status >= 3)
                            <p class="text-sm text-gray-700 font-medium mt-1">
                                {{ \Carbon\Carbon::parse($transaksi->tgl_proses ?? now())->translatedFormat('l, d F Y') }}
                            </p>
                            <p class="text-sm text-gray-700 font-medium mt-1">
                                Pukul {{ \Carbon\Carbon::parse($transaksi->tgl_proses ?? now())->translatedFormat('H:i') }} WIB
                            </p>
                        @endif
                    </div>
                </div>
            @endif
            {{-- STATUS SELESAI (4) --}}
            @if($transaksi->status >= 4 && $transaksi->status != 5 && $transaksi->status != 6 && $transaksi->status != 8)
                <div class="flex items-start mb-4">
                    <div class="flex flex-col items-center mr-4" aria-hidden="true">
                        <div class="w-4 h-4 rounded-full {{ $transaksi->status >= 4 ? 'bg-green-700' : 'bg-gray-400' }}"></div>
                        <div class="w-0.5 h-12 bg-gray-300"></div>
                    </div>
                    <div class="flex-grow">
                        <h2 class="{{ $transaksi->status >= 4 ? 'font-bold text-green-900 text-base' : 'font-semibold text-gray-800 text-base' }}">Selesai</h2>
                        @if ($transaksi->status >= 4)
                            <p class="text-sm text-gray-700 font-medium mt-1">
                                {{ \Carbon\Carbon::parse($transaksi->tgl_selesai ?? now())->translatedFormat('l, d F Y') }}
                            </p>
                            <p class="text-sm text-gray-700 font-medium mt-1">
                                Pukul {{ \Carbon\Carbon::parse($transaksi->tgl_selesai ?? now())->translatedFormat('H:i') }} WIB
                            </p>
                        @endif
                    </div>
                </div>
            @endif
            {{-- STATUS KOMPLAIN (7) --}}
            @if($transaksi->status == 7)
                <div class="flex items-start mb-4">
                    <div class="flex flex-col items-center mr-4" aria-hidden="true">
                        <div class="w-4 h-4 rounded-full bg-amber-600"></div>
                        <div class="w-0.5 h-12 bg-gray-300"></div>
                    </div>
                    <div class="flex-grow">
                        <h2 class="font-bold text-amber-800 text-base">Komplain</h2>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y') }}
                        </p>
                        <p class="text-sm text-gray-700 font-medium mt-1">
                            Pukul {{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('H:i') }} WIB
                        </p>
                    </div>
                </div>
            @endif

            <!-- Tombol Setelah Selesai -->
            @if($transaksi->status == 4)
                <div class="mt-6 p-4 bg-white rounded-xl shadow-md border border-gray-200">
                    <h2 class="font-bold text-gray-900 text-base mb-3">Tindakan Selanjutnya</h2>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <!-- Tombol Lihat -->
                        <button type="button" id="cek-berkas-btn" 
                                aria-label="Cek Berkas Permohonan"
                                class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2.5 px-4 rounded-lg flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            Cek Berkas
                        </button>
                    </div>
                </div>
            @endif

        @else
            {{-- Tampilan jika tidak ada data tracking --}}
            <div class="text-center p-8 text-gray-700">
                <p class="mt-4 font-medium">Maaf, data tracking tidak ditemukan.</p>
                <a href="{{ route('tracking.index') }}" class="mt-4 inline-block text-blue-800 hover:text-blue-900 font-bold underline focus:outline-none focus:ring-2 focus:ring-blue-600 rounded px-2 py-1">Kembali ke Daftar Pesanan</a>
            </div>
        @endif
    </div>
</main>

<!-- Modal Cek Berkas (Ukuran Besar) -->
<div id="cek-berkas-modal" aria-labelledby="modal-cek-berkas-title" role="dialog" aria-modal="true" style="position: fixed; inset: 0; z-index: 50; display: none; overflow-y: auto; background-color: rgba(17, 24, 39, 0.7); backdrop-filter: blur(4px);">
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px;">
        <div style="background: white; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2); width: 90vw; height: 80vh; display: flex; flex-direction: column; border: 1px solid #d1d5db;">
            <!-- Header Modal -->
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem; background-color: #f9fafb; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h3 id="modal-cek-berkas-title" style="font-size: 1.25rem; font-weight: 700; color: #111827;">📄 Dokumen Cek Berkas</h3>
                <!-- Tombol Konfirmasi & Komplain -->
                <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                    <button type="button" id="konfirmasi-button" aria-label="Konfirmasi Dokumen Sesuai" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-3.5 rounded-lg flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 text-sm">
                        <svg aria-hidden="true" class="w-4 h-4 mr-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        Konfirmasi
                    </button>
                    <!-- Tombol Download Semua Berkas -->
                    <button type="button" id="download-berkas-button" aria-label="Unduh Semua Berkas Hasil" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-3.5 rounded-lg flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 text-sm">
                        <svg aria-hidden="true" class="w-4 h-4 mr-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-1m-4-4-4 4m0 0-4-4m4 4V4"/>
                        </svg>
                        Download
                    </button>
                    <!-- Tombol Nilai Kami -->
                    <button type="button" id="nilai-button" aria-label="Berikan Penilaian Layanan" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-3.5 rounded-lg flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-amber-600 focus:ring-offset-2 text-sm">
                        <svg aria-hidden="true" class="w-4 h-4 mr-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z"/>
                        </svg>
                        Nilai Kami
                    </button>
                    <button type="button" id="komplain-button"
                        aria-label="Ajukan Komplain Dokumen"
                        @if($transaksi->konfirmasi == 'Y')
                            disabled
                            title="Tidak dapat komplain setelah konfirmasi dokumen"
                        @endif
                        class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-3.5 rounded-lg flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 text-sm
                            {{ $transaksi->konfirmasi == 'Y' ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <svg aria-hidden="true" class="w-4 h-4 mr-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z"/>
                        </svg>
                        Komplain
                    </button>
                </div>
                <!-- Tombol Close -->
                <button type="button" id="cek-berkas-cancel" aria-label="Tutup Modal Cek Berkas" style="color: #4b5563; background: none; border: none; cursor: pointer; margin-left: 0.5rem; padding: 0.25rem;" class="hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-600 rounded">
                    <svg aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <!-- Konten PDF -->
            <div id="pdf-preview-container" style="flex: 1; overflow: hidden; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                    <div style="text-align: center;">
                        <div style="width: 32px; height: 32px; border: 4px solid #1d4ed8; border-top-color: transparent; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                        <p style="margin-top: 12px; color: #1f2937; font-weight: 600;">Sedang memuat dokumen...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="konfirmasi-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-konfirmasi-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-70 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg aria-hidden="true" class="h-6 w-6 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 6v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-konfirmasi-title">
                            Konfirmasi Cek Dokumen
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-700 font-medium">
                                Apakah Anda yakin dokumen sudah sesuai?<br>
                                Dokumen Anda bisa diunduh di tombol Download jika file berformat PDF.
                                Jika file fisik (KTP/KIA) akan dikirim/diambil sesuai pilihan pengajuan Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2 border-t border-gray-200">
                <button type="button" id="konfirmasi-submit" class="w-full inline-flex justify-center rounded-lg border border-transparent px-4 py-2 bg-green-700 text-base font-bold text-white hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 sm:w-auto sm:text-sm">
                    Ya, Saya Yakin
                </button>
                <button type="button" id="konfirmasi-cancel" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 px-4 py-2 bg-gray-200 text-base font-bold text-gray-900 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<div id="komplain-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-komplain-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-70 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-amber-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg aria-hidden="true" class="w-6 h-6 text-amber-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-komplain-title">
                            Ajukan Komplain
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-700 font-medium">
                                Silakan isi alasan komplain Anda dengan jelas, agar kami dapat menyelesaikan masalahnya dengan tepat dan benar.
                            </p>
                            <label for="komplain-text" class="sr-only">Alasan Komplain</label>
                            <textarea id="komplain-text" rows="4" class="w-full mt-2 px-3 py-2 border border-gray-300 text-gray-900 font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Tulis alasan komplain..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2 border-t border-gray-200">
                <button type="button" id="komplain-submit" class="w-full inline-flex justify-center rounded-lg border border-transparent px-4 py-2 bg-red-700 text-base font-bold text-white hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 sm:w-auto sm:text-sm">
                    Kirim Komplain
                </button>
                <button type="button" id="komplain-cancel" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 px-4 py-2 bg-gray-200 text-base font-bold text-gray-900 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nilai Kami -->
<div id="nilai-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-nilai-show-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-70 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-gray-200">
            <div class="bg-white px-6 pt-6 pb-4 sm:p-8">
                <div class="flex flex-col items-center text-center">
                    <!-- Icon Header with Gradient -->
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-800 mb-4 shadow-inner">
                        <svg aria-hidden="true" class="h-8 w-8 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight" id="modal-nilai-show-title">
                        Nilai Layanan Kami
                    </h2>
                    <p class="text-sm text-gray-700 font-medium mt-1 max-w-xs">
                        Kepuasan Anda adalah prioritas kami. Berikan penilaian Anda untuk layanan ini.
                    </p>
                    
                    <!-- Rating Stars Container -->
                    <div class="mt-6 w-full">
                        <fieldset class="flex justify-center space-x-3 mb-2" id="star-rating-container">
                            <legend class="sr-only">Tingkat Kepuasan (1 sampai 5 bintang)</legend>
                            <label class="cursor-pointer group">
                                <input type="radio" name="rating" value="1" aria-label="1 Bintang - Sangat Kurang" class="sr-only focus:outline-none">
                                <span class="star text-gray-300 text-4xl md:text-5xl transition-all duration-150 inline-block transform group-hover:scale-125 select-none">★</span>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="rating" value="2" aria-label="2 Bintang - Kurang" class="sr-only focus:outline-none">
                                <span class="star text-gray-300 text-4xl md:text-5xl transition-all duration-150 inline-block transform group-hover:scale-125 select-none">★</span>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="rating" value="3" aria-label="3 Bintang - Cukup" class="sr-only focus:outline-none">
                                <span class="star text-gray-300 text-4xl md:text-5xl transition-all duration-150 inline-block transform group-hover:scale-125 select-none">★</span>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="rating" value="4" aria-label="4 Bintang - Baik" class="sr-only focus:outline-none">
                                <span class="star text-gray-300 text-4xl md:text-5xl transition-all duration-150 inline-block transform group-hover:scale-125 select-none">★</span>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="rating" value="5" aria-label="5 Bintang - Sangat Baik" class="sr-only focus:outline-none">
                                <span class="star text-gray-300 text-4xl md:text-5xl transition-all duration-150 inline-block transform group-hover:scale-125 select-none">★</span>
                            </label>
                        </fieldset>
                        <!-- Teks Deskripsi Dinamis -->
                        <div id="rating-label" class="inline-block px-3 py-1 bg-gray-100 text-gray-800 text-xs font-bold rounded-full border border-gray-300 transition-all duration-200">
                            Pilih tingkat kepuasan Anda
                        </div>
                    </div>

                    <!-- Komentar Opsional -->
                    <div class="mt-6 w-full text-left">
                        <label for="comment" class="block text-sm font-bold text-gray-900 mb-1">Komentar / Masukan (opsional)</label>
                        <textarea id="comment" rows="3" class="mt-1 block w-full border border-gray-300 rounded-2xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm text-gray-900 font-medium transition-all duration-200" placeholder="Ceritakan pengalaman Anda atau berikan saran..."></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer Buttons -->
            <div class="bg-gray-50 px-6 py-4 sm:px-8 flex flex-col-reverse sm:flex-row sm:justify-end gap-2 border-t border-gray-200 rounded-b-3xl">
                <button type="button" id="nilai-cancel" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl border border-gray-300 bg-gray-200 px-5 py-2.5 text-sm font-bold text-gray-900 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 transition">
                    Batal
                </button>
                <button type="button" id="nilai-submit" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl border border-transparent bg-blue-700 px-6 py-2.5 text-sm font-bold text-white hover:bg-blue-800 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 transition active:scale-95">
                    Kirim Penilaian
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Pastikan DOM sudah siap
document.addEventListener('DOMContentLoaded', function() {
    // === FITUR: CEK BERKAS (Modal Inline CSS) ===
    const cekBerkasButton = document.getElementById('cek-berkas-btn');
    const cekBerkasModal = document.getElementById('cek-berkas-modal');
    const cekBerkasCancel = document.getElementById('cek-berkas-cancel');
    const downloadBerkasButton = document.getElementById('download-berkas-button');
    window.autoDownloadAfterRating = false;
    window.hasUserRated = @json($transaksi->rating ? true : false);

    window.triggerDownload = function() {
        const userDokumen = @json($transaksi->userDokumen);
        if (userDokumen.length > 0) {
            userDokumen.forEach((dokumen, index) => {
                setTimeout(() => {
                    const link = document.createElement('a');
                    link.href = "{{ url('/dokumen') }}/" + dokumen.file_path + "?download=1";
                    link.download = dokumen.file_path.split('/').pop();
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }, index * 250);
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Tidak Ada Berkas',
                text: 'Belum ada berkas hasil proses untuk diunduh.',
                confirmButtonText: 'Tutup'
            });
        }
    }

    if (downloadBerkasButton) {
        downloadBerkasButton.addEventListener('click', () => {
            if (!window.hasUserRated) {
                Swal.fire({
                    title: 'Beri Penilaian Terlebih Dahulu',
                    text: 'Silakan berikan penilaian layanan kami sebelum mengunduh berkas.',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Beri Penilaian ⭐',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#1d4ed8',
                    cancelButtonColor: '#4b5563',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.autoDownloadAfterRating = true;
                        bukaRatingModal();
                    }
                });
                return;
            }
            triggerDownload();
        });
    }

    if (cekBerkasButton && cekBerkasModal) {
        cekBerkasButton.addEventListener('click', () => {
            // Ambil dokumen petugas
            const userDokumen = @json($transaksi->userDokumen);
            const pdfContainer = document.getElementById('pdf-preview-container');
            
            if (userDokumen.length > 0) {
                let html = '<div style="height: 100%; overflow-y: auto; padding: 16px;">';
                userDokumen.forEach((dokumen, index) => {
                    const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                    const src = "{{ url('/dokumen') }}/" + dokumen.file_path + "#toolbar=0";
                    let viewer;
                    
                    if (isMobile) {
                        viewer = `
                            <iframe 
                                src="${src}" 
                                title="Dokumen Preview ${dokumen.nama_dokumen || index + 1}"
                                style="width: 100%; height: 500px; border: none;"
                                frameborder="0">
                            </iframe>
                        `;
                    } else {
                        viewer = `
                            <object 
                                data="${src}" 
                                type="application/pdf"
                                aria-label="Dokumen Preview ${dokumen.nama_dokumen || index + 1}"
                                style="width: 100%; height: 500px; border: none;">
                                <p>Browser Anda tidak mendukung PDF.</p>
                            </object>
                        `;
                    }
                    
                    html += `
                        <div style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 12px; margin-bottom: 16px; background-color: #ffffff;">
                            <h4 style="font-weight: 700; color: #111827; font-size: 0.95rem; margin-bottom: 8px;">
                                Jenis : ${dokumen.nama_dokumen || `Dokumen ${index + 1}`} <br>
                                Pesan : ${dokumen.keterangan || `Dokumen ${index + 1}`}
                            </h4>
                            ${viewer}
                        </div>
                    `;
                });
                html += '</div>';
                pdfContainer.innerHTML = html;

                document.addEventListener('keydown', function(e) {
                    if (e.ctrlKey || e.metaKey) {
                        switch (e.key.toLowerCase()) {
                            case 'p':
                            case 's':
                            case 'u':
                                e.preventDefault();
                                return false;
                        }
                    }
                    if (e.key === 'F12') {
                        e.preventDefault();
                    }
                });

                const iframes = pdfContainer.querySelectorAll('iframe');
                const objects = pdfContainer.querySelectorAll('object');

                const preventRightClick = (event) => {
                    event.preventDefault();
                    return false;
                };

                iframes.forEach(iframe => {
                    iframe.addEventListener('contextmenu', preventRightClick);
                    iframe.addEventListener('dragstart', preventRightClick);
                    iframe.onload = function() {
                        try {
                            const doc = iframe.contentDocument || iframe.contentWindow.document;
                            if (doc) {
                                doc.addEventListener('contextmenu', preventRightClick);
                            }
                        } catch (err) {
                            console.warn('Tidak bisa mengakses konten iframe (cross-origin).');
                        }
                    };
                });

                objects.forEach(obj => {
                    obj.addEventListener('contextmenu', preventRightClick);
                    obj.addEventListener('dragstart', preventRightClick);
                });

            } else {
                pdfContainer.innerHTML = `
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; text-align: center; padding: 16px;">
                        <div>
                            <p style="color: #374151; font-weight: 600;">Belum ada dokumen hasil proses dari petugas.</p>
                        </div>
                    </div>
                `;
            }

            cekBerkasModal.style.display = 'block';
        });
    }

    if (cekBerkasCancel && cekBerkasModal) {
        cekBerkasCancel.addEventListener('click', () => {
            cekBerkasModal.style.display = 'none';
        });
    }

    if (cekBerkasModal) {
        cekBerkasModal.addEventListener('click', (e) => {
            if (e.target === cekBerkasModal) {
                cekBerkasModal.style.display = 'none';
            }
        });
    }


    // === FITUR: KONFIRMASI ===
    const konfirmasiButton = document.getElementById('konfirmasi-button');
    const konfirmasiModal = document.getElementById('konfirmasi-modal');
    const konfirmasiSubmit = document.getElementById('konfirmasi-submit');
    const konfirmasiCancel = document.getElementById('konfirmasi-cancel');

    if (konfirmasiButton && konfirmasiModal) {
        konfirmasiButton.addEventListener('click', () => {
            konfirmasiModal.classList.remove('hidden');
        });
    }

    if (konfirmasiCancel && konfirmasiModal) {
        konfirmasiCancel.addEventListener('click', () => {
            konfirmasiModal.classList.add('hidden');
        });
    }

    if (konfirmasiSubmit) {
        konfirmasiSubmit.addEventListener('click', () => {
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(`/konfirmasi/{{ $transaksi->id_trx }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    konfirmasi: 'Y',
                    tgl_konfirmasi: new Date().toISOString().slice(0, 19).replace('T', ' ')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Konfirmasi Berhasil!',
                        text: 'Dokumen Anda telah dikonfirmasi, silahkan unduh berkas (pdf).',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat mengirim konfirmasi.',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan teknis. Silakan coba lagi nanti.',
                    confirmButtonText: 'Tutup'
                });
            })
            .finally(() => {
                konfirmasiModal.classList.add('hidden');
            });
        });
    }

    // === FITUR: KOMPLAIN ===
    const komplainButton = document.getElementById('komplain-button');
    const komplainModal = document.getElementById('komplain-modal');
    const komplainSubmit = document.getElementById('komplain-submit');
    const komplainCancel = document.getElementById('komplain-cancel');
    const komplainText = document.getElementById('komplain-text');

    function showErrorModal(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
            confirmButtonText: 'Tutup'
        });
    }

    async function handleJsonError(response) {
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Permintaan gagal. Status: ' + response.status);
        } 
        throw new Error('Terjadi kesalahan teknis. Cek koneksi atau URL API.');
    }

    if (komplainButton && komplainModal) {
        komplainButton.addEventListener('click', () => {
            komplainModal.classList.remove('hidden');
        });
    }

    if (komplainCancel && komplainModal && komplainText) {
        komplainCancel.addEventListener('click', () => {
            komplainModal.classList.add('hidden');
            komplainText.value = '';
        });
    }

    if (komplainSubmit && komplainText) {
        komplainSubmit.addEventListener('click', () => {
            const alasan = komplainText.value.trim();
            if (!alasan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Kosong!',
                    text: 'Silakan isi alasan komplain.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            komplainSubmit.disabled = true;

            fetch(`{{ route('komplain.store', $transaksi->id_trx) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    alasan: alasan,
                    id_trx: '{{ $transaksi->id_trx }}' 
                })
            })
            .then(async response => {
                if (!response.ok) {
                    await handleJsonError(response);
                }
                return response.json();
            })
            .then(data => {
                komplainSubmit.disabled = false;
                
                if (data.success) {
                    komplainModal.classList.add('hidden'); 
                    Swal.fire({
                        icon: 'success',
                        title: 'Komplain Terkirim!',
                        text: data.message || 'Terima kasih atas laporan Anda.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload(); 
                    });
                } else {
                    komplainModal.classList.add('hidden'); 
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal mengirim komplain.',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                komplainSubmit.disabled = false;
                console.error('Error saat komplain:', error);
                komplainModal.classList.add('hidden'); 
                showErrorModal(error.message || 'Terjadi kesalahan teknis.');
            });
        });
    }

    // === FITUR: NILAI KAMI ===
    const nilaiButton = document.getElementById('nilai-button');
    const nilaiModal = document.getElementById('nilai-modal');
    const nilaiSubmit = document.getElementById('nilai-submit');
    const nilaiCancel = document.getElementById('nilai-cancel');
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    const commentInput = document.getElementById('comment');
    const ratingLabel = document.getElementById('rating-label');

    const stars = document.querySelectorAll('.star');

    function highlightStars(count) {
        stars.forEach((star, index) => {
            if (index < count) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-amber-400', 'scale-110');
            } else {
                star.classList.remove('text-amber-400', 'scale-110');
                star.classList.add('text-gray-300');
            }
        });
    }

    function updateRatingDisplay() {
        const selected = document.querySelector('input[name="rating"]:checked');
        if (selected) {
            const ratingValue = parseInt(selected.value);
            highlightStars(ratingValue);
            
            let labelText = '';
            let labelClass = '';
            switch(ratingValue) {
                case 1: 
                    labelText = 'Sangat Kurang 😞'; 
                    labelClass = 'text-red-900 border-red-300 bg-red-100';
                    break;
                case 2: 
                    labelText = 'Kurang 😕'; 
                    labelClass = 'text-orange-900 border-orange-300 bg-orange-100';
                    break;
                case 3: 
                    labelText = 'Cukup 😐'; 
                    labelClass = 'text-amber-900 border-amber-300 bg-amber-100';
                    break;
                case 4: 
                    labelText = 'Baik 🙂'; 
                    labelClass = 'text-blue-900 border-blue-300 bg-blue-100';
                    break;
                case 5: 
                    labelText = 'Sangat Baik! 😀'; 
                    labelClass = 'text-green-900 border-green-300 bg-green-100';
                    break;
            }
            ratingLabel.textContent = labelText;
            ratingLabel.className = `inline-block px-3 py-1 font-bold rounded-full border transition-all duration-200 ${labelClass}`;
        } else {
            highlightStars(0);
            ratingLabel.textContent = 'Pilih tingkat kepuasan Anda';
            ratingLabel.className = 'inline-block px-3 py-1 bg-gray-100 text-gray-800 text-xs font-bold rounded-full border border-gray-300 transition-all duration-200';
        }
    }

    updateRatingDisplay();

    ratingInputs.forEach(input => {
        input.addEventListener('change', updateRatingDisplay);
    });

    stars.forEach((star, index) => {
        star.addEventListener('mouseenter', () => {
            highlightStars(index + 1);
        });
        star.addEventListener('mouseleave', () => {
            const selected = document.querySelector('input[name="rating"]:checked');
            if (selected) {
                highlightStars(parseInt(selected.value));
            } else {
                highlightStars(0);
            }
        });
    });

    window.bukaRatingModal = function() {
        if (nilaiModal) {
            nilaiModal.classList.remove('hidden');
            ratingInputs.forEach(radio => radio.checked = false);
            updateRatingDisplay();
        }
    };

    if (nilaiButton && nilaiModal) {
        nilaiButton.addEventListener('click', () => {
            bukaRatingModal();
        });
    }

    if (nilaiCancel && nilaiModal) {
        nilaiCancel.addEventListener('click', () => {
            nilaiModal.classList.add('hidden');
            ratingInputs.forEach(radio => radio.checked = false);
            updateRatingDisplay();
            if (commentInput) commentInput.value = '';
            window.autoDownloadAfterRating = false;
        });
    }

    if (nilaiSubmit) {
        nilaiSubmit.addEventListener('click', () => {
            const selectedRating = document.querySelector('input[name="rating"]:checked');
            const comment = commentInput ? commentInput.value.trim() : '';
            if (!selectedRating) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Belum Memilih Rating',
                    text: 'Silakan pilih salah satu tingkat kepuasan.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Mengirim Penilaian...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(`/api/nilai/{{ $transaksi->id_trx }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    rating: parseInt(selectedRating.value),
                    comment: comment
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.hasUserRated = true;
                    const ratingBtn = document.getElementById('nilai-button');
                    if (ratingBtn) {
                        ratingBtn.remove();
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Terima Kasih!',
                        text: 'Penilaian Anda telah kami terima. Kami sangat menghargai masukan Anda!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        if (window.autoDownloadAfterRating) {
                            window.triggerDownload();
                            window.autoDownloadAfterRating = false;
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat mengirim penilaian.',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan teknis. Silakan coba lagi nanti.',
                    confirmButtonText: 'Tutup'
                });
            })
            .finally(() => {
                nilaiModal.classList.add('hidden');
                ratingInputs.forEach(radio => radio.checked = false);
                updateRatingDisplay();
                if (commentInput) commentInput.value = '';
            });
        });
    }

    // === TUTUP MODAL JIKA KLIK DI LUAR ===
    window.addEventListener('click', (event) => {
        if (konfirmasiModal && event.target === konfirmasiModal) {
            konfirmasiModal.classList.add('hidden');
        }
        if (komplainModal && event.target === komplainModal) {
            komplainModal.classList.add('hidden');
            if (komplainText) komplainText.value = '';
        }
        if (nilaiModal && event.target === nilaiModal) {
            nilaiModal.classList.add('hidden');
            if (commentInput) commentInput.value = '';
            ratingInputs.forEach(radio => radio.checked = false);
        }
    });

    if (window.location.search.includes('cek_berkas=1') && cekBerkasButton) {
        cekBerkasButton.click();
    }
});
</script>
@endpush

@endsection