@extends('admin.master.master')

@section('title', 'Certificate Requests')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Certificate Requests</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Certificate Requests</div>
            </div>
        </div>

        <div class="section-body">
            <!-- Search Filters Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter"></i> Search & Filter Certificate Requests
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.certificates.index') }}" id="search-form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="full_name" class="form-label">
                                                <i class="fas fa-user"></i> Search by Name
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="full_name" 
                                                       name="full_name" 
                                                       placeholder="Enter full name..." 
                                                       value="{{ request('full_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope"></i> Search by Email
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input type="email" 
                                                       class="form-control" 
                                                       id="email" 
                                                       name="email" 
                                                       placeholder="Enter email address..." 
                                                       value="{{ request('email') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-flag"></i> Filter by Status
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-flag"></i>
                                                </span>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="">All Status</option>
                                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                        <i class="fas fa-clock"></i> Pending
                                                    </option>
                                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                                        <i class="fas fa-check-circle"></i> Approved
                                                    </option>
                                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                                        <i class="fas fa-times-circle"></i> Rejected
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    <i class="fas fa-search"></i> Search Certificate Requests
                                                </button>
                                                <a href="{{ route('admin.certificates.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                                    <i class="fas fa-refresh"></i> Clear Filters
                                                </a>
                                            </div>
                                            <div class="text-muted">
                                                <small>
                                                    <i class="fas fa-info-circle"></i> 
                                                    Use the filters above to find specific certificate requests
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

            <!-- Certificate Requests Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <i class="fas fa-certificate"></i> All Certificate Requests
                                @if(request()->hasAny(['full_name', 'email', 'status']))
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
                                            <th>Certificate ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Requested Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($certificateRequests as $request)
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>
                                                @if($request->certificate_id)
                                                    <span class="badge badge-light">{{ $request->certificate_id }}</span>
                                                @else
                                                    <span class="text-muted">Not Generated</span>
                                                @endif
                                            </td>
                                            <td>{{ $request->full_name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->phone ?? 'N/A' }}</td>
                                            <td>
                                                @if($request->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($request->status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.certificates.show', $request) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No certificate requests found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $certificateRequests->links() }}
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
    /* Enhanced Search Form Styling */
    .card-header h5 {
        color: #495057;
        font-weight: 600;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        display: block;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
    }
    
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .input-group:focus-within .input-group-text {
        border-color: #007bff;
        background-color: #e3f2fd;
        color: #007bff;
    }
    
    /* Button Styling */
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
    
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }
    
    /* Card Enhancements */
    .card {
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: none;
    }
    
    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid #dee2e6;
        border-radius: 12px 12px 0 0 !important;
    }
    
    /* Form Group Spacing */
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .btn-lg {
            padding: 10px 20px;
            font-size: 14px;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 15px;
        }
        
        .text-muted {
            text-align: center;
        }
    }
    
    /* Filter Badge */
    .badge-info {
        background-color: #17a2b8;
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 20px;
    }
    
    /* Table Enhancements */
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
        border-top: none;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    /* Status Badges */
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    
    .badge-success {
        background-color: #28a745;
    }
    
    .badge-danger {
        background-color: #dc3545;
    }
    
    .badge-light {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
    }
</style>
@endsection
