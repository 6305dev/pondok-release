@extends('layouts.admin')

@section('title', 'User Baru')

@section('content_header')
<h1>User Aktivasi</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            @if($users->isEmpty())
            <div class="alert alert-info">Tidak ada user baru.</div>
            @else
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <label>Show</label>
                        <select onchange="location = this.value;" class="form-control d-inline-block w-auto ml-2">
                            <option value="{{ route('admin.user.index', array_merge(request()->all(), ['per_page' => 10])) }}" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="{{ route('admin.user.index', array_merge(request()->all(), ['per_page' => 25])) }}" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="{{ route('admin.user.index', array_merge(request()->all(), ['per_page' => 50])) }}" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span class="ml-2">records</span>
                    </div>
                </div>
            </div>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIK</th>
                        <th>KK</th>
                        <th>Telepon</th>
                        <th>Tanggal Daftar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nik ?? '-' }}</td>
                        <td>{{ $user->kk ?? '-' }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>{{ $user->created_at?->format('d M Y H:i') ?? '-' }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-nik="{{ $user->nik }}" data-kk="{{ $user->kk }}" data-phone="{{ $user->phone }}" data-created-at="{{ $user->created_at?->format('d M Y H:i') }}">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                </div>
                <div>
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Detail User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="actionForm" method="POST">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="user_id" id="modal_user_id">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" id="modal_name" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="modal_email" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" class="form-control" id="modal_nik" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>KK</label>
                                            <input type="text" class="form-control" id="modal_kk" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control" id="modal_phone" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Daftar</label>
                                            <input type="text" class="form-control" id="modal_created_at" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tambahkan di bawah "Tanggal Daftar" -->
                                <div class="form-group">
                                    <label>Kode OTP</label>
                                    <input type="text" class="form-control" id="modal_otp" readonly>
                                </div>

                                <!-- Pilihan Aksi -->
                                <div class="form-group mt-4">
                                    <label>Aksi:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="action" id="activate" value="activate" required>
                                        <label class="form-check-label" for="activate">Aktivasi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="action" id="edit" value="edit">
                                        <label class="form-check-label" for="edit">Edit Data</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="action" id="reject" value="reject">
                                        <label class="form-check-label" for="reject">Tolak / Hapus</label>
                                    </div>
                                </div>

                                <!-- Form Edit (sembunyikan dulu) -->
                                <div id="editSection" style="display:none; margin-top:20px; padding:15px; background:#f8f9fa; border-radius:5px;">
                                    <h6>Edit Data User</h6>
                                    <div class="form-group">
                                        <label>Nama Baru</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nama baru">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Baru</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email baru">
                                    </div>
                                    <div class="form-group">
                                        <label>NIK Baru</label>
                                        <input type="text" name="nik" class="form-control" placeholder="NIK baru">
                                    </div>
                                    <div class="form-group">
                                        <label>KK Baru</label>
                                        <input type="text" name="kk" class="form-control" placeholder="KK baru">
                                    </div>
                                    <div class="form-group">
                                        <label>Telepon Baru</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Telepon baru">
                                    </div>
                                </div>

                                <!-- Form Tolak (sembunyikan dulu) -->
                                <div id="rejectSection" style="display:none; margin-top:20px; padding:15px; background:#f8f9fa; border-radius:5px;">
                                    <h6>Alasan Penolakan</h6>
                                    <div class="form-group">
                                        <textarea name="reason" class="form-control" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="modal-footer mt-3">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Perubahan</button>
                                </div>

                                @if($user->active == 1 && $user->activation_code_expires_at < now()) <button type="button" class="btn btn-warning btn-sm" onclick="resetOtp({{ $user->id }})">
                                    <i class="fas fa-redo"></i> Reset OTP
                                    </button>
                                    @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.min.css" integrity="sha512-Ivy7sPrd6LPp20adiK3al16GBelPtqswhJnyXuha3kGtmQ1G2qWpjuipfVDaZUwH26b3RDe8x707asEpvxl7iA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.min.js" integrity="sha512-pnPZhx5S+z5FSVwy62gcyG2Mun8h6R+PG01MidzU+NGF06/ytcm2r6+AaWMBXAnDHsdHWtsxS0dH8FBKA84FlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        // Saat modal dibuka, isi data user
        $('#detailModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var email = button.data('email');
            var nik = button.data('nik');
            var kk = button.data('kk');
            var phone = button.data('phone');
            var createdAt = button.data('created-at');

            var modal = $(this);
            modal.find('#modal_user_id').val(id);
            modal.find('#modal_name').val(name);
            modal.find('#modal_email').val(email);
            modal.find('#modal_nik').val(nik);
            modal.find('#modal_kk').val(kk);
            modal.find('#modal_phone').val(phone);
            modal.find('#modal_created_at').val(createdAt);

            // Reset
            $('input[name="action"]').prop('checked', false);
            $('#editSection').hide();
            $('#rejectSection').hide();
            $('#submitBtn')
                .text('Simpan Perubahan')
                .removeClass('btn-success btn-warning btn-danger')
                .addClass('btn-primary');
        });

        // ✅ Gunakan .on() agar event tetap berfungsi
        $(document).on('change', 'input[name="action"]', function() {
            var action = $(this).val();

            if (action === 'activate') {
                $('#editSection').hide();
                $('#rejectSection').hide();
                $('#submitBtn')
                    .text('Aktifkan User')
                    .removeClass('btn-warning btn-danger')
                    .addClass('btn-success');
            } else if (action === 'edit') {
                $('#editSection').show();
                $('#rejectSection').hide();
                $('#submitBtn')
                    .text('Update Data')
                    .removeClass('btn-success btn-danger')
                    .addClass('btn-warning');
            } else if (action === 'reject') {
                $('#editSection').hide();
                $('#rejectSection').show();
                $('#submitBtn')
                    .text('Tolak User')
                    .removeClass('btn-success btn-warning')
                    .addClass('btn-danger');
            }
        });

        // Handle submit form
        $('#actionForm').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var userId = $('#modal_user_id').val();
            var url = '{{ route("user_baru.action", ":id") }}'.replace(':id', userId);

            formData += '&phone=' + encodeURIComponent($('#modal_phone').val());
            formData += '&reason=' + encodeURIComponent($('textarea[name="reason"]').val());

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#detailModal').modal('hide');
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON ?. message || 'Gagal melakukan tindakan.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        function resetOtp(userId) {
            if (!confirm('Kirim ulang OTP untuk user ini?')) return;

            $.post('{{ route("user_baru.reset_otp", ":id") }}'.replace(':id', userId))
                .done(function(res) {
                    Swal.fire('Berhasil!', res.message, 'success');
                })
                .fail(function() {
                    Swal.fire('Error!', 'Gagal reset OTP.', 'error');
                });
        }
    });
</script>
@stop
@endsection