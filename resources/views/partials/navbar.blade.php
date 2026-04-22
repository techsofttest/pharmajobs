<!-- Menu Wrapper -->
        <div class="th-menu-wrapper">
            <div class="th-menu-area text-center">
                
                <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
                
                <div class="mobile-logo">
                    <a href="{{route('home')}}">
                        <img style="max-width: 180px; height: auto;" src="{{asset('img/logo/primary-logo.png')}}" alt="Pharma Healthcare Jobs">
                    </a>
                </div>

                <div class="mobile-login">
                    @if(auth()->guard('employee')->check())
                        <a href="{{ route('employee.dashboard') }}" class="book-n-btn">
                            <i class="fa fa-user" aria-hidden="true"></i> {{ auth()->guard('employee')->user()->first_name }}
                        </a>
                    @elseif(auth()->guard('employer')->check())
                        <a href="{{ route('employer.dashboard') }}" class="book-n-btn">
                            <i class="fa fa-user" aria-hidden="true"></i> {{ auth()->guard('employer')->user()->first_name }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="book-n-btn">
                            <i class="fa fa-user" aria-hidden="true"></i> Login 
                        </a>
                        <a href="{{ route('register.type') }}" class="log-n-btn">
                            <i class="fa fa fa-user-edit" aria-hidden="true"></i> Register 
                        </a>
                    @endif
                </div>

                <div class="th-mobile-menu">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        
                        <li><a href="{{url('about')}}">About Us</a></li>

                        <li><a href="{{route('jobs')}}">Browse Jobs</a></li>
                        
                        @if(auth()->guard('employee')->check())
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0);">Employee</a>

                            <ul class="sub-menu">

                                <li><a href="{{route('employee.dashboard')}}">Dashboard</a></li> 
                                <li><a href="{{route('employee.profile.edit')}}">Edit Profile</a></li> 
                                <li><a href="{{route('employee.password')}}">Change Password</a></li> 
                                <li><a href="{{route('subscribe')}}">Our Packages</a></li>

                            </ul>

                        </li>
                        @endif


                        @if(auth()->guard('employer')->check())
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0)">Employers</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('employer.dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('employer.jobs.index')}}">View My Jobs</a></li>
                                <li><a href="{{route('employer.jobs.create')}}">Post Job</a></li>
                                <li><a href="{{route('employer.profile.edit')}}">Edit Profile</a></li>

                            </ul>
                        </li>
                        @endif


                        <li><a href="{{url('faq')}}">FAQS</a></li>
                        <li><a href="{{route('subscribe')}}">Subscribe Now</a></li>
                        <li><a href="{{url('contact')}}">Contact Us</a></li>



                    </ul>
                </div>

            </div>
        </div>

      
        <!-- Header -->
        <header class="th-header header-layout1">
            <div class="sticky-wrapper">
                <div class="container th-container2">
                    <div class="menu-area">
                        <div class="row align-items-center justify-content-between">
                            
                            <div class="col-auto">
                                <div class="header-logo">
                                    <a href="{{route('home')}}">
                                        <img style="width: 220px; height: auto;" src="{{asset('img\logo\primary-logo.png')}}" alt="logo">
                                    </a>
                                </div>
                            </div>

                            <div class="col-auto">
                                <nav class="main-menu d-none d-xl-inline-block">
                                    <ul>
                                        <li><a href="{{url('/')}}">Home</a></li>

                                        <li><a href="{{url('about')}}">About Us</a></li>

                                        <li><a href="{{route('jobs')}}">Browse Jobs</a></li>
                                        
                                        @if(auth()->guard('employee')->check())
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">Employee</a>

                                            <ul class="sub-menu">
                                                
                                            <li><a href="{{route('employee.dashboard')}}">Dashboard</a></li> 
                                            <li><a href="{{route('employee.profile.edit')}}">Edit Profile</a></li> 
                                            <li><a href="{{route('employee.password')}}">Change Password</a></li> 

                                            </ul>

                                        </li>
                                        @endif


                                        @if(auth()->guard('employer')->check())
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0)">Employers</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('employer.dashboard')}}">Dashboard</a></li>
                                                <li><a href="{{route('employer.jobs.index')}}">View My Jobs</a></li>
                                                <li><a href="{{route('employer.jobs.create')}}">Post Job</a></li>
                                                <li><a href="{{route('employer.profile.edit')}}">Edit Profile</a></li>

                                            </ul>
                                        </li>
                                        @endif

                                        <li><a href="{{url('faq')}}">FAQS</a></li>
                                        <li><a href="{{route('subscribe')}}">Subscribe</a></li>
                                        <li><a href="{{url('contact')}}">Contact Us</a></li>


                                    </ul>
                                </nav>
                            </div>

                            <div class="col-auto booo-auto">
                                
                                @if(auth()->guard('employee')->check())
                                    <a href="{{ route('employee.dashboard') }}" class="book-n-btn">
                                        <i class="fa fa-user" aria-hidden="true"></i> {{ auth()->guard('employee')->user()->first_name }}
                                    </a>
                                @elseif(auth()->guard('employer')->check())
                                    <a href="{{ route('employer.dashboard') }}" class="book-n-btn">
                                        <i class="fa fa-user" aria-hidden="true"></i> {{ auth()->guard('employer')->user()->first_name }}
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="book-n-btn">
                                        <i class="fa fa-user" aria-hidden="true"></i> Login 
                                    </a>

                                    <a href="{{ route('register.type') }}" class="log-n-btn">
                                        <i class="fa fa fa-user-edit" aria-hidden="true"></i> Register 
                                    </a>
                                @endif


                            </div>

                            <div class="col-auto d-inline-block d-xl-none">
                                <button type="button" class="th-menu-toggle">
                                    <i class="far fa-bars"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->