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
        <link rel="stylesheet" href="{{ asset('css/style.min.css?v1.5') }}" />
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
        <!--<div class="cursor"></div>
        <div class="cursor2"></div>-->


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




  <style>
   /* Floating Navbar */


   .fnav {
  opacity: 0;
  transform: translate(-50%, 20px);
  transition: all 0.25s ease;
  pointer-events: none;
    }

    .fnav.show {
    opacity: 1;
    transform: translate(-50%, 0);
    pointer-events: auto;
    }


  .fnav {
    position: fixed;
    z-index:99;
    bottom: 18px;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    background: white;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 0.5px solid rgba(255,255,255,0.12);
    border-radius: 26px;
    display: flex;
    align-items: center;
    padding: 6px 6px;
    gap: 2px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.55), 0 1px 0 rgba(255,255,255,0.06) inset;
  }

  .fnav-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 3px;
    padding: 7px 4px 6px;
    border-radius: 20px;
    cursor: pointer;
    position: relative;
    transition: background 0.18s;
    border: none;
    background: transparent;
  }

  /* Subtle separator between items */
  .fnav-item:not(:last-child)::after {
    content: '';
    position: absolute;
    right: -1px;
    top: 20%;
    height: 60%;
    width: 0.5px;
    background: rgba(255,255,255,0.08);
  }

  .fnav-item .icon {
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .fnav-item .label {
    font-size: 10px;
    font-weight: 500;
    letter-spacing: 0.01em;
    line-height: 1;
  }

  /* Home — teal */
  .fnav-item.home .icon svg { stroke: #5DCAA5; }
  .fnav-item.home .label { color: #5DCAA5; }
  .fnav-item.home.active,
  .fnav-item.home:hover { background: rgba(93,202,165,0.13); }

  /* Jobs — purple */
  .fnav-item.jobs .icon svg { stroke: #AFA9EC; }
  .fnav-item.jobs .label { color: #AFA9EC; }
  .fnav-item.jobs.active,
  .fnav-item.jobs:hover { background: rgba(175,169,236,0.13); }

  /* Register — coral */
  .fnav-item.register .icon svg { stroke: #F0997B; }
  .fnav-item.register .label { color: #F0997B; }
  .fnav-item.register.active,
  .fnav-item.register:hover { background: rgba(240,153,123,0.13); }

  /* Contact — amber */
  .fnav-item.contact .icon svg { stroke: #EF9F27; }
  .fnav-item.contact .label { color: #EF9F27; }
  .fnav-item.contact.active,
  .fnav-item.contact:hover { background: rgba(239,159,39,0.13); }


  </style>



       <!-- Floating Navbar -->
    <nav class="fnav" role="navigation" aria-label="Main navigation">

      <a class="fnav-item home" href="{{route('home')}}">
        <span class="icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
            <path d="M9 21V12h6v9"/>
          </svg>
        </span>
        <span class="label">Home</span>
      </a>

      <a class="fnav-item jobs" href="{{route('jobs')}}">
        <span class="icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="7" width="20" height="14" rx="2"/>
            <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
            <line x1="12" y1="12" x2="12" y2="16"/>
            <line x1="10" y1="14" x2="14" y2="14"/>
          </svg>
        </span>
        <span class="label">Jobs</span>
      </button>

      <a class="fnav-item register" href="{{route('register.type')}}">
        <span class="icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
            <line x1="19" y1="8" x2="19" y2="14"/>
            <line x1="16" y1="11" x2="22" y2="11"/>
          </svg>
        </span>
        <span class="label">Register</span>
    </a>

      <a class="fnav-item contact" href="{{route('contact')}}">
        <span class="icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
        </span>
        <span class="label">Contact</span>
     </a>

    </nav>
  </div>
</div>

<script>
function setActive(el) {
  document.querySelectorAll('.fnav-item').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
}
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const fnav = document.querySelector(".fnav");

    function handleScroll() {
        const scrollY = window.scrollY;
        const viewportHeight = window.innerHeight;
        const pageHeight = document.documentElement.scrollHeight;

        // 1. Show after 1 viewport height
        const shouldShow = scrollY > viewportHeight-100;

        // 2. Hide near bottom (adjust 100px buffer if needed)
        const nearBottom = (scrollY + viewportHeight) >= (pageHeight - 100);

        if (shouldShow && !nearBottom) {
            fnav.classList.add("show");
        } else {
            fnav.classList.remove("show");
        }
    }

    window.addEventListener("scroll", handleScroll);
});

if (window.innerWidth <= 768) {
   window.addEventListener("scroll", handleScroll);
}

</script>












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







