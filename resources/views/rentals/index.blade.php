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

    .nav-tabs .nav-link.active {
        color: #fff;
    }

    .nav-tabs .nav-link {
        color: #fff;
    }
</style>
@endpush
@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sewa Mobil</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pengembalian Mobil</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h5 class="mb-4">Form Sewa Mobil</h5>
                        <form action="{{ route('rentals.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Pilih Mobil</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="car_id" id="car_id">
                                        @foreach($cars as $car)
                                        <option value="{{ $car->id }}" data-rate="{{ $car->rental_rate_per_day }}">{{ $car->brand }} {{ $car->model }} - {{ $car->license_plate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tarif Sewa Perhari</label>
                                <div class="col-sm-9">
                                    <input type="text" id="rental_rate_per_day" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="start_date" id="start_date" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="end_date" id="end_date" required>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-grd-primary px-4">Sewa</button>
                                        <button type="button" class="btn btn-grd-royal px-4">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h5 class="mb-4">Form Pengembalian Mobil</h5>
                        <form action="{{ route('rentals.return') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Plat Nomor Mobil</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="license_plate" id="license_plate" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="return_date" id="return_date" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Total Harga Sewa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="total_cost" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-grd-primary px-4">Pengembalian</button>
                                        <button type="button" class="btn btn-grd-royal px-4">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Daftar Transaksi</h5>
                <div class="table-responsive">
                    <table id="transactionTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Jenis Transaski</th>
                                <th class="text-center">Mobil</th>
                                <th class="text-center">Plat Nomor</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Total Harga Sewa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactionLogs as $log)
                            <tr>
                                <td class="text-center">
                                    @if ($log['transaction_type'] == 'Rental')
                                    <p class="dash-label mb-0 bg-warning bg-opacity-10 text-warning rounded-2">Sewa</p>
                                    @else
                                    <p class="dash-label mb-0 bg-success bg-opacity-10 text-success rounded-2">Pengembalian</p>
                                    @endif
                                </td>
                                <td class="text-center">{{ $log['car'] }}</td>
                                <td class="text-center">{{ $log['license_plate'] }}</td>
                                <td class="text-center">{{ $log['transaction_type'] == 'Rental' ? \Carbon\Carbon::parse($log['start_date'])->translatedFormat('d F Y') . ' - ' .                 \Carbon\Carbon::parse($log['end_date'])->translatedFormat('d F Y')
                            : \Carbon\Carbon::parse($log['return_date'])->translatedFormat('d F Y') }}</td>
                                <td class="text-center"> @if($log['total_cost'] == 0)
                                    -
                                    @else
                                    Rp. {{ number_format($log['total_cost'], 0, ',', '.') }}
                                    @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div><!--end row-->


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
        $('#transactionTable').DataTable({
            order: false,
        });

        function updateRentalRate() {
            var rentalRate = $('#car_id').find(':selected').data('rate');
            if (rentalRate) {
                $('#rental_rate_per_day').val('Rp. ' + parseInt(rentalRate).toLocaleString('id-ID'));
            } else {
                $('#rental_rate_per_day').val('');
            }
        }

        $('#car_id').on('change', function() {
            var rentalRate = $(this).find(':selected').data('rate');
            $('#rental_rate_per_day').val('Rp. ' + parseInt(rentalRate).toLocaleString('id-ID'));
        });

        updateRentalRate();

        $('#car_id').on('change', updateRentalRate);

        function calculateTotalCost() {
            var licensePlate = $('#license_plate').val();
            var returnDate = $('#return_date').val();

            if (licensePlate && returnDate) {
                $.ajax({
                    url: '/api/get-rental-rate',
                    method: 'GET',
                    data: {
                        license_plate: licensePlate
                    },
                    success: function(response) {
                        if (response.success) {
                            var rentalRatePerDay = response.rental_rate_per_day;
                            var startDate = new Date(response.start_date);
                            var endDate = new Date(returnDate);
                            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                            var totalCost = diffDays * rentalRatePerDay;
                            $('#total_cost').val('Rp. ' + totalCost.toLocaleString('id-ID'));
                        } else {
                            $('#total_cost').val('Car not found or not rented by you.');
                        }
                    },
                    error: function() {
                        $('#total_cost').val('Error fetching data.');
                    }
                });
            }
        }

        $('#license_plate, #return_date').on('change', calculateTotalCost);
    });
</script>

<script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/js/main.js') }}"></script>
@endpush