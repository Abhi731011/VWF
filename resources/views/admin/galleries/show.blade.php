@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Gallery Details</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back to List</a>
                    <a href="{{ route('galleries.edit', $gallery) }}" class="btn btn-primary">Edit Gallery</a>
                </div>
            </div>
        </div>

        <!-- Gallery Details -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Gallery Information</h5>
                                <table class="table table-borderless">
                                    {{-- <tr>
                                        <td><strong>Title:</strong></td>
                                        <td>{{ $gallery->title ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Description:</strong></td>
                                        <td>{{ $gallery->description ?? 'N/A' }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <span class="badge badge-{{ $gallery->status ? 'success' : 'danger' }}">
                                                {{ $gallery->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td><strong>Sort Order:</strong></td>
                                        <td>{{ $gallery->sort_order }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td><strong>Images Count:</strong></td>
                                        <td>{{ count($gallery->images ?? []) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created At:</strong></td>
                                        <td>{{ $gallery->created_at->format('M d, Y H:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Updated At:</strong></td>
                                        <td>{{ $gallery->updated_at->format('M d, Y H:i A') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Images -->
        @if($gallery->images && count($gallery->images) > 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Gallery Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($gallery->images as $index => $imageData)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ asset($imageData['image']) }}" alt="Gallery Image" class="img-fluid rounded" style="max-height: 200px; width: 100%; object-fit: cover;">
                                        @if(isset($imageData['description']) && $imageData['description'])
                                        <p class="mt-2 text-muted">{{ $imageData['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <p class="text-muted">No images found in this gallery.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
