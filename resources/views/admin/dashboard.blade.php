@extends('layouts.admin')

@section('title', 'Dashboard Admin - Pondok')

@section('content_header_text', 'Dashboard')

@section('content')
@if($transaksiBaruCount ?? 0 > 0)
<div class="container-fluid mb-4 px-0">
    <div class="alert alert-warning d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-triangle me-3 text-lg"></i>
            <div>
                <strong>Perhatian!</strong> Ada <strong>{{ $transaksiBaruCount }}</strong> permohonan baru menunggu verifikasi.
            </div>
        </div>
        <a href="{{ route('admin.transaksi.index', ['status' => 1]) }}" class="btn btn-sm btn-primary">Cek Sekarang !</a>
    </div>
</div>
@endif

<div class="container-fluid px-0">
    <!-- Grid Info Boxes / Statistik -->
    <div class="row g-4 mb-4">
        
        <!-- 1. Permohonan Hari Ini -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $newOrdersToday }}</h3>
                    <p>Permohonan Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['tgl_dari' => now()->toDateString(), 'tgl_sampai' => now()->toDateString()]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 2. Permohonan Diverifikasi -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-lime">
                <div class="inner">
                    <h3>{{ $transaksiVerifikasi }}</h3>
                    <p>Permohonan Diverifikasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clone"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['status' => 2]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 3. Permohonan Diproses -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $transaksiProses }}</h3>
                    <p>Permohonan Diproses</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['status' => 3]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 4. Permohonan Selesai -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $transaksiSelesai }}</h3>
                    <p>Permohonan Selesai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-square"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['status' => 4]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 5. Pengajuan Ulang -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $transaksiUlang }}</h3>
                    <p>Pengajuan Ulang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-undo"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['status' => 6]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 6. Permohonan Ditolak -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $transaksiTolak }}</h3>
                    <p>Permohonan Ditolak</p>
                </div>
                <div class="icon">
                    <i class="fas fa-window-close"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['status' => 5]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 7. Komplain -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{ $transaksiKomplain }}</h3>
                    <p>Komplain</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['status' => 7]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 8. Permohonan Dibatalkan -->
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $transaksiDibatalkan }}</h3>
                    <p>Permohonan Dibatalkan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ban"></i>
                </div>
                <a href="{{ route('admin.transaksi.index', ['status' => 8]) }}" class="small-box-footer">
                    <span>Detail Info</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- Grafik dan Daftar Anggota -->
    <div class="row g-4">
        
        <!-- Grafik Permohonan -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-chart-bar me-2 text-slate-400"></i> Grafik Permohonan</h3>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Members -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h3 class="card-title"><i class="fas fa-users me-2 text-slate-400"></i> Pendaftar Terbaru</h3>
                    <span class="badge bg-danger text-white">{{ $newMembersCount }} Baru (7 Hari Terakhir)</span>
                </div>
                <div class="card-body p-0">
                    <div class="row g-3 py-4 px-4">
                        @foreach($latestMembers as $member)
                            <div class="col-3 text-center">
                                <div class="relative inline-block">
                                    <img src="{{ $member->avatar_url }}" alt="User Image" class="w-14 h-14 rounded-full object-cover ring-2 ring-slate-100 mx-auto shadow-sm">
                                </div>
                                <a class="font-semibold text-slate-700 hover:text-blue-600 text-truncate d-block mt-2 text-decoration-none text-sm" href="{{ route('admin.user.index', ['nama' => $member->name]) }}" title="{{ $member->name }}">
                                    {{ Str::limit($member->name, 10) }}
                                </a>
                                <span class="text-xs text-slate-400">
                                    @if($member->created_at->isToday())
                                        Hari ini
                                    @elseif($member->created_at->isYesterday())
                                        Kemarin
                                    @else
                                        {{ $member->created_at->translatedFormat('d M') }}
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.user.index') }}" class="font-semibold text-blue-600 hover:text-blue-700 text-decoration-none text-sm">Lihat Semua Pengguna</a>
                </div>
            </div>
        </div>
        
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('salesChart').getContext('2d');

    const chartData = @json($data);

    const labels = chartData.map(item => item.keterangan);
    const values = chartData.map(item => item.total);

    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Berdasarkan Jenis Dokumen',
                data: values,
                backgroundColor: [
                    '#3b82f6', // Blue
                    '#10b981', // Emerald green
                    '#f59e0b', // Amber yellow
                    '#ef4444', // Red
                    '#06b6d4', // Cyan
                    '#8b5cf6', // Violet purple
                    '#ec4899', // Pink
                ],
                borderRadius: 8,
                borderWidth: 0,
                maxBarThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Sembunyikan legenda karena warna berbeda-beda untuk tiap batang
                },
                tooltip: {
                    callbacks: {
                        title: (context) => 'Dokumen : ' + context[0].label,
                        label: (context) => 'Jumlah : ' + context.parsed.y
                    },
                    backgroundColor: '#1e293b',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 10,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        color: '#64748b',
                        font: { size: 11 }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: { size: 11 }
                    }
                }
            }
        }
    });
});
</script>
@endsection

@section('css')
<style>
    /* Styling khusus kotak kecil (statistik) */
    .small-box {
        position: relative;
        display: block;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid transparent;
        overflow: hidden;
        transition: all 0.25s ease;
    }
    
    .small-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    }
    
    .small-box .inner {
        position: relative;
        z-index: 10;
    }
    
    .small-box h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 2.25rem;
        font-weight: 800;
        margin: 0 0 0.25rem 0;
        line-height: 1.1;
    }
    
    .small-box p {
        font-size: 0.875rem;
        font-weight: 500;
        margin: 0;
        opacity: 0.85;
    }
    
    .small-box .icon {
        position: absolute;
        right: 1.25rem;
        top: 1.25rem;
        font-size: 2.75rem;
        opacity: 0.15;
        transition: all 0.25s ease;
    }
    
    .small-box:hover .icon {
        transform: scale(1.1);
        opacity: 0.25;
    }
    
    .small-box-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1.25rem;
        padding-top: 0.75rem;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        font-size: 0.775rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: inherit;
        text-decoration: none;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    
    .small-box-footer:hover {
        opacity: 1;
        color: inherit;
    }

    /* Varian warna gradien modern */
    .small-box.bg-info {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #1e40af;
        border-color: #bfdbfe;
    }
    
    .small-box.bg-lime {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        color: #166534;
        border-color: #bbf7d0;
    }
    
    .small-box.bg-primary {
        background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
        color: #3730a3;
        border-color: #c7d2fe;
    }
    
    .small-box.bg-success {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        color: #065f46;
        border-color: #a7f3d0;
    }
    
    .small-box.bg-warning {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        color: #92400e;
        border-color: #fde68a;
    }
    
    .small-box.bg-danger {
        background: linear-gradient(135deg, #fff5f5 0%, #fee2e2 100%);
        color: #c53030;
        border-color: #fecaca;
    }
    
    .small-box.bg-orange {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        color: #9a3412;
        border-color: #fed7aa;
    }
    
    .small-box.bg-secondary {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: #475569;
        border-color: #e2e8f0;
    }
</style>
@endsection
