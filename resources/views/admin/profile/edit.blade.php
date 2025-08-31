@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Profile</h3>
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

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <!-- Profile Image -->
                            <div class="row mb-4">
                                <div class="col-md-12 text-center">
                                    <div class="profile-image-container mb-3">
                                                                                 @if($user->profile_img)
                                             <img src="{{ asset('admin_profile/' . $user->profile_img) }}" 
                                                  alt="Profile Image" 
                                                  class="rounded-circle profile-image" 
                                                  style="width: 150px; height: 150px; object-fit: contain; border: 3px solid #e3e6f0;">
                                         @else
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto" 
                                                 style="width: 150px; height: 150px;">
                                                <i class="fas fa-user text-white fa-3x"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_img" class="form-label">Profile Image</label>
                                        <input type="file" 
                                               class="form-control @error('profile_img') is-invalid @enderror" 
                                               id="profile_img" 
                                               name="profile_img" 
                                               accept="image/*">
                                        @error('profile_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Upload a new profile image (JPEG, PNG, JPG, GIF up to 2MB)</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .profile-image-container {
        position: relative;
        display: inline-block;
    }
    
    .profile-image {
        transition: transform 0.3s ease;
    }
    
    .profile-image:hover {
        transform: scale(1.05);
    }
    
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    
    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }
</style>
@endsection
