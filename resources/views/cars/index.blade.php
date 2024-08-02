@extends('layouts.app')
@section('title')
Datatables
@endsection
@push('css')
<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<style>
    .dash-label {
        display: inline-block;
        padding: 0.2rem 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-align: center;
    }
</style>
@endpush
@section('content')
<h6 class="mb-0 text-uppercase">Daftar Mobil</h6>
<hr>
<div class="row g-3">
    <div class="col-auto ms-auto">
        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
            <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#addCarModal"><i class="bi bi-plus-lg me-2"></i>Tambah Unit</button>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="carsTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Merek</th>
                        <th>Model</th>
                        <th>Plat Nomor</th>
                        <th>Tarif Sewa Perhari</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $index => $car)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->license_plate }}</td>
                        <td>Rp. {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if ($car->available)
                            <p class="dash-label mb-0 bg-success bg-opacity-10 text-success rounded-2">Tersedia</p>
                            @else
                            <p class="dash-label mb-0 bg-danger bg-opacity-10 text-danger rounded-2">Tidak Tersedia</p>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-outline-secondary btn-sm edit" data-id="{{ $car->id }}" data-bs-toggle="modal" data-bs-target="#editCarModal">Edit</button>
                            <button class="btn btn-outline-danger btn-sm delete" data-id="{{ $car->id }}" data-bs-toggle="modal" data-bs-target="#deleteCarModal">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCarModalLabel">
                    Tambah Unit Mobil
                </h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('cars.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="brand" class="form-label">Merek</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="license_plate" class="form-label">Plat Nomor</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate" required>
                    </div>
                    <div class="mb-3">
                        <label for="rental_rate_per_day" class="form-label">Tarif Sewa Perhari</label>
                        <input type="number" step="0.01" class="form-control" id="rental_rate_per_day" name="rental_rate_per_day" required>
                    </div>
                    <div class="mb-3">
                        <label for="available" class="form-label">Status</label>
                        <select class="form-select" id="available" name="available" required>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="deleteCarModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteCarForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus Unit Mobil</h5>
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
                </div>
                <div class="modal-body">
                    Apa anda yakin ini menghapus mobil tersebut?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="editCarModal" tabindex="-1" aria-labelledby="editCarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCarModalLabel">Edit Unit Mobil</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
                <form id="editCarForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_car_id" name="car_id">
                    <div class="mb-3">
                        <label for="edit_brand" class="form-label">Merek</label>
                        <input type="text" class="form-control" id="edit_brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="edit_model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_license_plate" class="form-label">Plat Nomor</label>
                        <input type="text" class="form-control" id="edit_license_plate" name="license_plate" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_rental_rate_per_day" class="form-label">Tarif Sewa Perhari</label>
                        <input type="number" class="form-control" id="edit_rental_rate_per_day" name="rental_rate_per_day" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_available" class="form-label">Status</label>
                        <select class="form-select" id="edit_available" name="available" required>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
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
        $('#carsTable').DataTable();
    });
</script>
<script>
    $(document).ready(function() {

        $('.edit').on('click', function() {
            var carId = $(this).data('id');
            $.get('/cars/' + carId + '/edit', function(data) {
                $('#edit_car_id').val(data.id);
                $('#edit_brand').val(data.brand);
                $('#edit_model').val(data.model);
                $('#edit_license_plate').val(data.license_plate);
                $('#edit_rental_rate_per_day').val(parseInt(data.rental_rate_per_day, 10));
                $('#edit_available').val(data.available);
                $('#editCarForm').attr('action', '/cars/' + carId);
            });
        });

        $('.delete').on('click', function() {
            const id = $(this).data('id');
            $('#deleteCarForm').attr('action', '/cars/' + id);
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/js/main.js') }}"></script>
@endpush