@extends('employer.dashboard')

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

<form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">First Name</label>
<input type="text" class="form-control" name="first_name"
value="{{ $employer->first_name }}" required>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Last Name</label>
<input type="text" class="form-control" name="last_name"
value="{{ $employer->last_name }}" required>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Email</label>
<input type="email" class="form-control"
value="{{ $employer->email }}" disabled>
</div>

<div class="col-md-6 form-group mb-3">
<label class="fw-bold mb-2 text-dark">Phone</label>
<input type="text" class="form-control" name="phone"
value="{{ $employer->phone }}" required>
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