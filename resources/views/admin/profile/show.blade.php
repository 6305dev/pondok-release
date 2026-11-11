@extends('layouts.admin')

@section('title', 'Profil Pengguna')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image / Info Box -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <div class="position-relative d-inline-block">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ $user->avatar_url }}"
                                     alt="User profile picture"
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                <form action="{{ route('admin.profile.updateAvatar') }}" method="POST" enctype="multipart/form-data" id="avatar-form">
                                    @csrf
                                    <input type="file" name="photos" id="avatar-input" class="d-none" accept="image/*">
                                </form>
                                <button type="button" class="btn btn-xs btn-primary position-absolute" 
                                        style="bottom: 0; right: 0; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"
                                        onclick="document.getElementById('avatar-input').click()">
                                    <i class="fas fa-pencil-alt text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <h3 class="profile-username text-center font-weight-bold">{{ $user->name }}</h3>
                        <p class="text-muted text-center">{{ $user->level_name }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIK</b> <a class="float-right text-dark font-weight-bold">{{ $user->nik }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>No. KK</b> <a class="float-right text-dark font-weight-bold">{{ $user->kk }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Form Edit Profil -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold">Ubah Informasi Profil</h3>
                    </div>
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" 
                                           name="name" 
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $user->name) }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" 
                                           name="email" 
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $user->email) }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-sm-3 col-form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" 
                                           name="phone" 
                                           id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone', $user->phone) }}"
                                           required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    document.getElementById('avatar-input').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            document.getElementById('avatar-form').submit();
        }
    });
</script>
@stop
