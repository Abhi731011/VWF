@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Package</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('packages.index') }}" class="btn btn-secondary">Back to List</a>
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

        <!-- Create Form -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('packages.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Package Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter package name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', 0) }}" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <select class="form-control" id="currency" name="currency">
                                            <option value="INR" {{ old('currency', 'INR') == 'INR' ? 'selected' : '' }}>INR</option>
                                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration_type">Duration Type</label>
                                        <select class="form-control" id="duration_type" name="duration_type">
                                            <option value="monthly" {{ old('duration_type', 'monthly') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                            <option value="yearly" {{ old('duration_type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                            <option value="lifetime" {{ old('duration_type') == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration_value">Duration Value</label>
                                        <input type="number" class="form-control" id="duration_value" name="duration_value" value="{{ old('duration_value', 1) }}" min="1" placeholder="1">
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="goodies_count">Goodies Count</label>
                                        <input type="number" class="form-control" id="goodies_count" name="goodies_count" value="{{ old('goodies_count') }}" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter package description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Package Image</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon">Package Icon</label>
                                        <input type="file" class="form-control" id="icon" name="icon" accept="image/*">
                                        <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF, SVG. Max size: 1MB</small>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sort_order">Sort Order</label>
                                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" placeholder="0">
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Featured Package
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">
                                                Active Status
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Package Perks Section -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Package Perks</label>
                                        <div id="perks-container">
                                            @if(old('perks'))
                                                @foreach(old('perks') as $index => $perk)
                                                    <div class="input-group mb-2 perk-item">
                                                        <input type="text" class="form-control" name="perks[]" value="{{ $perk }}" placeholder="Enter perk">
                                                        <button type="button" class="btn btn-danger remove-perk">Remove</button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="input-group mb-2 perk-item">
                                                    <input type="text" class="form-control" name="perks[]" placeholder="Enter perk">
                                                    <button type="button" class="btn btn-danger remove-perk">Remove</button>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-success" id="add-perk">Add Perk</button>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group text-end">
                                        <button type="submit" class="btn btn-primary">Create Package</button>
                                        <a href="{{ route('packages.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
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
        // Add perk functionality
        document.getElementById('add-perk').addEventListener('click', function() {
            const container = document.getElementById('perks-container');
            const newPerk = document.createElement('div');
            newPerk.className = 'input-group mb-2 perk-item';
            newPerk.innerHTML = `
                <input type="text" class="form-control" name="perks[]" placeholder="Enter perk">
                <button type="button" class="btn btn-danger remove-perk">Remove</button>
            `;
            container.appendChild(newPerk);
        });

        // Remove perk functionality
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-perk')) {
                const perkItems = document.querySelectorAll('.perk-item');
                if (perkItems.length > 1) {
                    e.target.closest('.perk-item').remove();
                }
            }
        });
    });
</script>
@endsection
