@extends('admin.master.master')

@section('title', 'Certificate Request Details')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Certificate Request Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.certificates.index') }}">Certificate Requests</a></div>
                <div class="breadcrumb-item">Details</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Request Information</h4>
                            <div class="card-header-action">
                                @if($certificateRequest->status == 'pending')
                                    <span class="badge badge-warning">Pending Review</span>
                                @elseif($certificateRequest->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Certificate ID:</strong></label>
                                        <p><span class="badge badge-info">{{ $certificateRequest->certificate_id ?? 'Not Generated' }}</span></p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Full Name:</strong></label>
                                        <p>{{ $certificateRequest->full_name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Email:</strong></label>
                                        <p>{{ $certificateRequest->email }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Phone:</strong></label>
                                        <p>{{ $certificateRequest->phone ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Address:</strong></label>
                                        <p>{{ $certificateRequest->address ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>City:</strong></label>
                                        <p>{{ $certificateRequest->city ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>State:</strong></label>
                                        <p>{{ $certificateRequest->state ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Country:</strong></label>
                                        <p>{{ $certificateRequest->country ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Request Date:</strong></label>
                                        <p>{{ $certificateRequest->created_at->format('M d, Y H:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($certificateRequest->image_path)
                            <div class="form-group">
                                <label><strong>Profile Image:</strong></label>
                                <div class="mt-2">
                                    <img src="http://localhost/ngo-user/{{ $certificateRequest->image_path }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                            @endif

                            @if($certificateRequest->admin_notes)
                            <div class="form-group">
                                <label><strong>Admin Notes:</strong></label>
                                <p>{{ $certificateRequest->admin_notes }}</p>
                            </div>
                            @endif

                            @if($certificateRequest->status == 'approved')
                            <div class="alert alert-success">
                                <h6><strong>Approval Details:</strong></h6>
                                <p><strong>Approved by:</strong> {{ $certificateRequest->approvedBy->name ?? 'N/A' }}</p>
                                <p><strong>Approved on:</strong> {{ $certificateRequest->approved_at->format('M d, Y H:i A') }}</p>
                                @if($certificateRequest->certificate_path)
                                <p><strong>Certificate:</strong> <a href="{{ asset($certificateRequest->certificate_path) }}" target="_blank" class="btn btn-sm btn-success">View Certificate</a></p>
                                @endif
                            </div>
                            @endif

                            @if($certificateRequest->status == 'rejected')
                            <div class="alert alert-danger">
                                <h6><strong>Rejection Details:</strong></h6>
                                <p><strong>Rejected by:</strong> {{ $certificateRequest->rejectedBy->name ?? 'N/A' }}</p>
                                <p><strong>Rejected on:</strong> {{ $certificateRequest->rejected_at->format('M d, Y H:i A') }}</p>
                                <p><strong>Reason:</strong> {{ $certificateRequest->rejection_reason }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($certificateRequest->status == 'pending')
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Approve Request</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.certificates.approve', $certificateRequest) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="certificate_design_id">Select Certificate Design</label>
                                    <select class="form-control" name="certificate_design_id" required>
                                        <option value="">Choose a design</option>
                                        @foreach($certificateDesigns as $design)
                                        <option value="{{ $design->id }}">{{ $design->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-check"></i> Approve & Send Certificate
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reject Request</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.certificates.reject', $certificateRequest) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="rejection_reason">Rejection Reason</label>
                                    <textarea class="form-control" name="rejection_reason" rows="4" placeholder="Please provide a reason for rejection..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="fas fa-times"></i> Reject Request
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
