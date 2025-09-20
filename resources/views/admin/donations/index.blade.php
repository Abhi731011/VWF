@extends('admin.master.master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Donation Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Donations</div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <!-- Total Donations -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Donations</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_donations'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">₹{{ number_format($stats['total_donation_amount'], 2) }}</span> 
                                            Total Amount
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-heart fa-3x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Purchases -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Package Purchases</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_package_purchases'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">₹{{ number_format($stats['total_package_amount'], 2) }}</span> 
                                            Total Amount
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Donations -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Recent Donations</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['recent_donations']->count() }}</h2>
                                        <p class="mb-0">
                                            Latest donations
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-clock fa-3x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Purchases -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Recent Purchases</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['recent_purchases']->count() }}</h2>
                                        <p class="mb-0">
                                            Latest purchases
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-receipt fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module Navigation -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Donation Modules</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.donations.user-packages') }}" class="btn btn-primary btn-block btn-lg">
                                    <i class="fas fa-shopping-cart"></i> 
                                    <h5 class="mt-2">User Packages</h5>
                                    <p class="mb-0">View all package purchases with user details</p>
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.donations.project-donations') }}" class="btn btn-success btn-block btn-lg">
                                    <i class="fas fa-heart"></i> 
                                    <h5 class="mt-2">Project Donations</h5>
                                    <p class="mb-0">View all project donations with details</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="row">
            <!-- Recent Donations -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Donations</h4>
                    </div>
                    <div class="card-body">
                        @forelse($stats['recent_donations'] as $donation)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">{{ $donation->donor_name ?? $donation->user->name ?? 'Anonymous' }}</h6>
                                    <small class="text-muted">
                                        {{ $donation->project_name ?? $donation->project->title ?? 'Project' }} - 
                                        ₹{{ number_format($donation->amount, 2) }}
                                    </small>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                    <br>
                                    <small class="text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No recent donations found</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Package Purchases -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Package Purchases</h4>
                    </div>
                    <div class="card-body">
                        @forelse($stats['recent_purchases'] as $purchase)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">{{ $purchase->user->name ?? $purchase->email }}</h6>
                                    <small class="text-muted">
                                        {{ $purchase->package_name ?? $purchase->package->name ?? 'Package' }} - 
                                        ₹{{ number_format($purchase->amount, 2) }}
                                    </small>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-{{ $purchase->status === 'completed' ? 'success' : ($purchase->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($purchase->status) }}
                                    </span>
                                    <br>
                                    <small class="text-muted">{{ $purchase->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No recent purchases found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
