@extends('admin.master.master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Donation Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.donations.project-donations') }}">Project Donations</a></div>
                <div class="breadcrumb-item">Donation #{{ $donation->id }}</div>
            </div>
        </div>

        <div class="row">
            <!-- Donation Details -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Donation Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Donation ID</h6>
                                <p>{{ $donation->id }}</p>
                                
                                <h6>Project Name</h6>
                                <p>{{ $donation->project_name ?? $donation->project->title ?? 'N/A' }}</p>
                                
                                <h6>Amount</h6>
                                <p><strong>₹{{ number_format($donation->amount, 2) }} {{ $donation->currency }}</strong></p>
                                
                                <h6>Status</h6>
                                <p>
                                    <span class="badge badge-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </p>
                                
                                <h6>Anonymous</h6>
                                <p>
                                    @if($donation->is_anonymous)
                                        <span class="badge badge-info">
                                            <i class="fas fa-user-secret"></i> Anonymous
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-user"></i> Named
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Donation Date</h6>
                                <p>{{ $donation->created_at->format('M d, Y h:i A') }}</p>
                                
                                <h6>Donor Email</h6>
                                <p>{{ $donation->donor_email ?? $donation->user->email ?? 'N/A' }}</p>
                                
                                @if($donation->donor_phone)
                                    <h6>Donor Phone</h6>
                                    <p>{{ $donation->donor_phone }}</p>
                                @endif
                                
                                @if($donation->razorpay_payment_id)
                                    <h6>Payment ID</h6>
                                    <p><code>{{ $donation->razorpay_payment_id }}</code></p>
                                @endif
                                
                                @if($donation->razorpay_order_id)
                                    <h6>Order ID</h6>
                                    <p><code>{{ $donation->razorpay_order_id }}</code></p>
                                @endif
                            </div>
                        </div>
                        
                        @if($donation->message)
                            <div class="mt-3">
                                <h6>Message</h6>
                                <div class="bg-light p-3 rounded">
                                    <p class="mb-0">{{ $donation->message }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Donor Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Donor Information</h4>
                    </div>
                    <div class="card-body">
                        @if($donation->is_anonymous)
                            <div class="text-center">
                                <i class="fas fa-user-secret fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Anonymous Donation</p>
                                <p><strong>Email:</strong> {{ $donation->donor_email ?? 'N/A' }}</p>
                                @if($donation->donor_phone)
                                    <p><strong>Phone:</strong> {{ $donation->donor_phone }}</p>
                                @endif
                            </div>
                        @elseif($donation->user)
                            <div class="text-center mb-3">
                                @if($donation->user->profile_img)
                                    <img src="{{ asset('admin_profile/' . $donation->user->profile_img) }}" 
                                         alt="{{ $donation->user->name }}" 
                                         class="rounded-circle" 
                                         width="80" height="80">
                                @else
                                    <div class="avatar bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px; font-size: 2rem;">
                                        {{ substr($donation->user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            
                            <h6>Name</h6>
                            <p>{{ $donation->donor_name ?? $donation->user->name }}</p>
                            
                            <h6>Email</h6>
                            <p>{{ $donation->donor_email ?? $donation->user->email }}</p>
                            
                            @if($donation->donor_phone || $donation->user->phone)
                                <h6>Phone</h6>
                                <p>{{ $donation->donor_phone ?? $donation->user->phone }}</p>
                            @endif
                            
                            @if($donation->user->address)
                                <h6>Address</h6>
                                <p>{{ $donation->user->address }}</p>
                            @endif
                            
                            @if($donation->user->city)
                                <h6>City</h6>
                                <p>{{ $donation->user->city }}</p>
                            @endif
                            
                            <h6>Member Since</h6>
                            <p>{{ $donation->user->created_at->format('M d, Y') }}</p>
                        @else
                            <div class="text-center">
                                <i class="fas fa-user fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Guest Donor</p>
                                <p><strong>Name:</strong> {{ $donation->donor_name ?? 'N/A' }}</p>
                                <p><strong>Email:</strong> {{ $donation->donor_email ?? 'N/A' }}</p>
                                @if($donation->donor_phone)
                                    <p><strong>Phone:</strong> {{ $donation->donor_phone }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Details -->
        @if($donation->project)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Project Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    @if($donation->project->featured_image)
                                        <img src="{{ asset('projects/' . $donation->project->slug . '/' . $donation->project->featured_image) }}" 
                                             alt="{{ $donation->project->title }}" 
                                             class="img-fluid rounded">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h5>{{ $donation->project->title }}</h5>
                                    <p>{{ $donation->project->description }}</p>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Goal Amount</h6>
                                            <p><strong>₹{{ number_format($donation->project->goal_amount, 2) }}</strong></p>
                                            
                                            <h6>Raised Amount</h6>
                                            <p><strong>₹{{ number_format($donation->project->raised_amount, 2) }}</strong></p>
                                            
                                            <h6>Status</h6>
                                            <p>
                                                <span class="badge badge-{{ $donation->project->status === 'published' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($donation->project->status) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Category</h6>
                                            <p>{{ $donation->project->category->name ?? 'N/A' }}</p>
                                            
                                            <h6>Created Date</h6>
                                            <p>{{ $donation->project->created_at->format('M d, Y') }}</p>
                                            
                                            <h6>Progress</h6>
                                            @php
                                                $progress = $donation->project->goal_amount > 0 ? ($donation->project->raised_amount / $donation->project->goal_amount) * 100 : 0;
                                            @endphp
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ min($progress, 100) }}%">
                                                    {{ round($progress, 1) }}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Payment Details -->
        @if($donation->payment_details)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment Details</h4>
                        </div>
                        <div class="card-body">
                            <pre class="bg-light p-3 rounded">{{ json_encode($donation->payment_details, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
</div>
@endsection
