@extends('landing.master')

@section('style')
<style>
    .event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    .event-card .card-img-top {
        transition: transform 0.3s ease;
    }
    
    .event-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .event-card .card-title {
        color: #333;
        font-weight: 600;
        line-height: 1.3;
    }
    
    .event-card .card-text {
        line-height: 1.6;
    }
    
    .event-card .btn {
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .event-card .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>
@endsection

@section('content')
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Upcoming Events</h1>
                <p class="fs-5 text-white mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                
            </div>
        </div>
        <!-- Header End -->

        <!-- Events Start -->
        <div class="container-fluid event py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                    <h5 class="text-uppercase text-primary">Upcoming Events</h5>
                    <h1 class="mb-0">Help today because tomorrow you may be the one who needs more helping!</h1>
                </div>
                <div class="row">
                    @if($events->count() > 0)
                        @foreach($events as $event)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card event-card h-100 border-0 shadow-sm">
                                    @if($event->banners && count($event->banners) > 0)
                                        <img src="{{ asset($event->banners[0]) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assetslanding/img/events-1.jpg') }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between mb-3">
                                            @if($event->venue)
                                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($event->venue, 20) }}</small>
                                            @else
                                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Location TBA</small>
                                            @endif
                                            @if($event->event_date)
                                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $event->event_date->format('d M, Y') }}</small>
                                            @else
                                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>Date TBA</small>
                                            @endif
                                        </div>
                                        <h5 class="card-title mb-3">{{ Str::limit($event->title, 50) }}</h5>
                                        <p class="card-text text-muted">
                                            @if($event->short_description)
                                                {{ Str::limit($event->short_description, 100) }}
                                            @elseif($event->description)
                                                {{ Str::limit(strip_tags($event->description), 100) }}
                                            @else
                                                Join us for this exciting event! More details coming soon.
                                            @endif
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 p-4">
                                    <a class="btn btn-primary w-100" href="{{ route('landing.events.show', $event->slug) }}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- No events available - show placeholder -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center p-5">
                                    <img src="{{ asset('assetslanding/img/events-1.jpg') }}" class="img-fluid mb-4" alt="No Events" style="max-width: 300px;">
                                    <h4 class="mb-3">No Events Available</h4>
                                    <p class="text-muted mb-4">We're currently planning our next events. Check back soon for exciting updates and new opportunities to get involved!</p>
                                    <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Events End -->
@endsection