@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Gallery</h3>
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

        <!-- Create Form -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Gallery Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter gallery title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sort_order">Sort Order</label>
                                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Gallery Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter gallery description">{{ old('description') }}</textarea>
                                    </div>
                                </div> --}}
                                
                                <!-- Dynamic Image Upload Section -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Gallery Images</label>
                                        <div id="images-container">
                                            <div class="image-upload-item mb-3 p-3 border rounded">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Image</label>
                                                            <input type="file" class="form-control image-input" name="images[]" accept="image/*" >
                                                            <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control" name="image_descriptions[]" placeholder="Enter image description">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-end">
                                                        <button type="button" class="btn btn-danger remove-image" style="display: none;">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success" id="add-image">
                                            <i class="fas fa-plus"></i> Add Image
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">
                                                Active Status
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group text-end">
                                        <button type="submit" class="btn btn-primary">Create Gallery</button>
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
        let imageIndex = 1;

        // Add image functionality
        document.getElementById('add-image').addEventListener('click', function() {
            const container = document.getElementById('images-container');
            const newImageItem = document.createElement('div');
            newImageItem.className = 'image-upload-item mb-3 p-3 border rounded';
            newImageItem.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control image-input" name="images[]" accept="image/*" required>
                            <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="image_descriptions[]" placeholder="Enter image description">
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-image">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newImageItem);
            imageIndex++;

            // Show remove buttons for all items if more than one
            updateRemoveButtons();
        });

        // Remove image functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-image')) {
                const imageItems = document.querySelectorAll('.image-upload-item');
                if (imageItems.length > 1) {
                    e.target.closest('.image-upload-item').remove();
                    updateRemoveButtons();
                }
            }
        });

        function updateRemoveButtons() {
            const imageItems = document.querySelectorAll('.image-upload-item');
            const removeButtons = document.querySelectorAll('.remove-image');
            
            if (imageItems.length > 1) {
                removeButtons.forEach(button => button.style.display = 'block');
            } else {
                removeButtons.forEach(button => button.style.display = 'none');
            }
        }

        // Initialize remove buttons visibility
        updateRemoveButtons();
    });
</script>
@endsection
