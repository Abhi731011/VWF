@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Gallery</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back to List</a>
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
                        <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Gallery Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $gallery->title) }}" placeholder="Enter gallery title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sort_order">Sort Order</label>
                                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Gallery Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter gallery description">{{ old('description', $gallery->description) }}</textarea>
                                    </div>
                                </div> --}}
                                
                                <!-- Existing Images Section -->
                                @if($gallery->images && count($gallery->images) > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Existing Images</label>
                                        <div id="existing-images-container">
                                            @foreach($gallery->images as $index => $imageData)
                                            <div class="existing-image-item mb-3 p-3 border rounded">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Preview</label>
                                                            <div class="image-preview">
                                                                <img src="{{ asset($imageData['image']) }}" alt="Gallery Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control" name="existing_image_descriptions[]" value="{{ $imageData['description'] ?? '' }}" placeholder="Enter image description">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-end">
                                                        <button type="button" class="btn btn-danger remove-existing-image">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- New Images Upload Section -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add New Images</label>
                                        <div id="new-images-container">
                                            <div class="new-image-upload-item mb-3 p-3 border rounded">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Image</label>
                                                            <input type="file" class="form-control new-image-input" name="new_images[]" accept="image/*">
                                                            <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 20MB</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control" name="new_image_descriptions[]" placeholder="Enter image description">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-end">
                                                        <button type="button" class="btn btn-danger remove-new-image" style="display: none;">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success" id="add-new-image">
                                            <i class="fas fa-plus"></i> Add New Image
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', $gallery->status) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">
                                                Active Status
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group text-end">
                                        <button type="submit" class="btn btn-primary">Update Gallery</button>
                                        <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Cancel</a>
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
        let newImageIndex = 1;

        // Add new image functionality
        document.getElementById('add-new-image').addEventListener('click', function() {
            const container = document.getElementById('new-images-container');
            const newImageItem = document.createElement('div');
            newImageItem.className = 'new-image-upload-item mb-3 p-3 border rounded';
            newImageItem.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control new-image-input" name="new_images[]" accept="image/*">
                            <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 20MB</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="new_image_descriptions[]" placeholder="Enter image description">
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-new-image">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newImageItem);
            newImageIndex++;

            // Show remove buttons for all new image items if more than one
            updateNewImageRemoveButtons();
        });

        // Remove new image functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-new-image')) {
                const newImageItems = document.querySelectorAll('.new-image-upload-item');
                if (newImageItems.length > 1) {
                    e.target.closest('.new-image-upload-item').remove();
                    updateNewImageRemoveButtons();
                }
            }
        });

        // Remove existing image functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-existing-image')) {
                e.target.closest('.existing-image-item').remove();
            }
        });

        function updateNewImageRemoveButtons() {
            const newImageItems = document.querySelectorAll('.new-image-upload-item');
            const removeButtons = document.querySelectorAll('.remove-new-image');
            
            if (newImageItems.length > 1) {
                removeButtons.forEach(button => button.style.display = 'block');
            } else {
                removeButtons.forEach(button => button.style.display = 'none');
            }
        }

        // Initialize remove buttons visibility
        updateNewImageRemoveButtons();
    });
</script>
@endsection
