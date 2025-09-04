@php
$baseurl = asset('projects');
@endphp

@extends('landing.master')

@section('content')
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">{{ $project->title }}</h3>
                <p class="fs-5 text-white mb-4">{{ $project->short_description ?? 'Support this important cause!' }}</p>
                
            </div>
        </div>
        
        <!-- Header End -->

        <!-- Project Details Start -->
    <div class="container py-5">
        <div class="row g-5">
            <!-- Project Images/Media -->
            <div class="col-lg-7">
                <div class="project-image rounded overflow-hidden shadow-sm">
                    @if($project->images && count($project->images) > 0)
                        @if(count($project->images) > 1)
                            <!-- Image Slider for Multiple Images -->
                            <div id="carousel-{{ $project->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($project->images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ $baseurl . '/' . $project->slug . '/' . basename($image) }}" class="d-block w-100" alt="{{ $project->title }} Image" style="object-fit: cover; height: 400px;">
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
                        @else
                            <!-- Single Image -->
                            <img src="{{ $baseurl . '/' . $project->slug . '/' . basename($project->images[0]) }}" class="img-fluid w-100" alt="{{ $project->title }} Image" style="object-fit: cover; height: 400px;">
                        @endif
                    @else
                        <img src="{{ asset('assetslanding/img/causes-4.jpg') }}" class="img-fluid w-100" alt="{{ $project->title }}" style="object-fit: cover; height: 400px;">
                    @endif
                </div>

                <!-- Project Description -->
                @if($project->description)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">About This Project</h4>
                            <div class="project-description">
                                {!! $project->description !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Project Video -->
                @if($project->video_file)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Project Video</h4>
                            <video class="w-100 rounded" style="max-height: 400px;" controls>
                                <source src="{{ $baseurl . '/' . $project->slug . '/' . basename($project->video_file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                @endif

                @if($project->video_url)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Project Video</h4>
                            <a href="{{ $project->video_url }}" target="_blank" class="btn btn-primary btn-lg">Watch Video</a>
                        </div>
                    </div>
                @endif

                <!-- Project Updates -->
                @if($project->updates && count($project->updates) > 0)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Project Updates</h4>
                            @foreach ($project->updates as $update)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $update['date'] ?? 'N/A' }}</h6>
                                        <p class="card-text">{{ $update['content'] ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Project FAQs -->
                @if($project->faqs && count($project->faqs) > 0)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Frequently Asked Questions</h4>
                            <div class="accordion" id="faqAccordion-{{ $project->id }}">
                                @foreach ($project->faqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqHeading-{{ $project->id }}-{{ $index }}">
                                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse-{{ $project->id }}-{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="faqCollapse-{{ $project->id }}-{{ $index }}">
                                                {{ $faq['question'] ?? 'N/A' }}
                                            </button>
                                        </h2>
                                        <div id="faqCollapse-{{ $project->id }}-{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="faqHeading-{{ $project->id }}-{{ $index }}" data-bs-parent="#faqAccordion-{{ $project->id }}">
                                            <div class="accordion-body">
                                                {{ $faq['answer'] ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Project Sidebar -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3">{{ $project->title }}</h3>
                        @if($project->short_description)
                            <p class="text-muted">{{ $project->short_description }}</p>
                        @endif

                        <!-- Project Info Grid -->
                        <div class="row g-3 mb-4">
                            @if($project->target_amount)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-chart-bar text-primary mb-2"></i>
                                        <small class="d-block text-muted">Goal</small>
                                        <span class="fw-bold">${{ number_format($project->target_amount, 2) }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->category)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-tag text-primary mb-2"></i>
                                        <small class="d-block text-muted">Category</small>
                                        <span class="fw-bold">{{ $project->category->name }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->location)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-map-marker-alt text-primary mb-2"></i>
                                        <small class="d-block text-muted">Location</small>
                                        <span class="fw-bold">{{ $project->location }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->status)
                                <div class="col-6">
                                    <div class="info-box p-3 bg-light rounded h-100">
                                        <i class="fas fa-info-circle text-primary mb-2"></i>
                                        <small class="d-block text-muted">Status</small>
                                        <span class="fw-bold">{{ ucfirst($project->status) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Contact Information -->
                        @if($project->organizer_name || $project->contact_email || $project->contact_phone)
                            <div class="mb-4">
                                <h6 class="fw-bold">Contact Info</h6>
                                @if($project->organizer_name)
                                    <p class="mb-1"><strong>Organizer:</strong> {{ $project->organizer_name }}</p>
                                @endif
                                @if($project->contact_email)
                                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:{{ $project->contact_email }}">{{ $project->contact_email}}</a></p>
                                @endif
                                @if($project->contact_phone)
                                    <p class="mb-1"><strong>Phone:</strong> <a href="tel:{{ $project->contact_phone }}">{{ $project->contact_phone }}</a></p>
                                @endif
                            </div>
                        @endif

                        <!-- Project Tags -->
                        @if($project->tags && count($project->tags) > 0)
                            <div class="mb-4">
                                <h6 class="fw-bold">Tags</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($project->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Project Documents -->
                        @if($project->documents && count($project->documents) > 0)
                            <div class="mb-4">
                                <h6 class="fw-bold">Documents</h6>
                                <ul class="list-unstyled">
                                    @foreach ($project->documents as $document)
                                        <li class="mb-2">
                                            <a href="{{ $baseurl . '/' . $project->slug . '/' . basename($document) }}" target="_blank" class="text-primary">
                                                <i class="fas fa-file-pdf me-2"></i>{{ basename($document) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('donate', $project->id) }}" class="btn btn-primary btn-lg">Donate Now</a>
                            <a href="{{ route('causes') }}" class="btn btn-outline-primary btn-lg">Back to Causes</a>
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
        .project-image img {
            transition: transform .3s ease;
        }
        .project-image img:hover {
            transform: scale(1.05);
        }
        .info-box {
            transition: all 0.3s ease-in-out;
        }
        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
    </style>
@endsection
