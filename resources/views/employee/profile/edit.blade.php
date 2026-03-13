@extends('employee.dashboard')

@section('head_metas')

@endsection

@section('dashboard-content')

<div class="container">
<div class="row">

<div class="col-lg-12 mb-4">
<div class="bg-white shadow-sm rounded p-4 p-md-5 border">

<div class="mb-4 pb-3 border-bottom">
<h3 class="h4 mb-1">Edit Profile</h3>
<p class="text-muted small">Update your personal information</p>
</div>

<form action="{{ route('employee.profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">First Name</label>
<input type="text" class="form-control" name="first_name"
value="{{ $employee->first_name }}" required>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Last Name</label>
<input type="text" class="form-control" name="last_name"
value="{{ $employee->last_name }}" required>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Email</label>
<input type="email" class="form-control"
value="{{ $employee->email }}" disabled>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Phone</label>
<input type="text" class="form-control" name="phone"
value="{{ $employee->phone }}" required>
</div>

<hr class="my-3">

<h5 class="mb-3">Professional Details</h5>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Category</label>
<input type="text" class="form-control"
value="{{ $employee->employee?->category?->name }}" disabled>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Designation</label>
<input type="text" class="form-control"
value="{{ $employee->employee?->designation?->name }}" disabled>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Preferred Location 1</label>
<input type="text" class="form-control"
value="{{ $employee->employee->locations->get(0)->name ?? '' }}" disabled>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Preferred Location 2</label>
<input type="text" class="form-control"
value="{{ $employee->employee->locations->get(1)->name ?? '' }}" disabled>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Speciality</label>
<input type="text" class="form-control"
name="speciality"
value="{{ $employee->employee->speciality }}">
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Years of Experience</label>
<input type="text" class="form-control"
name="yoe"
value="{{ $employee->employee->yoe }}">
</div>


<div class="col-md-12 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Highest Qualification</label>
<input type="text" class="form-control"
name="qualification"
value="{{ $employee->employee->qualification }}">
</div>

<hr class="my-3">

<h5 class="mb-3">Resume</h5>

<div class="col-md-12 form-group mb-3">

@if($employee->cv)
<p class="mb-2">
Current Resume :
<a href="{{ asset('storage/'.$employee->cv) }}" target="_blank">
View Resume
</a>
</p>
@endif

<input type="file" class="form-control pt-2" name="cv" accept=".pdf,.doc,.docx">

</div>

<div class="col-12 mt-3">
<button type="submit" class="th-btn style1 w-100">
Update Profile
</button>
</div>

</div>
</form>

</div>
</div>

</div>
</div>

@endsection