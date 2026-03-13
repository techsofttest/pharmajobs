@extends('employee.dashboard')


@section('dashboard-content')




<!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card blue">
        <div class="stat-icon blue"><i class="fa-solid fa-briefcase"></i></div>
        <div class="stat-value">{{$application_count}}</div>
        <div class="stat-label">Applied Jobs</div>
      </div>
      
      <div class="stat-card green">
        <div class="stat-icon green"><i class="fa-solid fa-layer-group"></i></div>
        <div class="stat-value">{{$employee->employee->category->name}}</div>
        <div class="stat-label">{{$employee->employee->designation->name}}</div>
      </div>
    
      
    </div>

    <!-- Two column section -->
    <div class="col-auto">
      <!-- Recent Jobs -->
      <div>
        <div class="section-header">
          <div class="section-title">Recently Applied</div>
          <a href="#" class="section-action" onclick="showPage('jobs', null)">View all →</a>
        </div>
        <div class="card-box">
          <div class="table-wrapper">
            <table class="dash-table">
              <thead>
                <tr>
                  <th>Job Title</th>
                  <th>Applied On</th>
                </tr>
              </thead>
              <tbody>


@forelse($applications as $job)

<tr>

<td>
<div class="job-title-cell">{{ $job->title }}</div>

<div class="job-dept">
{{ $job->designation->name ?? '' }}
</div>
</td>

<td>
<span class="applicants-count">
<i class="fa-solid fa-user-group"></i>
{{ $job->created_at }}
</span>
</td>

</tr>

@empty

<tr>
<td colspan="3">No jobs applied yet</td>
</tr>

@endforelse

              </tbody>
            </table>

          </div>

        </div>
      </div>


    </div>



@endsection