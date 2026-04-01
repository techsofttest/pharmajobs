@extends('layouts.app')

@section('head_metas')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection


@section('content')

 <!-- Breadcrumb -->
        <div class="breadcumb-wrapper" style="background-image: url('{{asset('img/banner1.jpg')}}'); background-size: cover; background-position: center; position: relative; padding: 35px 0;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);"></div>
            
            <div class="container" style="position: relative; z-index: 2;">
                <div class="breadcumb-content text-center">
                    <h1 class="breadcumb-title text-white" style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">Employer Registration</h1>
                    <ul class="list-unstyled d-flex justify-content-center align-items-center text-white" style="font-size: 16px;">
                        <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="mx-2"><i class="fas fa-angle-right"></i></li>
                        <li>Employer Registration</li>
                    </ul>
                </div>
            </div>
        </div>



        <!-- Employer Registration Form -->
        <section class="space-top space-extra-bottom" style="padding: 80px 0; background-color: #f8f9fa;">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <div class="bg-white shadow-sm rounded p-4 p-md-5 border">
                            
                            <div class="mb-4 pb-3 border-bottom">
                                <h3 class="h4 mb-1">Create Account</h3>
                                <p class="text-muted small">Join us to find candidates, Post Jobs for free</p>
                            </div>

                            <form action="{{ route('employer.register.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
                                    </div>


                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="" required>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone" placeholder="" required>
                                    </div>



                                    <div class="col-md-12 form-group mb-3">     
                                       <label class="fw-bold mb-2 text-dark">Company <span class="text-danger">*</span></label>
                                        
                                        
                                       <select class="form-select form-control select2" name="company_id" required>
                                            <option value="">Select Company</option>

                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>


                                    </div>


                                    <div class="col-md-12 form-group mb-3 text-center">
                      
                                        <small class="mt-1">
                                            Company not found? contact <a href="tel:+918137069973">+91 8137069973</a> to add new company
                                        </small>

                                        </div>
        

                                    <div class="col-md-12 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Company Designation <span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="designation" required>
                                            <option value="">Select Designation</option>
                                            <option value="manager">Manager</option>
                                            <option value="hr">Human Resources</option>
                                        </select>
                                    </div>
     
                                    <div class="col-md-6 form-group mb-4 position-relative">
                                        <label class="fw-bold mb-2 text-dark">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" placeholder="" required>
                                        <span class="password-toggle-icon"><i class="fa fa-eye"></i></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-4 position-relative">
                                        <label class="fw-bold mb-2 text-dark">Retype Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="" required>
                                        <span class="password-toggle-icon"><i class="fa fa-eye"></i></span>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <button type="submit" class="th-btn style1 w-100">
                                            Register Now <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right ms-2" width="16" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path></svg>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="bg-white shadow-sm rounded p-4 mb-4 border">
                            <h4 class="h5 mb-3" style="color: var(--theme-color);">Why Register With Us?</h4>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-start mb-3">
                                    <i class="fas fa-check-circle mt-1 me-2" style="color: var(--theme-color2);"></i>
                                    <div><strong>Find Candidates In Your Speciality</strong><br><span class="text-muted small">Access to talent pool</span></div>
                                </li>
                                <li class="d-flex align-items-start mb-3">
                                    <i class="fas fa-check-circle mt-1 me-2" style="color: var(--theme-color2);"></i>
                                    <div><strong>Post Unlimited Jobs!</strong><br><span class="text-muted small">Free job posting for employers</span></div>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fas fa-check-circle mt-1 me-2" style="color: var(--theme-color2);"></i>
                                    <div><strong>Manage Applications</strong><br><span class="text-muted small">Profile Dashboard with application history.</span></div>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-white shadow-sm rounded p-4 mb-4 border text-center">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-3x text-muted"></i>
                            </div>
                            <h4 class="h5">Already Registered?</h4>
                            <p class="text-muted small mb-3">Log in to your dashboard to manage your applications and profile.</p>
                            <a href="{{ route('login') }}" class="th-btn style2 w-100">Login Here</a>
                        </div>
                         
                         <div class="rounded overflow-hidden shadow-sm">
                            <img src="{{asset('img/banner2.jpg')}}" alt="Recruitment" class="w-100" style="object-fit: cover; height: 200px;">
                         </div>

                    </div>
                </div>
            </div>
        </section>

@endsection

@section('footer_extras')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Company",
            allowClear: true,
            width: '100%'
        });
    });
</script>


 <script>
            document.querySelectorAll('.password-toggle-icon').forEach(item => {
                item.addEventListener('click', event => {
                    const icon = event.currentTarget.querySelector('i');
                    const input = event.currentTarget.previousElementSibling;
                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = "password";
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
    </script>


@endsection