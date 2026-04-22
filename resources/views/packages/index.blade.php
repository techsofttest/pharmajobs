@extends('layouts.app')

@section('head_metas')
<title>Our Packages - Pharma Healthcare Jobs</title>
@endsection

@section('head_extras')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcumb-wrapper" style="background-image: url('{{asset('img/banner1.jpg')}}'); background-size: cover; background-position: center; position: relative; padding: 60px 0;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title text-white" style="font-size: 56px; font-weight: 800; margin-bottom: 15px; letter-spacing: -1px;">Our Packages</h1>
                <p class="text-white-50 mb-0 mx-auto" style="max-width: 600px; font-size: 18px;">Choose the perfect plan to accelerate your career or find the best talent in the pharma industry.</p>
            </div>
        </div>
    </div>

    <!-- Packages Section -->
    <section class="space-top space-extra-bottom" style="padding: 100px 0; background-color: #f0f2f5;">
        <div class="container">
            <div class="row justify-content-center mb-50">
                <div class="col-lg-8 text-center">
                    <span class="sub-title" style="color: var(--theme-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Pricing Plans</span>
                    <h2 class="sec-title h1 mt-2" style="font-weight: 800; color: #1a1a1a;">Select Your Subscription</h2>
                    <div class="sec-line mx-auto mt-3" style="width: 70px; height: 4px; background: var(--theme-color); border-radius: 2px;"></div>
                </div>
            </div>

            <div class="row gy-40 justify-content-center">
                @if(count($packages) > 0)
                    <x-package-card :packages="$packages" />
                @else
                    <div class="col-12 text-center py-5">
                        <div class="empty-state p-5 bg-white rounded-4 shadow-sm border">
                            <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
                            <h3>No Packages Available</h3>
                            <p class="text-muted">We couldn't find any packages for your category at the moment. Please check back later or contact support.</p>
                            <a href="{{ route('home') }}" class="th-btn mt-3">Back to Home</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        .package-card-premium:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.12) !important;
        }
        .fw-800 { font-weight: 800; }
        :root {
            --theme-color-rgb: 0, 106, 255; /* Default fallback */
        }
    </style>

@endsection

@section('footer_extras')
<script>
$(document).ready(function() {
    $('.subscribe-btn').click(function() {
        const packageId = $(this).data('id');
        const packageName = $(this).data('name');
        const btn = $(this);
        const originalText = btn.html();

        // Show loading
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Processing...');

        $.ajax({
            url: "/checkout/" + packageId,
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    var options = {
                        "key": response.key,
                        "amount": response.amount,
                        "currency": "INR",
                        "name": response.name,
                        "description": response.description,
                        "order_id": response.order_id,
                        "handler": function (paymentResponse){
                            verifyPayment(paymentResponse);
                        },
                        "prefill": {
                            "name": response.user.name,
                            "email": response.user.email,
                            "contact": response.user.contact
                        },
                        "theme": {
                            "color": "#006aff"
                        },
                        "modal": {
                            "ondismiss": function(){
                                btn.prop('disabled', false).html(originalText);
                            }
                        }
                    };
                    var rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    alertify.error(response.message || 'Something went wrong');
                    btn.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html(originalText);
                if (xhr.status === 401) {
                    alertify.error('Session expired. Please login again.');
                    window.location.href = "{{ route('login') }}";
                } else {
                    alertify.error('Error initiating payment. Please try again.');
                }
            }
        });
    });

    function verifyPayment(paymentResponse) {
        $.ajax({
            url: "{{ route('payment.callback') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                razorpay_payment_id: paymentResponse.razorpay_payment_id,
                razorpay_order_id: paymentResponse.razorpay_order_id,
                razorpay_signature: paymentResponse.razorpay_signature
            },
            success: function(response) {
                if (response.success) {
                    alertify.success(response.message);
                    setTimeout(() => {
                        window.location.href = "{{ route('home') }}"; // Or dashboard
                    }, 2000);
                } else {
                    alertify.error(response.message);
                }
            },
            error: function() {
                alertify.error('Payment verification failed.');
            }
        });
    }
});
</script>
@endsection
