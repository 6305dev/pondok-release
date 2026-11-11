@extends('layouts.admin')

@section('title', 'Admin - Transaksi')

@section('content_header')
<!-- <h1>Manajemen Transaksi Permohonan</h1> -->
@stop

@section('content')
<div class="container-fluid">
    <!-- Filter Form -->
    <div class="card card-filter mb-4">
        <div class="card-header">
            <h5>Filter Data</h5>
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row row-tight">
                    <div class="col-md-2">
                        <label>Id Transaksi</label>
                        <input type="text" name="id_trx" class="form-control" placeholder="Masukan Id Trx" value="{{ request('id_trx') }}">
                    </div>
                    <div class="col-md-2">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Ketik Nama" value="{{ request('nama') }}">
                    </div>
                    <div class="col-md-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            @foreach(\App\Models\Transaksi::statusLabels() as $value => $label)
                            <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Jenis Dokumen</label>
                        <select name="filter_jenis" class="form-control">
                            <option value="">Semua Jenis</option>
                            @foreach($filterGroups as $group => $keyword)
                            <option value="{{ $group }}" {{ request('filter_jenis') == $group ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Tgl. Dari</label>
                        <input type="date" name="tgl_dari" class="form-control" value="{{ request('tgl_dari') }}">
                    </div>
                    <div class="col-md-2">
                        <label>Tgl. Sampai</label>
                        <input type="date" name="tgl_sampai" class="form-control" value="{{ request('tgl_sampai') }}">
                    </div>
                    <div class="col-12 mt-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary ml-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>DAFTAR PERMOHONAN</b></h3>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif


        <div class="table-responsive">
            <!-- <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID TRX</th>
                        <th>Nama & NIK</th>
                        <th>Jenis Layanan</th>
                        <th>Progress Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr>
                        <td>
                            <div><strong>{{ $t->id_trx }}</strong></div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($t->tgl)->format('d-m-Y H:i') }}</small>
                        </td>
                        <td>
                            <div><strong>{{ $t->nama }}</strong></div>
                            <small class="text-muted">{{ $t->nik }}</small>
                        </td>
                        <td>{{ $t->jenisPelayanan->nama ?? 'Lainnya' }}</td>
                        <td>
                            <span class="badge {{ $t->status_badge_class }}">
                                {{ $t->status_label }}
                            </span>

                            @if($t->status == 4 && $t->konfirmasi == 'Y')
                            <span class="badge bg-success ml-1">Ter-Konfirmasi</span>
                            @endif

                            <br>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($t->tgl)->format('d-m-Y H:i') }}
                            </small>
                        </td>
                        <td>
                            <a href="{{ route('admin.transaksi.show', $t->id_trx) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table> -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID TRX</th>
                            <th>Nama & NIK</th>
                            <th>Jenis Layanan</th>
                            <th>Progress Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr>
                        <td>
                            <div><strong>{{ $t->id_trx }}</strong></div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($t->tgl)->format('d-m-Y H:i') }}</small>
                        </td>
                        <td>
                            <div><strong>{{ $t->nama }}</strong></div>
                            <small class="text-muted">{{ $t->nik }}</small>
                        </td>
                        
                        {{-- 🌟 BAGIAN PERBAIKAN JENIS LAYANAN (SAMA SEPERTI DETAIL.PHP) 🌟 --}}
                        <td style="vertical-align: top;">
                            @php
                                $rawLayananDetail = $t->id_dokumen;
                                $idsDetail = [];
                                $isDataLama = false; // Flag penanda data lama

                                if (!empty($rawLayananDetail)) {
                                    if (is_array($rawLayananDetail)) {
                                        $idsDetail = $rawLayananDetail;
                                    } else {
                                        // Deteksi apakah string mengandung '[' (Karakter JSON Array)
                                        if (!str_contains($rawLayananDetail, '[')) {
                                            // JALUR DATA LAMA: Angka tunggal murni (seperti 9 atau 6)
                                            $isDataLama = true;
                                            $pureString = trim(str_replace(['"', "'"], '', $rawLayananDetail));
                                            if ($pureString !== '') {
                                                $idsDetail = [$pureString];
                                            }
                                        } else {
                                            // JALUR DATA BARU: Format array JSON (seperti ["6","3"])
                                            $cleanJson = html_entity_decode($rawLayananDetail);
                                            $decoded = json_decode($cleanJson, true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                $idsDetail = $decoded;
                                            }
                                        }
                                    }
                                }

                                // MAPPING UTAMA (Hanya berlaku untuk data baru sekarang dan seterusnya)
                                $layananMapDetail = [
                                    '1' => 'Kartu Keluarga',
                                    '2' => 'KTP',
                                    '3' => 'KIA',
                                    '4' => 'Pindah',  
                                    '5' => 'Datang',
                                    '6' => 'Akta Kelahiran',                    
                                    '7' => 'Akta Kematian',
                                    '8' => 'Akta Perkawinan',
                                    '9' => 'Akta Perceraian',
                                    '10' => 'Lainnya' // Jika data baru mengirim ID 10, akan tertulis "Lainnya"                                     
                                ];
                            @endphp

                            @if(!empty($idsDetail) && is_array($idsDetail))
                                <ul style="list-style-type: none; padding-left: 0; margin-bottom: 0; margin-top: 0; text-align: left;">
                                    @foreach($idsDetail as $idDetail)
                                        @php
                                            $cleanId = trim((string)$idDetail);
                                        @endphp
                                        
                                        <li style="margin-bottom: 4px; font-size: 0.85rem; font-weight: 500; color: #111827;">
                                            {{-- Jika terdeteksi DATA LAMA, langsung paksa cari ke DATABASE --}}
                                            @if($isDataLama)
                                                @php
                                                    $layananDb = \App\Models\JenisPelayanan::find($cleanId);
                                                @endphp
                                                @if($layananDb)
                                                    - {{ $layananDb->nama ?? $layananDb->nama_layanan }}
                                                @else
                                                    - Layanan Lama (ID: {{ $cleanId }})
                                                @endif

                                            {{-- Jika DATA BARU, gunakan MAPPING UTAMA terlebih dahulu --}}
                                            @else
                                                @if(isset($layananMapDetail[$cleanId]))
                                                    - {{ $layananMapDetail[$cleanId] }}
                                                @else
                                                    @php
                                                        $layananDbBaru = \App\Models\JenisPelayanan::find($cleanId);
                                                    @endphp
                                                    - {{ $layananDbBaru->nama ?? "Layanan ID: $cleanId" }}
                                                @endif
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span style="color: #6b7280; font-style: italic; font-size: 0.85rem;">Tidak ada layanan</span>
                            @endif
                        </td>
                        {{-- 🌟 END BAGIAN PERBAIKAN 🌟 --}}

                        <td>
                            @php
                                $tglBaru = $t->tgl ? \Carbon\Carbon::parse($t->tgl) : null;
                                $tglRespon = $t->tgl_respon ? \Carbon\Carbon::parse($t->tgl_respon) : null;
                                $tglProses = $t->tgl_proses ? \Carbon\Carbon::parse($t->tgl_proses) : null;
                                $tglSelesai = $t->tgl_selesai ? \Carbon\Carbon::parse($t->tgl_selesai) : null;
                                $tglUpdate = $t->updated_at ? \Carbon\Carbon::parse($t->updated_at) : null;

                                $durasiStr = null;
                                if ($tglProses && $tglSelesai) {
                                    $diff = $tglProses->diff($tglSelesai);
                                    $parts = [];
                                    if ($diff->d > 0) $parts[] = $diff->d . ' hari';
                                    if ($diff->h > 0) $parts[] = $diff->h . ' jam';
                                    if ($diff->i > 0) $parts[] = $diff->i . ' menit';
                                    $durasiStr = !empty($parts) ? implode(', ', $parts) : '0 menit';
                                }
                            @endphp

                            <div class="d-flex flex-column gap-1" style="font-size: 12px; line-height: 1.6;">
                                @if($tglBaru)
                                <div>
                                    <span class="badge badge-warning" style="width: 75px; display: inline-block; text-align: center; color: #212529;">Baru</span>
                                    <span class="font-weight-bold ml-1" style="color: #d39e00 !important;">{{ $tglBaru->format('d-m-Y H:i') }}</span>
                                </div>
                                @endif

                                @if($tglRespon)
                                <div>
                                    <span class="badge badge-secondary" style="width: 75px; display: inline-block; text-align: center;">Verifikasi</span>
                                    <span class="text-secondary ml-1">{{ $tglRespon->format('d-m-Y H:i') }}</span>
                                </div>
                                @endif

                                @if($tglProses)
                                <div>
                                    <span class="badge badge-info" style="width: 75px; display: inline-block; text-align: center;">Proses</span>
                                    <span class="text-info font-weight-bold ml-1">{{ $tglProses->format('d-m-Y H:i') }}</span>
                                </div>
                                @endif

                                @if($tglSelesai)
                                <div>
                                    <span class="badge badge-success" style="width: 75px; display: inline-block; text-align: center;">Selesai</span>
                                    <span class="text-success font-weight-bold ml-1">{{ $tglSelesai->format('d-m-Y H:i') }}</span>
                                </div>
                                @endif

                                @if($t->status == 5)
                                <div>
                                    <span class="badge badge-danger" style="width: 75px; display: inline-block; text-align: center;">Ditolak</span>
                                    <span class="text-danger font-weight-bold ml-1">{{ $tglUpdate ? $tglUpdate->format('d-m-Y H:i') : '' }}</span>
                                </div>
                                @endif

                                @if($t->status == 8)
                                <div>
                                    <span class="badge badge-danger" style="width: 75px; display: inline-block; text-align: center;">Batal</span>
                                    <span class="text-danger font-weight-bold ml-1">{{ $tglUpdate ? $tglUpdate->format('d-m-Y H:i') : '' }}</span>
                                </div>
                                @endif

                                @if($t->status == 6)
                                <div>
                                    <span class="badge badge-primary" style="width: 75px; display: inline-block; text-align: center; background-color: #6f42c1;">Ulang</span>
                                    <span class="text-purple font-weight-bold ml-1" style="color: #6f42c1 !important;">{{ $tglUpdate ? $tglUpdate->format('d-m-Y H:i') : '' }}</span>
                                </div>
                                @endif

                                @if($t->status == 7)
                                <div>
                                    <span class="badge badge-danger" style="width: 75px; display: inline-block; text-align: center;">Komplain</span>
                                    <span class="text-danger font-weight-bold ml-1">{{ $tglUpdate ? $tglUpdate->format('d-m-Y H:i') : '' }}</span>
                                </div>
                                @endif

                                @if($durasiStr)
                                <div class="mt-1">
                                    <span class="badge badge-dark" style="width: 75px; display: inline-block; text-align: center;">Durasi</span>
                                    <span class="text-primary font-weight-bold ml-1">{{ $durasiStr }}</span>
                                </div>
                                @endif


                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.transaksi.show', $t->id_trx) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-3">
                <div class="mb-2 mb-md-0 text-muted">
                    Showing {{ $transaksis->firstItem() ?? 0 }} to {{ $transaksis->lastItem() ?? 0 }} of {{ $transaksis->total() }} results
                </div>
                <div class="w-100 w-md-auto d-flex justify-content-start justify-content-md-end overflow-auto py-1 no-scrollbar">
                    {{ $transaksis->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
