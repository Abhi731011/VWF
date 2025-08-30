@php
$baseurl = asset('projects');
@endphp

@extends('landing.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Recent Causes</h3>
        <p class="fs-5 text-white mb-4">Support our initiatives to make a difference in communities worldwide.</p>
        <ol class="breadcrumb justify-content-center mb-0">
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> --}}
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Causes</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Causes Start -->
<div class="container-fluid causes py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5" style="max-width: 800px;">
            <h5 class="text-uppercase text-primary">Recent Causes</h5>
            <h1 class="mb-4">Support Our Projects</h1>
            <p class="mb-0">Join us in making a positive impact through our carefully curated projects.</p>
        </div>
        <div class="row g-4">
            @if ($projects->isEmpty())
                <div class="col-12 text-center">
                    <p>No projects available at the moment.</p>
                </div>
            @else
                @foreach ($projects as $project)
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
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#" data-bs-toggle="modal" data-bs-target="#projectModal-{{ $project->id }}">Read More</a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Project Details -->
                    <div class="modal fade" id="projectModal-{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel-{{ $project->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h4 class="modal-title" id="projectModalLabel-{{ $project->id }}">{{ $project->title }}</h4>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-5">
                                    <div class="row">
                                        <!-- Images/Video Section -->
                                        <div class="col-lg-6 mb-4">
                                            @if ($project->images && count($project->images) > 1)
                                                <div id="modal-carousel-{{ $project->id }}" class="carousel slide mb-4" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach ($project->images as $index => $image)
                                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                <img src="{{ $baseurl . '/' . $project->slug . '/' . basename($image) }}" class="d-block w-100 rounded" alt="{{ $project->title }} Image" style="object-fit: cover; height: 300px;">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#modal-carousel-{{ $project->id }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#modal-carousel-{{ $project->id }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            @elseif ($project->images && count($project->images) == 1)
                                                <img src="{{ $baseurl . '/' . $project->slug . '/' . basename($project->images[0]) }}" class="d-block w-100 rounded mb-4" alt="{{ $project->title }} Image" style="object-fit: cover; height: 300px;">
                                            @else
                                                <p class="text-muted">No images available.</p>
                                            @endif
                                            @if ($project->video_file)
                                                <div class="mb-4">
                                                    <h5 class="fw-bold mb-3">Video</h5>
                                                    <video class="w-100 rounded" style="max-height: 300px;" controls>
                                                        <source src="{{ $baseurl . '/' . $project->slug . '/' . basename($project->video_file) }}" type="video/mp4">
                                                    </video>
                                                </div>
                                            @endif
                                            @if ($project->video_url)
                                                <h5 class="fw-bold mb-3">Video Link</h5>
                                                <p><a href="{{ $project->video_url }}" target="_blank" class="btn btn-outline-primary">Watch Video</a></p>
                                            @endif
                                        </div>
                                        <!-- Details Section -->
                                        <div class="col-lg-6">
                                            <h5 class="fw-bold mb-3">Short Description</h5>
                                            <p class="text-muted mb-4">{{ $project->short_description ?? 'No short description available.' }}</p>
                                            <h5 class="fw-bold mb-3">Description</h5>
                                            <p class="text-muted mb-4">{{ $project->description ?? 'No description available.' }}</p>
                                            <h5 class="fw-bold mb-3">Category</h5>
                                            <p class="text-muted mb-4">{{ $project->category ? $project->category->name : 'No category assigned.' }}</p>
                                            <h5 class="fw-bold mb-3">Target Amount</h5>
                                            <p class="text-muted mb-4">${{ number_format($project->target_amount ?? 0, 2) }}</p>
                                            <h5 class="fw-bold mb-3">Details</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><strong>Organizer:</strong> {{ $project->organizer_name ?? 'N/A' }}</li>
                                                <li class="mb-2"><strong>Contact Email:</strong> {{ $project->contact_email ?? 'N/A' }}</li>
                                                <li class="mb-2"><strong>Contact Phone:</strong> {{ $project->contact_phone ?? 'N/A' }}</li>
                                                <li class="mb-2"><strong>Location:</strong> {{ $project->location ?? 'N/A' }}</li>
                                                <li class="mb-2"><strong>Status:</strong> {{ ucfirst($project->status ?? 'N/A') }}</li>
                                                <li class="mb-2"><strong>Recurring:</strong> {{ $project->is_recurring ? 'Yes' : 'No' }}</li>
                                                <li class="mb-2"><strong>Featured:</strong> {{ $project->is_featured ? 'Yes' : 'No' }}</li>
                                                <li class="mb-2"><strong>Visibility:</strong> {{ $project->visibility ? 'Visible' : 'Hidden' }}</li>
                                            </ul>
                                            @if ($project->tags)
                                                <h5 class="fw-bold mb-3">Tags</h5>
                                                <p class="text-muted mb-4">{{ implode(', ', $project->tags) }}</p>
                                            @endif
                                            @if ($project->documents)
                                                <h5 class="fw-bold mb-3">Documents</h5>
                                                <ul class="list-unstyled">
                                                    @foreach ($project->documents as $document)
                                                        <li class="mb-2"><a href="{{ $baseurl . '/' . $project->slug . '/' . basename($document) }}" target="_blank" class="text-primary">{{ basename($document) }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if ($project->faqs)
                                                <h5 class="fw-bold mb-3">FAQs</h5>
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
                                            @endif
                                            @if ($project->updates)
                                                <h5 class="fw-bold mb-3">Updates</h5>
                                                @foreach ($project->updates as $update)
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <h6 class="card-title">{{ $update['date'] ?? 'N/A' }}</h6>
                                                            <p class="card-text">{{ $update['content'] ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <a class="btn btn-primary" href="{{ route('donate', $project->id) }}">Donate Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- Causes End -->

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
</style>
@endsection
@endsection