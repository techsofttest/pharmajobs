@extends('layouts.app')

@section('head_metas')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: calc(3.5rem + 2px);
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.2rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 3.5rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow
    {
        top:0 !important;
    }
</style>
@endsection

@section('footer_extras')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_id');
    const designationSelect = document.getElementById('designation_id');
    const locationSelect = $('#location_id');

    let selectedDesignation = '{{ request('designation') }}';

    function loadDesignations(categoryId, callback = null) {
        designationSelect.innerHTML = '<option value="">Select Designation</option>';
        designationSelect.disabled = true;
        
        if (!categoryId) return;

        const url = "{{ route('api.designations.by_category', ['category' => ':id']) }}".replace(':id', categoryId);
        fetch(url)
            .then(response => response.json())
            .then(data => {
                data.forEach(designation => {
                    const option = document.createElement('option');
                    option.value = designation.id;
                    option.textContent = designation.name;
                    if (selectedDesignation == designation.id) {
                        option.selected = true;
                    }
                    designationSelect.appendChild(option);
                });
                designationSelect.disabled = false;
                if (callback) callback();
            })
            .catch(error => console.error('Error fetching designations:', error));
    }

    categorySelect.addEventListener('change', function() {
        selectedDesignation = null;
        locationSelect.val(null).trigger('change');
        locationSelect.empty();
        loadDesignations(this.value);
    });

    $('#designation_id').on('change', function() {
        selectedDesignation = $(this).val();
        locationSelect.val(null).trigger('change');
        locationSelect.empty();
    });

    locationSelect.select2({
        placeholder: 'Search Location',
        allowClear: true,
        ajax: {
            url: function () {
                if (!selectedDesignation) return null;
                return `/api/designations/${selectedDesignation}/locations`;
            },
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                // Add pagination support if your API returns it, or just plain array
                let results = Array.isArray(data) ? data : (data.results || data);
                // Map the results to Select2 format
                results = results.map(item => ({
                    id: item.id,
                    text: item.text || item.name
                }));
                return {
                    results: results,
                    pagination: {
                        more: data.pagination ? data.pagination.more : false
                    }
                };
            },
            cache: true
        }
    });

    // Initial load
    if (categorySelect.value) {
        loadDesignations(categorySelect.value, function() {
            @if(request('location'))
                // Try to find the location name via a quick fetch or just show "Selected"
                // Assuming we just populate an option so Select2 shows it
                @php
                    $reqLoc = \App\Models\Location::find(request('location'));
                @endphp
                @if($reqLoc)
                    const option = new Option("{{ $reqLoc->name }}", "{{ $reqLoc->id }}", true, true);
                    locationSelect.append(option).trigger('change');
                @endif
            @endif
        });
    }
});
</script>
@endsection


@section('content')


        <!-- Recommended Jobs -->
        @if(auth('employee')->check())
        <div class="career-inner-sec pb-0 mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center col-xl-8 wow fadeInUp" data-wow-delay=".3s">
                        <div class="title-area mb-30">
                            <h2 class="sec-title style2 split-text">Recommended Jobs</h2>
                            <p>Jobs matching your designation and preferred locations</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    @if($recommended_jobs && $recommended_jobs->count() > 0)
                        @include('components.job-card',['jobs' => $recommended_jobs ])
                    @else
                        <div class="col-12 text-center py-5">
                            <div class="bg-light rounded p-5 border">
                                <i class="fa-solid fa-briefcase text-muted mb-3" style="font-size: 3rem;"></i>
                                <h4 class="text-muted">No jobs found for your preferences</h4>
                                
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <hr class="container mt-5">
        @endif

        <!-- Latest Jobs -->
        <div class="career-inner-sec">

            <div class="container">
    
                <div class="row justify-content-center">

                    <div class="col-lg-10 text-center  col-xl-8 wow mt-5 mb-5 fadeInUp" data-wow-delay=".3s">
                        <div class="title-area   mb-30">
                        
                            <h2 class="sec-title style2 split-text  ">
                                Browse All Jobs
                            </h2>
                            
                                <p class="mt-3" style="color: #535353;"> Explore opportunities and choose the career path <br> that best fits your professional goals and dreams.</p>

                        </div>

                        <!-- Search Form -->
                        <div class="job-search-area bg-light p-4 rounded border shadow-sm text-start">
                            <form action="{{ url('jobs') }}" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="fw-bold mb-2 text-dark small">Job Category</label>
                                        <select class="form-select form-control" name="category" id="category_id">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="fw-bold mb-2 text-dark small">Designation</label>
                                        <select class="form-select form-control" name="designation" id="designation_id" disabled>
                                            <option value="">Select Category First</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="fw-bold mb-2 text-dark small">Location</label>
                                        <select class="form-select form-control location-select" name="location" id="location_id">
                                        </select>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="th-btn style1 px-5">Search Jobs <i class="fas fa-search ms-2"></i></button>
                                        @if(request('category') || request('designation') || request('location'))
                                            <a href="{{ url('jobs') }}" class="btn btn-outline-secondary ms-3 px-4" style="padding: 13px 30px; border-radius: 5px; font-weight: 500;">Clear Filters</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                    </div>
                </div>
                <div class="row" id="jobs-row">


                    <!-- jobcards -->

                    @if($jobs && $jobs->count() > 0)
                        @include('components.job-card',['jobs' => $jobs ])
                    @else
                        <div class="col-12 text-center py-5">
                            <div class="bg-light rounded p-5 border">
                                <i class="fa-solid fa-search text-muted mb-3" style="font-size: 3rem;"></i>
                                <h4 class="text-muted">No jobs found matching your criteria</h4>
                                <p class="text-muted mb-0">Try adjusting your filters to find more opportunities.</p>
                            </div>
                        </div>
                    @endif
        
                </div>

                <div class="text-center">
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center" id="jobs-pagination"></ul>
                    </nav>
                </div>

            </div>


        </div>
					



@endsection