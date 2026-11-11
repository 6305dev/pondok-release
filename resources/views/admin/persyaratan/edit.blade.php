@extends('layouts.admin')

@section('title', 'Edit Persyaratan')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mb-4 mb-md-0">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Data Persyaratan untuk: <strong>{{ $persyaratan->layanan }}</strong></h3>
                    </div>
                    <form action="{{ route('admin.persyaratan.update', $persyaratan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="layanan">Nama Layanan <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="layanan" 
                                       id="layanan"
                                       class="form-control @error('layanan') is-invalid @enderror"
                                       value="{{ old('layanan', $persyaratan->layanan) }}"
                                       placeholder="Contoh: Kartu Keluarga, KTP, dll"
                                       required>
                                @error('layanan')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="deskripsi_syarat">Teks Persyaratan <span class="text-danger">*</span></label>
                                <textarea name="deskripsi_syarat" 
                                          id="deskripsi_syarat"
                                          class="form-control @error('deskripsi_syarat') is-invalid @enderror"
                                          rows="10"
                                          placeholder="Tuliskan daftar persyaratan di sini (gunakan enter / baris baru untuk memisahkan):&#10;1. Kartu Keluarga (KK)&#10;2. Akta Kelahiran&#10;3. ..."
                                          required>{{ old('deskripsi_syarat', $persyaratan->deskripsi_syarat) }}</textarea>
                                @error('deskripsi_syarat')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Tekan Enter untuk membuat baris baru. Setiap baris baru akan langsung ditampilkan sebagai poin/baris terpisah di form pengguna. Anda juga dapat menggunakan tag HTML link <code>&lt;a&gt;</code> untuk menyisipkan link khusus.
                                </small>
                            </div>

                            <div class="form-group mt-3">
                                <label for="deskripsi_output">Teks Output Layanan</label>
                                <textarea name="deskripsi_output" 
                                          id="deskripsi_output"
                                          class="form-control @error('deskripsi_output') is-invalid @enderror"
                                          rows="5"
                                          placeholder="Tuliskan daftar hasil/output layanan di sini (gunakan enter / baris baru untuk memisahkan):&#10;1. Kartu Keluarga (KK) Baru&#10;2. KTP-el Baru jika ada perubahan data">{{ old('deskripsi_output', $persyaratan->deskripsi_output) }}</textarea>
                                @error('deskripsi_output')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Tuliskan dokumen hasil atau output yang akan diperoleh pengguna. Gunakan enter untuk memisahkan baris. (Opsional, kosongkan jika tidak ada output khusus).
                                </small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Perbarui
                            </button>
                            <a href="{{ route('admin.persyaratan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-file-download mr-1"></i> Daftar Formulir Aktif</h3>
                    </div>
                    <div class="card-body p-0" style="overflow-y: auto;">
                        @if($formulirs->isEmpty())
                            <div class="p-3 text-center text-muted">Belum ada formulir aktif.</div>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($formulirs as $index => $f)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong>{{ $f->jenis_formulir }}</strong>
                                            <span class="badge badge-success btn-xs">Aktif</span>
                                        </div>
                                        <small class="text-muted d-block mb-2">{{ $f->keterangan }}</small>
                                        <div class="input-group input-group-sm">
                                            <input type="text" 
                                                   id="code-{{ $index }}" 
                                                   class="form-control" 
                                                   value="<a href='{{ route('formulir.download', $f->dokumen) }}' class='ml-1.5 px-2 py-0.5 text-[10px] bg-blue-100 hover:bg-blue-200 text-blue-800 border border-blue-300 font-bold rounded hover:shadow-sm transition inline-flex items-center gap-0.5 focus:outline-none focus:ring-2 focus:ring-blue-600' target='_blank' rel='noopener noreferrer'><svg aria-hidden='true' style='width: 12px; height: 12px; display: inline-block; vertical-align: middle; margin-right: 2px;' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path d='M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4' stroke-width='2' stroke-linecap='round'></path></svg>Unduh</a>" 
                                                   readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" 
                                                        type="button" 
                                                        onclick="copyCode('code-{{ $index }}')" 
                                                        title="Salin Link HTML">
                                                    <i class="fas fa-copy"></i> Salin
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="card-footer text-muted small">
                        <i class="fas fa-info-circle mr-1"></i> Klik tombol <strong>Salin</strong> lalu tempelkan (paste) kode link tersebut ke dalam textarea <strong>Teks Persyaratan</strong> di tempat yang diinginkan.
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
function copyCode(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    navigator.clipboard.writeText(copyText.value).then(function() {
        alert("Kode link HTML berhasil disalin ke clipboard!");
    }).catch(function(err) {
        document.execCommand("copy");
        alert("Kode link HTML berhasil disalin ke clipboard!");
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const leftCard = document.querySelector('.col-md-8 .card');
    const rightCard = document.querySelector('.col-md-4 .card');
    const rightBody = document.querySelector('.col-md-4 .card-body');
    
    if (leftCard && rightCard && rightBody) {
        const adjustHeight = () => {
            if (window.innerWidth >= 768) {
                rightCard.style.height = 'auto';
                const leftHeight = leftCard.offsetHeight;
                rightCard.style.height = leftHeight + 'px';
                
                const headerHeight = rightCard.querySelector('.card-header').offsetHeight;
                const footerHeight = rightCard.querySelector('.card-footer').offsetHeight;
                const remainingHeight = leftHeight - headerHeight - footerHeight;
                rightBody.style.height = remainingHeight + 'px';
                rightBody.style.maxHeight = remainingHeight + 'px';
            } else {
                rightCard.style.height = 'auto';
                rightBody.style.height = 'auto';
                rightBody.style.maxHeight = '500px';
            }
        };
        
        // Run after image load or small timeout to ensure layout is complete
        setTimeout(adjustHeight, 100);
        window.addEventListener('resize', adjustHeight);
    }
});
</script>
@stop
