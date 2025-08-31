@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Event</h3>
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
                        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
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
                                        <label for="event_date">Event Date</label>
                                        <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_time">Event Time</label>
                                        <input type="time" class="form-control" id="event_time" name="event_time" value="{{ old('event_time') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="venue">Venue</label>
                                        <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about_event">About the Event (Mission, Purpose)</label>
                                        <textarea class="form-control" id="about_event" name="about_event" rows="4">{{ old('about_event') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="agenda">Agenda</label>
                                        <textarea class="form-control" id="agenda" name="agenda" rows="4">{{ old('agenda') }}</textarea>
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
                                        <label for="max_attendees">Maximum Attendees</label>
                                        <input type="number" class="form-control" id="max_attendees" name="max_attendees" value="{{ old('max_attendees') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_required">Registration Required</label>
                                        <select class="form-control" id="registration_required" name="registration_required">
                                            <option value="0" {{ old('registration_required') == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('registration_required') == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_deadline">Registration Deadline</label>
                                        <input type="date" class="form-control" id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline') }}">
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

                                <!-- Banners -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Event Banners</label>
                                        <div id="banners-container">
                                            <!-- Initial empty banner input -->
                                        </div>
                                        <button type="button" id="add-banner" class="btn btn-sm btn-primary">+</button>
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

                                <!-- Speakers -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Speakers</label>
                                        <div id="speakers-container">
                                            <!-- Initial empty speaker -->
                                        </div>
                                        <button type="button" id="add-speaker" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <!-- Sponsors -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Sponsors</label>
                                        <div id="sponsors-container">
                                            <!-- Initial empty sponsor -->
                                        </div>
                                        <button type="button" id="add-sponsor" class="btn btn-sm btn-primary">+</button>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Create Event</button>
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
        let tagIndex = 0;
        let bannerIndex = 0;
        let documentIndex = 0;
        let speakerIndex = 0;
        let sponsorIndex = 0;

        // Add initial fields
        addTagField();
        addBannerField();
        addDocumentField();
        addSpeakerField();
        addSponsorField();

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
                <input type="file" class="form-control" name="banners[${bannerIndex}]">
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
    });
</script>
@endsection
