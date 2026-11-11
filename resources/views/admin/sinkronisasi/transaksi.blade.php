@extends('layouts.admin')

@section('title', 'Sinkronisasi - Cek Transaksi')

@section('content_header')
    <h1>Sinkronisasi Data</h1>
@stop

@section('content')
<div class="container-fluid pb-5">
    
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white py-3">
            <h3 class="card-title font-weight-bold mb-0 text-white" style="font-size: 1.1rem;">
                <i class="fas fa-exchange-alt mr-2 text-white"></i> Cek Transaksi (NIK Ganda)
            </h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle mr-2"></i> Berikut adalah daftar transaksi permohonan di mana kode NIK pemohon terdata lebih dari 1 kali di dalam database transaksi.
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

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
                            <th>Status</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $index => $item)
                            <tr>
                                <td class="text-center">{{ $transaksi->firstItem() + $index }}</td>
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
                                <td>{{ \Carbon\Carbon::parse($item->tgl)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge {{ $item->status_badge_class }}">
                                        {{ $item->status_label }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center" style="gap: 5px;">
                                        <a href="{{ route('admin.transaksi.show', $item->id_trx) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                        <form action="{{ route('admin.sinkronisasi.transaksi.hapus', $item->id_trx) }}" method="POST" class="delete-trx-form" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <p class="mb-0">Hebat! Tidak ditemukan data transaksi dengan NIK ganda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $transaksi->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</div>

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handler konfirmasi hapus transaksi dengan SweetAlert2
    $(document).on('submit', '.delete-trx-form', function(e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Transaksi ini akan dihapus dari tabel utama dan dipindahkan ke Riwayat Hapus (Backup).",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
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
