@extends('admin.master.master')

@section('title', 'Landing Page Donations')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Landing Page Donations</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Landing Donations</div>
            </div>
        </div>

        <div class="section-body">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-donate"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Donations</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($stats['total_donations']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Amount</h4>
                            </div>
                            <div class="card-body">
                                ₹{{ number_format($stats['total_amount'], 2) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Completed</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($stats['completed_donations']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-user-secret"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Anonymous</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($stats['anonymous_donations']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Filters Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter"></i> Search & Filter Donations
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.landing-donations.index') }}" id="search-form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="donor_name" class="form-label">
                                                <i class="fas fa-user"></i> Donor Name
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="donor_name" 
                                                   name="donor_name" 
                                                   placeholder="Search by donor name..." 
                                                   value="{{ request('donor_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="donor_email" class="form-label">
                                                <i class="fas fa-envelope"></i> Donor Email
                                            </label>
                                            <input type="email" 
                                                   class="form-control" 
                                                   id="donor_email" 
                                                   name="donor_email" 
                                                   placeholder="Search by email..." 
                                                   value="{{ request('donor_email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="referral_volunteer_id" class="form-label">
                                                <i class="fas fa-handshake"></i> Referral Volunteer ID
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="referral_volunteer_id" 
                                                   name="referral_volunteer_id" 
                                                   placeholder="Search by volunteer ID..." 
                                                   value="{{ request('referral_volunteer_id') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-flag"></i> Status
                                            </label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="">All Status</option>
                                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="is_anonymous" class="form-label">
                                                <i class="fas fa-user-secret"></i> Anonymous
                                            </label>
                                            <select class="form-control" id="is_anonymous" name="is_anonymous">
                                                <option value="">All</option>
                                                <option value="1" {{ request('is_anonymous') == '1' ? 'selected' : '' }}>Anonymous Only</option>
                                                <option value="0" {{ request('is_anonymous') == '0' ? 'selected' : '' }}>Named Only</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="amount_min" class="form-label">
                                                <i class="fas fa-rupee-sign"></i> Min Amount
                                            </label>
                                            <input type="number" 
                                                   class="form-control" 
                                                   id="amount_min" 
                                                   name="amount_min" 
                                                   placeholder="Minimum amount..." 
                                                   value="{{ request('amount_min') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="amount_max" class="form-label">
                                                <i class="fas fa-rupee-sign"></i> Max Amount
                                            </label>
                                            <input type="number" 
                                                   class="form-control" 
                                                   id="amount_max" 
                                                   name="amount_max" 
                                                   placeholder="Maximum amount..." 
                                                   value="{{ request('amount_max') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date_from" class="form-label">
                                                <i class="fas fa-calendar"></i> Date From
                                            </label>
                                            <input type="date" 
                                                   class="form-control" 
                                                   id="date_from" 
                                                   name="date_from" 
                                                   value="{{ request('date_from') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    <i class="fas fa-search"></i> Search Donations
                                                </button>
                                                <a href="{{ route('admin.landing-donations.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                                    <i class="fas fa-refresh"></i> Clear Filters
                                                </a>
                                                <a href="{{ route('admin.landing-donations.export', request()->query()) }}" class="btn btn-success btn-lg ms-2">
                                                    <i class="fas fa-download"></i> Export CSV
                                                </a>
                                            </div>
                                            <div class="text-muted">
                                                <small>
                                                    <i class="fas fa-info-circle"></i> 
                                                    Use the filters above to find specific donations
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donations Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <i class="fas fa-donate"></i> Landing Page Donations
                                @if(request()->hasAny(['donor_name', 'donor_email', 'status', 'referral_volunteer_id', 'is_anonymous', 'amount_min', 'amount_max', 'date_from', 'date_to']))
                                    <span class="badge badge-info ms-2">
                                        Filtered Results
                                    </span>
                                @endif
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Donor</th>
                                            <th>Amount</th>
                                            <th>Project</th>
                                            <th>Referral Volunteer</th>
                                            <th>Status</th>
                                            <th>Anonymous</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($donations as $donation)
                                        <tr>
                                            <td>{{ $donation->id }}</td>
                                            <td>
                                                @if($donation->is_anonymous)
                                                    <span class="text-muted">Anonymous</span>
                                                @else
                                                    <div>
                                                        <strong>{{ $donation->donor_name ?? 'N/A' }}</strong>
                                                        @if($donation->donor_email)
                                                            <br><small class="text-muted">{{ $donation->donor_email }}</small>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>₹{{ number_format($donation->amount, 2) }}</strong>
                                                @if($donation->donor_phone && !$donation->is_anonymous)
                                                    <br><small class="text-muted">{{ $donation->donor_phone }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($donation->project)
                                                    <span class="badge badge-info">{{ $donation->project->title }}</span>
                                                @else
                                                    <span class="text-muted">General Donation</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($donation->referral_volunteer_id)
                                                    <span class="badge badge-success">{{ $donation->referral_volunteer_id }}</span>
                                                @else
                                                    <span class="text-muted">Direct</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($donation->status == 'completed')
                                                    <span class="badge badge-success">Completed</span>
                                                @elseif($donation->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @else
                                                    <span class="badge badge-danger">Failed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($donation->is_anonymous)
                                                    <span class="badge badge-secondary">Yes</span>
                                                @else
                                                    <span class="badge badge-light">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $donation->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.landing-donations.show', $donation) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No donations found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $donations->appends(request()->query())->links() }}
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
    .card-statistic-1 .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .card-statistic-1 .card-body {
        padding-left: 80px;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        display: block;
    }
    
    .btn-lg {
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }
    
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
        border-top: none;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .badge {
        font-size: 11px;
        padding: 6px 12px;
        border-radius: 20px;
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
</style>
@endsection
