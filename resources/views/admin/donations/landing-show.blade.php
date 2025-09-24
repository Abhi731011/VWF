@extends('admin.master.master')

@section('title', 'Landing Donation Details')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Landing Donation Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.landing-donations.index') }}">Landing Donations</a></div>
                <div class="breadcrumb-item">Details</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Donation Information</h4>
                            <div class="card-header-action">
                                @if($landingDonation->status == 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif($landingDonation->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Failed</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Donation ID:</strong></label>
                                        <p><span class="badge badge-primary">#{{ $landingDonation->id }}</span></p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Donor Name:</strong></label>
                                        <p>{{ $landingDonation->donor_name ?? 'Anonymous' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Donor Email:</strong></label>
                                        <p>{{ $landingDonation->donor_email ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Donor Phone:</strong></label>
                                        <p>{{ $landingDonation->donor_phone ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Amount:</strong></label>
                                        <p><strong class="text-success">₹{{ number_format($landingDonation->amount, 2) }}</strong></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Currency:</strong></label>
                                        <p>{{ $landingDonation->currency }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Project:</strong></label>
                                        <p>
                                            @if($landingDonation->project)
                                                <span class="badge badge-info">{{ $landingDonation->project->title }}</span>
                                            @else
                                                <span class="text-muted">General Donation</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Referral Volunteer ID:</strong></label>
                                        <p>
                                            @if($landingDonation->referral_volunteer_id)
                                                <span class="badge badge-success">{{ $landingDonation->referral_volunteer_id }}</span>
                                            @else
                                                <span class="text-muted">Direct Donation</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Anonymous Donation:</strong></label>
                                        <p>
                                            @if($landingDonation->is_anonymous)
                                                <span class="badge badge-secondary">Yes</span>
                                            @else
                                                <span class="badge badge-light">No</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Donation Date:</strong></label>
                                        <p>{{ $landingDonation->created_at->format('M d, Y H:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($landingDonation->message)
                            <div class="form-group">
                                <label><strong>Message:</strong></label>
                                <div class="alert alert-info">
                                    <p class="mb-0">{{ $landingDonation->message }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- Payment Details Section -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-credit-card"></i> Payment Details
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($landingDonation->status == 'completed')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Payment ID:</strong></label>
                                                    <p><code>{{ $landingDonation->razorpay_payment_id ?? 'N/A' }}</code></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Order ID:</strong></label>
                                                    <p><code>{{ $landingDonation->razorpay_order_id ?? 'N/A' }}</code></p>
                                                </div>
                                            </div>
                                        </div>
                                        @if($landingDonation->payment_details)
                                        <div class="form-group">
                                            <label><strong>Payment Details:</strong></label>
                                            <pre class="bg-light p-3 rounded"><code>{{ json_encode($landingDonation->payment_details, JSON_PRETTY_PRINT) }}</code></pre>
                                        </div>
                                        @endif
                                    @else
                                        <div class="alert alert-warning">
                                            <strong>Payment Status:</strong> {{ ucfirst($landingDonation->status) }}
                                            @if($landingDonation->status == 'pending')
                                                <br><small>Payment is still pending or not completed.</small>
                                            @elseif($landingDonation->status == 'failed')
                                                <br><small>Payment failed or was cancelled.</small>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('style')
<style>
    .badge {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 20px;
    }
    
    .badge-primary {
        background-color: #007bff;
    }
    
    .badge-success {
        background-color: #28a745;
    }
    
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    
    .badge-danger {
        background-color: #dc3545;
    }
    
    .badge-info {
        background-color: #17a2b8;
    }
    
    .badge-secondary {
        background-color: #6c757d;
    }
    
    .badge-light {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
    }
    
    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-group p {
        margin-bottom: 0;
        padding: 8px 0;
    }
    
    .alert-info {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
    }
    
    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeaa7;
        color: #856404;
    }
    
    pre {
        font-size: 12px;
        max-height: 200px;
        overflow-y: auto;
    }
    
    code {
        font-family: 'Courier New', monospace;
        background-color: #f8f9fa;
        padding: 2px 4px;
        border-radius: 3px;
    }
</style>
@endsection
