@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Event Details</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-primary">Edit Event</a>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to List</a>
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

        <!-- Event Details -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $event->title }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Basic Information</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Title:</strong></td>
                                        <td>{{ $event->title }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Category:</strong></td>
                                        <td>{{ $event->category ? $event->category->name : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td><span class="badge badge-{{ $event->status == 'published' ? 'success' : ($event->status == 'draft' ? 'warning' : 'secondary') }}">{{ ucfirst($event->status) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Featured:</strong></td>
                                        <td>{{ $event->is_featured ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Visibility:</strong></td>
                                        <td>{{ $event->visibility ? 'Visible' : 'Hidden' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Event Details</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Event Date:</strong></td>
                                        <td>{{ $event->event_date ? $event->event_date->format('M d, Y') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Event Time:</strong></td>
                                        <td>{{ $event->event_time ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Venue:</strong></td>
                                        <td>{{ $event->venue ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Location:</strong></td>
                                        <td>{{ $event->location ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Max Attendees:</strong></td>
                                        <td>{{ $event->max_attendees ?? 'Unlimited' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Descriptions -->
                        @if($event->short_description)
                        <div class="mb-4">
                            <h6>Short Description</h6>
                            <p>{{ $event->short_description }}</p>
                        </div>
                        @endif

                        @if($event->description)
                        <div class="mb-4">
                            <h6>Description</h6>
                            <p>{{ $event->description }}</p>
                        </div>
                        @endif

                        @if($event->about_event)
                        <div class="mb-4">
                            <h6>About the Event (Mission, Purpose)</h6>
                            <p>{{ $event->about_event }}</p>
                        </div>
                        @endif

                        @if($event->agenda)
                        <div class="mb-4">
                            <h6>Agenda</h6>
                            <p>{{ $event->agenda }}</p>
                        </div>
                        @endif

                        <!-- Registration Information -->
                        <div class="mb-4">
                            <h6>Registration Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Registration Required:</strong></td>
                                    <td>{{ $event->registration_required ? 'Yes' : 'No' }}</td>
                                </tr>
                                @if($event->registration_deadline)
                                <tr>
                                    <td><strong>Registration Deadline:</strong></td>
                                    <td>{{ $event->registration_deadline->format('M d, Y') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>

                        <!-- Organizer Information -->
                        @if($event->organizer_name || $event->contact_email || $event->contact_phone)
                        <div class="mb-4">
                            <h6>Organizer Information</h6>
                            <table class="table table-borderless">
                                @if($event->organizer_name)
                                <tr>
                                    <td><strong>Organizer:</strong></td>
                                    <td>{{ $event->organizer_name }}</td>
                                </tr>
                                @endif
                                @if($event->contact_email)
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $event->contact_email }}</td>
                                </tr>
                                @endif
                                @if($event->contact_phone)
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $event->contact_phone }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        @endif

                        <!-- Tags -->
                        @if($event->tags && count($event->tags) > 0)
                        <div class="mb-4">
                            <h6>Tags</h6>
                            <div>
                                @foreach($event->tags as $tag)
                                    <span class="badge badge-primary mr-1">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Banners -->
                @if($event->banners && count($event->banners) > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Event Banners</h6>
                    </div>
                    <div class="card-body">
                        @foreach($event->banners as $banner)
                            <div class="mb-3">
                                <img src="{{ asset($banner) }}" alt="Event Banner" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Speakers -->
                @if($event->speakers && count($event->speakers) > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Speakers</h6>
                    </div>
                    <div class="card-body">
                        @foreach($event->speakers as $speaker)
                            <div class="mb-3 p-3 border rounded">
                                <h6 class="mb-1">{{ $speaker['name'] ?? 'N/A' }}</h6>
                                @if(isset($speaker['designation']) && $speaker['designation'])
                                    <p class="text-muted mb-1"><small>{{ $speaker['designation'] }}</small></p>
                                @endif
                                @if(isset($speaker['bio']) && $speaker['bio'])
                                    <p class="mb-0"><small>{{ $speaker['bio'] }}</small></p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Sponsors -->
                @if($event->sponsors && count($event->sponsors) > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Sponsors</h6>
                    </div>
                    <div class="card-body">
                        @foreach($event->sponsors as $sponsor)
                            <div class="mb-3 p-3 border rounded text-center">
                                @if(isset($sponsor['logo']) && $sponsor['logo'])
                                    <img src="{{ asset($sponsor['logo']) }}" alt="{{ $sponsor['name'] ?? 'Sponsor' }}" class="img-fluid mb-2" style="max-height: 60px;">
                                @endif
                                <h6 class="mb-0">{{ $sponsor['name'] ?? 'N/A' }}</h6>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Documents -->
                @if($event->documents && count($event->documents) > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Documents</h6>
                    </div>
                    <div class="card-body">
                        @foreach($event->documents as $document)
                            <div class="mb-2">
                                <a href="{{ asset($document) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file"></i> {{ basename($document) }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Timestamps -->
                <div class="card">
                    <div class="card-header">
                        <h6>Timestamps</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $event->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $event->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
