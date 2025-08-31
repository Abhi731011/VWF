@extends('landing.master')

@section('content')
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">{{ $event->title }}</h3>
                <p class="fs-5 text-white mb-4">{{ $event->short_description ?? 'Join us for this exciting event!' }}</p>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('eventslanding') }}">Events</a></li>
                    <li class="breadcrumb-item active text-white">{{ $event->title }}</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- Event Details Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row">
                    <!-- Event Image -->
                    <div class="col-lg-6 mb-5">
                        @if($event->banners && count($event->banners) > 0)
                            <img src="{{ asset($event->banners[0]) }}" class="img-fluid rounded" alt="{{ $event->title }}">
                        @else
                            <img src="{{ asset('assetslanding/img/events-1.jpg') }}" class="img-fluid rounded" alt="{{ $event->title }}">
                        @endif
                    </div>
                    
                    <!-- Event Details -->
                    <div class="col-lg-6 mb-5">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="mb-4">{{ $event->title }}</h2>
                                
                                @if($event->short_description)
                                    <p class="text-muted mb-4">{{ $event->short_description }}</p>
                                @endif

                                <!-- Event Info -->
                                <div class="row mb-4">
                                    @if($event->event_date)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar-alt text-primary me-3"></i>
                                                <div>
                                                    <small class="text-muted">Event Date</small>
                                                    <div class="fw-bold">{{ $event->event_date->format('l, F d, Y') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($event->event_time)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-clock text-primary me-3"></i>
                                                <div>
                                                    <small class="text-muted">Event Time</small>
                                                    <div class="fw-bold">{{ $event->event_time }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($event->venue)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                                <div>
                                                    <small class="text-muted">Venue</small>
                                                    <div class="fw-bold">{{ $event->venue }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($event->location)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-location-dot text-primary me-3"></i>
                                                <div>
                                                    <small class="text-muted">Location</small>
                                                    <div class="fw-bold">{{ $event->location }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($event->category)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-tag text-primary me-3"></i>
                                                <div>
                                                    <small class="text-muted">Category</small>
                                                    <div class="fw-bold">{{ $event->category->name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($event->max_attendees)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-users text-primary me-3"></i>
                                                <div>
                                                    <small class="text-muted">Max Attendees</small>
                                                    <div class="fw-bold">{{ $event->max_attendees }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Contact Information -->
                                @if($event->organizer_name || $event->contact_email || $event->contact_phone)
                                    <div class="border-top pt-4 mb-4">
                                        <h5 class="mb-3">Contact Information</h5>
                                        @if($event->organizer_name)
                                            <p class="mb-2"><strong>Organizer:</strong> {{ $event->organizer_name }}</p>
                                        @endif
                                        @if($event->contact_email)
                                            <p class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $event->contact_email }}">{{ $event->contact_email }}</a></p>
                                        @endif
                                        @if($event->contact_phone)
                                            <p class="mb-2"><strong>Phone:</strong> <a href="tel:{{ $event->contact_phone }}">{{ $event->contact_phone }}</a></p>
                                        @endif
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
                                    <a href="{{ route('eventslanding') }}" class="btn btn-outline-primary">Back to Events</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Description -->
                @if($event->description)
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h4 class="mb-4">About This Event</h4>
                                    <div class="event-description">
                                        {!! $event->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Event Agenda -->
                @if($event->agenda)
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h4 class="mb-4">Event Agenda</h4>
                                    <div class="event-agenda">
                                        {!! $event->agenda !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Speakers -->
                @if($event->speakers && count($event->speakers) > 0)
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h4 class="mb-4">Speakers</h4>
                                    <div class="row">
                                        @foreach($event->speakers as $speaker)
                                            @if(!empty($speaker['name']))
                                                <div class="col-md-6 col-lg-4 mb-4">
                                                    <div class="text-center">
                                                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                                            <i class="fas fa-user text-primary fa-2x"></i>
                                                        </div>
                                                        <h6 class="mb-1">{{ $speaker['name'] }}</h6>
                                                        @if(!empty($speaker['designation']))
                                                            <small class="text-muted">{{ $speaker['designation'] }}</small>
                                                        @endif
                                                        @if(!empty($speaker['bio']))
                                                            <p class="small text-muted mt-2">{{ Str::limit($speaker['bio'], 100) }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Sponsors -->
                @if($event->sponsors && count($event->sponsors) > 0)
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h4 class="mb-4">Sponsors</h4>
                                    <div class="row">
                                        @foreach($event->sponsors as $sponsor)
                                            @if(!empty($sponsor['name']))
                                                <div class="col-md-6 col-lg-4 mb-4">
                                                    <div class="text-center">
                                                        @if(!empty($sponsor['logo']))
                                                            <img src="{{ asset($sponsor['logo']) }}" alt="{{ $sponsor['name'] }}" class="img-fluid mb-2" style="max-height: 60px;">
                                                        @else
                                                            <div class="bg-light rounded d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                                                <i class="fas fa-building text-primary"></i>
                                                            </div>
                                                        @endif
                                                        <h6 class="mb-0">{{ $sponsor['name'] }}</h6>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- Event Details End -->
@endsection
