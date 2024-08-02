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
              <img src="{{ URL::asset('build/images/user.png') }}" class="rounded-circle bg-grd-info p-1" width="60" height="60" alt="user">
              <div class="">
                <br>
                <p class="mb-0 fw-semibold">Selamat Datang,</p>
                <h5 class="user-name mb-0 fw-bold">{{ Auth::user()->name }}</h5>
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
  <div class="col-xxl-12 d-flex align-items-stretch">
    <div class="col">
      <div class="card rounded-4">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between gap-3">

            <div class="">
              <div class="d-flex align-items-center align-self-end text-success mb-1">
                <p class="mb-0">Rental Terakhir</p>
              </div>
              @if ($lastRental && $lastRental->car)
              <h4 class="mb-0">{{ $lastRental->car->brand }} {{ $lastRental->car->model }}</h4>
              <h6 class="mb-0">{{ $lastRental->car->license_plate }}</h6>
              <p class="mb-0">{{ \Carbon\Carbon::parse($lastRental->start_date)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($lastRental->end_date)->translatedFormat('d F Y') }}</p>
              @else
              <h4 class="mb-0">Tidak ada rental terakhir</h4>
              @endif
            </div>
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