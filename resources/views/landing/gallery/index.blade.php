@extends('landing.master')

@section('style')
<style>
    .gallery-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    .gallery-card .card-img-top {
        transition: transform 0.3s ease;
        height: 250px;
        object-fit: cover;
    }
    
    .gallery-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .gallery-card .card-title {
        color: #333;
        font-weight: 600;
        line-height: 1.3;
    }
    
    .gallery-card .card-text {
        line-height: 1.6;
    }
    
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .gallery-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .gallery-item img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.9));
        color: white;
        padding: 25px 20px 20px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
        backdrop-filter: blur(2px);
    }
    
    .gallery-item:hover .gallery-overlay {
        transform: translateY(0);
    }
    
    .gallery-description {
        text-align: center;
        font-weight: 600;
        font-size: 16px;
        line-height: 1.4;
        margin: 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
    }
    
    /* Alternative caption style (for descriptions below images) */
    .gallery-caption {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 0 0 10px 10px;
        border-top: 1px solid #e9ecef;
    }
    
    .gallery-description-text {
        text-align: center;
        font-weight: 500;
        font-size: 14px;
        color: #495057;
        margin: 0;
        line-height: 1.5;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-top: 30px;
    }
    
    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
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
                     <div class="gallery-grid">
                         @foreach($galleries as $gallery)
                             @if($gallery->images && count($gallery->images) > 0)
                                 @foreach($gallery->images as $index => $imageData)
                                     <div class="gallery-item">
                                         <img src="{{ asset($imageData['image']) }}" alt="{{ $imageData['description'] ?? 'Gallery Image' }}" class="img-fluid">
                                         @if(isset($imageData['description']) && $imageData['description'])
                                             <div class="gallery-overlay">
                                                 <p class="gallery-description">{{ $imageData['description'] }}</p>
                                             </div>
                                         @endif
                                         <!-- Alternative: Description below image (uncomment to use) -->
                                         {{-- @if(isset($imageData['description']) && $imageData['description'])
                                             <div class="gallery-caption">
                                                 <p class="gallery-description-text">{{ $imageData['description'] }}</p>
                                             </div>
                                         @endif --}}
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
