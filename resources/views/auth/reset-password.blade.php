@extends('layouts.app')

@section('head_metas')
<title>Reset Password - Pharma Healthcare Jobs</title>
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcumb-wrapper" style="background-image: url('{{asset('img/banner1.jpg')}}'); background-size: cover; background-position: center; position: relative; padding: 35px 0;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title text-white" style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">Reset Password</h1>
                <ul class="list-unstyled d-flex justify-content-center align-items-center text-white" style="font-size: 16px;">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li class="mx-2"><i class="fas fa-angle-right"></i></li>
                    <li>Reset Password</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Reset Password Section -->
    <section class="space-top space-extra-bottom" style="padding: 80px 0; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="bg-white shadow-sm rounded p-4 p-md-5 border">
                        <div class="mb-4 pb-3 border-bottom text-center">
                            <h3 class="h4 mb-1">Set New Password</h3>
                            <p class="text-muted small">Enter your new password below</p>
                        </div>

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-2 text-dark">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" readonly required>
                            </div>

                            <div class="form-group mb-3 position-relative">
                                <label class="fw-bold mb-2 text-dark">New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" placeholder="Enter new password" required autofocus>
                            </div>

                            <div class="form-group mb-4 position-relative">
                                <label class="fw-bold mb-2 text-dark">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password" required>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="th-btn style1 w-100">
                                    Update Password <i class="fas fa-sync-alt ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
