@extends('layouts.app')

@section('head_metas')
<title>Employee Login - Pharma Healthcare Jobs</title>
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcumb-wrapper" style="background-image: url('{{asset('img/banner1.jpg')}}'); background-size: cover; background-position: center; position: relative; padding: 35px 0;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title text-white" style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">Login</h1>
                <ul class="list-unstyled d-flex justify-content-center align-items-center text-white" style="font-size: 16px;">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li class="mx-2"><i class="fas fa-angle-right"></i></li>
                    <li>Login</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Login Section -->
    <section class="space-top space-extra-bottom" style="padding: 80px 0; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="bg-white shadow-sm rounded p-4 p-md-5 border">
                        <div class="mb-4 pb-3 border-bottom text-center">
                            <h3 class="h4 mb-1">Welcome Back</h3>
                            <p class="text-muted small">Log in to your dashboard</p>
                        </div>

                        <form id="loginForm" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-2 text-dark">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required autofocus>
                            </div>

                            <div class="form-group mb-3 position-relative">
                                <label class="fw-bold mb-2 text-dark">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="********" required>
                                <span class="password-toggle-icon" style="position: absolute; right: 15px; top: 45px; cursor: pointer; color: #666;">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small text-muted" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotModal" class="small text-decoration-none" style="color: var(--theme-color);">Forgot Password?</a>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="th-btn style1 w-100" id="loginBtn">
                                    Login <i class="fas fa-sign-in-alt ms-2"></i>
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="small text-muted mb-0">Don't have an account? <a href="{{ route('register.type') }}" class="fw-bold text-decoration-none" style="color: var(--theme-color);">Register Now</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footer_extras')
<script>
$(document).ready(function() {
    // Password Toggle
    $('.password-toggle-icon').click(function() {
        const input = $(this).siblings('input');
        const icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // AJAX Login
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        
        const btn = $('#loginBtn');
        const originalText = btn.html();
        
        // Show loading state
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Checking...');

        $.ajax({
            url: "{{ route('login.post') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    alertify.success(response.message);
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1000);
                } else {
                    alertify.error(response.message || 'Login failed');
                    btn.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html(originalText);
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(key => {
                        alertify.error(errors[key][0]);
                    });
                } else if (xhr.status === 401 || xhr.status === 403) {
                    alertify.error(xhr.responseJSON.message);
                } else {
                    alertify.error('An error occurred. Please try again.');
                }
            }
        });
    });
});
</script>
@endsection
