@extends('layouts.admin')

@section('title', 'Kelola Persyaratan')

@section('content_header')
    <a href="{{ route('admin.persyaratan.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Persyaratan
    </a>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>DAFTAR PERSYARATAN</b></h3>
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

                        @if($persyaratans->isEmpty())
                            <div class="text-center py-4">
                                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada data persyaratan.</p>
                            </div>
                        @else
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 25%">Layanan</th>
                                        <th>Persyaratan</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($persyaratans as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><strong>{{ $p->layanan }}</strong></td>
                                        <td>
                                            <div style="white-space: pre-line; font-size: 0.9rem; line-height: 1.5;" class="text-secondary font-weight-bold">
                                                {{ $p->deskripsi_syarat }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.persyaratan.edit', $p->id) }}" 
                                               class="btn btn-warning btn-sm mr-1" 
                                               title="Edit Persyaratan">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.persyaratan.destroy', $p->id) }}" 
                                                  method="POST" 
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Yakin ingin menghapus persyaratan untuk layanan {{ $p->layanan }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i> Hapus
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
