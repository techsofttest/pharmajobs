@extends('layouts.app')

@section('head_metas')
<title>Checkout - {{ $package->name }} - Pharma Healthcare Jobs</title>
@endsection

@section('head_extras')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>



<style>


.payment-container
{
    background-color:var(--theme-color2);
}

</style>


@endsection

@section('content')
<div class="checkout-page-wrapper py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                    <div class="row g-0">
                        <!-- Left Side: Package Details -->
                        <div class="payment-container col-md-5 text-white p-4 d-flex flex-column justify-content-between" style="">
                            <div>
                                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 2px; opacity: 0.8;">Selected Plan</h6>
                                <h2 class="fw-800 mb-2 text-white">{{ $package->category->name }}</h2>
                                <p class="mb-4 text-white" style="">{{ $package->name }}</p>
                                
                                <div class="price-box mb-4">
                                    <span class="fs-4">Rs.</span>
                                    <span class="display-5 fw-bold">{{ number_format($package->price, 2) }}</span>
                                    <p class="small opacity-75 mt-1 text-white">(Inclusive of all taxes)</p>
                                </div>

                                <div class="package-features">
                                    <p class="mb-2 text-white"><i class="fas fa-check-circle me-2"></i> Validity: {{ $package->duration_value }} {{ ucfirst($package->duration_unit) }}</p>
                                    <p class="mb-2 text-white"><i class="fas fa-check-circle me-2"></i> Access to {{ $user->employee?->designation?->name ?? 'your designation' }} Jobs</p>
                                    <p class="mb-2 text-white"><i class="fas fa-check-circle me-2"></i> Limited to {{ $user->employee && $user->employee->locations->count() > 0 ? $user->employee->locations->pluck('name')->implode(', ') : 'your selected locations' }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-auto pt-5 text-center">
                                <i class="fas fa-shield-alt fa-4x mb-3" style="opacity: 0.5;"></i>
                                <p class="small text-uppercase fw-bold text-white" style="letter-spacing: 1px; opacity: 0.7;">Secure Checkout</p>
                            </div>
                        </div>

                        <!-- Right Side: Order Summary & Confirmation -->
                        <div class="col-md-7 bg-white p-5">
                            <h4 class="fw-bold mb-4">Order Summary</h4>
                            
                            <div class="summary-details mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subscription Plan</span>
                                    <span class="fw-semibold">{{ $package->category->name }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Duration</span>
                                    <span class="fw-semibold">{{ $package->duration_value }} {{ ucfirst($package->duration_unit) }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="h5 fw-bold">Total Amount</span>
                                    <span class="h5 fw-bold text-primary">Rs. {{ number_format($package->price, 2) }}</span>
                                </div>
                            </div>

                            <div class="confirmation-section p-4 rounded-3 border bg-light mb-4 text-center">
                                <div class="form-check d-inline-block text-start">
                                    <input class="form-check-input" type="checkbox" id="terms_confirmation" style="cursor: pointer; width: 20px; height: 20px;">
                                    <label class="form-check-label ms-2 mt-1" for="terms_confirmation" style="cursor: pointer; font-size: 14px; line-height: 1.4;">
                                        I agree to the <a href="{{ route('terms-and-conditions') }}" target="_blank" class="text-decoration-none fw-bold">Terms and Conditions</a> and I understand that the amount is <strong>non-refundable</strong>.
                                    </label>
                                </div>
                            </div>

                            <button id="make-payment-btn" class="btn btn-primary w-100 py-3 fw-bold shadow-sm" style="border-radius: 12px; font-size: 18px; transition: all 0.3s ease;">
                                <i class="fas fa-lock me-2"></i> Make Payment
                            </button>
                            
                            <a href="{{ auth()->guard('employee')->check() ? route('employee.dashboard') : route('employer.dashboard') }}" class="btn btn-outline-secondary w-100 py-3 fw-bold shadow-sm mt-3" style="border-radius: 12px; font-size: 18px; transition: all 0.3s ease;">
                                Skip Now
                            </a>
                            
                            <div class="text-center mt-3">
                                <p class="text-muted small mb-0"><i class="fas fa-shield-alt me-1"></i> 100% Secure Transaction via Razorpay</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('packages') }}" class="text-muted text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Back to Plans</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    #make-payment-btn:disabled {
        background-color: #ccc;
        border-color: #ccc;
        cursor: not-allowed;
        opacity: 0.7;
    }
    #make-payment-btn:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 106, 255, 0.2);
    }
</style>

@endsection

@section('footer_extras')
<script>
$(document).ready(function() {
    const paymentBtn = $('#make-payment-btn');
    const termsCheckbox = $('#terms_confirmation');

    paymentBtn.click(function() {
        if (!termsCheckbox.is(':checked')) {
            alertify.error('Please agree to the terms and conditions to proceed.');
            return;
        }

        const originalText = paymentBtn.html();

        // Show loading
        paymentBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Processing order...');

        $.ajax({
            url: "{{ route('checkout.initiate', $package->id) }}",
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
                                paymentBtn.prop('disabled', false).html(originalText);
                            }
                        }
                    };
                    var rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    alertify.error(response.message || 'Something went wrong');
                    paymentBtn.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr) {
                paymentBtn.prop('disabled', false).html(originalText);
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
        paymentBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Verifying payment...');
        
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
                        window.location.href = "{{ route('home') }}";
                    }, 2000);
                } else {
                    alertify.error(response.message);
                    paymentBtn.prop('disabled', false).html('<i class="fas fa-lock me-2"></i> Retrying...');
                }
            },
            error: function() {
                alertify.error('Payment verification failed.');
                paymentBtn.prop('disabled', false).html('<i class="fas fa-lock me-2"></i> Retrying...');
            }
        });
    }
});
</script>
@endsection
