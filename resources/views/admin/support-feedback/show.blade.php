@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Support Ticket Details</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.support-feedback.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Ticket Information -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-ticket-alt"></i> Ticket Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Subject:</strong></label>
                                    <p class="form-control-plaintext">{{ $supportFeedback->subject }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Type:</strong></label>
                                    <p class="form-control-plaintext">
                                        <span class="{{ $supportFeedback->getTypeBadgeClass() }}">
                                            {{ ucfirst(str_replace('_', ' ', $supportFeedback->type)) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Priority:</strong></label>
                                    <p class="form-control-plaintext">
                                        <span class="{{ $supportFeedback->getPriorityBadgeClass() }}">
                                            {{ ucfirst($supportFeedback->priority) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Status:</strong></label>
                                    <p class="form-control-plaintext">
                                        <span class="{{ $supportFeedback->getStatusBadgeClass() }}">
                                            {{ ucfirst(str_replace('_', ' ', $supportFeedback->status)) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Category:</strong></label>
                                    <p class="form-control-plaintext">{{ $supportFeedback->category ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Created:</strong></label>
                                    <p class="form-control-plaintext">
                                        {{ $supportFeedback->created_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                            </div>
                            @if($supportFeedback->resolved_at)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Resolved:</strong></label>
                                    <p class="form-control-plaintext">
                                        {{ $supportFeedback->resolved_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label><strong>Message:</strong></label>
                            <div class="border p-3 bg-light rounded">
                                {!! nl2br(e($supportFeedback->message)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Information -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user"></i> User Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Name:</strong></label>
                                    <p class="form-control-plaintext">{{ $supportFeedback->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Email:</strong></label>
                                    <p class="form-control-plaintext">{{ $supportFeedback->user->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Actions -->
            <div class="col-md-4">
                <!-- Status Update -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-cogs"></i> Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Status Change -->
                        <div class="form-group">
                            <label><strong>Change Status:</strong></label>
                            <form id="status-form" method="POST" action="{{ route('admin.support-feedback.update-status', $supportFeedback) }}">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" onchange="updateStatus()">
                                    <option value="open" {{ $supportFeedback->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $supportFeedback->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ $supportFeedback->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ $supportFeedback->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Admin Response -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-reply"></i> Admin Response
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($supportFeedback->admin_response)
                            <div class="border p-3 bg-light rounded mb-3">
                                {!! nl2br(e($supportFeedback->admin_response)) !!}
                            </div>
                        @else
                            <p class="text-muted">No response yet.</p>
                        @endif

                        <form method="POST" action="{{ route('admin.support-feedback.update-response', $supportFeedback) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="admin_response"><strong>Add/Update Response:</strong></label>
                                <textarea name="admin_response" id="admin_response" class="form-control" rows="4" placeholder="Enter your response...">{{ old('admin_response', $supportFeedback->admin_response) }}</textarea>
                                @error('admin_response')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-save"></i> Update Response
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Close Ticket -->
                @if($supportFeedback->status !== 'closed')
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-lock"></i> Close Ticket
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.support-feedback.close', $supportFeedback) }}" id="close-form">
                            @csrf
                            <div class="form-group">
                                <label for="close_response"><strong>Final Response:</strong></label>
                                <textarea name="admin_response" id="close_response" class="form-control" rows="3" placeholder="Enter final response before closing..." required>{{ old('admin_response') }}</textarea>
                                @error('admin_response')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmClose()">
                                <i class="fas fa-lock"></i> Close Ticket
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                <!-- Delete Ticket -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-danger">
                            <i class="fas fa-trash"></i> Danger Zone
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.support-feedback.destroy', $supportFeedback) }}" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirmDelete()">
                                <i class="fas fa-trash"></i> Delete Ticket
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function updateStatus() {
        const form = document.getElementById('status-form');
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: 'Success!',
                text: data.success,
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.reload();
            });
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update status.',
                icon: 'error'
            });
        });
    }

    function confirmClose() {
        return Swal.fire({
            title: 'Are you sure?',
            text: 'This will close the ticket permanently. You can still view it but cannot reopen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, close it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            return result.isConfirmed;
        });
    }

    function confirmDelete() {
        return Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the ticket. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-form');
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: data.success,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '{{ route("admin.support-feedback.index") }}';
                    });
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete the ticket.',
                        icon: 'error'
                    });
                });
            }
            return false;
        });
    }
</script>
@endsection
