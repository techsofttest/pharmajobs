@extends('layouts.app')

@section('head_metas')

@endsection


@section('content')


        <!-- Latest Jobs -->
        <div class="career-inner-sec">

            <div class="container">
    
                <div class="row justify-content-center">

                    <div class="col-lg-10 text-center  col-xl-8 wow mt-5 mb-5 fadeInUp" data-wow-delay=".3s">
                        
                    @include('components.searchbar')

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