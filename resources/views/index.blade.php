@extends('layouts.app')

@section('head_metas')

@endsection


@section('content')


<style>

.swiper-pagination-fraction {
    display: none !important;
}

</style>

		 <!-- Hero Section -->
         <div class="th-hero-wrapper position-relative">
		 

		 
            <div class="hero-4">
                <div class="swiper th-slider" id="hero-thumb" data-slider-options='{"effect":"fade","loop":true,"paginationType":"fraction"}'>
                    <div class="container">
                        <div class="row">
                            <div class="slider-pagination"></div>
                        </div>
                    </div>

                    <div class="swiper-wrapper">


                    @foreach($banners as $banner)
                        <div class="swiper-slide">
                        <div class="hero-inner">
                            <img src="{{asset('storage')}}/{{$banner->image}}" class="bann-img" width="100%" alt="banner_image{{$loop->iteration}}">
                        </div>
						</div>
                    @endforeach

						  
                   
                    </div>
                    <div class="slider-controller">
                        <div class="hero-thumb" data-slider-tab="#hero-thumb">
                            <div class="tab-btn active"></div>
                            <div class="tab-btn"></div>
                          <div class="tab-btn"></div>
                        </div>
                    </div>
                </div>
                
            </div>
			
				 <!-- Search Banner Form -->
                 <div class="banner-formmain">
				 <div class="container">
		 <div class="row align-items-center justify-content-center">
 <div class="col-lg-12  ">
 <div class="hero-style4">
 
<h1 class="hero-title" >Find your dream job now</h1>
 




	
<div class="btn-group justify-content-center mt-15  crr-btngroup">

<a href="{{route('jobs')}}" class="th-btn  ">Browse Jobs <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path></svg></a>

<a href="{{route('about')}}" class="th-btn  style2">About  <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path></svg></a> </div>

 
 
</div> <!-- end hero-title-->
 </div> 
 
   </div><!-- row-->
	</div>
             	</div>
        </div>
		
		
		<!-- Designations Data & Handler -->
        <script>
    // Data mapping from your image
    const data = {
        pharma: [
           "(MR) Medical Representative",
"(ASM) Area Sales Manager (First Line Manager)",
"(KAM) Key Accounts Manager",
"(BDM) Business Development Manager",
"(PMD) Product Managers",
"(MM) Marketing Managers",
"(RM) Regional Manager (Second Line manager)",
"(ZM) Zonal Sales Manager  (Third Line Manager)",
"(SM) Sales Manager(Fourth Line Manager)",
"(NSM) National Sales Manager",
"DGM/GM/ VP"
        ],
        medical: [
            "Physician",
"Pediatrician",
"Gynecologist/Obstetrician",
"Anesthesiologist",
"Cardiologist",
" Dermatologist",
"Endocrinologist",
"Gastroenterologist",
"Neurologist",
"Oncologist",
"Ophthalmologist",
"Orthopedic Surgeon",
"(ENT) Otolaryngologist",
"Psychiatrist",
"Pulmonologist",
"Radiologist",
"Urologist",
"General surgeon",
"Rheumatologist",
"Nephrologist",
"Neonatologist",
"Dentist",
"Cosmetologist",
"Fertility Specialist",
"Sexologist",
"Andrologist",
"Pathologist",
"Immunologist",
"Ayurvedic General Physician",
"Homeopathic Physician",
"Naturopathy Physician",
"Siddha",
"Unani",
"Osteopathy",
"Veterinarian (Doctors)",
"General Physician"
        ],
        paramedical: [
 "Nurse",
"Lab technician",
"Pharmacist",
"Radiographer (X Ray)",
"MRI/CT/USG Technologist",
"Diagnostic Medical Sonographer ",
"Optometrist",
"Physiotherapist",
"Occupational Therapist",
"Speech & Language Pathologist/Therapist",
"Dietitian/Nutritionist",
"Respiratory Therapist",
"OT Technologist",
"Anesthesia Technologist/Assistant",
"Surgical Technologist/Assistant",
"Dialysis Technologist",
"Perfusionist (Operates heart-lung Machine)",
"Cardiovascular Technologist",
"Medical Records Technician",
"Emergency Medical Technician ",
"ECG Technician",
"HR Managers",
"Microbiologist",
"Biotechnologist",
"Biomedical Scientist",
"Research Scientist",
"Pharmaceutical /QC",
"Food Technologist",
"Forensic Specialist",
"Biochemists",
"Accountants",
"Clerks",
"Office Assistants"
        ]
    };

    function updateDesignations() {
        const categorySelect = document.getElementById("category");
        const designationSelect = document.getElementById("designation");
        const selectedCategory = categorySelect.value;

        // Clear existing options
        designationSelect.innerHTML = '<option value="" disabled>Select Designation</option>';

        if (selectedCategory && data[selectedCategory]) {
            data[selectedCategory].forEach(item => {
                let option = document.createElement("option");
                option.value = item;
                option.textContent = item;
                designationSelect.appendChild(option);
            });
        }
    }
        </script>
		
		 
		
		<!-- About Section -->
        <div class="Aboo-sec">
				
				<div class="container">
				
				
				<div class="row align-items-center  justify-content-center">
 
                    <div class="col-lg-11  col-xl-10 wow fadeInUp" data-wow-delay=".3s">
					        <div class="acc-aa text-center ">
						  
							       <div class="title-area   mb-30">
                          
                            <h2 class="sec-title style2 split-text  ">
                       Empowered Talent. Stronger Organizations
                            </h2>
                        </div>
						
						   <p>Pharma Healthcare Jobs  is a  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
<p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
             
					  
							  </div>
                   
                      
                   
						</div>
                    </div>
               
				
				</div>
				
				
        </div>
				
					</div>
					
					
					
            
                @if(!auth('employee')->check() && !auth('employer')->check())

                <!-- Candidate/Employer Cards -->
				<div class="Emploo-jobsec">
				 
				 <div class="container">
				 <div class="row">
				 
		 
				 
				 <div class="col-lg-6 col-md-6 d-flex">
				 
				  <a href="{{route('employee.register')}}" class="job-seekers-box"  >
				  <div class="row jooo-row">
				  <div class="col-lg-6 d-flex">
				  <div class="jooo-img"><img src="{{asset('img/candiate.jpg')}}"  ></div>
				  </div>
					  <div class="col-lg-6 d-flex">
				    <div class="jooo-con-in">
					    <div class="jooo-con">
					 <h3>I am a Employee / Candidate</h3>
					 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					 <span class="th-btn  ">Click Here
					 
					 </span>
					 	</div>
					</div>
				  </div>
				  </div>
				    </a>
				 </div>
				 
				 
				  <div class="col-lg-6 col-md-6 d-flex">
				 
				  <a href="{{route('employer.register')}}" class="job-seekers-box employers-box"  >
				  <div class="row jooo-row">
				  <div class="col-lg-6 d-flex">
				  <div class="jooo-img"><img src="{{asset('img/employer.jpg')}}"  ></div>
				  </div>
					  <div class="col-lg-6 d-flex">
				    <div class="jooo-con-in">
					    <div class="jooo-con">
					 <h3>I am an Employer</h3>
					 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					 <span class="th-btn  style2">Click Here
					 
					 </span>
					 	</div>
					</div>
				  </div>
				  </div>
				    </a>
				 </div>
				 
				 
				 </div>
				 
				 </div>
				 
				 </div>

                 @endif


	 
			<!-- Latest Jobs -->
            <div class="career-inner-sec">

<div class="container">
 	 	
				<div class="row    justify-content-center">
 
                    <div class="col-lg-10 text-center  col-xl-8 wow fadeInUp" data-wow-delay=".3s">
  <div class="title-area   mb-30">
                          
                            <h2 class="sec-title style2 split-text  ">
                         Our Latest Jobs 
                            </h2>
							
								<p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  </p>
  
                        </div>
					
</div>
                    </div>
<div class="row">

@include('components.job-card',['jobs' => $jobs ])
			    
</div>

<div class="text-center">
<a href="{{route('jobs')}}" class="th-btn style2 ">View All Jobs <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path></svg></a>
</div>

</div>


</div>
				
				  
				 
				 
				 
				 
				 
				  <!-- Categories Section -->
                  <section class="overflow-hidden  blogggsec overflow-hidden" id="blog-sec">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <div class="title-area text-center">
                       
                            <h2 class="sec-title style2 split-text mb-10">
       Our  Medical Categories 
                            </h2>
							<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> 
                        </div>
                    </div>
                </div>
				
				
				
				
				
			    <div class="row">
                 



                    @foreach($categories as $category)

                    <div class="col-lg-4 col-md-4 col-sm-6 d-flex">
                        <div class="blog-card wow fadeInUp" data-wow-delay=".3s">

                            <div class="box-img global-img">
                                <img 
                                    src="{{ $category->image 
                                            ? asset('storage/'.$category->image) 
                                            : asset('assets/img/services/default.jpg') }}" 
                                    alt="{{ $category->name }}" />
                            </div>

                            <div class="box-content">
                                <h3 class="box-title">
                                    <a href="">
                                        {{ $category->name }}
                                    </a>
                                </h3>

                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($category->description), 120) }}
                                </p>
                            </div>

                            @php /*

                            <a href="" class="th-btn">
                                Read More
                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right"
                                    viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path>
                                </svg>
                            </a>

                            */ @endphp

                        </div>
                    </div>

                    @endforeach
                            
						  
                </div>
				
				
				
				
				
          
            </div>
        </section>
		
		
		
		<!-- Packages Section -->
        <div class="Sunb-secsss">
				
				<div class="container">
				
			 
						  
							       <div class="title-area  text-center mb-30">
                          
                            <h2 class="sec-title style2 split-text  ">
                      Our Packages
                            </h2>
                        </div>
						
			 
                    
					
<div class="row">
  

@include('components.package-card',['packages' => $packages])
 
  
</div>
               
				
				</div>
				
				
				</div>
				
			 
			
          
		<!-- Counter/Stats Section -->
        <div class="Countersss overflow-hidden">
            <div class="container">
			
			
			   <div class="title-area   mb-30 text-center   ">
			   <span class="sub-title text-anime">Best in Markets</span>
              <h2 class="sec-title style2  split-text">Pharma Healthcare Jobs  Difference

              </h2>
			  </div>
                <div class="counter-card_wrapp row">
				
				<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                    <div class="counter-card  wow fadeInUp" data-wow-delay=".3s">
					
				<div class="ccimg">
					<img src="{{asset('img/co1.png')}}" alt=""></div>
					<div class=" ccdd">
                        <h3 class="box-number"><span class="counter-number">5000</span>+</h3>
                        <p class="box-text">Jobs Posted</p>
                    </div>
					    </div>   </div>
						<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                    <div class="counter-card  wow fadeInUp" data-wow-delay=".3s">
	<div class="ccimg">
					<img src="{{asset('img/co2.png')}}" alt=""></div>
							<div class=" ccdd">
                        <h3 class="box-number"><span class="counter-number">80</span>+</h3>
                        <p class="box-text">Designations</p>
                    </div>
					    </div>   </div>
						<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                    <div class="counter-card  wow fadeInUp" data-wow-delay=".3s">
					<div class="ccimg">
					<img src="{{asset('img/co3.png')}}" alt=""></div>
							<div class=" ccdd">
                        <h3 class="box-number"><span class="counter-number">1000</span>+</h3>
                        <p class="box-text">Happy Employers </p>
                    </div>
					    </div>   </div>
						<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                    <div class="counter-card  wow fadeInUp" data-wow-delay=".3s">
				<div class="ccimg">
					<img src="{{asset('img/co4.png')}}" alt=""></div>
							<div class=" ccdd">
                        <h3 class="box-number"><span class="counter-number">450</span>+</h3>
                        <p class="box-text">Cities Covered</p>
                    </div>   </div>
					    </div>
                </div>
            </div>
        </div> 





@endsection