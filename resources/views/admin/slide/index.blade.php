@extends('layouts.admin')

@section('title', 'Kelola Gambar Slide')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold">Daftar Slide Halaman Utama</h3>
                        <div class="card-tools">
                            <span class="badge badge-info">Maksimal 4 Slide</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 5%" class="text-center">No</th>
                                        <th style="width: 25%">Preview Gambar (1280 x 720)</th>
                                        <th>Judul Slide</th>
                                        <th style="width: 15%" class="text-center">Status</th>
                                        <th style="width: 15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slides as $slide)
                                        <tr>
                                            <td class="text-center font-weight-bold">{{ $slide->id }}</td>
                                            <td>
                                                <div class="rounded border bg-light p-1 shadow-sm" style="max-width: 200px;">
                                                    <img src="{{ asset('images/' . $slide->filename) }}?v={{ time() }}" 
                                                         alt="Slide {{ $slide->id }}" 
                                                         class="img-fluid rounded" 
                                                         style="aspect-ratio: 16/9; object-fit: cover;">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="font-weight-bold">{{ $slide->judul ?? 'Slide Tanpa Judul' }}</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                @if($slide->aktif == 'Y')
                                                    <span class="badge badge-success px-3 py-2"><i class="fas fa-check-circle mr-1"></i> Aktif</span>
                                                @else
                                                    <span class="badge badge-danger px-3 py-2"><i class="fas fa-times-circle mr-1"></i> Non-aktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <!-- Button trigger modal -->
                                                <button type="button" 
                                                        class="btn btn-sm btn-warning font-weight-bold px-3 btn-edit-slide" 
                                                        data-toggle="modal" 
                                                        data-target="#editSlideModal"
                                                        data-id="{{ $slide->id }}"
                                                        data-judul="{{ $slide->judul }}"
                                                        data-aktif="{{ $slide->aktif }}"
                                                        data-filename="{{ asset('images/' . $slide->filename) }}?v={{ time() }}">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Slide -->
    <div class="modal fade" id="editSlideModal" tabindex="-1" role="dialog" aria-labelledby="editSlideModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title font-weight-bold" id="editSlideModalLabel"><i class="fas fa-edit mr-2"></i> Edit Slide <span id="slide-id-title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-slide-form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label class="font-weight-bold">Preview Gambar Saat Ini</label>
                                <div class="border rounded bg-light p-2 shadow-sm text-center">
                                    <img id="modal-img-preview" src="" alt="Preview" class="img-fluid rounded" style="aspect-ratio: 16/9; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="judul" class="font-weight-bold">Judul / Label Slide</label>
                                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul slide" max="100">
                                </div>

                                <div class="form-group">
                                    <label for="image" class="font-weight-bold">Ganti Gambar (Maks 5 MB)</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input" accept="image/*">
                                        <label class="custom-file-label" for="image">Pilih file gambar baru...</label>
                                    </div>
                                    <small class="form-text text-danger mt-1">
                                        <i class="fas fa-info-circle mr-1"></i> Wajib berdimensi tepat <strong>1280 x 720</strong> piksel (16:9).
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="aktif" class="font-weight-bold">Status Keaktifan</label>
                                    <select name="aktif" id="aktif" class="form-control" required>
                                        <option value="Y">Aktif</option>
                                        <option value="N">Non-aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning font-weight-bold"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Handle custom file input label name change
        $('#image').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        // Bind data attributes to edit modal
        $('.btn-edit-slide').on('click', function() {
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var aktif = $(this).data('aktif');
            var filename = $(this).data('filename');

            // Populate form values
            $('#slide-id-title').text('#' + id);
            $('#judul').val(judul);
            $('#aktif').val(aktif);
            $('#modal-img-preview').attr('src', filename);

            // Set form action dynamically
            var actionUrl = "{{ route('admin.slide.update', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $('#edit-slide-form').attr('action', actionUrl);
            
            // Reset custom file label
            $('.custom-file-label').html('Pilih file gambar baru...');
            $('#image').val('');
        });
    });
</script>
@stop
