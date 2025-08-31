@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Event</h3>
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

        <!-- Edit Form -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea class="form-control" id="short_description" name="short_description">{{ old('short_description', $event->short_description) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ old('description', $event->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_date">Event Date</label>
                                        <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_time">Event Time</label>
                                        <input type="time" class="form-control" id="event_time" name="event_time" value="{{ old('event_time', $event->event_time) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="venue">Venue</label>
                                        <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue', $event->venue) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event->location) }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about_event">About the Event (Mission, Purpose)</label>
                                        <textarea class="form-control" id="about_event" name="about_event" rows="4">{{ old('about_event', $event->about_event) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="agenda">Agenda</label>
                                        <textarea class="form-control" id="agenda" name="agenda" rows="4">{{ old('agenda', $event->agenda) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organizer_name">Organizer Name</label>
                                        <input type="text" class="form-control" id="organizer_name" name="organizer_name" value="{{ old('organizer_name', $event->organizer_name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_email">Contact Email</label>
                                        <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ old('contact_email', $event->contact_email) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_phone">Contact Phone</label>
                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $event->contact_phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max_attendees">Maximum Attendees</label>
                                        <input type="number" class="form-control" id="max_attendees" name="max_attendees" value="{{ old('max_attendees', $event->max_attendees) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_required">Registration Required</label>
                                        <select class="form-control" id="registration_required" name="registration_required">
                                            <option value="0" {{ old('registration_required', $event->registration_required) == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('registration_required', $event->registration_required) == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_deadline">Registration Deadline</label>
                                        <input type="date" class="form-control" id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline', $event->registration_deadline ? $event->registration_deadline->format('Y-m-d') : '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="archived" {{ old('status', $event->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_featured">Featured</label>
                                        <select class="form-control" id="is_featured" name="is_featured">
                                            <option value="0" {{ old('is_featured', $event->is_featured) == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('is_featured', $event->is_featured) == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="visibility">Visibility</label>
                                        <select class="form-control" id="visibility" name="visibility">
                                            <option value="0" {{ old('visibility', $event->visibility) == '0' ? 'selected' : '' }}>Hidden</option>
                                            <option value="1" {{ old('visibility', $event->visibility) == '1' ? 'selected' : '' }}>Visible</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <div id="tags-container">
                                            @if($event->tags)
                                                @foreach($event->tags as $index => $tag)
                                                    <div class="input-group mb-2 tag-item">
                                                        <input type="text" class="form-control" name="tags[{{ $index }}]" value="{{ $tag }}" placeholder="Enter tag">
                                                        <button type="button" class="btn btn-danger remove-tag">-</button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" id="add-tag" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Banners -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Event Banners</label>
                                        @if($event->banners)
                                            <div class="mb-3">
                                                <h6>Current Banners:</h6>
                                                @foreach($event->banners as $index => $banner)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <img src="{{ asset($banner) }}" alt="Banner" style="width: 100px; height: 60px; object-fit: cover; margin-right: 10px;">
                                                        <input type="checkbox" name="delete_banners[]" value="{{ $banner }}" id="delete_banner_{{ $index }}">
                                                        <label for="delete_banner_{{ $index }}" class="ml-2">Delete this banner</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div id="banners-container">
                                            <!-- New banner inputs -->
                                        </div>
                                        <button type="button" id="add-banner" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Documents -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Documents</label>
                                        @if($event->documents)
                                            <div class="mb-3">
                                                <h6>Current Documents:</h6>
                                                @foreach($event->documents as $index => $document)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="mr-2">{{ basename($document) }}</span>
                                                        <input type="checkbox" name="delete_documents[]" value="{{ $document }}" id="delete_document_{{ $index }}">
                                                        <label for="delete_document_{{ $index }}" class="ml-2">Delete this document</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div id="documents-container">
                                            <!-- New document inputs -->
                                        </div>
                                        <button type="button" id="add-document" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Speakers -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Speakers</label>
                                        <div id="speakers-container">
                                            @if($event->speakers)
                                                @foreach($event->speakers as $index => $speaker)
                                                    <div class="card mb-2 speaker-item">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control" name="speakers[{{ $index }}][name]" value="{{ $speaker['name'] ?? '' }}" placeholder="Enter speaker name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Designation</label>
                                                                        <input type="text" class="form-control" name="speakers[{{ $index }}][designation]" value="{{ $speaker['designation'] ?? '' }}" placeholder="Enter designation">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Bio</label>
                                                                        <textarea class="form-control" name="speakers[{{ $index }}][bio]" placeholder="Enter bio">{{ $speaker['bio'] ?? '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-danger remove-speaker">-</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" id="add-speaker" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Sponsors -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Sponsors</label>
                                        <div id="sponsors-container">
                                            @if($event->sponsors)
                                                @foreach($event->sponsors as $index => $sponsor)
                                                    <div class="card mb-2 sponsor-item">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Sponsor Name</label>
                                                                        <input type="text" class="form-control" name="sponsors[{{ $index }}][name]" value="{{ $sponsor['name'] ?? '' }}" placeholder="Enter sponsor name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Logo</label>
                                                                        @if(isset($sponsor['logo']))
                                                                            <div class="mb-2">
                                                                                <img src="{{ asset($sponsor['logo']) }}" alt="Sponsor Logo" style="width: 100px; height: 60px; object-fit: contain;">
                                                                            </div>
                                                                        @endif
                                                                        <input type="file" class="form-control" name="sponsors[{{ $index }}][logo]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-danger remove-sponsor">-</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" id="add-sponsor" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Update Event</button>
                                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
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
        let tagIndex = {{ $event->tags ? count($event->tags) : 0 }};
        let bannerIndex = 0;
        let documentIndex = 0;
        let speakerIndex = {{ $event->speakers ? count($event->speakers) : 0 }};
        let sponsorIndex = {{ $event->sponsors ? count($event->sponsors) : 0 }};

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

        // Add banner
        document.getElementById('add-banner').addEventListener('click', addBannerField);

        function addBannerField() {
            const container = document.getElementById('banners-container');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2', 'banner-item');
            div.innerHTML = `
                <input type="file" class="form-control" name="new_banners[${bannerIndex}]">
                <button type="button" class="btn btn-danger remove-banner">-</button>
            `;
            container.appendChild(div);
            bannerIndex++;

            // Remove banner
            div.querySelector('.remove-banner').addEventListener('click', function() {
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
                <input type="file" class="form-control" name="new_documents[${documentIndex}]">
                <button type="button" class="btn btn-danger remove-document">-</button>
            `;
            container.appendChild(div);
            documentIndex++;

            // Remove document
            div.querySelector('.remove-document').addEventListener('click', function() {
                div.remove();
            });
        }

        // Add Speaker
        document.getElementById('add-speaker').addEventListener('click', addSpeakerField);

        function addSpeakerField() {
            const container = document.getElementById('speakers-container');
            const div = document.createElement('div');
            div.classList.add('card', 'mb-2', 'speaker-item');
            div.innerHTML = `
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="speakers[${speakerIndex}][name]" placeholder="Enter speaker name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="speakers[${speakerIndex}][designation]" placeholder="Enter designation">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="form-control" name="speakers[${speakerIndex}][bio]" placeholder="Enter bio"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger remove-speaker">-</button>
                </div>
            `;
            container.appendChild(div);
            speakerIndex++;

            // Remove Speaker
            div.querySelector('.remove-speaker').addEventListener('click', function() {
                div.remove();
            });
        }

        // Add Sponsor
        document.getElementById('add-sponsor').addEventListener('click', addSponsorField);

        function addSponsorField() {
            const container = document.getElementById('sponsors-container');
            const div = document.createElement('div');
            div.classList.add('card', 'mb-2', 'sponsor-item');
            div.innerHTML = `
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sponsor Name</label>
                                <input type="text" class="form-control" name="sponsors[${sponsorIndex}][name]" placeholder="Enter sponsor name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" class="form-control" name="sponsors[${sponsorIndex}][logo]">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger remove-sponsor">-</button>
                </div>
            `;
            container.appendChild(div);
            sponsorIndex++;

            // Remove Sponsor
            div.querySelector('.remove-sponsor').addEventListener('click', function() {
                div.remove();
            });
        }

        // Add event listeners for existing remove buttons
        document.querySelectorAll('.remove-tag').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.tag-item').remove();
            });
        });

        document.querySelectorAll('.remove-speaker').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.speaker-item').remove();
            });
        });

        document.querySelectorAll('.remove-sponsor').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.sponsor-item').remove();
            });
        });
    });
</script>
@endsection
