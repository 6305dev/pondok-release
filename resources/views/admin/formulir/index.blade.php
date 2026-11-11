@extends('layouts.admin')

@section('title', 'Kelola Formulir')

@section('content_header')
    <a href="{{ route('admin.formulir.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Formulir
    </a>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>DAFTAR FORMULIR</b></h3>
                    </div>
                    <div class="card-body table-responsive">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if($formulirs->isEmpty())
                            <div class="text-center py-4">
                                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada data formulir.</p>
                            </div>
                        @else
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Jenis Formulir</th>
                                        <th>Keterangan</th>
                                        <th>Dokumen</th>
                                        <th>Status</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formulirs as $index => $f)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $f->jenis_formulir }}</td>
                                        <td>{{ Str::limit($f->keterangan, 50) }}</td>
                                        <td>
                                            @if($f->dokumen)
                                                <a href="{{ route('formulir.download', $f->dokumen) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted">–</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $f->aktif == 'Y' ? 'success' : 'danger' }}">
                                                {{ $f->aktif == 'Y' ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.formulir.edit', $f) }}" 
                                               class="btn btn-warning btn-sm mr-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.formulir.destroy', $f) }}" 
                                                  method="POST" 
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Yakin ingin menghapus formulir ini? Dokumen terkait juga akan dihapus.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop