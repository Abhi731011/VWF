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
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{ route('landing.causes.show', $project->slug) }}">Read More</a>
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