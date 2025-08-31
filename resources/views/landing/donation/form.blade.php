@extends('landing.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Donation Form</h1>
        <p class="fs-5 text-white mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Donation Form</li>
        </ol>    
    </div>
</div>
<!-- Header End -->
<!-- Donation Form Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">
                            @if($project)
                                Donate to {{ $project->title }}
                            @else
                                Make a Donation
                            @endif
                        </h3>
                    </div>
                    <div class="card-body p-5">
                        @if($project)
                            <div class="alert alert-info mb-4">
                                <h5>Project Details:</h5>
                                <p class="mb-2"><strong>Title:</strong> {{ $project->title }}</p>
                                <p class="mb-2"><strong>Category:</strong> {{ $project->category ? $project->category->name : 'N/A' }}</p>
                                <p class="mb-2"><strong>Target Amount:</strong> ₹{{ number_format($project->target_amount ?? 0, 2) }}</p>
                                <p class="mb-0"><strong>Description:</strong> {{ Str::limit($project->short_description ?? 'No description available.', 200) }}</p>
                            </div>
                        @endif

                        <form id="donationForm">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project ? $project->id : '' }}">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="donor_name" class="form-label">Full Name (Optional)</label>
                                    <input type="text" class="form-control" id="donor_name" name="donor_name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="donor_email" class="form-label">Email Address (Optional)</label>
                                    <input type="email" class="form-control" id="donor_email" name="donor_email">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="donor_phone" class="form-label">Phone Number (Optional)</label>
                                    <input type="tel" class="form-control" id="donor_phone" name="donor_phone">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="amount" class="form-label">Donation Amount (₹) *</label>
                                    <input type="number" class="form-control" id="amount" name="amount" min="1" step="0.01" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quick Amount Options</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-outline-primary quick-amount" data-amount="100">₹100</button>
                                    <button type="button" class="btn btn-outline-primary quick-amount" data-amount="500">₹500</button>
                                    <button type="button" class="btn btn-outline-primary quick-amount" data-amount="1000">₹1,000</button>
                                    <button type="button" class="btn btn-outline-primary quick-amount" data-amount="5000">₹5,000</button>
                                    <button type="button" class="btn btn-outline-primary quick-amount" data-amount="10000">₹10,000</button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">Message (Optional)</label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Leave a message with your donation..."></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5" id="donateBtn">
                                    <i class="fas fa-heart me-2"></i>Donate Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Donation Form End -->

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Complete Your Donation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="paymentForm">
                    <!-- Razorpay payment form will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$(document).ready(function() {
    // Quick amount buttons
    $('.quick-amount').click(function() {
        const amount = $(this).data('amount');
        $('#amount').val(amount);
    });

    // Handle form submission
    $('#donationForm').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = $('#donateBtn');
        const originalText = submitBtn.html();
        
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Processing...');
        submitBtn.prop('disabled', true);

        $.ajax({
            url: '{{ route("payment.create") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    // Initialize Razorpay
                    const options = {
                        key: response.key,
                        amount: response.amount * 100, // Convert to paise
                        currency: response.currency,
                        name: 'Vaishvik Welfare Foundation',
                        description: response.project ? `Donation for ${response.project.title}` : 'General Donation',
                        order_id: response.order_id,
                        handler: function(response) {
                            // Handle successful payment
                            handlePaymentSuccess(response);
                        },
                        prefill: {
                            name: $('#donor_name').val() || 'Anonymous',
                            email: $('#donor_email').val() || 'anonymous@donor.com',
                            contact: $('#donor_phone').val() || ''
                        },
                        theme: {
                            color: '#0d6efd'
                        }
                    };

                    const rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred while processing your request.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                alert('Error: ' + errorMessage);
            },
            complete: function() {
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }
        });
    });

    function handlePaymentSuccess(response) {
        // Send payment verification to server
        $.ajax({
            url: '{{ route("payment.success") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_order_id: response.razorpay_order_id,
                razorpay_signature: response.razorpay_signature
            },
            success: function(verificationResponse) {
                if (verificationResponse.success) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank You!',
                        text: verificationResponse.message,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Redirect to home page or show receipt
                        window.location.href = '{{ route("index") }}';
                    });
                } else {
                    alert('Payment verification failed: ' + verificationResponse.message);
                }
            },
            error: function() {
                alert('Payment verification failed. Please contact support.');
            }
        });
    }
});
</script>

<!-- SweetAlert2 for better alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
