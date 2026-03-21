@extends('layouts.app')

@section('head_metas')

<style>

    .select2-container--default .select2-search--inline .select2-search__field
    {
    min-height: unset;
    height: 0;
    }

</style>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endsection


@section('content')



 <!-- Breadcrumb -->
        <div class="breadcumb-wrapper" style="background-image: url('{{asset('img/banner1.jpg')}}'); background-size: cover; background-position: center; position: relative; padding: 35px 0;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);"></div>
            
            <div class="container" style="position: relative; z-index: 2;">
                <div class="breadcumb-content text-center">
                    <h1 class="breadcumb-title text-white" style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">Employee Registration</h1>
                    <ul class="list-unstyled d-flex justify-content-center align-items-center text-white" style="font-size: 16px;">
                        <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="mx-2"><i class="fas fa-angle-right"></i></li>
                        <li>Employee Registration</li>
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
                                <p class="text-muted small">Join us to find your dream job.</p>
                            </div>

                            <form action="{{ route('employee.register.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <input type="email" class="form-control" name="email" placeholder="Enter Official Email Address" required>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone" placeholder="" required>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Job Category <span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="category_id" id="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Designation <span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="designation_id" id="designation_id" required disabled>
                                            <option value="">Select Designation</option>
                                            {{-- Populated by JS --}}
                                        </select>
                                    </div>

                        <div class="col-md-12 form-group mb-3 text-center">

                        <small class="text-danger d-flex align-items-center mt-1">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            The category and designation cannot be changed later!
                        </small>

                        </div>

                                    


                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Preferred Location 1 <span class="text-danger">*</span></label>
                           
                            <select class="form-select location-select" name="locations[]" required></select>

                        </div>


                        <div class="col-md-6 form-group mb-3">

                            <label class="fw-bold mb-2 text-dark">Preferred Location 2 <span class="text-danger">*</span></label>
                            
                            <select class="form-select location-select" name="locations[]" required></select>

                        </div>

                        <div class="col-md-12 form-group mb-3 text-center">
                      
                        <small class="text-danger d-flex align-items-center mt-1">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            The prefered locations cannot be changed later!
                        </small>

                        <small class="mt-1">
                            Location not found? contact <a href="tel:+91 9747532827">+91 9747532827</a> to add new location
                        </small>

                        </div>
                                    

                                    <div class="col-md-12 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Resume / CV (You can upload later)</label>
                                        <input type="file" class="form-control pt-2" name="cv" accept=".pdf,.doc,.docx">
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
                                    <div><strong>Find Jobs In Your Speciality</strong><br><span class="text-muted small">Get the latest job updates</span></div>
                                </li>
                                <li class="d-flex align-items-start mb-3">
                                    <i class="fas fa-check-circle mt-1 me-2" style="color: var(--theme-color2);"></i>
                                    <div><strong>Create an awesome profile!</strong><br><span class="text-muted small">Show employers what you can do.</span></div>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fas fa-check-circle mt-1 me-2" style="color: var(--theme-color2);"></i>
                                    <div><strong>Apply instantly</strong><br><span class="text-muted small">One click application.</span></div>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-white shadow-sm rounded p-4 mb-4 border text-center">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-3x text-muted"></i>
                            </div>
                            <h4 class="h5">Already Registered?</h4>
                            <p class="text-muted small mb-3">Log in to your dashboard to manage your applications and profile.</p>
                            <a href="{{route('login')}}"   class="th-btn style2 w-100">Login Here</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_id');
    const designationSelect = document.getElementById('designation_id');
    const locationsSelect = document.getElementById('locations');

    // Fetch dynamic designations based on category
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        
        designationSelect.innerHTML = '<option value="">Select Designation</option>';
        designationSelect.disabled = true;

        if (categoryId) {
            const url = "{{ route('api.designations.by_category', ['category' => ':id']) }}".replace(':id', categoryId);
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    data.forEach(designation => {
                        const option = document.createElement('option');
                        option.value = designation.id;
                        option.textContent = designation.name;
                        designationSelect.appendChild(option);
                    });
                    designationSelect.disabled = false;
                })
                .catch(error => console.error('Error fetching designations:', error));
        }
    });

    // Limit multi-select locations to max 2
    locationsSelect.addEventListener('change', function() {
        const selectedOptions = Array.from(this.options).filter(opt => opt.selected);
        if (selectedOptions.length > 2) {
            // Unselect the last chosen item that exceeded limit
            // Note: behavior varies on standard select multples. A simple alert or forcing unselect:
            alert('You can only select up to 2 preferred locations.');
            // Revert last selection
            this.options[this.selectedIndex].selected = false;
        }
    });
});
</script>

<script>
document.querySelectorAll('select[name="locations[]"]').forEach(select => {
    select.addEventListener('change', function () {

        let values = Array.from(document.querySelectorAll('select[name="locations[]"]'))
            .map(s => s.value)
            .filter(v => v);

        let unique = new Set(values);

        if(values.length !== unique.size){
            alert('You already selected this location');
            this.value = '';
        }

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


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

    let selectedDesignation = null;

    $('#designation_id').on('change', function () {
        selectedDesignation = $(this).val();

        // Reset both selects
        $('.location-select').val(null).trigger('change');
    });

    $('.location-select').select2({
        placeholder: 'Search Location',
        ajax: {
            delay: 250,
            transport: function (params, success, failure) {

                if (!selectedDesignation) {
                    alert('Please select designation first');
                    return;
                }

                const url = `/designations/${selectedDesignation}/locations?q=${params.data.q || ''}`;

                fetch(url)
                    .then(res => res.json())
                    .then(success)
                    .catch(failure);
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });

</script>


@endsection