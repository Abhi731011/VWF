@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Event Registration Details</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.event-registrations.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>

        <!-- Registration Details -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- User Information -->
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">User Information</h5>
                                <div class="form-group">
                                    <label><strong>User Name:</strong></label>
                                    <p>{{ $eventRegistration->user->name ?? 'N/A' }}</p>
                                </div>
                                <div class="form-group">
                                    <label><strong>User Email:</strong></label>
                                    <p>{{ $eventRegistration->user->email ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Event Information -->
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">Event Information</h5>
                                <div class="form-group">
                                    <label><strong>Event Title:</strong></label>
                                    <p>{{ $eventRegistration->event->title ?? 'N/A' }}</p>
                                </div>
                                <div class="form-group">
                                    <label><strong>Event Date:</strong></label>
                                    <p>{{ $eventRegistration->event->event_date ? \Carbon\Carbon::parse($eventRegistration->event->event_date)->format('d M Y, h:i A') : 'N/A' }}</p>
                                </div>
                                <div class="form-group">
                                    <label><strong>Event Location:</strong></label>
                                    <p>{{ $eventRegistration->event->location ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Registration Details -->
                            <div class="col-md-12">
                                <hr>
                                <h5 class="mb-3 text-primary">Registration Details</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Full Name:</strong></label>
                                    <p>{{ $eventRegistration->full_name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Email:</strong></label>
                                    <p>{{ $eventRegistration->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Phone:</strong></label>
                                    <p>{{ $eventRegistration->phone ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Status:</strong></label>
                                    <p>
                                        @if($eventRegistration->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($eventRegistration->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($eventRegistration->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @elseif($eventRegistration->status == 'cancelled')
                                            <span class="badge badge-secondary">Cancelled</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Address:</strong></label>
                                    <p>{{ $eventRegistration->address ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Emergency Contact -->
                            <div class="col-md-12">
                                <hr>
                                <h5 class="mb-3 text-primary">Emergency Contact</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Emergency Contact Name:</strong></label>
                                    <p>{{ $eventRegistration->emergency_contact_name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Emergency Contact Phone:</strong></label>
                                    <p>{{ $eventRegistration->emergency_contact_phone ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Special Requirements:</strong></label>
                                    <p>{{ $eventRegistration->special_requirements ?? 'None' }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Motivation:</strong></label>
                                    <p>{{ $eventRegistration->motivation ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Admin Notes -->
                            @if($eventRegistration->admin_notes)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Admin Notes:</strong></label>
                                    <div class="alert alert-info">
                                        {{ $eventRegistration->admin_notes }}
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Timestamps -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Registered At:</strong></label>
                                    <p>{{ $eventRegistration->registered_at ? $eventRegistration->registered_at->format('d M Y, h:i A') : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Last Updated:</strong></label>
                                    <p>{{ $eventRegistration->updated_at ? $eventRegistration->updated_at->format('d M Y, h:i A') : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        @if($eventRegistration->status == 'pending')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Registration Actions</h5>
                        <button type="button" class="btn btn-success btn-lg mr-3 approve-btn" data-id="{{ $eventRegistration->id }}" data-name="{{ $eventRegistration->full_name }}">
                            <i class="fas fa-check"></i> Approve Registration
                        </button>
                        <button type="button" class="btn btn-danger btn-lg reject-btn" data-id="{{ $eventRegistration->id }}" data-name="{{ $eventRegistration->full_name }}">
                            <i class="fas fa-times"></i> Reject Registration
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @elseif($eventRegistration->status == 'approved')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Registration Actions</h5>
                        <button type="button" class="btn btn-warning btn-lg cancel-btn" data-id="{{ $eventRegistration->id }}" data-name="{{ $eventRegistration->full_name }}">
                            <i class="fas fa-ban"></i> Cancel Registration
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Approve Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="approveForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="approve_notes">Admin Notes (Optional)</label>
                        <textarea class="form-control" id="approve_notes" name="admin_notes" rows="3" placeholder="Add any notes for this approval..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Approve Registration</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Reject Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="rejectForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reject_notes">Reason for Rejection <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="reject_notes" name="admin_notes" rows="3" placeholder="Please provide a reason for rejection..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Registration</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentRegistrationId = {{ $eventRegistration->id }};

        // Handle approve button clicks
        const approveButton = document.querySelector('.approve-btn');
        if (approveButton) {
            approveButton.addEventListener('click', function() {
                const userName = this.getAttribute('data-name');
                document.getElementById('approveModalLabel').textContent = `Approve Registration - ${userName}`;
                $('#approveModal').modal('show');
            });
        }

        // Handle reject button clicks
        const rejectButton = document.querySelector('.reject-btn');
        if (rejectButton) {
            rejectButton.addEventListener('click', function() {
                const userName = this.getAttribute('data-name');
                document.getElementById('rejectModalLabel').textContent = `Reject Registration - ${userName}`;
                $('#rejectModal').modal('show');
            });
        }

        // Handle cancel button clicks
        const cancelButton = document.querySelector('.cancel-btn');
        if (cancelButton) {
            cancelButton.addEventListener('click', function() {
                const userName = this.getAttribute('data-name');
                
                Swal.fire({
                    title: 'Cancel Registration?',
                    text: `Are you sure you want to cancel the registration for ${userName}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f39c12',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cancelRegistration(currentRegistrationId);
                    }
                });
            });
        }

        // Handle approve form submission
        document.getElementById('approveForm').addEventListener('submit', function(e) {
            e.preventDefault();
            approveRegistration(currentRegistrationId);
        });

        // Handle reject form submission
        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            rejectRegistration(currentRegistrationId);
        });

        function approveRegistration(registrationId) {
            const formData = new FormData();
            formData.append('admin_notes', document.getElementById('approve_notes').value);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            fetch(`/admin/event-registrations/${registrationId}/approve`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to approve registration.',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to approve registration.',
                    icon: 'error'
                });
            })
            .finally(() => {
                $('#approveModal').modal('hide');
                document.getElementById('approve_notes').value = '';
            });
        }

        function rejectRegistration(registrationId) {
            const formData = new FormData();
            formData.append('admin_notes', document.getElementById('reject_notes').value);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            fetch(`/admin/event-registrations/${registrationId}/reject`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to reject registration.',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to reject registration.',
                    icon: 'error'
                });
            })
            .finally(() => {
                $('#rejectModal').modal('hide');
                document.getElementById('reject_notes').value = '';
            });
        }

        function cancelRegistration(registrationId) {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            fetch(`/admin/event-registrations/${registrationId}/cancel`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to cancel registration.',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to cancel registration.',
                    icon: 'error'
                });
            });
        }
    });
</script>
@endsection
