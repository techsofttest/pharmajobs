<html class="no-js" lang="zxx">

 <head>

        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @yield('head_metas')



        <link rel="icon" type="image/png"   href="{{asset('img/favicon.png')}}" />
        <link rel="preconnect" href="https://fonts.googleapis.com/" />
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />

	      <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/gallery-fonts.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />

        <!-- jQuery UI CDN -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

        <!-- Alertify.js -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />

        @yield('head_extras')

        </head>


        <body id="show-grid">
        <!-- Cursor UI -->
        <div class="cursor"></div>
        <div class="cursor2"></div>


        @include('partials.navbar')


        @yield('content')



        @include('partials.footer')



         <!-- Scroll To Top -->
        <div class="scroll-top">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path
                    d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                    style="
                        transition: stroke-dashoffset 10ms linear 0s;
                        stroke-dasharray: 307.919, 307.919;
                        stroke-dashoffset: 307.919;
                    "
                ></path>
            </svg>
        </div>
		
		
		
		 <!-- Fixed Contact Buttons -->
        <div class="fixedRit">
        <ul>
        
            <li> <a class="call" href="tel:+918137069973"><img src="{{asset('img/l3.png')}}"></a> </li>

            
            <li> <a  class="whatsapp"  href="https://api.whatsapp.com/send/?phone=918137069973&text=%2AHey     Pharma Healthcare Jobs +&app_absent=0" target="_blank">

            <img src="{{asset('img/l1.png')}}">

            </a> 
        
            </li>

        </ul>
        </div>




                <!-- Forgot Password Modal -->
<div class="modal fade youmyModal" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Forgot Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
       <form action="" method="POST" class="slider-contactform form-style3 cnt ">
<div class="row gx-20 mt-30">
<div class="form-group col-md-12">
<input type="email" name="email"  placeholder="Email  " required>  
</div>
 <div class="form-btn col-12">
<div class="text-center mt-20">
<button type="submit" class="th-btn  style2   ">Submit Now <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path></svg> </button>
 <div class="row  mt-10 justify-content-center align-items-center facebb-google">
 <div class="col-lg-12"><div class="llllri">Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#youmyModal" data-bs-dismiss="modal" aria-label="Close" > Sign In</a></div>
		    </div>
   </div>
 </div>
 </div>

</div>

</form>
      </div>
     
    </div>
  </div>
</div>

<!-- Decorative Chat Background -->
<div class="chat-bg">
  <img src="{{asset('img/chat.png')}}">
  
  </div>
        <!-- Vendor and Theme Scripts -->
       <script src="{{ asset('js/vendor/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!--<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>-->
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
        <!--<script src="{{ asset('js/circle-progress.js') }}"></script>-->
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
        <!--<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>-->
        <script src="{{ asset('js/nice-select.min.js') }}"></script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <!--<script src="{{ asset('js/threesixty.min.js') }}"></script>-->
        <!--<script src="{{ asset('js/panolens.min.js') }}"></script>-->
        <!--<script src="{{ asset('js/gsap.min.js') }}"></script>-->
        <script src="{{ asset('js/ScrollTrigger.min.js') }}"></script>
        <!--<script src="{{ asset('js/SplitText.js') }}"></script>-->
        <!--<script src="{{ asset('js/SplitType.js') }}"></script>-->
        <!--<script src="{{ asset('js/lenis.min.js') }}"></script>-->
        <script src="{{ asset('js/CustomEase.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
		
	 
			


  <script>

var win = $(window);

win.on('scroll', function () {

    // Only run if page can actually scroll
    if ($(document).height() <= win.height()) {
        return;
    }

    if (win.scrollTop() > 200) {
        $(".fixedRit").addClass("fixedRit-sticky");
        $(".sti-menu").addClass("sti-menu-sticky");
    } else {
        $(".fixedRit").removeClass("fixedRit-sticky");
        $(".sti-menu").removeClass("sti-menu-sticky");
    }

});

</script>



  <script>
	function openprofile(evt, profileName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("mtabcontent");
 
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("mtablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
	
  }
  document.getElementById(profileName).style.display = "block";
  evt.currentTarget.className += " active";
   AOS.refresh();
 
}
 const defaultOpenEl = document.getElementById("defaultOpen");
 if (defaultOpenEl) defaultOpenEl.click();

	</script> 



    <!-- Alertify.js -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier', 'position', 'bottom-center');

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                alertify.error('{{ addslashes($error) }}');
            @endforeach
        @endif

        @if (session('error'))
            alertify.error('{{ addslashes(session('error')) }}');
        @endif

        @if (session('success'))
            alertify.success('{{ addslashes(session('success')) }}');
        @endif
    </script>

    @yield('footer_extras')




</body>
</html>







