@extends('employer.dashboard')

@section('dashboard-content')

<div class="section-header" style="margin-bottom:20px;">
    <div>
        <div class="section-title" style="font-size:22px;">
            Applicants for {{ $job->title }}
        </div>

        <div style="font-size:13px;color:var(--text-muted);">
            {{ $applications->count() }} Applicants
        </div>

    </div>

    <a class="btn-post-job" href="{{route('employer.jobs.index')}}">
        <i class="fa-solid fa-backward"></i> Back
    </a>


</div>


<div class="card-box">

<table class="dash-table">

<thead>
<tr>
<th>Applicant</th>
<th>Email</th>
<th>Phone</th>
<th>Applied</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@forelse($applications as $app)

<tr>

<td>
{{ $app->employee->first_name ?? '' }}
{{ $app->employee->last_name ?? '' }}
</td>

<td>
{{ $app->employee->email ?? '' }}
</td>

<td>
{{ $app->employee->phone ?? '' }}
</td>

<td>
{{ $app->created_at->diffForHumans() }}
</td>

<td>

<a href="#" class="tbl-btn">
<i class="fa-solid fa-eye"></i> View
</a>

</td>

</tr>

@empty

<tr>
<td colspan="5" style="text-align:center;color:var(--text-muted);">
No applicants yet
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

@endsection