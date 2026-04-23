@extends('employer.dashboard')

@section('dashboard-content')

<div class="section-header">
    <div>
        <div class="section-title">{{ $job->title }}</div>
        <div style="font-size:13px;color:var(--text-muted);">
            Posted {{ $job->created_at->diffForHumans() }}
        </div>
    </div>
</div>

<div class="card-box">

<div style="margin-bottom:20px;">
<strong>Designation:</strong>
{{ $job->designation->name ?? '' }}
</div>

<div style="margin-bottom:20px;">
<strong>Location:</strong>
{{ $job->locations->pluck('name')->implode(', ') }}
</div>

<div style="margin-bottom:20px;">
<strong>Status:</strong>

<span class="status-badge {{ $job->is_active ? 'approved' : 'pending' }}">
{{ $job->is_active ? 'Approved' : 'Pending' }}
</span>

</div>

<div style="margin-bottom:20px;">
<strong>Applicants:</strong>
{{ $job->applications->count() }}
</div>

<div style="margin-bottom:20px;">
<strong>Description</strong>

<div style="margin-top:8px;color:var(--text-muted)">
{!! $job->description !!}
</div>

</div>

</div>

@endsection