@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    
    <div class="row">
    <div class="col-xxl-12 d-flex align-items-stretch">
            <div class="card w-100 overflow-hidden rounded-4">
                <div class="card-body position-relative p-4">
                    <div class="row">
                        <div class="col-12 col-sm-7">
                            <div class="d-flex align-items-center gap-3 mb-5">
                                <img src="{{ URL::asset('build/images/user.png') }}" class="rounded-circle bg-grd-info p-1"
                                    width="60" height="60" alt="user">
                                <div class="">
                                    <p class="mb-0 fw-semibold">Selamat Datang di,</p>
                                    <h5 class="mb-0 fw-semibold">Jasamedika Car Rental</h5>
                                </div>
                            </div>
                          
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="welcome-back-img pt-4">
                                <img src="{{ URL::asset('build/images/gallery/welcome-back-3.png') }}" height="180" alt="">
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
      
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
          <div class="card rounded-4">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
                  <span class="material-icons-outlined">directions_car</span>
                </div>
                <div class="">
                  <h4 class="mb-0 text-center">{{ $carCount }}</h4>
                  <p class="mb-0">Unit Mobil</p>
                </div>
                <div class="">
                  <h4 class="mb-0 text-center">{{ $availableCarCount }}</h4>
                  <p class="mb-0">Tersedia</p>
                </div>
                <div class="">
                  <h4 class="mb-0 text-center">{{ $rentedCarCount }}</h4>
                  <p class="mb-0">Sewa</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card rounded-4">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="wh-48 d-flex bg-success text-success bg-opacity-10 align-items-center justify-content-center rounded-circle">
                  <span class="material-icons-outlined">account_circle</span>
                </div>
                <div class="">
                  <h5 class="mb-0">{{ $userCount }} Total Pengguna</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card rounded-4">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="wh-48 d-flex bg-info text-info bg-opacity-10 align-items-center justify-content-center rounded-circle">
                  <span class="material-icons-outlined">attach_money</span>
                </div>
                <div class="">
                  <h4 class="mb-0">Rp. {{ number_format($monthlyRevenue, 0, ',', '.') }}</h4>
                  <p class="mb-0">Pendapatan Bulan Ini</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col d-flex">
          <div class="card w-100 rounded-4">
            <div class="card-header p-3 bg-transparent">
              <div class="d-flex align-items-center justify-content-between">
                <div class="">
                  <h5 class="mb-0">Unit Mobil Terbaru</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
            <table class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Unit Mobil</th>
                      <th>Biaya Sewa/Hari</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($latestCars as $latestCars)
                    <tr>
                      <td>
                          <h6 class="mb-0">{{ $latestCars->brand }} {{ $latestCars->model }}</h6>
                          <p class="mb-0">{{ $latestCars->license_plate }}</p>
                      </td>
                      <td>
                        <h5 class="mb-0">Rp.{{ number_format($latestCars->rental_rate_per_day, 0, ',', '.') }}</h5>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                </table>
            </div>
          </div>
        </div>
        <div class="col d-flex">
          <div class="card w-100 rounded-4">
            <div class="card-header p-3 bg-transparent">
              <div class="d-flex align-items-center justify-content-between">
                <div class="">
                  <h5 class="mb-0">Rental Terbaru</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
            <table class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Unit Mobil</th>
                      <th class="text-right">Durasi</th>
                      <th>Pengguna</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($latestRentals as $latestRentals)
                    <tr>
                      <td>
                          <h6 class="mb-0">{{ $latestRentals->car->brand }} {{ $latestRentals->car->model }}</h6>
                          <p class="mb-0">{{ $latestRentals->car->license_plate }}</p>
                      </td>
                      <td class="text-right">
                        <p class="mb-0">{{ \Carbon\Carbon::parse($latestRentals->start_date )->translatedFormat('d F Y') }}</p>
                        <p class="mb-0">{{ \Carbon\Carbon::parse($latestRentals->end_date )->translatedFormat('d F Y') }}</p>
                      </td>
                      <td>
                          <p class="mb-0">{{ $latestRentals->user->name }}</p>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                </table>
            </div>
          </div>
        </div>
       </div>
    </div>
@endsection
@push('script')
    <!--plugins-->
    <script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/dashboard1.js') }}"></script>
    <script>
        new PerfectScrollbar(".user-list")
    </script>
@endpush
