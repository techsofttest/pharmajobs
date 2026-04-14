@extends('layouts.app')

@section('head_metas')

@endsection


@section('content')




 <!-- Breadcumb -->
        <div class="breadcumb-wrapper" style="background-image: url('{{asset('img/banner1.jpg')}}); background-size: cover; background-position: center; position: relative; padding: 100px 0;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);"></div>
            
            <div class="container" style="position: relative; z-index: 2;">
                <div class="breadcumb-content text-center">
                    <h1 class="breadcumb-title text-white" style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">Contact Us</h1>
                    <ul class="list-unstyled d-flex justify-content-center align-items-center text-white" style="font-size: 16px;">
                        <li><a href="index.html" class="text-white text-decoration-none">Home</a></li>
                        <li class="mx-2"><i class="fas fa-angle-right"></i></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <section class="space-top space-extra-bottom" style="padding: 80px 0; background-color: #f8f9fa;">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <div class="bg-white shadow-sm rounded p-4 p-md-5 border">
                            
                            <div class="mb-4 pb-3 border-bottom">
                                <span class="sub-title" style="color: var(--theme-color); font-weight: 600; font-size: 14px; text-transform: uppercase;">Get In Touch</span>
                                <h2 class="sec-title mt-2">Send Us a Message</h2>
                                <p class="text-muted small">Have a question or need support? Fill out the form below and we'll get back to you shortly.</p>
                            </div>

                            <form action="#" method="POST">
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Your Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Ex: David Smith" required>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Your Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Ex: email@domain.com" required>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone" placeholder="Ex: +91 98765 43210">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="fw-bold mb-2 text-dark">Subject <span class="text-danger">*</span></label>
                                        <select class="form-select" name="subject">
                                            <option value="" disabled selected>Select Subject</option>
                                            <option value="General Inquiry">General Inquiry</option>
                                            <option value="Support">Support</option>
                                            <option value="Feedback">Feedback</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group mb-4">
                                        <label class="fw-bold mb-2 text-dark">Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="message" rows="5" placeholder="Write your message here..." style="height: 150px; padding-top: 15px;"></textarea>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <button type="submit" class="th-btn style1 w-100">
                                            Send Message <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right ms-2" width="16" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path></svg>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="bg-white shadow-sm rounded p-4 mb-4 border">
                            <h4 class="h5 mb-4 pb-2 border-bottom">Contact Information</h4>
                            
                            <div class="d-flex align-items-start mb-4">
                                <div class="icon-box me-3 mt-1 text-center rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: rgba(247, 138, 35, 0.1); color: var(--theme-color);">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Office Address</h6>
                                    <p class="text-muted small mb-0">XXII/41, Akhurath <br>Poonthoppu Ward, Avalukunnu Post<br> Alappuzha, Kerala, India - 688006 </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-4">
                                <div class="icon-box me-3 mt-1 text-center rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: rgba(247, 138, 35, 0.1); color: var(--theme-color);">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Phone Number</h6>
                                    <p class="text-muted small mb-0"><a href="tel:+918137069973" class="text-muted text-decoration-none hover-orange">+91 8137069973</a></p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-0">
                                <div class="icon-box me-3 mt-1 text-center rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: rgba(247, 138, 35, 0.1); color: var(--theme-color);">
                                    <i class="fa-solid fa-envelope"></i>
                                </div> 
                                <div>
                                    <h6 class="mb-1">Email Address</h6>
                                    <p class="text-muted small mb-0"><a href="mailto:info@pharmahealthcarejobs.com" class="text-muted text-decoration-none hover-orange">info@pharmahealthcarejobs.com</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm rounded p-4 mb-4 border text-center">
                            <h4 class="h5 mb-3">Follow Us</h4>
                            <p class="text-muted small mb-4">Stay connected with us for the latest updates.</p>
                            <div class="th-social style2 justify-content-center">
                                <a href="#" class="mx-1" style="width: 40px; height: 40px; line-height: 40px; background: #f4f4f4; border-radius: 50%; color: #333; display: inline-block;"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="mx-1" style="width: 40px; height: 40px; line-height: 40px; background: #f4f4f4; border-radius: 50%; color: #333; display: inline-block;"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="mx-1" style="width: 40px; height: 40px; line-height: 40px; background: #f4f4f4; border-radius: 50%; color: #333; display: inline-block;"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="mx-1" style="width: 40px; height: 40px; line-height: 40px; background: #f4f4f4; border-radius: 50%; color: #333; display: inline-block;"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>

                        <div class="rounded overflow-hidden shadow-sm border">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.11609823277!2d72.74109995!3d19.08219785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                    </div>
                </div>
            </div>
        </section>





@endsection