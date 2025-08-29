@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Project</h3>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif

        <!-- Create Form -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea class="form-control" id="short_description" name="short_description">{{ old('short_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="target_amount">Target Amount</label>
                                        <input type="number" step="0.01" class="form-control" id="target_amount" name="target_amount" value="{{ old('target_amount') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min_donation">Minimum Donation</label>
                                        <input type="number" step="0.01" class="form-control" id="min_donation" name="min_donation" value="{{ old('min_donation') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video_url">Video URL</label>
                                        <input type="url" class="form-control" id="video_url" name="video_url" value="{{ old('video_url') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video_file">Video File</label>
                                        <input type="file" class="form-control" id="video_file" name="video_file">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organizer_name">Organizer Name</label>
                                        <input type="text" class="form-control" id="organizer_name" name="organizer_name" value="{{ old('organizer_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_email">Contact Email</label>
                                        <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_phone">Contact Phone</label>
                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_recurring">Recurring</label>
                                        <select class="form-control" id="is_recurring" name="is_recurring">
                                            <option value="0" {{ old('is_recurring') == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('is_recurring') == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_featured">Featured</label>
                                        <select class="form-control" id="is_featured" name="is_featured">
                                            <option value="0" {{ old('is_featured') == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="visibility">Visibility</label>
                                        <select class="form-control" id="visibility" name="visibility">
                                            <option value="0" {{ old('visibility') == '0' ? 'selected' : '' }}>Hidden</option>
                                            <option value="1" {{ old('visibility') == '1' ? 'selected' : '' }}>Visible</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <div id="tags-container">
                                            <!-- Initial empty tag input -->
                                        </div>
                                        <button type="button" id="add-tag" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Images -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Images</label>
                                        <div id="images-container">
                                            <!-- Initial empty image input -->
                                        </div>
                                        <button type="button" id="add-image" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Documents -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Documents</label>
                                        <div id="documents-container">
                                            <!-- Initial empty document input -->
                                        </div>
                                        <button type="button" id="add-document" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- FAQs -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>FAQs</label>
                                        <div id="faqs-container">
                                            <!-- Initial empty FAQ -->
                                        </div>
                                        <button type="button" id="add-faq" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Updates -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Updates</label>
                                        <div id="updates-container">
                                            <!-- Initial empty update -->
                                        </div>
                                        <button type="button" id="add-update" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Create Project</button>
                                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
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
        let tagIndex = 0;
        let imageIndex = 0;
        let documentIndex = 0;
        let faqIndex = 0;
        let updateIndex = 0;

        // Add initial fields
        addTagField();
        addImageField();
        addDocumentField();
        addFaqField();
        addUpdateField();

        // Add tag
        document.getElementById('add-tag').addEventListener('click', addTagField);

        function addTagField() {
            const container = document.getElementById('tags-container');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2', 'tag-item');
            div.innerHTML = `
                <input type="text" class="form-control" name="tags[${tagIndex}]" placeholder="Enter tag">
                <button type="button" class="btn btn-danger remove-tag">-</button>
            `;
            container.appendChild(div);
            tagIndex++;

            // Remove tag
            div.querySelector('.remove-tag').addEventListener('click', function() {
                div.remove();
            });
        }

        // Add image
        document.getElementById('add-image').addEventListener('click', addImageField);

        function addImageField() {
            const container = document.getElementById('images-container');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2', 'image-item');
            div.innerHTML = `
                <input type="file" class="form-control" name="images[${imageIndex}]">
                <button type="button" class="btn btn-danger remove-image">-</button>
            `;
            container.appendChild(div);
            imageIndex++;

            // Remove image
            div.querySelector('.remove-image').addEventListener('click', function() {
                div.remove();
            });
        }

        // Add document
        document.getElementById('add-document').addEventListener('click', addDocumentField);

        function addDocumentField() {
            const container = document.getElementById('documents-container');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2', 'document-item');
            div.innerHTML = `
                <input type="file" class="form-control" name="documents[${documentIndex}]">
                <button type="button" class="btn btn-danger remove-document">-</button>
            `;
            container.appendChild(div);
            documentIndex++;

            // Remove document
            div.querySelector('.remove-document').addEventListener('click', function() {
                div.remove();
            });
        }

        // Add FAQ
        document.getElementById('add-faq').addEventListener('click', addFaqField);

        function addFaqField() {
            const container = document.getElementById('faqs-container');
            const div = document.createElement('div');
            div.classList.add('card', 'mb-2', 'faq-item');
            div.innerHTML = `
                <div class="card-body">
                    <div class="form-group">
                        <label>Question</label>
                        <input type="text" class="form-control" name="faqs[${faqIndex}][question]" placeholder="Enter question">
                    </div>
                    <div class="form-group">
                        <label>Answer</label>
                        <textarea class="form-control" name="faqs[${faqIndex}][answer]" placeholder="Enter answer"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger remove-faq">-</button>
                </div>
            `;
            container.appendChild(div);
            faqIndex++;

            // Remove FAQ
            div.querySelector('.remove-faq').addEventListener('click', function() {
                div.remove();
            });
        }

        // Add Update
        document.getElementById('add-update').addEventListener('click', addUpdateField);

        function addUpdateField() {
            const container = document.getElementById('updates-container');
            const div = document.createElement('div');
            div.classList.add('card', 'mb-2', 'update-item');
            div.innerHTML = `
                <div class="card-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="updates[${updateIndex}][date]">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="updates[${updateIndex}][content]" placeholder="Enter update content"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger remove-update">-</button>
                </div>
            `;
            container.appendChild(div);
            updateIndex++;

            // Remove Update
            div.querySelector('.remove-update').addEventListener('click', function() {
                div.remove();
            });
        }
    });
</script>
@endsection