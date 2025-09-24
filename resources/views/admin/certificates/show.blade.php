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
                                        <label><strong>Request ID:</strong></label>
                                        <p><span class="badge badge-primary">{{ $certificateRequest->request_id ?? 'Not Generated' }}</span></p>
                                    </div>
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
                                    @if($certificateRequest->user)
                                    <div class="form-group">
                                        <label><strong>User Since:</strong></label>
                                        <p>{{ $certificateRequest->user->created_at->format('M d, Y') }} 
                                           <small class="text-muted">({{ $certificateRequest->user->created_at->diffForHumans() }})</small>
                                        </p>
                                    </div>
                                    @endif
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

                            {{-- Always show approval details section in card format --}}
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-info-circle"></i> Approval Details
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($certificateRequest->status == 'approved')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Approved by:</strong></label>
                                                    <p>{{ $certificateRequest->approvedBy->name ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Approved on:</strong></label>
                                                    <p>{{ $certificateRequest->approved_at->format('M d, Y H:i A') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @if($certificateRequest->certificate_path)
                                        <div class="form-group">
                                            <label><strong>Certificate:</strong></label>
                                            <p><a href="{{ asset($certificateRequest->certificate_path) }}" target="_blank" class="btn btn-success">
                                                <i class="fas fa-file-pdf"></i> View Certificate
                                            </a></p>
                                        </div>
                                        @endif
                                    @elseif($certificateRequest->status == 'rejected')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Rejected by:</strong></label>
                                                    <p>{{ $certificateRequest->rejectedBy->name ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Rejected on:</strong></label>
                                                    <p>{{ $certificateRequest->rejected_at->format('M d, Y H:i A') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Rejection Reason:</strong></label>
                                            <p>{{ $certificateRequest->rejection_reason }}</p>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Status:</strong></label>
                                                    <p><span class="badge badge-warning">Pending Review</span></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Certificate:</strong></label>
                                                    <p><span class="text-muted">Not yet uploaded</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

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
                            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#approveModal">
                                <i class="fas fa-check"></i> Approve & Upload Certificate
                            </button>
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

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Upload Certificate PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.certificates.approve', $certificateRequest) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="certificate_file">Select Certificate PDF File</label>
                        <input type="file" class="form-control" name="certificate_file" id="certificate_file" accept=".pdf" required>
                        <small class="form-text text-muted">Please upload a pre-designed certificate PDF file (max 10MB)</small>
                    </div>
                    <div class="alert alert-info">
                        <strong>Note:</strong> Upload a pre-designed certificate PDF file. The system will save it and send it to the user via email.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-upload"></i> Upload & Send Certificate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
