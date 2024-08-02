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
<h6 class="mb-0 text-uppercase">Daftar Transaksi Rental</h6>
<hr>
<br>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="transactionTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Jenis Transaski</th>
                        <th class="text-center">Mobil</th>
                        <th class="text-center">Plat Nomor</th>
                        <th class="text-center">Pengguna</th>
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
                        <td class="text-center">{{ $log['user'] }}</td>
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
            order: [[4, 'asc']],
        });
    });
</script>

<script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/js/main.js') }}"></script>
@endpush