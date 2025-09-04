@extends('landing.master')

@section('content')
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">{{ $event->title }}</h3>
                <p class="fs-5 text-white mb-4">{{ $event->short_description ?? 'Join us for this exciting event!' }}</p>
                
            </div>
        </div>
        
        <!-- Header End -->

        <!-- Event Details Start -->
    <div class="container py-5">
        <div class="row g-5">
            <!-- Event Image -->
            <div class="col-lg-7">
                <div class="event-image rounded overflow-hidden shadow-sm">
                    @if($event->banners && count($event->banners) > 0)
                        <img src="{{ asset($event->banners[0]) }}" class="img-fluid w-100" alt="{{ $event->title }}">
                    @else
                        <img src="{{ asset('assetslanding/img/events-1.jpg') }}" class="img-fluid w-100" alt="{{ $event->title }}">
                    @endif
                </div>

                <!-- Event Description -->
                @if($event->description)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">About This Event</h4>
                            <div class="event-description">
                                {!! $event->description !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Event Agenda -->
                @if($event->agenda)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Event Agenda</h4>
                            <div class="event-agenda">
                                {!! $event->agenda !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Speakers -->
                @if($event->speakers && count($event->speakers) > 0)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Speakers</h4>
                            <div class="row">
                                @foreach($event->speakers as $speaker)
                                    @if(!empty($speaker['name']))
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="speaker-card text-center p-3 rounded shadow-sm h-100">
                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 90px; height: 90px;">
                                                    <i class="fas fa-user text-primary fa-2x"></i>
                                                </div>
                                                <h6 class="fw-bold">{{ $speaker['name'] }}</h6>
                                                @if(!empty($speaker['designation']))
                                                    <small class="text-muted">{{ $speaker['designation'] }}</small>
                                                @endif
                                                @if(!empty($speaker['bio']))
                                                    <p class="small text-muted mt-2">{{ Str::limit($speaker['bio'], 80) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Sponsors -->
                @if($event->sponsors && count($event->sponsors) > 0)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Sponsors</h4>
                            <div class="row text-center">
                                @foreach($event->sponsors as $sponsor)
                                    @if(!empty($sponsor['name']))
                                        <div class="col-md-4 col-6 mb-4">
                                            @if(!empty($sponsor['logo']))
                                                <img src="{{ asset($sponsor['logo']) }}" alt="{{ $sponsor['name'] }}" class="img-fluid mb-2" style="max-height: 70px;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center mb-2" style="width: 70px; height: 70px; margin:auto;">
                                                    <i class="fas fa-building text-primary"></i>
                                                </div>
                                            @endif
                                            <h6 class="mb-0">{{ $sponsor['name'] }}</h6>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Event Sidebar -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3">{{ $event->title }}</h3>
                        @if($event->short_description)
                            <p class="text-muted">{{ $event->short_description }}</p>
                        @endif

                        <!-- Event Info Grid -->
                        <div class="row g-3 mb-4">
                            @if($event->event_date)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-calendar-alt text-primary mb-2"></i>
                                        <small class="d-block text-muted">Date</small>
                                        <span class="fw-bold">{{ $event->event_date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($event->event_time)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-clock text-primary mb-2"></i>
                                        <small class="d-block text-muted">Time</small>
                                        <span class="fw-bold">{{ $event->event_time }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($event->venue)
                            <div class="col-6">
                                <div class="info-box p-3 bg-light rounded h-100 ">
                                    <i class="fas fa-building text-primary mb-2"></i>
                                    <small class="d-block text-muted">Venue</small>
                                    <span class="fw-bold">{{ $event->venue }}</span>
                                </div>
                             </div>
                            @endif
                            @if($event->location)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-map-marker-alt text-primary mb-2"></i>
                                        <small class="d-block text-muted">Location</small>
                                        <span class="fw-bold">{{ $event->location }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($event->category)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-tag text-primary mb-2"></i>
                                        <small class="d-block text-muted">Category</small>
                                        <span class="fw-bold">{{ $event->category->name }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($event->max_attendees)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-users text-primary mb-2"></i>
                                        <small class="d-block text-muted">Attendees</small>
                                        <span class="fw-bold">{{ $event->max_attendees }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Contact Information -->
                        @if($event->organizer_name || $event->contact_email || $event->contact_phone)
                            <div class="mb-4">
                                <h6 class="fw-bold">Contact Info</h6>
                                @if($event->organizer_name)
                                    <p class="mb-1"><strong>Organizer:</strong> {{ $event->organizer_name }}</p>
                                @endif
                                @if($event->contact_email)
                                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:{{ $event->contact_email }}">{{ $event->contact_email}}</a></p>
                                @endif
                                @if($event->contact_phone)
                                    <p class="mb-1"><strong>Phone:</strong> <a href="tel:{{ $event->contact_phone }}">{{ $event->contact_phone }}</a></p>
                                @endif
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Contact Us</a>
                            <a href="{{ route('eventslanding') }}" class="btn btn-outline-primary btn-lg">Back to Events</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-breadcrumb {
            position: relative;
        }
        .event-image img {
            transition: transform .3s ease;
        }
        .event-image img:hover {
            transform: scale(1.05);
        }
        .speaker-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease-in-out;
        }
    </style>
@endsection