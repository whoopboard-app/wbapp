@extends('layouts.admin')

@section('title', 'Admin Login')

@section('content')
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="card auth-card">
                    <div class="card-body px-3 py-5">

                        <div class="mx-auto mb-4 text-center auth-logo">
                            <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                                <img src="{{ asset('assets/admin/images/logo-dark.png') }}" height="32" alt="logo dark">
                            </a>

                            <a href="{{ asset('assets/admin/images/logo-light.png') }}" class="logo-light">
                                <img src="{{ asset('assets/admin/images/logo-light.png') }}" height="28" alt="logo light">
                            </a>
                        </div>

                        <h2 class="fw-bold text-uppercase text-center fs-18">Sign In</h2>
                        <p class="text-muted text-center mt-1 mb-4">
                            Enter your email address and password to access admin panel.
                        </p>

                        <div class="px-4">
                            <form method="POST" action="{{ route('admin.login.submit') }}" class="authentication-form">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" 
                                        class="form-control bg-light bg-opacity-50 border-light py-2" 
                                        placeholder="Enter your email" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <a href="#" class="float-end text-muted text-unline-dashed ms-1">Reset password</a>
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" 
                                        class="form-control bg-light bg-opacity-50 border-light py-2" 
                                        placeholder="Enter your password" required>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-1 text-center d-grid">
                                    <button class="btn btn-dark py-2 fw-medium" type="submit">Sign In</button>
                                </div>
                            </form>

                            <p class="mt-3 fw-semibold text-center">OR sign with</p>

                            <div class="text-center">
                                <a href="javascript:void(0);" class="btn btn-outline-light shadow-none"><i class="bx bxl-google fs-20"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-light shadow-none"><i class="bx bxl-facebook fs-20"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-light shadow-none"><i class="bx bxl-github fs-20"></i></a>
                            </div>

                        </div> <!-- end px-4 -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->

                <p class="mb-0 text-center text-white">
                    New here? <a href="#" class="text-reset text-unline-dashed fw-bold ms-1">Sign Up</a>
                </p>

            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
@endsection
