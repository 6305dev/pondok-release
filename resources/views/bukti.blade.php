@extends('layouts.app')

@section('content')
<main id="main-content" class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
        <!-- Header -->
        <div class="bg-blue-800 text-white p-6 text-center">
            <h1 class="text-2xl font-extrabold uppercase tracking-wider">BUKTI PERMOHONAN</h1>
            <p class="text-2xl font-black mt-1">{{ $transaksi->id_trx }}</p>
        </div>

        <!-- Badan Bukti -->
        <div class="p-6">
            <!-- Informasi Umum -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- IDENTITAS PEMOHON -->
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <div class="bg-gray-200/80 px-4 py-3 border-b border-gray-200">
                            <h2 class="font-bold text-gray-900 text-sm md:text-base flex items-center gap-2">
                                <svg aria-hidden="true" class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Identitas Pemohon
                            </h2>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-[minmax(120px,auto)_1fr] gap-y-2">
                                <span class="font-bold text-sm text-gray-800">NIK</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-gray-600 font-bold text-sm">:</span>
                                    <span class="text-gray-900 text-sm font-semibold">{{ $transaksi->nik }}</span>
                                </div>    
                                <span class="font-bold text-sm text-gray-800">Nama</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-gray-600 font-bold text-sm">:</span>
                                    <span class="text-gray-900 text-sm font-semibold">{{ $transaksi->nama }}</span>
                                </div>    
                                <span class="font-bold text-sm text-gray-800">No. KK</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-gray-600 font-bold text-sm">:</span>
                                    <span class="text-gray-900 text-sm font-semibold">{{ $transaksi->kk }}</span>
                                </div>    
                            </div>
                        </div>
                    </div>

                    @if($transaksi->pesan)
                    <div class="bg-orange-100 border-l-4 border-orange-600 p-4 rounded-r-lg shadow-sm">
                        <h2 class="font-bold text-orange-900 text-sm mb-1 uppercase tracking-wide">Pesan Petugas</h2>
                        <p class="text-sm text-orange-900 font-medium">{{ $transaksi->pesan }}</p>
                    </div>
                    @endif
                </div>

                <!-- DETAIL PENGAJUAN -->
                <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden shadow-sm h-full">
                    <div class="bg-gray-200/80 px-4 py-3 border-b border-gray-200">
                        <h2 class="font-bold text-gray-900 text-sm md:text-base flex items-center gap-2">
                            <svg aria-hidden="true" class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Detail Pengajuan
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-[auto_1fr] gap-y-2">
                            <!-- Baris 1 -->
                            <span class="font-bold text-sm text-gray-800">ID Transaksi</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-gray-600 font-bold text-sm">:</span>
                                <span class="font-bold text-gray-900 text-sm"><code class="bg-blue-100 text-blue-900 border border-blue-300 px-1.5 py-0.5 rounded text-sm font-mono">{{ $transaksi->id_trx }}</code></span>
                            </div>

                            <!-- Baris 2 -->
                            <span class="font-bold text-sm text-gray-800">Layanan</span>
                            <div class="flex items-start gap-2">
                                <span class="text-gray-600 font-bold text-sm">:</span>
                                
                                @php
                                    // 1. Ambil data mentah dari database
                                    $rawLayanan = $transaksi->id_dokumen;

                                    // 2. Ubah JSON menjadi Array PHP
                                    $ids = is_array($rawLayanan) ? $rawLayanan : json_decode($rawLayanan, true);

                                    // 3. Mapping Layanan
                                    $layananMap = [
                                        '1' => 'Kartu Keluarga',
                                        '2' => 'KTP',
                                        '3' => 'KIA',
                                        '4' => 'Pindah',  
                                        '5' => 'Datang',
                                        '6' => 'Akta Kelahiran',                    
                                        '7' => 'Akta Kematian',
                                        '8' => 'Surat Pengantar KUA',   
                                        '9' => 'Lainnya'                                    
                                    ];
                                @endphp

                                <ul style="list-style-type: none; padding-left: 0; margin-bottom: 0; margin-top: 0;" class="space-y-1" aria-label="Daftar Layanan Dipilih">
                                @if(!empty($ids) && is_array($ids))
                                    @foreach($ids as $id)
                                        @php
                                            $cleanId = trim((string)$id);
                                        @endphp
                                        <li class="flex items-center gap-1.5">
                                            <span class="text-gray-700 font-bold text-sm">-</span>
                                            <span class="font-bold text-white text-sm">
                                                <code class="bg-green-700 text-white px-2 py-0.5 rounded text-xs tracking-wide">
                                                    {{ $layananMap[$cleanId] ?? "Layanan ID: $cleanId" }}
                                                </code>
                                            </span>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <span class="text-gray-700 italic text-xs font-medium">Tidak ada layanan yang dipilih</span>
                                    </li>
                                @endif
                                </ul>
                            </div>

                            <!-- Baris 3 -->
                            <span class="font-bold text-sm text-gray-800">Pengambilan</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-gray-600 font-bold text-sm">:</span>
                                <span class="text-gray-900 text-sm font-semibold">{{ $transaksi->pengambilan?->nama ?? '-' }}</span>
                            </div>

                            <!-- Baris 4 -->
                            <span class="font-bold text-sm text-gray-800">Status</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-gray-600 font-bold text-sm">:</span>
                                <span class="font-bold text-gray-900 text-sm"><code class="bg-red-100 text-red-900 border border-red-300 px-1.5 py-0.5 rounded text-sm">{{ $transaksi->statusLabel }}</code></span>
                            </div>

                            <!-- Baris 5 -->
                            <span class="font-bold text-sm text-gray-800">Tanggal</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-gray-600 font-bold text-sm">:</span>
                                <span class="text-gray-900 text-sm font-semibold">{{ $transaksi->tgl?->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider Line -->
            <hr class="border-gray-300 my-8">

            <!-- Section Title -->
            <div class="mb-6">
                <h2 class="font-bold text-gray-900 text-lg flex items-center gap-2 uppercase tracking-wide">
                    <svg aria-hidden="true" class="w-5 h-5 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                    Lampiran Dokumen & Verifikasi
                </h2>
            </div>

            <!-- Group 1: Berkas Persyaratan -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden mb-6 shadow-sm">
                <div class="bg-gray-200/80 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                        <svg aria-hidden="true" class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Berkas Persyaratan Administrasi
                    </h3>
                    <span class="bg-blue-100 text-blue-900 border border-blue-300 text-xs font-black px-2.5 py-0.5 rounded-full">
                        {{ $files->count() }} Berkas
                    </span>
                </div>
                <div class="p-4">
                    @if($files->count())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($files as $file)
                                <a href="{{ route('dokumen.show', $file->file) }}" target="_blank" rel="noopener noreferrer" 
                                   aria-label="Buka berkas {{ basename($file->file) }} di tab baru"
                                   class="block bg-white border border-gray-300 rounded-lg overflow-hidden hover:border-blue-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition group">
                                    @if (in_array(pathinfo($file->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img src="{{ route('dokumen.show', $file->file) }}" alt="Pratinjau Berkas {{ basename($file->file) }}" loading="lazy" class="w-full h-24 object-cover group-hover:scale-105 transition-transform duration-200">
                                    @else
                                        <div class="bg-blue-50 h-24 flex items-center justify-center">
                                            <svg aria-hidden="true" class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-2 bg-gray-100 border-t border-gray-200 text-[10px] text-center text-gray-800 font-bold truncate group-hover:text-blue-800">
                                        {{ basename($file->file) }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-700 italic text-center py-4 text-sm font-medium">Tidak ada berkas persyaratan terunggah</p>
                    @endif
                </div>
            </div>

            <!-- Group 2: Selfie & Signature -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden mb-8 shadow-sm">
                <div class="bg-gray-200/80 px-4 py-3 border-b border-gray-200">
                    <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                        <svg aria-hidden="true" class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Verifikasi Identitas & Tanda Tangan Digital
                    </h3>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Selfie -->
                    <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                        <h4 class="font-bold text-gray-800 text-xs uppercase mb-3 flex items-center gap-1.5">
                            <svg aria-hidden="true" class="w-3.5 h-3.5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Foto Selfie Pemohon
                        </h4>
                        @if($transaksi->has_selfie)
                            <div class="border rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                <img src="{{ $transaksi->selfie_url }}" alt="Foto Selfie Pemohon atas nama {{ $transaksi->nama }}" loading="lazy" class="w-full h-48 object-cover">
                            </div>
                        @else
                            <p class="text-gray-700 italic text-sm text-center py-8 font-medium">Tidak ada selfie</p>
                        @endif
                    </div>

                    <!-- Signature -->
                    <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                        <h4 class="font-bold text-gray-800 text-xs uppercase mb-3 flex items-center gap-1.5">
                            <svg aria-hidden="true" class="w-3.5 h-3.5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Tanda Tangan Digital
                        </h4>
                        @if($transaksi->has_signature)
                            <div class="border rounded-lg overflow-hidden bg-gray-50 p-4 flex items-center justify-center h-48">
                                <img src="{{ $transaksi->signature_url }}" alt="Tanda Tangan Digital Pemohon atas nama {{ $transaksi->nama }}" loading="lazy" class="max-h-36 mx-auto">
                            </div>
                        @else
                            <p class="text-gray-700 italic text-sm text-center py-8 font-medium">Tidak ada tanda tangan</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status dengan Badge Warna -->
            <div class="mb-6">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-gray-900">Status:</span>
                    <span class="px-2.5 py-1 rounded {{ $transaksi->statusBadgeClass }} text-white text-xs font-bold shadow-sm">
                        {{ $transaksi->statusLabel }}
                    </span>
                </div>
            </div>

            <!-- Catatan & Informasi -->
            <div class="bg-blue-100 border-l-4 border-blue-700 p-4 rounded-r-lg mb-8">
                <h3 class="font-bold text-blue-950 mb-1 text-base">Petunjuk Penting</h3>
                <ul class="text-sm text-blue-900 list-disc pl-5 space-y-1 font-medium">
                    <li>Simpan ID Transaksi <code class="font-mono font-bold bg-blue-200 px-1 py-0.5 rounded text-blue-950">{{ $transaksi->id_trx }}</code> untuk pengecekan status.</li>
                    <li>Status perkembangan dapat dicek di menu <strong>Lacak</strong>.</li>
                    <li>Siapkan dokumen persyaratan saat pengambilan.</li>
                    <li>Jika status ditolak, Anda bisa mengajukan ulang permohonan di menu <strong>Lacak</strong>, tanpa harus mengajukan baru.</li>
                </ul>
            </div>

            <!-- QR Code Section -->
            <div class="text-center mb-8">
                <p class="text-gray-800 font-bold mb-2">Scan QR Code untuk cek status pengajuan:</p>
                <div class="inline-block bg-white p-2 rounded-xl border border-gray-300 shadow-sm">
                    <canvas id="qrcode" width="150" height="150" aria-label="QR Code Tautan Bukti Permohonan {{ $transaksi->id_trx }}" role="img"></canvas>
                </div>
            </div>
        </div>

        <!-- Footer & Tombol -->
        <div class="bg-gray-100 border-t border-gray-200 px-6 py-4 flex flex-col sm:flex-row justify-center gap-3">
            <button onclick="window.print()" 
                    aria-label="Cetak Bukti Permohonan Ini"
                    class="px-5 py-2.5 bg-blue-700 text-white font-bold rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 flex items-center justify-center transition shadow-sm">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Bukti
            </button>

            <a href="{{ route('tracking.show', $transaksi->id_trx) }}" 
               aria-label="Lacak Status Permohonan {{ $transaksi->id_trx }}"
               class="px-5 py-2.5 bg-green-700 text-white font-bold rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 flex items-center justify-center transition shadow-sm">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Lacak Status
            </a>
        </div>
    </div>

    <p class="text-center text-gray-700 font-semibold text-xs mt-6">
        © {{ date('Y') }} Pondok Dukcapil - Layanan Online | Dokumen ini sah tanpa tanda tangan basah
    </p>
</main>
@endsection

@push('styles')
<style>
@media print {
    body * {
        visibility: hidden;
    }
    #main-content, #main-content * {
        visibility: visible;
    }
    #main-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 20px;
        box-sizing: border-box;
    }
    .bg-blue-800 { background-color: #1e40af !important; }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.0/dist/qrious.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrCanvas = document.getElementById('qrcode');
    if (qrCanvas) {
        new QRious({
            element: qrCanvas,
            value: "{{ url('/bukti/' . $transaksi->id_trx) }}",
            size: 150,
            background: '#ffffff',
            foreground: '#000000',
            level: 'H' // High error correction
        });
    }
});
</script>
@endpush