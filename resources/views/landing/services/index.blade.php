@extends('landing.master')
@section('content')

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Our Services</h3>
                <p class="fs-5 text-white mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Services</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

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
                <p class="my-4">Education & Digital Literacy – so every child can dream freely and every youth can step into the future with confidence
                </p>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="service-item">
                    <img src="{{ asset('assetslanding/img/service-2.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="service-link">
                        <a href="#" class="h4 mb-0"> Women & Youth Empowerment</a>
                    </div>
                </div>
                <p class="my-4">Women & Youth Empowerment – because true progress begins when voices that were once silenced rise strong and independent.
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="service-item">
                    <img src="{{ asset('assetslanding/img/service-3.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="service-link">
                        <a href="#" class="h4 mb-0">Health & Sanitation</a>
                    </div>
                </div>
                <p class="my-4">Health & Sanitation – ensuring that health and dignity are not privileges, but basic rights for all.
                </p>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="service-item">
                    <img src="{{ asset('assetslanding/img/service-4.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="service-link">
                        <a href="#" class="h4 mb-0">Livelihood & Environment</a>
                    </div>
                </div>
                <p class="my-4">Livelihood & Environment – creating opportunities that sustain families today while protecting nature for tomorrow.
                </p>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="service-item">
                    <img src="{{ asset('assetslanding/img/service-4.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="service-link">
                        <a href="#" class="h4 mb-0">Animal Welfare (especially for cows)</a>
                    </div>
                </div>
                <p class="my-4">Animal Welfare (especially for cows) – nurturing beings who cannot speak for themselves but deserve every ounce of love and care.</p>
            </div>
            {{-- <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">
                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- Services End -->
@endsection