@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Admin User Details</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admins.edit', $admin) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary">Back to List</a>
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

        <!-- Admin Details -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Profile Section -->
                            <div class="col-md-4">
                                <div class="text-center">
                                    @if($admin->profile_img)
                                        <img src="{{ asset('admin_profile/' . $admin->profile_img) }}" alt="Profile" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 20px;">
                                    @else
                                        <div style="width: 150px; height: 150px; border-radius: 50%; background-color: #ddd; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-user" style="font-size: 60px; color: #666;"></i>
                                        </div>
                                    @endif
                                    <h4>{{ $admin->name }}</h4>
                                    <p class="text-muted">{{ $admin->email }}</p>
                                </div>
                            </div>

                            <!-- Details Section -->
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Name</h5>
                                        <p>{{ $admin->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Email</h5>
                                        <p>{{ $admin->email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Phone</h5>
                                        <p>{{ $admin->phone ?? 'N/A' }}</p>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <h5>Package</h5>
                                        <p>{{ $admin->package ? $admin->package->name : 'N/A' }}</p>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <h5>Address</h5>
                                        <p>{{ $admin->address ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>City</h5>
                                        <p>{{ $admin->city ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>State</h5>
                                        <p>{{ $admin->state ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Country</h5>
                                        <p>{{ $admin->country ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Zip Code</h5>
                                        <p>{{ $admin->zip_code ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Created At</h5>
                                        <p>{{ $admin->created_at->format('M d, Y H:i A') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Last Updated</h5>
                                        <p>{{ $admin->updated_at->format('M d, Y H:i A') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Email Verified</h5>
                                        <p>{{ $admin->email_verified_at ? $admin->email_verified_at->format('M d, Y H:i A') : 'Not Verified' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Banner Image Section -->
                        @if($admin->banner_img)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>Banner Image</h5>
                                <img src="{{ asset('admin_banner/' . $admin->banner_img) }}" alt="Banner" style="width: 100%; max-width: 600px; height: auto; border-radius: 8px;">
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <a href="{{ route('admins.edit', $admin) }}" class="btn btn-primary mr-2">Edit Admin</a>
                                <button type="button" class="btn btn-warning mr-2 reset-password-btn" data-admin-id="{{ $admin->id }}" data-admin-name="{{ $admin->name }}">Reset Password</button>
                                <form action="{{ route('admins.destroy', $admin) }}" method="POST" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Admin</button>
                                </form>
                            </div>
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
                                    window.location.href = '{{ route("admins.index") }}';
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
