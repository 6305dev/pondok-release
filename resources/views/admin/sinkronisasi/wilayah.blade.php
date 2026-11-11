@extends('layouts.admin')

@section('title', 'Sinkronisasi - Cek Wilayah')

@section('content_header')
    <h1>Sinkronisasi Data</h1>
@stop

@section('content')
<div class="container-fluid pb-5">
    
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white py-3">
            <h3 class="card-title font-weight-bold mb-0 text-white" style="font-size: 1.1rem;">
                <i class="fas fa-map-marker-alt mr-2 text-white"></i> Cek Wilayah (Kecamatan Kosong)
            </h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle mr-2"></i> Berikut adalah daftar pengguna (User) di mana data kode Kecamatan (`id_kec`) kosong atau null. Hal ini dapat menghambat pemrosesan wilayah atau pembuatan laporan statistik.
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. Telepon / HP</th>
                            <th>Tanggal Terdaftar</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $item)
                            <tr>
                                <td class="text-center">{{ $users->firstItem() + $index }}</td>
                                <td class="font-weight-bold">{{ $item->nik }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.user.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit mr-1"></i> Edit User
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <p class="mb-0">Hebat! Semua pengguna terdata memiliki kode Kecamatan lengkap.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</div>
@endsection
