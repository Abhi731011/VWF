<!-- Footer Start -->
<div class="container-fluid footer bg-dark text-body py-5">
    <div class="container py-0">
        <div class="row g-5">
            <!-- Section 1: About Vaishvik Welfare -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="mb-4 text-white">About Vaishvik Welfare</h4>
                    <p class="mb-4">We are committed to creating positive change in our community through education, healthcare, environmental conservation, and social welfare initiatives. Join us in making a difference.</p>
                    <a href="{{ route('admin.dashboard') }}" class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-3">Admin Login</a>
                </div>
            </div>
            
            <!-- Section 2: Our Programs -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Causes</h4>
                    @if(isset($footerData['ongoing_programs']) && $footerData['ongoing_programs']->count() > 0)
                        @foreach($footerData['ongoing_programs'] as $program)
                            <a href="{{ route('landing.causes.show', $program->slug) }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <i class="fas fa-angle-right me-2"></i> {{ $program->title }}
                            </a>
                        @endforeach
                    @else
                        <a href="{{ route('landing.causes') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-angle-right me-2"></i> Education for All</a>
                        <a href="{{ route('landing.causes') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-angle-right me-2"></i> Healthcare Support</a>
                        <a href="{{ route('landing.causes') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-angle-right me-2"></i> Environmental Conservation</a>
                        <a href="{{ route('landing.causes') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-angle-right me-2"></i> Women Empowerment</a>
                        <a href="{{ route('landing.causes') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-angle-right me-2"></i> Child Welfare</a>
                    @endif
                </div>
            </div>
            
            <!-- Section 3: Events -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Events</h4>
                    @if(isset($footerData['ongoing_events']) && $footerData['ongoing_events']->count() > 0)
                        @foreach($footerData['ongoing_events'] as $event)
                            <a href="{{ route('landing.events.show', $event->slug) }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <i class="fas fa-calendar-alt me-2"></i> {{ $event->title }}
                            </a>
                        @endforeach
                    @else
                        <a href="{{ route('landing.events') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-calendar-alt me-2"></i> Global Youth Leadership Summit</a>
                        <a href="{{ route('landing.events') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-calendar-alt me-2"></i> Environmental Awareness Campaign</a>
                        <a href="{{ route('landing.events') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-calendar-alt me-2"></i> Health Check-up Drive</a>
                        <a href="{{ route('landing.events') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-calendar-alt me-2"></i> Education Workshop</a>
                        <a href="{{ route('landing.events') }}" class="text-truncate mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-calendar-alt me-2"></i> Community Development Program</a>
                    @endif
                </div>
            </div>
            
            <!-- Section 4: Gallery -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="mb-4 text-white">Our Gallery</h4>
                    <div class="row g-2">
                        @if(isset($footerData['gallery_images']) && $footerData['gallery_images']->count() > 0)
                            @foreach($footerData['gallery_images'] as $index => $image)
                                <div class="col-4">
                                    <div class="footer-gallery">
                                        <a href="{{ route('gallerylanding') }}">
                                            <img src="{{ $image }}" class="img-fluid w-100" alt="Gallery Image {{ $index + 1 }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Fallback to static images if no dynamic images available --}}
                            <div class="col-4">
                                <div class="footer-gallery">
                                    <a href="{{ route('gallerylanding') }}">
                                        <img src="{{ asset('assetslanding/img/gallery-footer-1.jpg') }}" class="img-fluid w-100" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="footer-gallery">
                                    <a href="{{ route('gallerylanding') }}">
                                        <img src="{{ asset('assetslanding/img/gallery-footer-2.jpg') }}" class="img-fluid w-100" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="footer-gallery">
                                    <a href="{{ route('gallerylanding') }}">
                                        <img src="{{ asset('assetslanding/img/gallery-footer-3.jpg') }}" class="img-fluid w-100" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="footer-gallery">
                                    <a href="{{ route('gallerylanding') }}">
                                        <img src="{{ asset('assetslanding/img/gallery-footer-4.jpg') }}" class="img-fluid w-100" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="footer-gallery">
                                    <a href="{{ route('gallerylanding') }}">
                                        <img src="{{ asset('assetslanding/img/gallery-footer-5.jpg') }}" class="img-fluid w-100" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="footer-gallery">
                                    <a href="{{ route('gallerylanding') }}">
                                        <img src="{{ asset('assetslanding/img/gallery-footer-6.jpg') }}" class="img-fluid w-100" alt="">
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Contact Section at Bottom -->
        <div class="row mt-3 pt-4 border-top border-secondary">
            <div class="col-12">
                <div class="text-center">
                    <h5 class="text-white mb-4">Quick Contact</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-phone me-3 text-primary fs-5"></i>
                                <span class="text-body">+91 98765 43210</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-envelope me-3 text-primary fs-5"></i>
                                <span class="text-body">info@vaishvikwelfare.org</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-map-marker-alt me-3 text-primary fs-5"></i>
                                <span class="text-body">Kuber Ganj Shankar Bazar Karwi Chitrakoot</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-5 text-center text-md-start mb-md-0">
                <span class="text-white"><i class="fas fa-copyright text-light me-2"></i>
                        Vaishvik Welfare Foundation, All right reserved.
                        </span>
                {{-- <span class="text-body">
                    
                    <a href="#"><i class="fas fa-copyright text-light me-2"></i>Vaishvik Welfare</a>, All right reserved.</span> --}}
            </div>
            <div class="col-md-4 text-center">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="https://www.facebook.com/share/1BmMchvEQ6/?mibextid=wwXIfr" target="_blank" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    {{-- <a href="#" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-twitter"></i></a> --}}
                    <a href="https://www.instagram.com/vaishvikwelfare?igsh=cW5kamIxOWV5OTA5" target ="_blank" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-instagram"></i></a>
                    {{-- <a href="#" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-pinterest"></i></a> --}}
                    <a href="https://www.linkedin.com/company/vwfoundation/" target="_blank" class="btn-hover-color btn-square text-white me-0"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            {{-- <div class="col-md-4 text-center text-md-end text-body">
                Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
            </div> --}}
        </div>
    </div>
</div>
<!-- Copyright End -->