@extends('layouts.guest')
@section('title')
Registrasi Pengguna
@endsection
@section('content')
<div class="section-authentication-cover">
    <div class="">
        <div class="row g-0">
            <div class="col-12 col-xl-6 col-xxl-7 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end bg-transparent">

                <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent bg-none">
                    <div class="card-body">
                        <img src="{{ URL::asset('build/images/auth/register1.png') }}" class="img-fluid auth-img-cover-login" width="500" alt="">
                    </div>
                </div>

            </div>

            <div class="col-12 col-xl-6 col-xxl-5 auth-cover-right align-items-center justify-content-center">
                <div class="card rounded-0 m-3 border-0 shadow-none bg-none">
                    <div class="card-body p-sm-5" style="padding: 0.5rem !important;">
                        <h4 class="fw-bold">Registrasi Pengguna</h4>
                        <div class="form-body mt-4">
                            <form method="POST" action="{{ route('register') }}" class="row g-3">
                                @csrf

                                <div class="col-12">
                                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Nama">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                                    <div class="input-group" id="show_hide_password">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Kata Sandi">
                                        <a href="javascript:void(0);" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address" autofocus placeholder="Alamat">{{ old('address') }}</textarea>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="phone" class="form-label">Telepon <span class="text-danger">*</span></label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus placeholder="Telepon">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="license_number" class="form-label">No. SIM <span class="text-danger">*</span></label>
                                    <input id="license_number" type="text" class="form-control @error('license_number') is-invalid @enderror" name="license_number" value="{{ old('license_number') }}" autocomplete="license_number" autofocus placeholder="No. SIM">

                                    @error('license_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-grd-primary">Daftar</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-start">
                                        <p class="mb-0">Sudah mempunyai akun? <a href="{{ route('login') }}">Login</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {

    });
</script>
@endpush