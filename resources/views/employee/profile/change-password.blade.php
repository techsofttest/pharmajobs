@extends('employee.dashboard')

@section('dashboard-content')

<div class="container">
<div class="row">

<div class="col-lg-12">
<div class="bg-white shadow-sm rounded p-4 p-md-5 border">

<h4 class="mb-4">Change Password</h4>

<form method="POST" action="{{ route('employee.password.update') }}">
@csrf
@method('PUT')

<div class="row">

<div class="col-md-12 mb-3">
<label class="fw-bold mb-2">Current Password</label>
<input type="password" class="form-control" name="current_password" required>
</div>

<div class="col-md-6 mb-3">
<label class="fw-bold mb-2">New Password</label>
<input type="password" class="form-control" name="password" required>
</div>

<div class="col-md-6 mb-3">
<label class="fw-bold mb-2">Confirm Password</label>
<input type="password" class="form-control" name="password_confirmation" required>
</div>

<div class="col-12 mt-3">
<button type="submit" class="th-btn style1 w-100">
Update Password
</button>
</div>

</div>
</form>

</div>
</div>

</div>
</div>

@endsection