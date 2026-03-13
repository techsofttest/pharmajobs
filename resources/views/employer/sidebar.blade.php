<!--<div class="col-lg-3 d-none d-lg-block" >
                    <div class="card shadow-sm border-0 overflow-hidden sticky-top" style="top: 20px; border-radius: 12px;">
                        <div class="card-body p-0">
                            <div class="nav flex-column nav-pills dash-sidebar" id="dashboardMainTabs" role="tablist">
                                <button class="nav-link active d-flex align-items-center" id="tab-profile-trigger" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">
                                    <i class="fas fa-user-circle me-3"></i> My Profile
                                </button>
                                <button class="nav-link d-flex align-items-center"  data-bs-toggle="pill" data-bs-target="#v-pills-jobs" type="button" role="tab">
                                    <i class="fas fa-briefcase me-3"></i> My Jobs
                                </button>
                                <button class="nav-link d-flex align-items-center" id="tab-password-trigger" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab">
                                    <i class="fas fa-key me-3"></i> Change Password
                                </button>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="nav-link d-flex align-items-center" type="submit">
                                        <i class="fas fa-key me-2"></i> Logout
                                    </button>
                                </form>
                           
                            </div>
                        </div>
                    </div>
                </div>-->


<div class="col-lg-3 d-none d-lg-block" >
<aside class="dashboard-sidebar">

@php
$user = auth()->user();

$fullname = $user->first_name.' '.$user->last_name;

@endphp

  <!-- Logo -->
  <div class="s-logo">
    <span class="s-logo-text">Hi, {{ $fullname }}</span>
  </div>

  <!-- Primary nav -->
  <div class="s-label">Main</div>

  <a class="s-item {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}" href="{{route('employer.dashboard')}}">
    <i class="fa-solid fa-grid-2"></i> Dashboard
  </a>

  <a class="s-item {{ request()->routeIs('employer.jobs.create') ? 'active' : '' }}" href="{{route('employer.jobs.create')}}">
    <i class="fa-solid fa-briefcase"></i> Post A Job
  </a>

  <a class="s-item {{ request()->routeIs('employer.jobs.index') ? 'active' : '' }}" href="{{route('employer.jobs.index')}}">
    <i class="fa-solid fa-briefcase"></i> My Jobs
  </a>

  <div class="s-divider"></div>

  <div class="s-label">Account</div>

  <a class="s-item {{ request()->routeIs('employer.profile.edit') ? 'active' : '' }}" href="{{route('employer.profile.edit')}}">
    <i class="fa-regular fa-user"></i> Edit Profile
  </a>

  <a class="s-item {{ request()->routeIs('employer.password') ? 'active' : '' }}" href="{{ route('employer.password') }}">
    <i class="fa-solid fa-chart-simple"></i> Change Password
  </a>



  <a class="s-item" href="javascript:void(0)"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-sliders"></i> Logout
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
  </form>

</aside>

</div>