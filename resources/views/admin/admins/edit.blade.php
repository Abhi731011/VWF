@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Admin User</h3>
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
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Form -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admins.update', $admin) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                                            <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                                                <i class="fas fa-eye" id="password-icon"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle"></i> Leave blank if you don't want to change the password
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                            <button type="button" class="btn btn-outline-secondary" id="toggle-password-confirmation">
                                                <i class="fas fa-eye" id="password-confirmation-icon"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">Only required if you're changing the password</small>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_id">Package</label>
                                        <select class="form-control" id="package_id" name="package_id">
                                            <option value="">Select Package</option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}" {{ old('package_id', $admin->package_id) == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $admin->address) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $admin->city) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $admin->state) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $admin->country) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zip_code">Zip Code</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code', $admin->zip_code) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profile_img">Profile Image</label>
                                        @if($admin->profile_img)
                                            <div class="mb-2">
                                                <img src="{{ asset('admin_profile/' . $admin->profile_img) }}" alt="Current Profile" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                                <p class="text-muted small">Current Profile Image</p>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" id="profile_img" name="profile_img" accept="image/*">
                                        <small class="form-text text-muted">Max size: 2MB, Formats: JPEG, PNG, JPG, GIF</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="banner_img">Banner Image</label>
                                        @if($admin->banner_img)
                                            <div class="mb-2">
                                                <img src="{{ asset('admin_banner/' . $admin->banner_img) }}" alt="Current Banner" style="width: 200px; height: 100px; object-fit: cover; border-radius: 8px;">
                                                <p class="text-muted small">Current Banner Image</p>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" id="banner_img" name="banner_img" accept="image/*">
                                        <small class="form-text text-muted">Max size: 2MB, Formats: JPEG, PNG, JPG, GIF</small>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Update Admin</button>
                                    <a href="{{ route('admins.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password field functionality
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const passwordConfirmationGroup = passwordConfirmationInput.closest('.form-group');

        // Initially hide password confirmation
        passwordConfirmationGroup.style.display = 'none';

        // Show/hide password confirmation based on password input
        passwordInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                passwordConfirmationGroup.style.display = 'block';
                passwordConfirmationInput.required = true;
            } else {
                passwordConfirmationGroup.style.display = 'none';
                passwordConfirmationInput.required = false;
                passwordConfirmationInput.value = '';
            }
        });

        // Password strength indicator
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('password-strength') || createPasswordStrengthIndicator();
            
            if (password.length === 0) {
                strengthIndicator.style.display = 'none';
                return;
            }
            
            strengthIndicator.style.display = 'block';
            
            let strength = 0;
            let strengthText = '';
            let strengthColor = '';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            switch (strength) {
                case 0:
                case 1:
                    strengthText = 'Very Weak';
                    strengthColor = '#dc3545';
                    break;
                case 2:
                    strengthText = 'Weak';
                    strengthColor = '#fd7e14';
                    break;
                case 3:
                    strengthText = 'Fair';
                    strengthColor = '#ffc107';
                    break;
                case 4:
                    strengthText = 'Good';
                    strengthColor = '#20c997';
                    break;
                case 5:
                    strengthText = 'Strong';
                    strengthColor = '#198754';
                    break;
            }
            
            strengthIndicator.innerHTML = `<small class="text-muted">Password Strength: <span style="color: ${strengthColor}; font-weight: bold;">${strengthText}</span></small>`;
        });

        function createPasswordStrengthIndicator() {
            const indicator = document.createElement('div');
            indicator.id = 'password-strength';
            indicator.style.display = 'none';
            passwordInput.parentNode.appendChild(indicator);
            return indicator;
        }

        // Password toggle functionality
        const togglePasswordBtn = document.getElementById('toggle-password');
        const passwordIcon = document.getElementById('password-icon');
        
        togglePasswordBtn.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        });

        // Password confirmation toggle functionality
        const togglePasswordConfirmationBtn = document.getElementById('toggle-password-confirmation');
        const passwordConfirmationIcon = document.getElementById('password-confirmation-icon');
        
        togglePasswordConfirmationBtn.addEventListener('click', function() {
            if (passwordConfirmationInput.type === 'password') {
                passwordConfirmationInput.type = 'text';
                passwordConfirmationIcon.classList.remove('fa-eye');
                passwordConfirmationIcon.classList.add('fa-eye-slash');
            } else {
                passwordConfirmationInput.type = 'password';
                passwordConfirmationIcon.classList.remove('fa-eye-slash');
                passwordConfirmationIcon.classList.add('fa-eye');
            }
        });

        // Image preview functionality
        const profileImgInput = document.getElementById('profile_img');
        const bannerImgInput = document.getElementById('banner_img');

        profileImgInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview if it doesn't exist
                    let preview = document.getElementById('profile-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'profile-preview';
                        preview.style.cssText = 'max-width: 150px; max-height: 150px; margin-top: 10px; border-radius: 8px;';
                        profileImgInput.parentNode.appendChild(preview);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        bannerImgInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview if it doesn't exist
                    let preview = document.getElementById('banner-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'banner-preview';
                        preview.style.cssText = 'max-width: 300px; max-height: 150px; margin-top: 10px; border-radius: 8px;';
                        bannerImgInput.parentNode.appendChild(preview);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
