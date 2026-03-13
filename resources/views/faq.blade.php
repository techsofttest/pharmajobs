@extends('layouts.app')

@section('head_metas')

@endsection


@section('content')





  <!-- FAQs -->
        <div class="career-inner-sec">

            <div class="container">
    
                <div class="row justify-content-center">

                    <div class="col-lg-10 text-center  col-xl-8 wow mt-5 mb-5 fadeInUp" data-wow-delay=".3s">
                        <div class="title-area   mb-30">
                        
                            <h2 class="sec-title style2 split-text  ">
                                FAQs
                            </h2>
                            
                                <!-- <p class="mt-3" style="color: #535353;"> Explore elite Quality Assurance opportunities and choose the career path <br> that best fits your professional goals and dreams.</p> -->

                        </div>

                      <div class="accordion" id="pharmaFaq">


                        @foreach($faq as $f)
                        
                          <div class="container mt-2">
                              <a href="#faq{{$loop->iteration}}" class="btn faqbtn btn-primary col-lg-12 d-flex justify-content-between text-start align-items-center" data-bs-toggle="collapse">
                                  {{$f->question}}
                                  <i class="fa fa-chevron-down"></i>
                              </a>
                              <div id="faq{{$loop->iteration}}" class="collapse mt-3  mb-4 text-start" data-bs-parent="#pharmaFaq">
                                   {{$f->answer}}
                              </div>
                          </div>

                        @endforeach

                         

                        
                      </div>
                    
                    </div>
                    
                </div>

            </div>


        </div>





@endsection