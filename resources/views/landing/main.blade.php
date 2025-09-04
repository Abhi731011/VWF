@php
$baseurl = asset('projects');
@endphp

@extends('landing.master')

@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Carousel Start -->
    <div class="container-fluid carousel-header vh-100 px-0">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ asset('assetslanding/img/carousel-1.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Because Every Life Matters</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">Serving Humanity, Nature & Animals Alike
                            </h1>
                            <p class="mb-5 fs-5">India’s first integrated welfare movement nurturing life in all its forms
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="https://vaishvikwelfare.org/user/register">Join With Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assetslanding/img/carousel-2.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Because Every Life Matters</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">Serving Humanity, Nature & Animals Alike
                            </h1>
                            <p class="mb-5 fs-5">India’s first integrated welfare movement nurturing life in all its forms
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="https://vaishvikwelfare.org/user/register">Join With Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assetslanding/img/carousel-3.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Because Every Life Matters</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">Serving Humanity, Nature & Animals Alike
                            </h1>
                            <p class="mb-5 fs-5">India’s first integrated welfare movement nurturing life in all its forms
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="https://vaishvikwelfare.org/user/register">Join With Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-5">
                    <div class="h-100">
                        <img src="{{ asset('assetslanding/img/about-1.jpg') }}" class="img-fluid w-100 h-100"
                            alt="Image">
                    </div>
                </div>
                <div class="col-xl-7">
                    <h5 class="text-uppercase text-primary">About Us</h5>
                    <h1 class="mb-4">Serving the world Alike</h1>
                    <p class="fs-5 mb-4">At Vaishvik Welfare Foundation, we believe that humans, animals, and nature are
                        deeply connected — and so should be our approach to welfare. While most NGOs work in silos, focusing
                        on just one issue, we’re bridging those gaps to create a holistic, sustainable future for all.
                    </p>
                    <div class="tab-class bg-secondary p-4">
                        <ul class="nav d-flex mb-2">
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 text-center bg-white active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 150px;">About</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 mx-3 text-center bg-white" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 150px;">Mission</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 text-center bg-white" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 150px;">Vision</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <p class="mb-4">At Vaishvik Welfare Foundation, we believe that humans,
                                                    animals, and nature are deeply connected — and so should be our approach
                                                    to welfare. While most NGOs work in silos, focusing on just one issue,
                                                    we're bridging those gaps to create a holistic, sustainable future for
                                                    all.
                                                </p>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                                        href="{{ route('about') }}">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane fade show p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <p class="mb-4">Vaishvik Welfare Foundation pioneers integrated welfare —
                                                    serving rural communities, conserving nature, and uplifting animals
                                                    through compassionate service, ecological innovation, and inclusive
                                                    development. With a special focus on cow protection.
                                                </p>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                                        href="{{ route('about') }}">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane fade show p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <p class="mb-4">To lead a new era of social transformation where rural
                                                    communities thrive, animals are protected with dignity, and nature is
                                                    preserved — all through compassion-driven action, inclusive growth, and
                                                    sustainable innovation for generations ahead.
                                                </p>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                                        href="{{ route('about') }}">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Services Start -->
    <div class="container-fluid service py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">What we do</h5>
                <h1 class="mb-0">What we do to protect environment</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="service-item">
                        <img src="{{ asset('assetslanding/img/service-1.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="service-link">
                            <a href="#" class="h4 mb-0">Education & Digital Literacy</a>
                        </div>
                    </div>
                    <p class="my-4">Education & Digital Literacy – so every child can dream freely and every youth can
                        step into the future with confidence
                    </p>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="service-item">
                        <img src="{{ asset('assetslanding/img/service-2.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="service-link">
                            <a href="#" class="h4 mb-0"> Women & Youth Empowerment</a>
                        </div>
                    </div>
                    <p class="my-4">Women & Youth Empowerment – because true progress begins when voices that were once
                        silenced rise strong and independent.
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="service-item">
                        <img src="{{ asset('assetslanding/img/service-3.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="service-link">
                            <a href="#" class="h4 mb-0">Health & Sanitation</a>
                        </div>
                    </div>
                    <p class="my-4">Health & Sanitation – ensuring that health and dignity are not privileges, but basic
                        rights for all.
                    </p>
                </div>
                {{-- <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="service-item">
                    <img src="{{ asset('assetslanding/img/service-4.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="service-link">
                        <a href="#" class="h4 mb-0">Livelihood & Environment</a>
                    </div>
                </div>
                <p class="my-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                </p>
            </div> --}}
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="service-item">
                        <img src="{{ asset('assetslanding/img/service-4.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="service-link">
                            <a href="#" class="h4 mb-0">Animal Welfare (especially for cows)</a>
                        </div>
                    </div>
                    <p class="my-4">Animal Welfare (especially for cows) – nurturing beings who cannot speak for
                        themselves but deserve every ounce of love and care.</p>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{route('services')}}">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Counter Start -->
    <div class="container-fluid counter py-5"
        style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, 0.4)), url({{ asset('assetslanding/img/volunteers-bg.jpg') }}) center center; background-size: cover;">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Achievements</h5>
                <p class="text-white mb-0">At Vaishvik Welfare Foundation, we believe that behind every number lies a
                    heartbeat, a smile, and a story of change. What may look like statistics to many are, for us, moments of
                    compassion turned into action. Together with our volunteers, donors, and well-wishers, we are weaving a
                    world where people, animals, and nature live in harmony.
                </p>
            </div>
            {{-- <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-user-graduate fa-4x text-white"></i>

                        <h3 class="text-white my-4">Children Educated</h3>
                        <div class="counter-counting">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">1500</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-tree fa-4x text-white"></i>
                        <h3 class="text-white my-4">Trees Planted</h3>
                        <div class="counter-counting text-center border-white w-100"
                            style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">500</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-user fa-4x text-white"></i>
                        <h3 class="text-white my-4">Volunteers Engaged</h3>
                        <div class="counter-counting text-center border-white w-100"
                            style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">900</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-heart fa-4x text-white"></i>
                        <h3 class="text-white my-4">Health Beneficiaries</h3>
                        <div class="counter-counting text-center border-white w-100"
                            style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">500</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="https://vaishvikwelfare.org/user/register">Join With Us</a>
                    </div>
                </div>
            </div> --}}
            <div class="row g-4">
    <div class="col-md-6 col-lg-6 col-xl-3 d-flex">
        <div class="counter-item text-center border p-5 h-100 w-100">
            <i class="fas fa-user-graduate fa-4x text-white"></i>
            <h3 class="text-white my-4">Children Educated</h3>
            <div class="counter-counting">
                <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">1500</span>
                <span class="h1 fw-bold text-primary">+</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3 d-flex">
        <div class="counter-item text-center border p-5 h-100 w-100">
            <i class="fas fa-tree fa-4x text-white"></i>
            <h3 class="text-white my-4"> Totals Trees Planted</h3>
            <div class="counter-counting text-center border-white w-100"
                style="border-style: dotted; font-size: 30px;">
                <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">500</span>
                <span class="h1 fw-bold text-primary">+</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3 d-flex">
        <div class="counter-item text-center border p-5 h-100 w-100">
            <i class="fas fa-user fa-4x text-white"></i>
            <h3 class="text-white my-4">Volunteers Engaged</h3>
            <div class="counter-counting text-center border-white w-100"
                style="border-style: dotted; font-size: 30px;">
                <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">900</span>
                <span class="h1 fw-bold text-primary">+</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3 d-flex">
        <div class="counter-item text-center border p-5 h-100 w-100">
            <i class="fas fa-heart fa-4x text-white"></i>
            <h3 class="text-white my-4">Health Beneficiaries</h3>
            <div class="counter-counting text-center border-white w-100"
                style="border-style: dotted; font-size: 30px;">
                <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">500</span>
                <span class="h1 fw-bold text-primary">+</span>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-center">
            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="https://vaishvikwelfare.org/user/register">Join With Us</a>
        </div>
    </div>
</div>

        </div>
    </div>
    <!-- Counter End -->

    <!-- Causes Start -->
    <div class="container-fluid causes py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Recent Causes</h5>
                <h1 class="mb-4">Support Our Projects</h1>
                <p class="mb-0">Join us in making a positive impact through our carefully curated projects.</p>
            </div>
            <div class="row g-4">
                @if (!$projects || $projects->isEmpty())
                    <div class="col-12 text-center">
                        <p>No projects available at the moment.</p>
                    </div>
                @else
                    @foreach ($projects->take(4) as $project)
                        <div class="col-lg-6 col-xl-3">
                            <div class="causes-item">
                                <div class="causes-img">
                                    @if ($project->images && count($project->images) > 1)
                                        <!-- Image Slider for Multiple Images -->
                                        <div id="carousel-{{ $project->id }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($project->images as $index => $image)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ $baseurl . '/' . $project->slug . '/' . basename($image) }}" class="img-fluid w-100" alt="{{ $project->title }} Image" style="object-fit: cover; height: 200px;">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $project->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $project->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @elseif ($project->images && count($project->images) == 1)
                                        <!-- Single Image -->
                                        <img src="{{ $baseurl . '/' . $project->slug . '/' . basename($project->images[0]) }}" class="img-fluid w-100" alt="{{ $project->title }} Image" style="object-fit: cover; height: 200px;">
                                    @else
                                        <!-- Fallback Image -->
                                        <img src="{{ asset('assetslanding/img/causes-4.jpg') }}" class="img-fluid w-100" alt="Default Image" style="object-fit: cover; height: 200px;">
                                    @endif
                                    <div class="causes-link pb-2 px-3">
                                        <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: ${{ number_format($project->target_amount ?? 0, 2) }}</small>
                                    </div>
                                    <div class="causes-dination p-2">
                                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="{{ route('donate', $project->id) }}">Donate Now</a>
                                    </div>
                                </div>
                                <div class="causes-content p-4">
                                    <h4 class="mb-3">{{ $project->title }}</h4>
                                    <p class="mb-4">{{ Str::limit($project->short_description ?? 'No description available.', 100) }}</p>
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{route('landing.causes.show', $project->slug)}}">Read More</a>
                                </div>
                            </div>
                        </div>

                      
                    @endforeach
                @endif
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{ route('causes') }}">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Causes End -->

    <!-- Events Start -->
    <div class="container-fluid event py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Upcoming Events</h5>
                <h1 class="mb-0">Help today because tomorrow you may be the one who needs more helping!</h1>
            </div>
            
            @if($events->isEmpty())
                <!-- Fallback content when no events are available -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="card event-card h-100 border-0 shadow-sm">
                            <img src="{{ asset('assetslanding/img/events-1.jpg') }}" class="card-img-top" alt="No Events Available" style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Coming Soon</small>
                                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>TBA</small>
                                </div>
                                <h5 class="card-title mb-3">No Events Available</h5>
                                <p class="card-text text-muted">We are working on bringing you exciting events. Stay tuned for updates!</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 p-4">
                                <a class="btn btn-primary w-100" href="{{ route('eventslanding') }}">View All Events</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
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
                                        @if($event->venue || $event->location)
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                @if($event->venue && $event->location)
                                                    {{ Str::limit($event->venue . ', ' . $event->location, 20) }}
                                                @elseif($event->venue)
                                                    {{ Str::limit($event->venue, 20) }}
                                                @else
                                                    {{ Str::limit($event->location, 20) }}
                                                @endif
                                            </small>
                                        @else
                                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Location TBA</small>
                                        @endif
                                        
                                        @if($event->event_date)
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $event->event_date->format('d M, Y') }}
                                            </small>
                                        @else
                                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>Date TBA</small>
                                        @endif
                                    </div>
                                    
                                    <h5 class="card-title mb-3">
                                        @if($event->title)
                                            {{ Str::limit($event->title, 50) }}
                                        @else
                                            Event Title
                                        @endif
                                    </h5>
                                    
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
                                    @if($event->slug)
                                <a class="btn-hover-bg  btn-primary text-white py-2 px-4 w-300" href="{{ route('landing.causes.show', $project->slug) }}">Read More</a>
                                                           @else
                                        <a class="btn btn-primary w-100" href="{{ route('eventslanding') }}">View Events</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <!-- View All Events Button -->
            
            <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{ route('eventslanding') }}">View All</a>
                    </div>
                </div>
        </div>
    </div>
    <!-- Events End -->

    <!-- Blog Start -->
    <!-- <div class="container-fluid blog py-5 mb-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Latest News</h5>
                <h1 class="mb-0">Help today because tomorrow you may be the one who needs more helping!
                </h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('assetslanding/img/blog-1.jpg') }}" class="img-fluid w-100"
                                alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                    <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="{{ asset('assetslanding/img/blog-1.jpg') }}" data-lightbox="Blog-1"
                                    class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 ">
                            <h4 class="mb-4">Save The Topic Forests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed
                                eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('assetslanding/img/blog-2.jpg') }}" class="img-fluid w-100"
                                alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                    <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="{{ asset('assetslanding/img/blog-2.jpg') }}" data-lightbox="Blog-2"
                                    class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 ">
                            <h4 class="mb-4">Save The Topic Forests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed
                                eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('assetslanding/img/blog-3.jpg') }}" class="img-fluid w-100"
                                alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                    <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="{{ asset('assetslanding/img/blog-3.jpg') }}" data-lightbox="Blog-3"
                                    class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 ">
                            <h4 class="mb-4">Save The Topic Forests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed
                                eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('assetslanding/img/blog-4.jpg') }}" class="img-fluid w-100"
                                alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                    <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="{{ asset('assetslanding/img/blog-4.jpg') }}" data-lightbox="Blog-4"
                                    class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 ">
                            <h4 class="mb-4">Save The Topic Forests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed
                                eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Blog End -->

    <!-- Gallery Start -->
    <div class="container-fluid gallery py-5 px-0">
        <div class="text-center mx-auto pb-5" style="max-width: 800px;">
            <h5 class="text-uppercase text-primary">Our work</h5>
            <h1 class="mb-4">We consider environment welfare</h1>
            <p class="mb-0">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor
                ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
        </div>
        <div class="row g-0">
            <div class="col-lg-4">
                <div class="gallery-item">
                    <img src="{{ asset('assetslanding/img/gallery-2.jpg') }}" class="img-fluid w-100" alt="">
                    <div class="search-icon">
                        <a href="{{ asset('assetslanding/img/gallery-2.jpg') }}" data-lightbox="gallery-2"
                            class="my-auto"><i
                                class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                    </div>
                    <div class="gallery-content">
                        <div class="gallery-inner pb-5">
                            <a href="#" class="h4 text-white">Beauty Of Life</a>
                            <a href="#" class="text-white">
                                <p class="mb-0">Gallery Name</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assetslanding/img/gallery-3.jpg') }}" class="img-fluid w-100" alt="">
                    <div class="search-icon">
                        <a href="{{ asset('assetslanding/img/gallery-3.jpg') }}" data-lightbox="gallery-3"
                            class="my-auto"><i
                                class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                    </div>
                    <div class="gallery-content">
                        <div class="gallery-inner pb-5">
                            <a href="#" class="h4 text-white">Beauty Of Life</a>
                            <a href="#" class="text-white">
                                <p class="mb-0">Gallery Name</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="gallery-item">
                    <img src="{{ asset('assetslanding/img/gallery-1.jpg') }}" class="img-fluid w-100" alt="">
                    <div class="search-icon">
                        <a href="{{ asset('assetslanding/img/gallery-1.jpg') }}" data-lightbox="gallery-1"
                            class="my-auto"><i
                                class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                    </div>
                    <div class="gallery-content">
                        <div class="gallery-inner pb-5">
                            <a href="#" class="h4 text-white">Beauty Of Life</a>
                            <a href="#" class="text-white">
                                <p class="mb-0">Gallery Name</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="gallery-item">
                    <img src="{{ asset('assetslanding/img/gallery-4.jpg') }}" class="img-fluid w-100" alt="">
                    <div class="search-icon">
                        <a href="{{ asset('assetslanding/img/gallery-4.jpg') }}" data-lightbox="gallery-4"
                            class="my-auto"><i
                                class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                    </div>
                    <div class="gallery-content">
                        <div class="gallery-inner pb-5">
                            <a href="#" class="h4 text-white">Beauty Of Life</a>
                            <a href="#" class="text-white">
                                <p class="mb-0">Gallery Name</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assetslanding/img/gallery-5.jpg') }}" class="img-fluid w-100" alt="">
                    <div class="search-icon">
                        <a href="{{ asset('assetslanding/img/gallery-5.jpg') }}" data-lightbox="gallery-5"
                            class="my-auto"><i
                                class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                    </div>
                    <div class="gallery-content">
                        <div class="gallery-inner pb-5">
                            <a href="#" class="h4 text-white">Beauty Of Life</a>
                            <a href="#" class="text-white">
                                <p class="mb-0">Gallery Name</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

    <!-- Volunteers Start -->
    <div class="container-fluid volunteer py-5 mt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="volunteer-img">
                                <img src="{{ asset('assetslanding/img/volunteers-1.jpg') }}" class="img-fluid w-100"
                                    alt="Image">
                                <div class="volunteer-title">
                                    <h5 class="mb-2 text-white">Michel Brown</h5>
                                    <p class="mb-0 text-white">Communicator</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="volunteer-img">
                                <img src="{{ asset('assetslanding/img/volunteers-3.jpg') }}" class="img-fluid w-100"
                                    alt="Image">
                                <div class="volunteer-title">
                                    <h5 class="mb-2 text-white">Michel Brown</h5>
                                    <p class="mb-0 text-white">Communicator</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="volunteer-img">
                                <img src="{{ asset('assetslanding/img/volunteers-2.jpg') }}" class="img-fluid w-100"
                                    alt="Image">
                                <div class="volunteer-title">
                                    <h5 class="mb-2 text-white">Michel Brown</h5>
                                    <p class="mb-0 text-white">Communicator</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="volunteer-img">
                                <img src="{{ asset('assetslanding/img/volunteers-4.jpg') }}" class="img-fluid w-100"
                                    alt="Image">
                                <div class="volunteer-title">
                                    <h5 class="mb-2 text-white">Michel Brown</h5>
                                    <p class="mb-0 text-white">Communicator</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h5 class="text-uppercase text-primary">Become a Volunteer?</h5>
                    <h1 class="mb-4">Join your hand with us for a better life and beautiful future.</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod
                        tempor amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor amet consectur adip
                        sed eiusmod amet consectur adip sed eiusmod tempor.
                    </p>
                    <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> We are friendly to each other.</p>
                    <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> If you join with us,We will give
                        you free training.</p>
                    <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> Its an opportunity to help poor
                        Environments.</p>
                    <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> No goal requirements.</p>
                    <p class="text-dark mb-5"><i class=" fa fa-check text-primary me-2"></i> Joining is tottaly free. We
                        dont need any money from you.</p>
                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="https://vaishvikwelfare.org/user/register">Join With Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Volunteers End -->

@section('styles')
<style>
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }
    .modal-body {
        background-color: #f8f9fa;
    }
    .modal-body h5 {
        color: #1a73e8;
        font-size: 1.25rem;
    }
    .modal-body p, .modal-body li {
        font-size: 1rem;
        line-height: 1.6;
    }
    .accordion-button {
        font-weight: 500;
        background-color: #fff;
    }
    .accordion-body {
        background-color: #f1f3f5;
    }
    .card {
        border: none;
        background-color: #fff;
    }
    .causes-img img {
        border-radius: 8px 8px 0 0;
    }
    .causes-content {
        background-color: #fff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Event Card Styles */
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
@endsection

