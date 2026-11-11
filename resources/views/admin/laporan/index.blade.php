@extends('layouts.admin')

@section('title', 'Laporan Statistik & Rekapitulasi - Pondok')

@section('content_header')
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div>
        <p class="text-muted mb-0">Analisis rekapitulasi data transaksi permohonan secara realtime.</p>
    </div>
    <div class="mt-2 mt-md-0">
        <span class="badge badge-info px-3 py-2 font-weight-bold" style="font-size: 0.95rem;">
            Periode: {{ \Carbon\Carbon::parse($tgl_awal)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($tgl_akhir)->format('d/m/Y') }}
        </span>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid pb-5">
    
    {{-- 🌟 CARD FILTER TANGGAL 🌟 --}}
    <div class="card card-filter mb-4">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="mb-0">
                <div class="row row-tight">
                    <div class="col-md-2">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control" value="{{ $tgl_awal }}" required>
                    </div>
                    <div class="col-md-2">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ $tgl_akhir }}" required>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="w-100">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                            <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary ml-2">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- 🌟 PILIHAN TAB LAPORAN 🌟 --}}
    <div class="card card-primary card-tabs shadow-sm border-0">
        <div class="card-header card-header-tabs p-0 pt-1 bg-white border-bottom">
            <ul class="nav nav-tabs" id="laporanTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active px-4 py-3 font-weight-bold text-secondary" id="wilayah-tab" data-toggle="pill" href="#tab-wilayah" role="tab" aria-controls="tab-wilayah" aria-selected="true">
                        <i class="fas fa-map-marked-alt mr-2 text-primary"></i> 1. Rekap Wilayah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-3 font-weight-bold text-secondary" id="dokumen-tab" data-toggle="pill" href="#tab-dokumen" role="tab" aria-controls="tab-dokumen" aria-selected="false">
                        <i class="fas fa-file-contract mr-2 text-info"></i> 2. Rekap Jenis Dokumen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-3 font-weight-bold text-secondary" id="status-tab" data-toggle="pill" href="#tab-status" role="tab" aria-controls="tab-status" aria-selected="false">
                        <i class="fas fa-tasks mr-2 text-warning"></i> 3. Status Pengajuan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-3 font-weight-bold text-secondary" id="bulanan-tab" data-toggle="pill" href="#tab-bulanan" role="tab" aria-controls="tab-bulanan" aria-selected="false">
                        <i class="fas fa-chart-area mr-2 text-success"></i> 4. Tren Bulanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-3 font-weight-bold text-secondary" id="rating-tab" data-toggle="pill" href="#tab-rating" role="tab" aria-controls="tab-rating" aria-selected="false">
                        <i class="fas fa-star mr-2 text-warning"></i> 5. Rating & Ulasan
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="card-body bg-light p-4">
            <div class="tab-content" id="laporanTabContent">
                
                {{-- TAB 1: REKAP WILAYAH (KECAMATAN / DESA) --}}
                <div class="tab-pane fade show active" id="tab-wilayah" role="tabpanel" aria-labelledby="wilayah-tab">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-dark font-weight-bold mb-0">Rekapitulasi Permohonan per Wilayah</h4>
                        <span class="text-muted text-sm">Klik baris kecamatan untuk melihat daftar kelurahan/desa.</span>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="accordion" id="accordionWilayah">
                                @foreach($rekapKecKel as $index => $kec)
                                    <div class="mb-3 shadow-sm border overflow-hidden rounded-lg bg-white" style="border-color: #c8e6c9 !important;">
                                        <div class="kec-header-wrapper p-0 border-0">
                                            <div class="d-flex justify-content-between align-items-center p-3 cursor-pointer transition-all kec-header w-100" 
                                                 data-target="#collapseKec{{ $kec['id'] }}" 
                                                 aria-expanded="false"
                                                 style="cursor: pointer;">
                                                <h5 class="font-weight-bold mb-0 text-dark d-flex align-items-center" style="font-size: 0.88rem;">
                                                    <i class="fas fa-map-marker-alt mr-3 text-primary" style="font-size: 1.05rem;"></i> 
                                                    Kecamatan {{ $kec['nama'] }}
                                                </h5>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-primary px-3 py-2 mr-3 font-weight-bold" style="font-size: 0.8rem; border-radius: 50px;">
                                                        {{ $kec['total'] }} Permohonan
                                                    </span>
                                                    <i class="fas fa-chevron-down text-muted transition-transform" id="iconKec{{ $kec['id'] }}"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapseKec{{ $kec['id'] }}" class="kec-collapse" style="display: none;">
                                            <div class="p-0 border-top">
                                                @if(count($kec['desas']) > 0)
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-striped mb-0">
                                                            <thead class="bg-gray-100 text-uppercase text-xs font-weight-bold text-secondary">
                                                                <tr>
                                                                    <th class="pl-4 py-3">Nama Kelurahan / Desa</th>
                                                                    <th class="text-right pr-4 py-3" style="width: 250px;">Jumlah Permohonan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($kec['desas'] as $desa)
                                                                    <tr class="transition-all">
                                                                        <td class="pl-4 py-3 text-secondary font-weight-500">{{ $desa['nama'] }}</td>
                                                                        <td class="text-right pr-4 py-3 font-weight-bold text-dark" style="font-size: 1.05rem;">
                                                                            {{ $desa['total'] }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <div class="p-4 text-center text-muted">
                                                        <i class="fas fa-info-circle mr-2 text-info"></i> Tidak ada rincian kelurahan/desa atau tidak ada data permohonan.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-chart-bar mr-2 text-primary"></i> Grafik Ranking Kecamatan
                                    </h5>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 420px;">
                                    @php
                                        $totalKec = array_sum(array_column($rekapKecKel, 'total'));
                                    @endphp
                                    @if($totalKec > 0)
                                        <div style="width: 100%; height: 420px; position: relative;">
                                            <canvas id="chartKecamatan"></canvas>
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="fas fa-map-marked-alt fa-3x mb-3 text-gray-300"></i>
                                            <p class="font-weight-500 mb-0">Tidak ada data wilayah dalam rentang tanggal ini.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: REKAP JENIS DOKUMEN --}}
                <div class="tab-pane fade" id="tab-dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-list-ol mr-2 text-info"></i> Tabel Distribusi Jenis Dokumen
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    @php
                                        $totalDocs = array_sum(array_column($rekapDokumen, 'total'));
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="bg-gray-100 text-uppercase text-xs font-weight-bold text-secondary">
                                                <tr>
                                                    <th class="pl-4 py-3">Nama Dokumen / Layanan</th>
                                                    <th class="py-3" style="width: 35%;">Distribusi %</th>
                                                    <th class="text-right pr-4 py-3" style="width: 120px;">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rekapDokumen as $id => $doc)
                                                    @php
                                                        $pct = $totalDocs > 0 ? round(($doc['total'] / $totalDocs) * 100, 1) : 0;
                                                    @endphp
                                                    <tr>
                                                        <td class="pl-4 py-3 align-middle">
                                                            <div class="font-weight-bold text-dark mb-0">{{ $doc['nama'] }}</div>
                                                            <small class="text-muted d-block text-xs">{{ $doc['keterangan'] }}</small>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="progress rounded-pill mb-1" style="height: 7px; background-color: #e9ecef;">
                                                                <div class="progress-bar bg-info rounded-pill" style="width: {{ $pct }}%"></div>
                                                            </div>
                                                            <small class="text-muted font-weight-500">{{ $pct }}%</small>
                                                        </td>
                                                        <td class="text-right pr-4 align-middle font-weight-bold text-info" style="font-size: 1.15rem;">
                                                            {{ $doc['total'] }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold text-secondary">Total Seluruh Dokumen:</span>
                                    <span class="badge badge-info px-3 py-2 font-weight-bold" style="font-size: 1rem; border-radius: 50px;">{{ $totalDocs }} Dokumen</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-chart-pie mr-2 text-info"></i> Visualisasi Persentase Dokumen
                                    </h5>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 380px;">
                                    @if($totalDocs > 0)
                                        <div style="width: 100%; height: 340px; position: relative;">
                                            <canvas id="chartDokumen"></canvas>
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="fas fa-chart-pie fa-3x mb-3 text-gray-300"></i>
                                            <p class="font-weight-500 mb-0">Tidak ada data dokumen dalam rentang tanggal ini.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 3: STATUS PENGAJUAN --}}
                <div class="tab-pane fade" id="tab-status" role="tabpanel" aria-labelledby="status-tab">
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-clipboard-list mr-2 text-warning"></i> Rekap Status Permohonan
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    @php
                                        $totalStatus = array_sum(array_column($rekapStatus, 'total'));
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="bg-gray-100 text-uppercase text-xs font-weight-bold text-secondary">
                                                <tr>
                                                    <th class="pl-4 py-3">Label Status</th>
                                                    <th class="text-right pr-4 py-3" style="width: 180px;">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rekapStatus as $stat)
                                                    @php
                                                        $pct = $totalStatus > 0 ? round(($stat['total'] / $totalStatus) * 100, 1) : 0;
                                                    @endphp
                                                    <tr>
                                                        <td class="pl-4 py-3 align-middle">
                                                            <span class="badge badge-{{ $stat['badge_class'] }} px-3 py-2 font-weight-bold shadow-sm" style="font-size: 0.85rem; border-radius: 4px;">
                                                                {{ $stat['label'] }}
                                                            </span>
                                                        </td>
                                                        <td class="text-right pr-4 align-middle font-weight-bold text-dark" style="font-size: 1.15rem;">
                                                            {{ $stat['total'] }}
                                                            <small class="text-muted ml-2 font-weight-normal" style="font-size: 0.8rem;">({{ $pct }}%)</small>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold text-secondary">Total Seluruh Transaksi:</span>
                                    <span class="badge badge-warning text-dark px-3 py-2 font-weight-bold" style="font-size: 1rem; border-radius: 50px;">{{ $totalStatus }} Transaksi</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-chart-bar mr-2 text-warning"></i> Distribusi Status
                                    </h5>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 380px;">
                                    @if($totalStatus > 0)
                                        <div style="width: 100%; height: 340px; position: relative;">
                                            <canvas id="chartStatus"></canvas>
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="fas fa-chart-bar fa-3x mb-3 text-gray-300"></i>
                                            <p class="font-weight-500 mb-0">Tidak ada data transaksi dalam rentang tanggal ini.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 4: TREN BULANAN --}}
                <div class="tab-pane fade" id="tab-bulanan" role="tabpanel" aria-labelledby="bulanan-tab">
                    <div class="row">
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-history mr-2 text-success"></i> Tabel Histori Bulanan
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    @if(count($rekapBulanan) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead class="bg-gray-100 text-uppercase text-xs font-weight-bold text-secondary">
                                                    <tr>
                                                        <th class="pl-4 py-3">Bulan & Tahun</th>
                                                        <th class="text-right pr-4 py-3" style="width: 180px;">Jumlah Permohonan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rekapBulanan as $row)
                                                        <tr>
                                                            <td class="pl-4 py-3 align-middle font-weight-bold text-secondary">{{ $row['bulan'] }}</td>
                                                            <td class="text-right pr-4 align-middle font-weight-bold text-success" style="font-size: 1.15rem;">
                                                                {{ $row['total'] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="p-5 text-center text-muted">
                                            <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                                            <p class="mb-0 font-weight-500">Tidak ada data bulanan.</p>
                                        </div>
                                    @endif
                                </div>
                                @if(count($rekapBulanan) > 0)
                                    @php
                                        $totalBulanan = array_sum(array_column($rekapBulanan, 'total'));
                                    @endphp
                                    <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold text-secondary">Total Seluruh Permohonan:</span>
                                        <span class="badge badge-success px-3 py-2 font-weight-bold" style="font-size: 1rem; border-radius: 50px;">{{ $totalBulanan }} Permohonan</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-7">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-chart-line mr-2 text-success"></i> Grafik Tren Pengajuan
                                    </h5>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 380px;">
                                    @if(count($rekapBulanan) > 0)
                                        <div style="width: 100%; height: 340px; position: relative;">
                                            <canvas id="chartBulanan"></canvas>
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="fas fa-chart-line fa-3x mb-3 text-gray-300"></i>
                                            <p class="font-weight-500 mb-0">Tidak ada data grafik tren bulanan.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 5: RATING & ULASAN --}}
                <div class="tab-pane fade" id="tab-rating" role="tabpanel" aria-labelledby="rating-tab">
                    <div class="row">
                        <!-- Left Column: Rating Summary and Stars Distribution -->
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-star mr-2 text-warning"></i> Ringkasan Kepuasan
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <h1 class="display-3 font-weight-bold text-dark mb-1">{{ $averageRating }}</h1>
                                        <div class="text-warning mb-2" style="font-size: 1.5rem;">
                                            @php
                                                $fullStars = floor($averageRating);
                                                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                                $emptyStars = 5 - $fullStars - $halfStar;
                                            @endphp
                                            @for($i = 0; $i < $fullStars; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            @if($halfStar)
                                                <i class="fas fa-star-half-alt"></i>
                                            @endif
                                            @for($i = 0; $i < $emptyStars; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        </div>
                                        <p class="text-muted font-weight-500 mb-0">Rata-rata Rating dari <strong>{{ $totalRatings }}</strong> Responden</p>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    <h6 class="font-weight-bold text-secondary mb-3">Distribusi Penilaian</h6>
                                    @php
                                        // Colors mapping for stars: 5=green, 4=greenish, 3=yellow, 2=orange, 1=red
                                        $starColors = [
                                            5 => 'bg-success',
                                            4 => 'bg-success',
                                            3 => 'bg-warning',
                                            2 => 'bg-orange',
                                            1 => 'bg-danger'
                                        ];
                                    @endphp
                                    @foreach(range(5, 1) as $star)
                                        @php
                                            $count = $starCounts[$star] ?? 0;
                                            $pct = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
                                            $color = $starColors[$star] ?? 'bg-secondary';
                                        @endphp
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="text-secondary font-weight-bold mr-3" style="width: 70px; font-size: 0.8rem; line-height: 1.2;">{{ $star }} Bintang</span>
                                            <div class="progress flex-grow-1 mr-3" style="height: 12px; border-radius: 6px;">
                                                <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $pct }}%; border-radius: 6px;" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-dark font-weight-bold text-right" style="width: 70px;">{{ $count }} <small class="text-muted">({{ round($pct, 1) }}%)</small></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Recent Review Comments -->
                        <div class="col-lg-7">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                                        <i class="fas fa-comments mr-2 text-primary"></i> Daftar Ulasan & Penilaian
                                    </h5>
                                    <div class="card-tools">
                                        <select id="filter-rating-select" class="form-control form-control-sm" style="width: 175px; border-radius: 30px; font-weight: bold; border: 1px solid #ced4da;">
                                            <option value="all">⭐ Semua Rating ({{ $totalRatings }})</option>
                                            <option value="5">⭐⭐⭐⭐⭐ ({{ $starCounts[5] ?? 0 }})</option>
                                            <option value="4">⭐⭐⭐⭐ ({{ $starCounts[4] ?? 0 }})</option>
                                            <option value="3">⭐⭐⭐ ({{ $starCounts[3] ?? 0 }})</option>
                                            <option value="2">⭐⭐ ({{ $starCounts[2] ?? 0 }})</option>
                                            <option value="1">⭐ ({{ $starCounts[1] ?? 0 }})</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body p-0" style="max-height: 480px; overflow-y: auto;">
                                    @if(count($latestReviews) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead class="bg-gray-100 text-uppercase text-xs font-weight-bold text-secondary">
                                                    <tr>
                                                        <th class="pl-4 py-3">Pemohon & Tanggal</th>
                                                        <th class="py-3" style="width: 130px;">Penilaian</th>
                                                        <th class="pr-4 py-3">Komentar / Ulasan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="reviews-table-body">
                                                    @foreach($latestReviews as $review)
                                                        <tr class="review-row" data-rating="{{ $review->rating }}">
                                                            <td class="pl-4 py-3 align-middle">
                                                                <div class="font-weight-bold text-dark">{{ $review->nama }}</div>
                                                                <small class="text-muted d-block">{{ $review->tgl_rating ? $review->tgl_rating->format('d/m/Y H:i') : '-' }}</small>
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                <div class="text-warning">
                                                                    @for($i = 0; $i < $review->rating; $i++)
                                                                        <i class="fas fa-star"></i>
                                                                    @endfor
                                                                    @for($i = $review->rating; $i < 5; $i++)
                                                                        <i class="far fa-star"></i>
                                                                    @endfor
                                                                </div>
                                                            </td>
                                                            <td class="pr-4 py-3 align-middle font-weight-500">
                                                                @if(!empty($review->komentar_rating))
                                                                    <div class="text-secondary" style="font-size: 0.95rem;">
                                                                        "{{ $review->komentar_rating }}"
                                                                    </div>
                                                                @else
                                                                    <span class="text-muted font-italic text-sm">Tidak ada komentar tertulis.</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="p-5 text-center text-muted">
                                            <i class="far fa-comments fa-3x mb-3 text-gray-300"></i>
                                            <p class="mb-0 font-weight-500">Tidak ada ulasan dalam rentang tanggal ini.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@stop

@section('css')
<style>
    /* Premium Styling and Animations */
    .transition-all {
        transition: all 0.25s ease-in-out;
    }
    .transition-transform {
        transition: transform 0.25s ease-in-out;
    }
    .rotate-180 {
        transform: rotate(180deg);
    }
    .cursor-pointer:hover {
        background-color: #f8f9fa !important;
    }
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease-in-out;
    }
    .nav-tabs .nav-link:hover {
        border-color: #e9ecef;
        color: #495057 !important;
    }
    .nav-tabs .nav-link.active {
        border-bottom: 3px solid #007bff !important;
        color: #007bff !important;
        background: transparent !important;
    }
    .progress-bar {
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .kec-header[aria-expanded="true"] {
        border-bottom: 1px solid #dee2e6;
        background-color: #f4f6f9 !important;
    }
    .bg-gray-100 {
        background-color: #f8f9fa;
    }
    .font-weight-500 {
        font-weight: 500;
    }
    
    /* Hover effects for tables */
    .table tbody tr {
        transition: background-color 0.15s ease-in-out;
    }
    .table tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.035) !important;
    }
</style>
@stop

@section('js')
{{-- Load Chart.js from CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function () {
    
    // Manually handle click on kecamatan header to toggle collapse with smooth jQuery slide
    $(document).on('click', '.kec-header', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var target = $(this).attr('data-target');
        var id = target.replace('#collapseKec', '');
        var icon = $('#iconKec' + id);
        
        var isExpanded = $(this).attr('aria-expanded') === 'true';
        
        // Accordion behavior: close other panels
        $('.kec-collapse').not(target).slideUp(300);
        $('.kec-header').not(this).attr('aria-expanded', 'false');
        $('.kec-header').not(this).find('.fa-chevron-down').removeClass('rotate-180');
        
        // Toggle current panel
        if (isExpanded) {
            $(this).attr('aria-expanded', 'false');
            icon.removeClass('rotate-180');
            $(target).slideUp(300);
        } else {
            $(this).attr('aria-expanded', 'true');
            icon.addClass('rotate-180');
            $(target).slideDown(300);
        }
    });

    // Handle Chart.js Redraw on Tab Switch (Avoid 0-width bug)
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        // Force charts to update layout when they become visible
        if (typeof chartKecamatanInstance !== 'undefined') chartKecamatanInstance.resize();
        if (typeof chartDokumenInstance !== 'undefined') chartDokumenInstance.resize();
        if (typeof chartStatusInstance !== 'undefined') chartStatusInstance.resize();
        if (typeof chartBulananInstance !== 'undefined') chartBulananInstance.resize();
    });

    // -------------------------------------------------------------
    // CHART 0: KECAMATAN (TAB 1)
    // -------------------------------------------------------------
    @if(isset($totalKec) && $totalKec > 0)
        const ctxKecamatan = document.getElementById('chartKecamatan').getContext('2d');
        const dataKecamatan = @json($rekapKecKel);
        
        // Filter out unmatched/Lainnya if you want, or keep all
        const filteredKec = dataKecamatan.filter(item => item.id !== 'unmatched' && item.total > 0);
        
        // Sort by total descending for ranking
        filteredKec.sort((a, b) => b.total - a.total);
        
        const labelsKec = filteredKec.map(item => item.nama);
        const valuesKec = filteredKec.map(item => item.total);
        
        window.chartKecamatanInstance = new Chart(ctxKecamatan, {
            type: 'bar',
            data: {
                labels: labelsKec,
                datasets: [{
                    label: 'Jumlah Permohonan',
                    data: valuesKec,
                    backgroundColor: 'rgba(0, 123, 255, 0.75)',
                    hoverBackgroundColor: 'rgba(0, 123, 255, 0.95)',
                    borderRadius: 6,
                    borderWidth: 0
                }]
            },
            options: {
                indexAxis: 'y', // Makes it a horizontal bar chart
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold' } }
                    }
                }
            }
        });
    @endif

    // -------------------------------------------------------------
    // CHART 1: DOKUMEN (TAB 2)
    // -------------------------------------------------------------
    @if(isset($totalDocs) && $totalDocs > 0)
        const ctxDokumen = document.getElementById('chartDokumen').getContext('2d');
        const dataDokumen = @json(array_values($rekapDokumen));
        
        // Filter out items with 0 count to make chart cleaner
        const filteredDocs = dataDokumen.filter(item => item.total > 0);
        
        const labelsDokumen = filteredDocs.map(item => item.nama);
        const valuesDokumen = filteredDocs.map(item => item.total);
        
        window.chartDokumenInstance = new Chart(ctxDokumen, {
            type: 'doughnut',
            data: {
                labels: labelsDokumen,
                datasets: [{
                    data: valuesDokumen,
                    backgroundColor: [
                        '#17a2b8', // info / cyan
                        '#007bff', // primary / blue
                        '#28a745', // success / green
                        '#fd7e14', // orange
                        '#6f42c1', // purple
                        '#e83e8c', // pink
                        '#ffc107', // warning / yellow
                        '#20c997', // teal
                        '#dc3545', // danger / red
                        '#6c757d'  // secondary / grey
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 15,
                            font: { size: 12, weight: 'bold' },
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.parsed || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return ` ${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });
    @endif

    // -------------------------------------------------------------
    // CHART 2: STATUS (TAB 3)
    // -------------------------------------------------------------
    @if(isset($totalStatus) && $totalStatus > 0)
        const ctxStatus = document.getElementById('chartStatus').getContext('2d');
        const dataStatus = @json($rekapStatus);
        
        // Map labels, values and status colors
        const labelsStatus = dataStatus.map(item => item.label);
        const valuesStatus = dataStatus.map(item => item.total);
        
        // Color mapping sesuai status badge bootstrap
        const colorMap = {
            'warning': '#ffc107',    // Baru
            'secondary': '#6c757d',  // Verifikasi
            'primary': '#007bff',    // Proses
            'success': '#28a745',    // Selesai
            'danger': '#dc3545',     // Ditolak
            'info': '#17a2b8',       // Pengajuan Ulang
            'dark': '#343a40',       // Dibatalkan
            'light': '#f8f9fa'
        };
        const bgColorsStatus = dataStatus.map(item => colorMap[item.badge_class] || '#6c757d');

        window.chartStatusInstance = new Chart(ctxStatus, {
            type: 'bar',
            data: {
                labels: labelsStatus,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: valuesStatus,
                    backgroundColor: bgColorsStatus,
                    borderRadius: 6,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold' } }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    @endif

    // -------------------------------------------------------------
    // CHART 3: BULANAN (TAB 4)
    // -------------------------------------------------------------
    @if(count($rekapBulanan) > 0)
        const ctxBulanan = document.getElementById('chartBulanan').getContext('2d');
        const dataBulanan = @json($rekapBulanan);
        
        const labelsBulanan = dataBulanan.map(item => item.bulan);
        const valuesBulanan = dataBulanan.map(item => item.total);

        window.chartBulananInstance = new Chart(ctxBulanan, {
            type: 'line',
            data: {
                labels: labelsBulanan,
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: valuesBulanan,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.15)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 3,
                    pointBackgroundColor: '#28a745',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold' } }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    @endif
    // -------------------------------------------------------------
    // RATING FILTER FOR REVIEW TABLE (TAB 5)
    // -------------------------------------------------------------
    $('#filter-rating-select').on('change', function() {
        const val = $(this).val();
        let visibleCount = 0;
        
        $('.review-row').each(function() {
            const rowRating = $(this).data('rating').toString();
            if (val === 'all' || rowRating === val) {
                $(this).show();
                visibleCount++;
            } else {
                $(this).hide();
            }
        });
        
        // Handle empty placeholder row
        if (visibleCount === 0) {
            if ($('#no-reviews-row').length === 0) {
                $('#reviews-table-body').append(`
                    <tr id="no-reviews-row">
                        <td colspan="3" class="text-center p-5 text-muted font-italic bg-white">
                            <i class="fas fa-info-circle mr-2 text-info"></i> Tidak ada ulasan dengan rating ${val} bintang.
                        </td>
                    </tr>
                `);
            } else {
                $('#no-reviews-row td').html(`<i class="fas fa-info-circle mr-2 text-info"></i> Tidak ada ulasan dengan rating ${val} bintang.`);
                $('#no-reviews-row').show();
            }
        } else {
            $('#no-reviews-row').hide();
        }
    });

});
</script>
@stop
