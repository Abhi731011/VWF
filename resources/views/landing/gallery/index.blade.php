@extends('landing.master')

@section('style')
<style>
    
    .gallery-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .gallery-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
    }
    
    .gallery-card .card-img-top {
        transition: transform 0.3s ease;
        height: 250px;
        object-fit: cover;
        border-radius: 0;
    }
    
    .gallery-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .gallery-card .card-body {
        padding: 20px;
        background: #fff;
    }
    
    .gallery-card .card-title {
        color: #333;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 10px;
        font-size: 16px;
    }
    
    .gallery-card .card-text {
        line-height: 1.6;
        color: #666;
        font-size: 14px;
        margin: 0;
    }
</style>
@endsection

@section('content')
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Our Gallery</h3>
                <p class="fs-5 text-white mb-4">Capturing moments of hope, compassion, and positive change in our community!</p>
            </div>
        </div>
        <!-- Header End -->

        <!-- Gallery Start -->
        <div class="container-fluid gallery py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                    <h5 class="text-uppercase text-primary">Photo Gallery</h5>
                    <h1 class="mb-0">Capturing moments of hope, compassion, and positive change in our community!</h1>
                </div>
                
                 @if($galleries->count() > 0)
                     <div class="row">
                         @foreach($galleries as $gallery)
                             @if($gallery->images && count($gallery->images) > 0)
                                 @foreach($gallery->images as $index => $imageData)
                                     <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                                         <div class="card gallery-card h-100">
                                             <img src="{{ asset($imageData['image']) }}" 
                                                  alt="{{ $imageData['description'] ?? 'Gallery Image' }}" 
                                                  class="card-img-top">
                                             @if(isset($imageData['description']) && $imageData['description'])
                                                 <div class="card-body">
                                                     <h6 class="card-title">{{ $imageData['description'] }}</h6>
                                                 </div>
                                             @endif
                                         </div>
                                     </div>
                                 @endforeach
                             @endif
                         @endforeach
                     </div>
                @else
                    <!-- No gallery images available - show placeholder -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center p-5">
                                    <img src="{{ asset('assetslanding/img/events-1.jpg') }}" class="img-fluid mb-4" alt="No Gallery Images" style="max-width: 300px;">
                                    <h4 class="mb-3">Gallery Coming Soon</h4>
                                    <p class="text-muted mb-4">We're currently updating our gallery with new photos. Check back soon to see our latest activities and events!</p>
                                    <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- Gallery End -->
@endsection
