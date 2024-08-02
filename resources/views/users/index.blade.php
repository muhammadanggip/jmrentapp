@extends('layouts.app')
@section('title')
Datatables
@endsection
@push('css')
<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
<h6 class="mb-0 text-uppercase">Daftar Pengguna</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>No. SIM</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->license_number }}</td>
                        <td class="text-center">
                            <button class="btn btn-outline-secondary btn-sm edit" data-id="{{ $user->id }}">Edit</button>
                            <button class="btn btn-outline-danger btn-sm delete" data-id="{{ $user->id }}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengguna</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <form id="editUserForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="address" id="editAddress" class="form-control" required>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" id="editPhone" class="form-control" required>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="form-label">No. SIM</label>
                            <input type="text" name="license_number" id="editLicenseNumber" class="form-control" required>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
            </form>

        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus Pengguna</h5>
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
                </div>
                <div class="modal-body">
                    Apa anda yakin ini menghapus pengguna tersebut?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@push('script')
<!--plugins-->
<script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script>
    new PerfectScrollbar(".user-list")
</script>
<script src="{{ URL::asset('build/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        $('.edit').on('click', function() {
            const id = $(this).data('id');
            $.get('/users/' + id + '/edit', function(user) {
                $('#editUserForm').attr('action', '/users/' + id);
                $('#editName').val(user.name);
                $('#editAddress').val(user.address);
                $('#editPhone').val(user.phone);
                $('#editLicenseNumber').val(user.license_number);
                $('#editUserModal').modal('show');
            });
        });

        $('.delete').on('click', function() {
            const id = $(this).data('id');
            $('#deleteUserForm').attr('action', '/users/' + id);
            $('#deleteUserModal').modal('show');
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/js/main.js') }}"></script>
@endpush