@extends('layouts.admin')

@section('title', 'Ubah Kata Sandi')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold">Form Ganti Kata Sandi</h3>
                    </div>
                    <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
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

                            <div class="form-group">
                                <label for="current_password">Kata Sandi Saat Ini <span class="text-danger">*</span></label>
                                <input type="password" 
                                       name="current_password" 
                                       id="current_password"
                                       class="form-control @error('current_password') is-invalid @enderror"
                                       placeholder="Masukkan kata sandi lama Anda"
                                       required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Kata Sandi Baru <span class="text-danger">*</span></label>
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Minimal 8 karakter"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Kata Sandi Baru <span class="text-danger">*</span></label>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation"
                                       class="form-control"
                                       placeholder="Ulangi kata sandi baru"
                                       required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
