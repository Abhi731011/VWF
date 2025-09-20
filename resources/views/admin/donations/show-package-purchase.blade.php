@extends('admin.master.master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Package Purchase Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.donations.user-packages') }}">User Packages</a></div>
                <div class="breadcrumb-item">Purchase #{{ $packagePurchase->id }}</div>
            </div>
        </div>

        <div class="row">
            <!-- Purchase Details -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Purchase Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Purchase ID</h6>
                                <p>{{ $packagePurchase->id }}</p>
                                
                                <h6>Package Name</h6>
                                <p>{{ $packagePurchase->package_name ?? $packagePurchase->package->name ?? 'N/A' }}</p>
                                
                                <h6>Amount</h6>
                                <p><strong>₹{{ number_format($packagePurchase->amount, 2) }} {{ $packagePurchase->currency }}</strong></p>
                                
                                <h6>Status</h6>
                                <p>
                                    <span class="badge badge-{{ $packagePurchase->status === 'completed' ? 'success' : ($packagePurchase->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($packagePurchase->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Purchase Date</h6>
                                <p>{{ $packagePurchase->created_at->format('M d, Y h:i A') }}</p>
                                
                                <h6>Email</h6>
                                <p>{{ $packagePurchase->email }}</p>
                                
                                @if($packagePurchase->razorpay_payment_id)
                                    <h6>Payment ID</h6>
                                    <p><code>{{ $packagePurchase->razorpay_payment_id }}</code></p>
                                @endif
                                
                                @if($packagePurchase->razorpay_order_id)
                                    <h6>Order ID</h6>
                                    <p><code>{{ $packagePurchase->razorpay_order_id }}</code></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>User Information</h4>
                    </div>
                    <div class="card-body">
                        @if($packagePurchase->user)
                            <div class="text-center mb-3">
                                @if($packagePurchase->user->profile_img)
                                    <img src="{{ asset('admin_profile/' . $packagePurchase->user->profile_img) }}" 
                                         alt="{{ $packagePurchase->user->name }}" 
                                         class="rounded-circle" 
                                         width="80" height="80">
                                @else
                                    <div class="avatar bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px; font-size: 2rem;">
                                        {{ substr($packagePurchase->user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            
                            <h6>Name</h6>
                            <p>{{ $packagePurchase->user->name }}</p>
                            
                            <h6>Email</h6>
                            <p>{{ $packagePurchase->user->email }}</p>
                            
                            @if($packagePurchase->user->phone)
                                <h6>Phone</h6>
                                <p>{{ $packagePurchase->user->phone }}</p>
                            @endif
                            
                            @if($packagePurchase->user->address)
                                <h6>Address</h6>
                                <p>{{ $packagePurchase->user->address }}</p>
                            @endif
                            
                            @if($packagePurchase->user->city)
                                <h6>City</h6>
                                <p>{{ $packagePurchase->user->city }}</p>
                            @endif
                            
                            <h6>Member Since</h6>
                            <p>{{ $packagePurchase->user->created_at->format('M d, Y') }}</p>
                        @else
                            <div class="text-center">
                                <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Guest User</p>
                                <p><strong>Email:</strong> {{ $packagePurchase->email }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Details -->
        @if($packagePurchase->package)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Package Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    @if($packagePurchase->package->image)
                                        <img src="{{ asset('packages/' . $packagePurchase->package->image) }}" 
                                             alt="{{ $packagePurchase->package->name }}" 
                                             class="img-fluid rounded">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h5>{{ $packagePurchase->package->name }}</h5>
                                    <p>{{ $packagePurchase->package->description }}</p>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Price</h6>
                                            <p><strong>₹{{ number_format($packagePurchase->package->price, 2) }}</strong></p>
                                            
                                            <h6>Duration</h6>
                                            <p>{{ $packagePurchase->package->duration_value }} {{ $packagePurchase->package->duration_type }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Goodies Count</h6>
                                            <p>{{ $packagePurchase->package->goodies_count }}</p>
                                            
                                            <h6>Featured</h6>
                                            <p>
                                                @if($packagePurchase->package->is_featured)
                                                    <span class="badge badge-success">Yes</span>
                                                @else
                                                    <span class="badge badge-secondary">No</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    @if($packagePurchase->package->perks && is_array($packagePurchase->package->perks))
                                        <h6>Perks</h6>
                                        <ul>
                                            @foreach($packagePurchase->package->perks as $perk)
                                                <li>{{ $perk }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Payment Details -->
        @if($packagePurchase->payment_details)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment Details</h4>
                        </div>
                        <div class="card-body">
                            <pre class="bg-light p-3 rounded">{{ json_encode($packagePurchase->payment_details, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
</div>
@endsection
