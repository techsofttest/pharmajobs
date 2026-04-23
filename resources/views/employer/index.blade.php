@extends('employer.dashboard')


@section('dashboard-content')




<!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card blue">
        <div class="stat-icon blue"><i class="fa-solid fa-briefcase"></i></div>
        <div class="stat-value">{{$job_count}}</div>
        <div class="stat-label">Active Job Listings</div>
      </div>
      <div class="stat-card green">
        <div class="stat-icon green"><i class="fa-solid fa-users"></i></div>
        <div class="stat-value">{{$applicant_count}}</div>
        <div class="stat-label">Total Applicants</div>
      </div>
      
    </div>

    <!-- Two column section -->
    <div class="col-auto">
      <!-- Recent Jobs -->
      <div>
        <div class="section-header">
          <div class="section-title">Recent Jobs</div>
          
        </div>

        <div class="card-box">


          <div class="table-wrapper">
            <table class="dash-table">
              <thead>
                <tr>
                  <th>Job Title</th>
                  <th>Locations</th>
                  <th>Status</th>
                  <th>Applied</th>
                </tr>
              </thead>
              <tbody>

                @forelse($jobs as $job)

<tr>

<td>
<div class="job-title-cell">{{ $job->title }}</div>

<div class="job-dept">
{{ $job->designation->name ?? '' }}
</div>
</td>


<td>

@if($job->locations->count() > 0)
  {{ $job->locations->pluck('name')->implode(', ') }}
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

</tr>

@empty

<tr>
<td colspan="3">No jobs posted yet</td>
</tr>

@endforelse

              </tbody>
            </table>

          </div>

        </div>
      </div>


    </div>

    <!-- Recent Applicants -->
    <div style="margin-top: 24px;">
      <div class="section-header">
        <div class="section-title">Latest Applicants</div>
        
      </div>
      <div class="card-box">

        <div class="applicant-list">


         <div class="table-wrapper">
            <table class="dash-table">
              <thead>
                <tr>
                  <th>Applicant Name</th>
                  <th>Job Title</th>
                  <th>Applied On</th>
                </tr>
              </thead>
              <tbody>

 @forelse($latest_applicants as $app)

<tr>

<td>
{{ $app->employee->first_name ?? '' }}
{{ $app->employee->last_name ?? '' }}
</td>

<td>

{{ $app->job->title }}

</td>

<td>
{{ $app->created_at->format('d M Y') }}
</td>

</tr>

@empty

<tr>
<td colspan="3">No Applicants yet</td>
</tr>

@endforelse

              </tbody>
            </table>

          </div>



        </div>
      </div>
    </div>





@endsection