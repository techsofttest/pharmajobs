@extends('employer.dashboard')



@section('dashboard-content')


    <div class="section-header" style="margin-bottom:20px;">
      <div>
        <div class="section-title" style="font-size:22px;">My Job Listings</div>
        <div style="font-size:13px;color:var(--text-muted);margin-top:3px;">Manage and track all your posted positions</div>
      </div>

      <a class="btn-post-job" href="{{route('employer.jobs.create')}}">
        <i class="fa-solid fa-plus"></i> Post New Job
      </a>

    </div>

    <div class="card-box">

        @php /*
      <div class="filter-bar">
        <div class="filter-chip active">All (12)</div>
        <div class="filter-chip">Active (8)</div>
        <div class="filter-chip">Paused (2)</div>
        <div class="filter-chip">Drafts (1)</div>
        <div class="filter-chip">Closed (1)</div>
      </div>
      */ @endphp
      <div class="table-wrapper">
        <table class="dash-table">
          <thead>
            <tr>
              <th>Job Title</th>

              <th>Designation</th>

              <th>Location</th>
              
              <th>Status</th>
              <th>Applicants</th>
              <th>Posted</th>
              <th>Actions</th>
            </tr>
          </thead>


          <tbody id="jobsTableBody">


          @foreach($jobs as $job)

<tr>
<td>
<div class="job-title-cell">{{ $job->title }}</div>
</td>

<td style="color:var(--text-muted);font-size:13px;">
{{ $job->designation->name ?? '' }}
</td>

<td style="color:var(--text-muted);font-size:13px;">
@if($job->districts->count() > 0)
  {{ $job->districts->pluck('name')->implode(', ') }}
@endif
</td>

<td>

 <span class="status-badge {{ $job->is_active ? 'active' : 'inactive' }}">
        {{ $job->is_active ? 'Active' : 'Inactive' }}
  </span>

</td>

<td>
@if(($job->applications->count() ?? 0) > 0)

<span class="applicants-count">
    <i class="fa-solid fa-user-group"></i>
    {{ $job->applications->count() }}
</span>

<a href="{{ route('employer.jobs.applicants',$job->id) }}" class="tbl-btn my-2">
<i class="fa-solid fa-eye"></i> View
</a>

@else

<span style="color:var(--text-muted);font-size:13px;">
    No applicants
</span>

@endif
</td>

<td style="color:var(--text-muted);font-size:13px;">
{{ $job->created_at->diffForHumans() }}
</td>

<td>
<div class="table-actions">

<a href="{{ route('employer.jobs.show',$job->id) }}" class="tbl-btn">
<i class="fa-solid fa-eye"></i>
</a>

<a href="{{ route('employer.jobs.edit', $job->id) }}" class="tbl-btn">
<i class="fa-solid fa-pen"></i>
</a>

<form action="" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button type="submit" class="tbl-btn danger">
<i class="fa-solid fa-trash"></i>
</button>
</form>

</div>
</td>

</tr>

@endforeach


          </tbody>


        </table>
      </div>
    </div>
    


@endsection