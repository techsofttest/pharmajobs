@extends('employer.dashboard')

@section('head_metas')

@endsection


@section('dashboard-content')


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-12 mb-4 mb-lg-0">
                        <div class="bg-white shadow-sm rounded p-4 p-md-5 border">
                            
                            <div class="mb-4 pb-3 border-bottom">
                                <h3 class="h4 mb-1">Post A Job Vacancy</h3>
                                <p class="text-muted small">Post unlimited jobs for free</p>
                            </div>



                            <form action="{{ route('employer.jobs.store') }}" method="POST">
                            @csrf

                            <div class="row">


                            <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Speciality</label>
                            <input type="text" class="form-control" name="job_id">
                            </div>


                            <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Designation *</label>
                            <select class="form-control" name="designation_id" required>
                            <option value="">Select Designation</option>

                            @foreach($designations as $designation)
                            <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach

                            </select>
                            </div>


                            <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Division Name *</label>
                            <input type="text" class="form-control" name="title" required>
                            </div>


                            <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Job Description *</label>
                            <textarea class="form-control" name="description" rows="5" required></textarea>
                            </div>


                            <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Qualification *</label>
                            <input type="text" class="form-control" name="qualification" required>
                            </div>


                            <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Headquaters *</label>
                           
                            <select class="district-select" name="districts[]" multiple required>

                            @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach

                            </select>

                            </div>


                            <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Min Experience</label>
                            <input type="text" class="form-control" name="min_experience">
                            </div>


                            <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Max Age</label>
                            <input type="number" class="form-control" name="max_age">
                            </div>
                            


                            <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Application Expiry</label>
                            <input type="date" class="form-control" name="expires_at">
                            </div>


                            <hr class="my-4">


                            <h5 class="mb-3">Contact Details</h5>

                            <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Contact Name *</label>
                            <input type="text" class="form-control" name="contact_name" required>
                            </div>


                            <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Contact Email *</label>
                            <input type="email" class="form-control" name="contact_email" required>
                            </div>


                            <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2 text-dark">Contact Phone *</label>
                            <input type="text" class="form-control" name="contact_phone" required>
                            </div>


                            <div class="col-12 mt-3">
                            <button type="submit" class="th-btn style1 w-100">
                            Post Job
                            </button>
                            </div>

                            </div>
                            </form>



                        </div>
                    </div>

                </div>
            </div>


@endsection

@section('footer_extras')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('.district-select').select2({
        placeholder: "Select Job Locations",
        maximumSelectionLength: 12,
        width: '100%'
    });

});
</script>

@endsection