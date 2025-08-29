@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Package Details</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('packages.edit', $package) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('packages.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>

        <!-- Package Details -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Package Name:</strong></label>
                                    <p>{{ $package->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Slug:</strong></label>
                                    <p>{{ $package->slug ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Price:</strong></label>
                                    <p>{{ $package->currency }} {{ number_format($package->price, 2) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Duration:</strong></label>
                                    <p>{{ $package->duration_value }} {{ ucfirst($package->duration_type) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Goodies Count:</strong></label>
                                    <p>{{ $package->goodies_count ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Sort Order:</strong></label>
                                    <p>{{ $package->sort_order }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Featured:</strong></label>
                                    <p>
                                        @if($package->is_featured)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Status:</strong></label>
                                    <p>
                                        @if($package->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Description:</strong></label>
                                    <p>{{ $package->description ?? 'No description available' }}</p>
                                </div>
                            </div>
                            
                            <!-- Package Images -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Package Image:</strong></label>
                                    @if($package->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($package->image) }}" alt="Package Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @else
                                        <p>No image uploaded</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Package Icon:</strong></label>
                                    @if($package->icon)
                                        <div class="mt-2">
                                            <img src="{{ asset($package->icon) }}" alt="Package Icon" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                    @else
                                        <p>No icon uploaded</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Package Perks -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Package Perks:</strong></label>
                                    @if($package->perks && count($package->perks) > 0)
                                        <ul class="list-group">
                                            @foreach($package->perks as $perk)
                                                @if(!empty($perk))
                                                    <li class="list-group-item">{{ $perk }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No perks defined</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Timestamps -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Created At:</strong></label>
                                    <p>{{ $package->created_at ? $package->created_at->format('d M Y, h:i A') : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Updated At:</strong></label>
                                    <p>{{ $package->updated_at ? $package->updated_at->format('d M Y, h:i A') : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
