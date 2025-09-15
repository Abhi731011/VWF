@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Support & Feedback Tickets</h3>
                </div>
            </div>
        </div>
        
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">{{ $supportFeedbacks->total() }}</h4>
                                <p class="mb-0">Total Tickets</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-ticket-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">{{ $supportFeedbacks->where('status', 'open')->count() }}</h4>
                                <p class="mb-0">Open</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">{{ $supportFeedbacks->where('status', 'in_progress')->count() }}</h4>
                                <p class="mb-0">In Progress</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-spinner fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">{{ $supportFeedbacks->where('status', 'resolved')->count() }}</h4>
                                <p class="mb-0">Resolved</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">{{ $supportFeedbacks->where('status', 'closed')->count() }}</h4>
                                <p class="mb-0">Closed</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-lock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">{{ $supportFeedbacks->where('priority', 'urgent')->whereIn('status', ['open', 'in_progress'])->count() }}</h4>
                                <p class="mb-0">Urgent</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-exclamation-triangle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="filter-form" method="GET" action="{{ route('admin.support-feedback.index') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-subject">Subject</label>
                                        <input type="text" class="form-control" id="filter-subject" name="subject" value="{{ request('subject') }}" placeholder="Filter by Subject">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-type">Type</label>
                                        <select class="form-control" id="filter-type" name="type">
                                            <option value="">All Types</option>
                                            <option value="support" {{ request('type') == 'support' ? 'selected' : '' }}>Support</option>
                                            <option value="feedback" {{ request('type') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                            <option value="bug_report" {{ request('type') == 'bug_report' ? 'selected' : '' }}>Bug Report</option>
                                            <option value="feature_request" {{ request('type') == 'feature_request' ? 'selected' : '' }}>Feature Request</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-priority">Priority</label>
                                        <select class="form-control" id="filter-priority" name="priority">
                                            <option value="">All Priorities</option>
                                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                            <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-status">Status</label>
                                        <select class="form-control" id="filter-status" name="status">
                                            <option value="">All Status</option>
                                            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-category">Category</label>
                                        <input type="text" class="form-control" id="filter-category" name="category" value="{{ request('category') }}" placeholder="Filter by Category">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-user-email">User Email</label>
                                        <input type="text" class="form-control" id="filter-user-email" name="user_email" value="{{ request('user_email') }}" placeholder="Filter by User Email">
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('admin.support-feedback.index') }}" class="btn btn-secondary">Clear Filters</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Feedback Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0" id="support-feedback-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Subject</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Created</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supportFeedbacks as $feedback)
                                    <tr class="support-feedback-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div>
                                                <strong>{{ $feedback->user->name ?? 'N/A' }}</strong><br>
                                                <small class="text-muted">{{ $feedback->user->email ?? 'N/A' }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="{{ $feedback->getTypeBadgeClass() }}">{{ ucfirst(str_replace('_', ' ', $feedback->type)) }}</span>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;" title="{{ $feedback->subject }}">
                                                {{ $feedback->subject }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="{{ $feedback->getPriorityBadgeClass() }}">{{ ucfirst($feedback->priority) }}</span>
                                        </td>
                                        <td>
                                            <span class="{{ $feedback->getStatusBadgeClass() }}">{{ ucfirst(str_replace('_', ' ', $feedback->status)) }}</span>
                                        </td>
                                        <td>{{ $feedback->category ?? 'N/A' }}</td>
                                        <td>
                                            <div>
                                                {{ $feedback->created_at->format('M d, Y') }}<br>
                                                <small class="text-muted">{{ $feedback->created_at->format('h:i A') }}</small>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions d-flex justify-content-end">
                                                <a href="{{ route('admin.support-feedback.show', $feedback) }}" class="btn btn-sm btn-primary me-2">View</a>
                                                <form action="{{ route('admin.support-feedback.destroy', $feedback) }}" method="POST" class="delete-form d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $supportFeedbacks->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .actions .btn {
        margin-right: 10px !important;
    }
    .actions .btn:last-child {
        margin-right: 0 !important;
    }
    .actions .delete-form {
        margin-left: 5px !important;
    }
</style>
@endsection

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete button clicks with SweetAlert
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfTokenMeta) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'CSRF token not found. Please refresh the page or contact support.',
                        icon: 'error'
                    });
                    return;
                }
                const csrfToken = csrfTokenMeta.content;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this support feedback ticket?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form via AJAX
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: new FormData(form)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: data.success,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Reload the page to refresh the table
                                    window.location.reload();
                                });
                            } else if (data.error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.error,
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Delete error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to delete the support feedback ticket. Please try again.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });
        });
    });
</script>
@endsection
