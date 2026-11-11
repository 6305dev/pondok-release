@extends('layouts.admin')

@section('title', 'Edit Formulir')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Perbarui Data</h3>
                    </div>
                    <form action="{{ route('admin.formulir.update', $formulir) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="jenis_formulir">Jenis Formulir <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="jenis_formulir" 
                                       id="jenis_formulir"
                                       class="form-control @error('jenis_formulir') is-invalid @enderror"
                                       value="{{ old('jenis_formulir', $formulir->jenis_formulir) }}"
                                       placeholder="Contoh: F-1.02">
                                @error('jenis_formulir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                <textarea name="keterangan" 
                                          id="keterangan"
                                          class="form-control @error('keterangan') is-invalid @enderror"
                                          rows="3"
                                          placeholder="Deskripsi formulir...">{{ old('keterangan', $formulir->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Dokumen Saat Ini</label>
                                @if($formulir->dokumen)
                                    <div class="mb-2">
                                        <a href="{{ route('formulir.download', $formulir->dokumen) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-file-pdf"></i> {{ $formulir->dokumen }}
                                        </a>
                                    </div>
                                @else
                                    <p class="text-muted">Tidak ada dokumen terpasang.</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="dokumen">Ganti Dokumen (PDF) <span class="text-muted">(opsional)</span></label>
                                <div class="custom-file">
                                    <input type="file" 
                                           name="dokumen" 
                                           id="dokumen"
                                           class="custom-file-input @error('dokumen') is-invalid @enderror"
                                           accept=".pdf">
                                    <label class="custom-file-label" for="dokumen">Pilih file baru...</label>
                                </div>
                                @error('dokumen')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Format: PDF | Maks: 10 MB
                                </small>
                            </div>

                            <div class="form-group">
                                <label>Status Aktif</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktif" id="aktif_y" value="Y" 
                                           {{ old('aktif', $formulir->aktif) == 'Y' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="aktif_y">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktif" id="aktif_n" value="N" 
                                           {{ old('aktif', $formulir->aktif) == 'N' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="aktif_n">Tidak</label>
                                </div>
                                @error('aktif')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Perbarui
                            </button>
                            <a href="{{ route('admin.formulir.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
$(document).ready(function() {
    $('#dokumen').on('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Pilih file baru...';
        $(this).next('.custom-file-label').html(fileName);
    });
});
</script>
@endpush