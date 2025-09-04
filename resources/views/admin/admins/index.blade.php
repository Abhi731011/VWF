@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Admin Users</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admins.create') }}" class="btn btn-primary">Create Admin</a>
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
                        <form id="filter-form" method="GET" action="{{ route('admins.index') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-name">Name</label>
                                        <input type="text" class="form-control" id="filter-name" name="name" value="{{ request('name') }}" placeholder="Filter by Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-email">Email</label>
                                        <input type="text" class="form-control" id="filter-email" name="email" value="{{ request('email') }}" placeholder="Filter by Email">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-phone">Phone</label>
                                        <input type="text" class="form-control" id="filter-phone" name="phone" value="{{ request('phone') }}" placeholder="Filter by Phone">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-city">City</label>
                                        <input type="text" class="form-control" id="filter-city" name="city" value="{{ request('city') }}" placeholder="Filter by City">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-state">State</label>
                                        <input type="text" class="form-control" id="filter-state" name="state" value="{{ request('state') }}" placeholder="Filter by State">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-package">Package</label>
                                        <select class="form-control" id="filter-package" name="package_id">
                                            <option value="">All Packages</option>
                                            @foreach (App\Models\Package::all() as $package)
                                                <option value="{{ $package->id }}" {{ request('package_id') == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('admins.index') }}" class="btn btn-secondary">Clear Filters</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0" id="admins-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Package</th>
                                        <th>Created</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                    <tr class="admin-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($admin->profile_img)
                                                <img src="{{ asset('admin_profile/' . $admin->profile_img) }}" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ddd; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="name">{{ $admin->name }}</td>
                                        <td class="email">{{ $admin->email }}</td>
                                        <td class="phone">{{ $admin->phone ?? 'N/A' }}</td>
                                        <td class="city">{{ $admin->city ?? 'N/A' }}</td>
                                        <td class="state">{{ $admin->state ?? 'N/A' }}</td>
                                        <td class="package">{{ $admin->package ? $admin->package->name : 'N/A' }}</td>
                                        <td>{{ $admin->created_at->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('admins.show', $admin) }}" class="btn btn-sm btn-primary mr-2">View</a>
                                                <a href="{{ route('admins.edit', $admin) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                                                <button type="button" class="btn btn-sm btn-warning mr-2 reset-password-btn" data-admin-id="{{ $admin->id }}" data-admin-name="{{ $admin->name }}">Reset Password</button>
                                                <form action="{{ route('admins.destroy', $admin) }}" method="POST" class="delete-form" style="display: inline-block;">
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
                            {{ $admins->appends(request()->query())->links('pagination::bootstrap-4') }}
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
                    text: 'Do you want to delete this admin?',
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
                                    text: data.error || 'Failed to delete the admin.',
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to delete the admin.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });
        });

        // Handle reset password button clicks
        const resetPasswordBtns = document.querySelectorAll('.reset-password-btn');
        resetPasswordBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const adminId = this.getAttribute('data-admin-id');
                const adminName = this.getAttribute('data-admin-name');
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfTokenMeta.content;

                Swal.fire({
                    title: 'Reset Password?',
                    text: `Are you sure you want to reset password for ${adminName}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admins/${adminId}/reset-password`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Password Reset!',
                                    text: data.success,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.error || 'Failed to reset password.',
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to reset password.',
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
