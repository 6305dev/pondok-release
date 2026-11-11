@extends('layouts.admin')

@section('title', 'Sinkronisasi - Riwayat Hapus')

@section('content_header')
    <h1>Sinkronisasi Data</h1>
@stop

@section('content')
<div class="container-fluid pb-5">
    
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white py-3">
            <h3 class="card-title font-weight-bold mb-0 text-white" style="font-size: 1.1rem;">
                <i class="fas fa-trash-alt mr-2 text-white"></i> Riwayat Hapus (Transaksi Backup)
            </h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle mr-2"></i> Berikut adalah daftar transaksi permohonan yang telah dihapus dari tabel transaksi utama dan dipindahkan ke penyimpanan cadangan (*backup*).
            </div>


            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>ID Transaksi</th>
                            <th>NIK</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Layanan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Dihapus</th>
                            <th class="text-center" style="width: 100px;">Status</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backups as $index => $item)
                            <tr>
                                <td class="text-center">{{ $backups->firstItem() + $index }}</td>
                                <td class="font-weight-bold">{{ $item->id_trx }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama }}</td>
                                <td style="vertical-align: top;">
                                    @php
                                        $rawLayananDetail = $item->id_dokumen;
                                        $idsDetail = [];
                                        $isDataLama = false;

                                        if (!empty($rawLayananDetail)) {
                                            if (is_array($rawLayananDetail)) {
                                                $idsDetail = $rawLayananDetail;
                                            } else {
                                                if (!str_contains($rawLayananDetail, '[')) {
                                                    $isDataLama = true;
                                                    $pureString = trim(str_replace(['"', "'"], '', $rawLayananDetail));
                                                    if ($pureString !== '') {
                                                        $idsDetail = [$pureString];
                                                    }
                                                } else {
                                                    $cleanJson = html_entity_decode($rawLayananDetail);
                                                    $decoded = json_decode($cleanJson, true);
                                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                        $idsDetail = $decoded;
                                                    }
                                                }
                                            }
                                        }

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
                                            '10' => 'Lainnya'                                
                                        ];
                                    @endphp

                                    @if(!empty($idsDetail) && is_array($idsDetail))
                                        <ul style="list-style-type: none; padding-left: 0; margin-bottom: 0; margin-top: 0;">
                                            @foreach($idsDetail as $idDetail)
                                                @php
                                                    $cleanId = trim((string)$idDetail);
                                                @endphp
                                                <li style="margin-bottom: 2px; font-size: 0.88rem; font-weight: 500; color: #111827;">
                                                    @if($isDataLama)
                                                        @php
                                                            $layananDb = \App\Models\JenisPelayanan::find($cleanId);
                                                        @endphp
                                                        @if($layananDb)
                                                            - {{ $layananDb->nama ?? $layananDb->nama_layanan }}
                                                        @else
                                                            - Layanan Lama (ID: {{ $cleanId }})
                                                        @endif
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
                                <td>{{ $item->tgl ? \Carbon\Carbon::parse($item->tgl)->format('d/m/Y H:i') : '-' }}</td>
                                <td class="text-danger font-weight-bold">
                                    {{ $item->deleted_at ? \Carbon\Carbon::parse($item->deleted_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td>
                                    @php
                                        // Map status labels & badges manually since $item is a stdClass from query builder
                                        $statuses = [
                                            1 => ['label' => 'Baru', 'class' => 'badge-warning text-dark'],
                                            2 => ['label' => 'Verifikasi', 'class' => 'badge-secondary text-white'],
                                            3 => ['label' => 'Proses', 'class' => 'badge-info text-white'],
                                            4 => ['label' => 'Selesai', 'class' => 'badge-success text-white'],
                                            5 => ['label' => 'Ditolak', 'class' => 'badge-danger text-white'],
                                            6 => ['label' => 'Belum Lengkap', 'class' => 'badge-warning text-dark'],
                                            7 => ['label' => 'Komplain', 'class' => 'badge-danger text-white'],
                                            8 => ['label' => 'Batal', 'class' => 'badge-dark text-white']
                                        ];
                                        $mapped = $statuses[$item->status] ?? ['label' => 'Unknown', 'class' => 'badge-light'];
                                    @endphp
                                    <span class="badge {{ $mapped['class'] }}">
                                        {{ $mapped['label'] }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.sinkronisasi.riwayat.restore', $item->id_trx) }}" method="POST" class="restore-trx-form" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-undo-alt mr-1"></i> Restore
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                                    <p class="mb-0">Belum ada riwayat transaksi yang dihapus.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $backups->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</div>

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handler konfirmasi restore transaksi dengan SweetAlert2
    $(document).on('submit', '.restore-trx-form', function(e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Kembalikan Transaksi?',
            text: "Transaksi ini akan dipindahkan kembali ke tabel utama transaksi.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Kembalikan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@stop

@endsection
