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


      <div class="stat-card {{ $activeSubscription ? 'green' : 'red' }}">
        <div class="stat-icon {{ $activeSubscription ? 'green' : 'red' }}"><i class="fa-solid fa-layer-group"></i></div>
        @if($activeSubscription)
            <div class="stat-value" style="font-size: 1.2rem;">{{ $activeSubscription->package->name ?? 'Plan' }} <br><span style="font-size: 0.9rem;">(Rs. {{ number_format($activeSubscription->price ?? 0, 2) }})</span></div>
            <div class="stat-label">Expires: {{ $activeSubscription->ends_at->format('d M, Y') }}</div>
        @else
            <div class="stat-value">No active plan</div>
            <div class="stat-label">--</div>
        @endif
      </div>
    
      
    </div>

    <!-- Two column section -->
    <div class="col-auto">
      <!-- Recent Jobs -->
      <div>
        <div class="section-header">
          <div class="section-title">Recently Applied</div>
          
        </div>
        <div class="card-box">
          <div class="table-wrapper">
            <table class="dash-table">
              <thead>
                <tr>
                  <th>Job Title</th>
                  <th>Company</th>
                  <th>Location</th>
                  <th>Applied On</th>
                </tr>
              </thead>
              <tbody>


@forelse($applications as $job)

<tr>

<td>

<div class="job-title-cell">{{ $job->job->title ?? '' }}</div>

<div class="job-dept">
{{ $job->job->designation->name ?? '' }}
</div>

</td>

<td>

<div class="job-title-cell">{{ $job->job->company->name ?? '' }}</div>

</td> 

<td>

<div class="job-title-cell">{{ $job->job->locations->pluck('name')->implode(', ') }}</div>

</td>

<td>
<span class="applicants-count">
<i class="fa-solid fa-calendar"></i>
{{ $job->created_at->format('d m Y') }}
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