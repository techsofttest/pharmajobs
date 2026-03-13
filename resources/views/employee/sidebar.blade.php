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

  <a class="s-item {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}" href="{{route('employee.dashboard')}}">
    <i class="fa-solid fa-grid-2"></i> Dashboard
  </a>

  @php /*
  <a class="s-item {{ request()->routeIs('employee.jobs.index') ? 'active' : '' }}" href="{{route('employee.jobs.index')}}">
    <i class="fa-solid fa-briefcase"></i> Applied Jobs
  </a>
  */ @endphp



  <div class="s-divider"></div>

  <div class="s-label">Account</div>

  <a class="s-item {{ request()->routeIs('employee.profile.edit') ? 'active' : '' }}" href="{{route('employee.profile.edit')}}">
    <i class="fa-regular fa-user"></i> Edit Profile
  </a>

  <a class="s-item {{ request()->routeIs('employee.password') ? 'active' : '' }}" href="{{ route('employee.password') }}">
    <i class="fa-solid fa-chart-simple"></i> Change Password
  </a>


    <a class="s-item" href="javascript:void(0)"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-sliders"></i> Logout
    </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
  </form>


  @php /*
  
  <div class="s-spacer"></div>
  <div class="s-divider"></div>

  <!-- Profile -->
  <div class="s-profile">

    <div class="profile-popup" id="profilePopup">
      <a class="pp-item" href="#"><i class="fa-regular fa-user"></i> View Profile</a>
      <a class="pp-item" href="#"><i class="fa-solid fa-building"></i> Company</a>
      <a class="pp-item" href="#"><i class="fa-solid fa-lock"></i> Change Password</a>
      <a class="pp-item" href="#"><i class="fa-solid fa-bell"></i> Notifications</a>
      <div class="pp-divider"></div>
      <a class="pp-item" href="#"><i class="fa-solid fa-circle-question"></i> Help</a>
      <a class="pp-item danger" href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a>
    </div>

    <div class="s-avatar-row" id="avatarRow" onclick="toggleProfile()">
      <div class="s-avatar">
        TK
        <span class="s-online"></span>
      </div>
      <div class="s-user-info">
        <div class="s-user-name">Thomas Klein</div>
        <div class="s-user-role">Hiring Manager</div>
      </div>
      <i class="fa-solid fa-chevron-up s-chevron"></i>
    </div>

  </div>

  */ @endphp

</aside>

</div>