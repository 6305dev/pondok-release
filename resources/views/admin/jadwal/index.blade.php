@extends('layouts.admin')

@section('title', 'Jadwal Harian')

@section('content_header')
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Setting Jam Operasional</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam Buka</th>
                                <th>Jam Tutup</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwal as $item)
                            <tr>
                                <td>{{ $item->hari }}</td>
                                <td>{{ $item->jam_buka }}</td>
                                <td>{{ $item->jam_tutup }}</td>
                                <td>
                                    @if($item->aktif)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Non-Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
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
@stop