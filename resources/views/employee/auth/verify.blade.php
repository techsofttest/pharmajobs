@extends('layouts.app')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcumb-wrapper" style="background-image: url('{{asset('img/banner1.jpg')}}'); background-size: cover; background-position: center; position: relative; padding: 35px 0;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);"></div>
        
        <div class="container" style="position: relative; z-index: 2;">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title text-white" style="font-size: 36px; font-weight: 700; margin-bottom: 10px;">Verify Your Email</h1>
                <ul class="list-unstyled d-flex justify-content-center align-items-center text-white" style="font-size: 16px;">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li class="mx-2"><i class="fas fa-angle-right"></i></li>
                    <li>Verify Email</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Verification Section -->
    <section class="space-top space-extra-bottom" style="padding: 80px 0; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-white shadow-sm rounded p-4 p-md-5 border text-center">
                        <div class="mb-4">
                            <i class="fas fa-envelope-open-text fa-4x" style="color: var(--theme-color);"></i>
                        </div>
                        <h3 class="h4 mb-3">Check Your Inbox</h3>
                        <p class="text-muted mb-4">
                            Thanks for signing up! Before getting started, you need to verify your email address by clicking on the link we just emailed to you.
                        </p>

                        @if (session('message'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <p class="text-muted small">If you didn't receive the email, we will gladly send you another.</p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="th-btn style1 w-100 mt-2">
                                Resend Verification Email
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
