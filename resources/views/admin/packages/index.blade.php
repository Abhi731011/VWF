@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Packages</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('packages.create') }}" class="btn btn-primary">Create Package</a>
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
                        <form id="filter-form" method="GET" action="{{ route('packages.index') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-name">Name</label>
                                        <input type="text" class="form-control" id="filter-name" name="name" value="{{ request('name') }}" placeholder="Filter by Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-duration">Duration Type</label>
                                        <select class="form-control" id="filter-duration" name="duration_type">
                                            <option value="">All Duration Types</option>
                                            <option value="monthly" {{ request('duration_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                            <option value="yearly" {{ request('duration_type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                            <option value="lifetime" {{ request('duration_type') == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-status">Status</label>
                                        <select class="form-control" id="filter-status" name="status">
                                            <option value="">All Statuses</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-featured">Featured</label>
                                        <select class="form-control" id="filter-featured" name="is_featured">
                                            <option value="">All</option>
                                            <option value="1" {{ request('is_featured') == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ request('is_featured') == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('packages.index') }}" class="btn btn-secondary">Clear Filters</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0" id="packages-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                    <tr class="package-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="name">{{ $package->name ?? 'N/A' }}</td>
                                        <td class="price">{{ $package->currency }} {{ number_format($package->price, 2) }}</td>
                                        <td class="duration">{{ $package->duration_value }} {{ ucfirst($package->duration_type) }}</td>
                                        <td class="status">{{ $package->status ? 'Active' : 'Inactive' }}</td>
                                        <td class="is-featured">{{ $package->is_featured ? 'Yes' : 'No' }}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('packages.show', $package) }}" class="btn btn-sm btn-primary mr-2">View</a>
                                                <a href="{{ route('packages.edit', $package) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                                                <form action="{{ route('packages.destroy', $package) }}" method="POST" class="delete-form" style="display: inline-block;">
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
                            {{ $packages->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
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
                    text: 'Do you want to delete this package?',
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
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: data.success,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.error || 'Failed to delete the package.',
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to delete the package.',
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
