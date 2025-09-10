@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Event Registrations</h3>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="filter-form" method="GET" action="{{ route('admin.event-registrations.index') }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter-status">Status</label>
                                        <select class="form-control" id="filter-status" name="status">
                                            <option value="">All Statuses</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter-event">Event</label>
                                        <select class="form-control" id="filter-event" name="event_id">
                                            <option value="">All Events</option>
                                            @foreach($events as $event)
                                                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                                    {{ $event->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter-event-title">Event Title</label>
                                        <select class="form-control" id="filter-event-title" name="event_title">
                                            <option value="">All Event Titles</option>
                                            @foreach($eventTitles as $title)
                                                <option value="{{ $title }}" {{ request('event_title') == $title ? 'selected' : '' }}>
                                                    {{ $title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter-user">User Name</label>
                                        <input type="text" class="form-control" id="filter-user" name="user_name" value="{{ request('user_name') }}" placeholder="Filter by User Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter-date-from">Date From</label>
                                        <input type="date" class="form-control" id="filter-date-from" name="date_from" value="{{ request('date_from') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter-date-to">Date To</label>
                                        <input type="date" class="form-control" id="filter-date-to" name="date_to" value="{{ request('date_to') }}">
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 text-end">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('admin.event-registrations.index') }}" class="btn btn-secondary">Clear Filters</a>
                                </div> -->
                            <!-- </div> -->
                            
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                                                        <label for="filter-date-to"></label>

                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('admin.event-registrations.index') }}" class="btn btn-secondary">Clear Filters</a>
</div>
                                </div>
</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0" id="registrations-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>User</th>
                                        <th>Event</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Registered At</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrations as $registration)
                                    <tr class="registration-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="user-name">{{ $registration->user->name ?? 'N/A' }}</td>
                                        <td class="event-title">{{ $registration->event->title ?? 'N/A' }}</td>
                                        <td class="full-name">{{ $registration->full_name ?? 'N/A' }}</td>
                                        <td class="email">{{ $registration->email ?? 'N/A' }}</td>
                                        <td class="phone">{{ $registration->phone ?? 'N/A' }}</td>
                                        <td class="status">
                                            @if($registration->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($registration->status == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($registration->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @elseif($registration->status == 'cancelled')
                                                <span class="badge badge-secondary">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="registered-at">{{ $registration->registered_at ? $registration->registered_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                        <td class="text-end">
                                            <div class="actions d-flex justify-content-start">
                                                <a href="{{ route('admin.event-registrations.show', $registration) }}" class="btn btn-sm btn-primary mr-2">
                                                    View
                                                </a>
                                                
                                                @if($registration->status == 'pending')
                                                    <button type="button" class="btn btn-sm btn-success mr-2 approve-btn" 
                                                            data-id="{{ $registration->id }}" 
                                                            data-name="{{ $registration->full_name }}">
                                                        Approve
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger mr-2 reject-btn" 
                                                            data-id="{{ $registration->id }}" 
                                                            data-name="{{ $registration->full_name }}">
                                                        Reject
                                                    </button>
                                                @elseif($registration->status == 'approved')
                                                    <button type="button" class="btn btn-sm btn-warning cancel-btn" 
                                                            data-id="{{ $registration->id }}" 
                                                            data-name="{{ $registration->full_name }}">
                                                        Cancel
                                                    </button>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $registrations->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        let currentRegistrationId = null;

        // Handle approve button clicks
        const approveButtons = document.querySelectorAll('.approve-btn');
        approveButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentRegistrationId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                document.getElementById('approveModalLabel').textContent = `Approve Registration - ${userName}`;
                $('#approveModal').modal('show');
            });
        });

        // Handle reject button clicks
        const rejectButtons = document.querySelectorAll('.reject-btn');
        rejectButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentRegistrationId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                document.getElementById('rejectModalLabel').textContent = `Reject Registration - ${userName}`;
                $('#rejectModal').modal('show');
            });
        });

        // Handle cancel button clicks
        const cancelButtons = document.querySelectorAll('.cancel-btn');
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const registrationId = this.getAttribute('data-id');
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
                        cancelRegistration(registrationId);
                    }
                });
            });
        });

        // Handle approve form submission
        document.getElementById('approveForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (currentRegistrationId) {
                approveRegistration(currentRegistrationId);
            }
        });

        // Handle reject form submission
        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (currentRegistrationId) {
                rejectRegistration(currentRegistrationId);
            }
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
