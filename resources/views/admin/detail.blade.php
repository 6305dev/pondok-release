@extends('layouts.admin')

@section('title', 'Detail Transaksi - ' . $transaksi->id_trx)

@section('content_header')
@stop

@section('content')
<div class="container-fluid pb-5">
    
    <!-- Tabbed Layout Container Card -->
    <div class="card shadow-sm border-0 overflow-hidden rounded-lg">
        <div class="card-header card-header-tabs p-0" style="background-color: var(--primary-green) !important;">
            <div class="d-flex justify-content-between align-items-center px-4 py-3">
                <h3 class="card-title font-weight-bold mb-0 text-white" style="font-size: 1.25rem;">
                    <i class="fas fa-file-invoice mr-2 text-white"></i> Detail Transaksi: {{ $transaksi->id_trx }}
                </h3>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-light text-success font-weight-bold px-3 py-1.5" style="border-radius: 8px;">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                </a>
            </div>
            
            <!-- Custom Tabs Navigation -->
            <ul class="nav nav-tabs border-0 mb-0 px-0" id="detailTab" role="tablist" style="background-color: var(--primary-green-active);">
                <li class="nav-item">
                    <a class="nav-link active px-4 py-3 font-weight-bold text-white" id="pemohon-tab" data-toggle="tab" href="#tab-pemohon" role="tab" aria-controls="tab-pemohon" aria-selected="true">
                        <i class="fas fa-user-circle mr-2" style="color: #60a5fa !important;"></i> 1. Data & Dokumen Pemohon
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-3 font-weight-bold text-white" id="proses-tab" data-toggle="tab" href="#tab-proses" role="tab" aria-controls="tab-proses" aria-selected="false">
                        <i class="fas fa-tasks mr-2" style="color: #fbbf24 !important;"></i> 2. Proses & Progress Status
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-3 font-weight-bold text-white" id="hasil-tab" data-toggle="tab" href="#tab-hasil" role="tab" aria-controls="tab-hasil" aria-selected="false">
                        <i class="fas fa-file-export mr-2" style="color: #34d399 !important;"></i> 3. Dokumen Hasil (Output)
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="card-body bg-light p-4">
            <div class="tab-content" id="detailTabContent">
                
                <!-- TAB 1: DATA & DOKUMEN PEMOHON -->
                <div class="tab-pane fade show active" id="tab-pemohon" role="tabpanel" aria-labelledby="pemohon-tab">
                    <div class="row">
                        <!-- Left Column: Transaction Information Table -->
                        <div class="col-lg-6 mb-4 mb-lg-0 d-flex flex-column">
                            <div class="card shadow-sm border-0 h-100 bg-white" style="border-radius: 12px !important;">
                                <div class="card-header bg-light py-3">
                                    <h5 class="text-dark font-weight-bold mb-0" style="font-size: 1rem;"><i class="fas fa-info-circle mr-2 text-success"></i> Informasi Permohonan</h5>
                                </div>
                                <div class="card-body p-4">
                                    <table class="table table-borderless mb-0" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 180px; padding-right: 20px;"><strong>ID Transaksi</strong></td>
                                                <td style="width: 20px;">:</td>
                                                <td>{{ $transaksi->id_trx }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nama</strong></td>
                                                <td>:</td>
                                                <td>{{ $transaksi->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>NIK</strong></td>
                                                <td>:</td>
                                                <td>{{ $transaksi->nik }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>No KK</strong></td>
                                                <td>:</td>
                                                <td>{{ $transaksi->kk ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top;"><strong>Jenis Layanan</strong></td>
                                                <td style="vertical-align: top;">:</td>
                                                <td>
                                                    @php
                                                        $rawLayananDetail = $transaksi->id_dokumen;
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
                                                                
                                                                <li style="margin-bottom: 6px; font-size: 1rem; font-weight: 500; color: #111827;">
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
                                                        <span style="color: #6b7280; font-style: italic; font-size: 1rem;">Tidak ada layanan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone / Email</strong></td>
                                                <td>:</td>
                                                <td>{{ $transaksi->user?->phone ?? '-' }} / {{ $transaksi->user?->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Kecamatan</strong></td>
                                                <td>:</td>
                                                <td>
                                                    @if($transaksi->kecamatan)
                                                        {{ $transaksi->kecamatan->nama }}
                                                    @else
                                                        <span class="badge badge-danger">Belum diupdate admin</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Desa / Kelurahan</strong></td>
                                                <td>:</td>
                                                <td>
                                                    @if($transaksi->desa)
                                                        {{ $transaksi->desa->nama }}
                                                    @else
                                                        <span class="badge badge-danger">Belum diupdate admin</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Pengajuan</strong></td>
                                                <td>:</td>
                                                <td>{{ \Carbon\Carbon::parse($transaksi->tgl)->format('d/m/Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Selesai</strong></td>
                                                <td>:</td>
                                                <td>
                                                    {{ $transaksi->tgl_selesai ? \Carbon\Carbon::parse($transaksi->tgl_selesai)->format('d/m/Y H:i') : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status</strong></td>
                                                <td>:</td>
                                                <td>
                                                    @php
                                                        $tglProsesDetail = $transaksi->tgl_proses ? \Carbon\Carbon::parse($transaksi->tgl_proses) : null;
                                                        $tglSelesaiDetail = $transaksi->tgl_selesai ? \Carbon\Carbon::parse($transaksi->tgl_selesai) : null;
                                                        $durasiStrDetail = null;
                                                        if ($tglProsesDetail && $tglSelesaiDetail) {
                                                            $diff = $tglProsesDetail->diff($tglSelesaiDetail);
                                                            $parts = [];
                                                            if ($diff->d > 0) $parts[] = $diff->d . ' hari';
                                                            if ($diff->h > 0) $parts[] = $diff->h . ' jam';
                                                            if ($diff->i > 0) $parts[] = $diff->i . ' menit';
                                                            $durasiStrDetail = !empty($parts) ? implode(', ', $parts) : '0 menit';
                                                        }
                                                    @endphp
                                                    
                                                    <span class="badge {{ $transaksi->status_badge_class }}">
                                                        {{ $transaksi->status_label }}
                                                    </span>

                                                    @if($transaksi->status == 4 && $durasiStrDetail)
                                                        <span class="badge badge-info ml-1 text-white">Durasi: {{ $durasiStrDetail }}</span>
                                                    @endif

                                                    @if($transaksi->status == 4 && $transaksi->konfirmasi == 'Y')
                                                        <span class="badge bg-success ml-1 text-white">Ter-Konfirmasi</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Keterangan</strong></td>
                                                <td>:</td>
                                                <td>{{ $transaksi->keterangan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pengambilan</strong></td>
                                                <td>:</td>
                                                <td>{{ $transaksi->pengambilan->nama ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pesan Petugas</strong></td>
                                                <td>:</td>
                                                <td>{{ $transaksi->pesan ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Right Column: Document and Selfie/Signature Previews -->
                        <div class="col-lg-6 d-flex flex-column">
                            <div class="d-flex flex-column flex-grow-1" style="gap: 16px;">
                                @php
                                    $dokumenSyarat = [];
                                    $selfieSignature = [];
                                    if ($transaksi->files) {
                                        $dokumenSyarat = $transaksi->files->filter(function($file) {
                                            return !str_contains($file->file, 'selfie/') && !str_contains($file->file, 'signature/');
                                        });
                                        $selfieSignature = $transaksi->files->filter(function($file) {
                                            return str_contains($file->file, 'selfie/') || str_contains($file->file, 'signature/');
                                        });
                                    }
                                @endphp
                                
                                <!-- Persyaratan Docs -->
                                <div class="card shadow-sm border-0 bg-white flex-fill" style="border-radius: 12px !important;">
                                    <div class="card-header bg-light py-3">
                                        <h5 class="text-dark font-weight-bold mb-0" style="font-size: 1rem;"><i class="fas fa-file-alt mr-2 text-success"></i> Berkas Persyaratan</h5>
                                    </div>
                                    <div class="card-body">
                                        @if(empty($dokumenSyarat) || $dokumenSyarat->isEmpty())
                                            <div class="text-center py-4 text-muted">Tidak ada berkas persyaratan khusus.</div>
                                        @else
                                            <div class="row">
                                                @foreach($dokumenSyarat as $file)
                                                    <div class="col-sm-4 mb-3">
                                                        <div class="card shadow-sm border p-1 mb-0 h-100">
                                                            <a href="{{ route('dokumen.show', $file->file) }}" target="_blank" class="d-block text-center bg-light">
                                                                <img src="{{ route('dokumen.show', $file->file) }}" 
                                                                    alt="Dokumen" 
                                                                    class="img-fluid"
                                                                    loading="lazy"
                                                                    onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiB2aWV3Qm94PSIwIDAgMTUwIDE1MCI+PHJlY3Qgd2lkdGg9IjE1MCIgaGVpZ2h0PSIxNTAiIGZpbGw9IiM3NzciLz48dGV4dCB4PSI3NSIgeT0iODAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIzMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZmlsbD0iIzAwMCI+PC90ZXh0Pjwvc3ZnPg=='"
                                                                    style="height: 120px; object-fit: contain; width: 100%;">
                                                            </a>
                                                            <div class="p-2 text-center bg-white border-top">
                                                                <small class="text-muted d-block text-truncate" title="{{ basename($file->file) }}">{{ basename($file->file) }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Selfie + Signature Docs -->
                                <div class="card shadow-sm border-0 bg-white flex-fill" style="border-radius: 12px !important;">
                                    <div class="card-header bg-light py-3">
                                        <h5 class="text-dark font-weight-bold mb-0" style="font-size: 1rem;"><i class="fas fa-user-check mr-2 text-success"></i> Verifikasi (Selfie & Tanda Tangan)</h5>
                                    </div>
                                    <div class="card-body">
                                        @if(empty($selfieSignature) || $selfieSignature->isEmpty())
                                            <div class="text-center py-4 text-muted">Tidak ada berkas verifikasi.</div>
                                        @else
                                            <div class="row">
                                                @foreach($selfieSignature as $file)
                                                    @php
                                                        $isSelfie = str_contains($file->file, 'selfie/');
                                                        $labelInfo = $isSelfie ? 'Foto Selfie' : 'Tanda Tangan';
                                                    @endphp
                                                    <div class="col-sm-6 mb-3">
                                                        <div class="card shadow-sm border p-1 mb-0 h-100">
                                                            <a href="{{ route('dokumen.show', $file->file) }}" target="_blank" class="d-block text-center bg-light">
                                                                <img src="{{ route('dokumen.show', $file->file) }}" 
                                                                    alt="{{ $labelInfo }}" 
                                                                    class="img-fluid"
                                                                    loading="lazy"
                                                                    onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiB2aWV3Qm94PSIwIDAgMTUwIDE1MCI+PHJlY3Qgd2lkdGg9IjE1MCIgaGVpZ2h0PSIxNTAiIGZpbGw9IiM3NzciLz48dGV4dCB4PSI3NSIgeT0iODAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIzMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZmlsbD0iIzAwMCI+PC90ZXh0Pjwvc3ZnPg=='"
                                                                    style="height: 120px; object-fit: contain; width: 100%;">
                                                            </a>
                                                            <div class="p-2 text-center bg-white border-top">
                                                                <span class="badge {{ $isSelfie ? 'bg-info' : 'bg-success' }} mb-1 text-white">{{ $labelInfo }}</span>
                                                                <small class="text-muted d-block text-truncate" title="{{ basename($file->file) }}">{{ basename($file->file) }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- TAB 2: PROSES & PROGRESS STATUS -->
                <div class="tab-pane fade" id="tab-proses" role="tabpanel" aria-labelledby="proses-tab">
                    <div class="row">
                        <!-- Left Column: Update Status Form -->
                        <div class="col-lg-6 mb-4 mb-lg-0 d-flex flex-column">
                            <div class="card shadow-sm border-0 h-100 bg-white" style="border-radius: 12px !important;">
                                <div class="card-header bg-light py-3">
                                    <h5 class="text-dark font-weight-bold mb-0" style="font-size: 1rem;"><i class="fas fa-edit mr-2 text-success"></i> Perbarui Status Permohonan</h5>
                                </div>
                                <div class="card-body p-4">
                                    <form action="{{ route('admin.transaksi.update-status', $transaksi->id_trx) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="status">Pilih Status Baru :</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">-- Pilih Status --</option>
                                                @foreach(\App\Models\Transaksi::statusLabels() as $value => $label)
                                                    <option value="{{ $value }}" {{ $transaksi->status == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Textarea Pesan Penolakan (muncul hanya saat pilih "Ditolak") -->
                                        <div class="form-group mt-3" id="pesan-penolakan-container" style="display: none;">
                                            <label for="pesan_penolakan">Pesan Penolakan <span class="text-danger">*</span></label>
                                            <textarea name="pesan_penolakan" id="pesan_penolakan" class="form-control" rows="4" placeholder="Jelaskan alasan penolakan kepada pemohon..."></textarea>
                                            <small class="text-muted">Pesan ini akan dikirim ke pemohon.</small>
                                        </div>

                                        <div class="form-group mt-3" id="pesan-batal-container" style="display: none;">
                                            <label for="pesan_batal">Pesan Pembatalan <span class="text-danger">*</span></label>
                                            <textarea name="pesan_batal" id="pesan_batal" class="form-control" rows="4" placeholder="Jelaskan alasan pembatalan kepada pemohon..."></textarea>
                                            <small class="text-muted">Pesan ini akan dikirim ke pemohon.</small>
                                        </div>

                                        <div class="form-group mt-3" id="pesan-selesai-container" style="display: none;">
                                            <label for="pesan_selesai">Pesan Selesai (Opsional)</label>
                                            <textarea name="pesan_selesai" id="pesan_selesai" class="form-control" rows="4" placeholder="Masukkan pesan tambahan untuk pemohon jika diperlukan (opsional)..."></textarea>
                                            <small class="text-muted">Pesan ini akan dikirim ke pemohon.</small>
                                        </div>

                                        {{-- Tampilkan Alasan Komplain JIKA ADA --}}
                                        @if($transaksi->alasan)
                                            <div class="row mt-4" id="komplain-alert" style="display: {{ $transaksi->status == 7 ? 'block' : 'none' }};">
                                                <div class="col-12">
                                                    <div class="alert alert-warning mb-0">
                                                        <strong>Alasan Komplain dari Pemohon:</strong>
                                                        <p class="mb-0 mt-2">{{ $transaksi->alasan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group mt-4 mb-0">
                                            <button type="submit" class="btn btn-success px-4">
                                                <i class="fas fa-check mr-1"></i> Respon Status
                                            </button>
                                            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary px-4 ml-2">
                                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Right Column: Progress Timeline -->
                        <div class="col-lg-6 d-flex flex-column">
                            <div class="card shadow-sm border-0 h-100 bg-white" style="border-radius: 12px !important;">
                                <div class="card-header bg-light py-3">
                                    <h5 class="text-dark font-weight-bold mb-0" style="font-size: 1rem;"><i class="fas fa-history mr-2 text-success"></i> Riwayat Progress Permohonan</h5>
                                </div>
                                <div class="card-body p-4">
                                    @if(count($timeline) > 0)
                                        <div class="d-flex flex-column" style="gap: 20px;">
                                            @foreach($timeline as $index => $item)
                                                <div class="d-flex align-items-start" style="gap: 15px;">
                                                    <!-- Icon -->
                                                    <span class="badge bg-{{ $item['color'] }}" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                                        <i class="fas fa-{{ $item['icon'] }} text-white"></i>
                                                    </span>
                                                    <!-- Detail -->
                                                    <div>
                                                        <div class="font-weight-bold text-dark">{{ $item['label'] }}</div>
                                                        <div class="text-muted small">
                                                            {{ $item['status_text'] }} • 
                                                            {{ \Carbon\Carbon::parse($item['datetime'])->format('d/m/y H:i') }}
                                                        </div>
                                                        @if(isset($item['duration']) && $item['duration'] !== null && $index > 0)
                                                            <div class="text-xs text-success mt-1">
                                                                ({{ floor($item['duration'] / 60) }} jam {{ $item['duration'] % 60 }} menit)
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if(!$loop->last)
                                                    <hr style="margin: 10px 0; border-top: 1px dashed #dee2e6;">
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted text-center py-4 mb-0">Belum ada progress.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- TAB 3: DOKUMEN HASIL -->
                <div class="tab-pane fade" id="tab-hasil" role="tabpanel" aria-labelledby="hasil-tab">
                    <div class="row">
                        <!-- Left Column: Upload Document Form -->
                        <div class="col-lg-5 mb-4 mb-lg-0 d-flex flex-column">
                            <div class="card shadow-sm border-0 h-100 bg-white" style="border-radius: 12px !important;">
                                <div class="card-header bg-light py-3">
                                    <h5 class="text-dark font-weight-bold mb-0" style="font-size: 1rem;"><i class="fas fa-upload mr-2 text-success"></i> Unggah Dokumen Output</h5>
                                </div>
                                <div class="card-body p-4">
                                    <form action="{{ route('admin.dokumen.upload', $transaksi->id_trx) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_dokumen">Nama Dokumen:</label>
                                            <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" required placeholder="Contoh: Surat Keterangan">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="file">Unggah File PDF:</label>
                                            <input type="file" name="file" id="file" class="form-control" accept=".pdf" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="keterangan_dok">Keterangan (Opsional):</label>
                                            <textarea name="keterangan" id="keterangan_dok" class="form-control" rows="3" placeholder="Jelaskan isi dokumen..."></textarea>
                                        </div>
                                        <div class="form-group mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fas fa-upload mr-1"></i> Unggah Dokumen
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column: List of Uploaded Documents -->
                        <div class="col-lg-7 d-flex flex-column">
                            <div class="card shadow-sm border-0 h-100 bg-white" style="border-radius: 12px !important;">
                                <div class="card-header bg-light py-3">
                                    <h5 class="text-dark font-weight-bold mb-0" style="font-size: 1rem;"><i class="fas fa-file-pdf mr-2 text-success"></i> Daftar Dokumen Hasil</h5>
                                </div>
                                <div class="card-body p-4">
                                    @if($transaksi->userDokumen->isEmpty())
                                        <div class="text-center py-5 text-muted">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <p class="mb-0">Belum ada dokumen hasil yang diunggah.</p>
                                        </div>
                                    @else
                                        @foreach($transaksi->userDokumen as $dokumen)
                                            <div class="mb-4 p-3 border rounded-lg bg-light">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h6 class="font-weight-bold text-dark mb-1">{{ $dokumen->nama_dokumen }}</h6>
                                                        <small class="text-muted d-block mb-1">
                                                            <i class="fas fa-clock mr-1"></i>{{ $dokumen->created_at->format('d/m/Y H:i') }}
                                                        </small>
                                                        @if($dokumen->keterangan)
                                                            <small class="text-secondary d-block"><i class="fas fa-info-circle mr-1"></i>{{ $dokumen->keterangan }}</small>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex" style="gap: 5px;">
                                                        <a href="{{ route('dokumen.show', $dokumen->file_path) }}" target="_blank" class="btn btn-sm btn-info px-3">
                                                            <i class="fas fa-eye mr-1"></i> Lihat
                                                        </a>
                                                        <form action="{{ route('admin.dokumen.delete', $dokumen->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus dokumen ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <iframe 
                                                        src="{{ route('dokumen.show', $dokumen->file_path) }}" 
                                                        width="100%" 
                                                        height="350px"
                                                        style="border: 1px solid #ddd; border-radius: 8px;">
                                                        <p>Browser Anda tidak mendukung iframe PDF.</p>
                                                    </iframe>
                                                </div>
                                            </div>
                                        @endforeach
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

<script>
(function() {
    function initStatusForm() {
        const statusSelect = document.getElementById('status');
        const penolakanContainer = document.getElementById('pesan-penolakan-container');
        const batalContainer = document.getElementById('pesan-batal-container');
        const selesaiContainer = document.getElementById('pesan-selesai-container');
        const komplainAlert = document.getElementById('komplain-alert');

        if (!statusSelect) return;

        function toggleFields() {
            const selectedValue = statusSelect.value;
            
            if (penolakanContainer) {
                penolakanContainer.style.display = (selectedValue === '5') ? 'block' : 'none';
            }

            if (batalContainer) {
                batalContainer.style.display = (selectedValue === '8') ? 'block' : 'none';
            }

            if (selesaiContainer) {
                selesaiContainer.style.display = (selectedValue === '4') ? 'block' : 'none';
            }

            if (komplainAlert) {
                komplainAlert.style.display = (selectedValue === '7') ? 'block' : 'none';
            }
        }

        toggleFields();
        statusSelect.addEventListener('change', toggleFields);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStatusForm);
    } else {
        initStatusForm();
    }
})();
</script>  

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true
    });
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: "{{ session('error') }}",
    confirmButtonText: 'OK'
});
</script>
@endif

@endsection