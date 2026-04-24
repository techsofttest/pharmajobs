@extends('layouts.app')

@section('head_metas')

@endsection


@section('content')


        <!-- Recommended Jobs -->
        @if(auth('employee')->check())
        <div class="career-inner-sec pb-0 mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center col-xl-8 wow fadeInUp" data-wow-delay=".3s">
                        <div class="title-area mb-30">
                            <h2 class="sec-title style2 split-text">Recommended Jobs</h2>
                            <p>Jobs matching your designation and preferred locations</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    @if($recommended_jobs && $recommended_jobs->count() > 0)
                        @include('components.job-card',['jobs' => $recommended_jobs ])
                    @else
                        <div class="col-12 text-center py-5">
                            <div class="bg-light rounded p-5 border">
                                <i class="fa-solid fa-briefcase text-muted mb-3" style="font-size: 3rem;"></i>
                                <h4 class="text-muted">No jobs found for your preferences</h4>
                                <p class="mb-0">Try updating your profile with more locations or different designations.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <hr class="container mt-5">
        @endif

        <!-- Latest Jobs -->
        <div class="career-inner-sec">

            <div class="container">
    
                <div class="row justify-content-center">

                    <div class="col-lg-10 text-center  col-xl-8 wow mt-5 mb-5 fadeInUp" data-wow-delay=".3s">
                        <div class="title-area   mb-30">
                        
                            <h2 class="sec-title style2 split-text  ">
                                Browse All Jobs
                            </h2>
                            
                                <p class="mt-3" style="color: #535353;"> Explore opportunities and choose the career path <br> that best fits your professional goals and dreams.</p>

                        </div>

                        

                        


                    
                    </div>
                </div>
                <div class="row" id="jobs-row">


                    <!-- jobcards -->

                    @include('components.job-card',['jobs' => $jobs ])

        
                </div>

                <div class="text-center">
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center" id="jobs-pagination"></ul>
                    </nav>
                </div>

            </div>


        </div>
					



@endsection