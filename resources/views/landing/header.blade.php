<!-- Navbar start -->
<div class="container-fluid fixed-top px-0">
    <div class="container px-0">
        <div class="topbar">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8">
                    <div class="topbar-info d-flex flex-wrap">
                        <a href="#" class="text-light me-4"><i class="fas fa-envelope text-white me-2"></i>info@vaishvikwelfare.org</a>
                        <a href="#" class="text-light"><i class="fas fa-phone-alt text-white me-2"></i>+91 7860333385</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="topbar-icon d-flex align-items-center justify-content-end">
                        <a href="https://www.facebook.com/share/1BmMchvEQ6/?mibextid=wwXIfr" target="_blank" class="btn-square text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        {{-- <a href="#" class="btn-square text-white me-2"><i class="fab fa-twitter"></i></a> --}}
                        <a href="https://www.instagram.com/vaishvikwelfare?igsh=cW5kamIxOWV5OTA5" target="_blank" class="btn-square text-white me-2"><i class="fab fa-instagram"></i></a>
                        {{-- <a href="#" class="btn-square text-white me-2"><i class="fab fa-pinterest"></i></a> --}}
                        <a href="https://www.linkedin.com/company/vwfoundation/" target="_blank" class="btn-square text-white me-0"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-light bg-light navbar-expand-xl">
           <a href="{{ route('index') }}" class="navbar-brand ms-3">
    <img src="{{ asset('assetslanding/img/logo.png') }}" alt="Vaisvik" class="img-fluid" style="height: 70px;">
</a>
            <button class="navbar-toggler py-2 px-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-light" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                    <a href="{{ route('services') }}" class="nav-item nav-link">Services</a>
                    <a href="{{ route('causes') }}" class="nav-item nav-link">Causes</a>
                    <a href="{{ route('events') }}" class="nav-item nav-link">Events</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ route('blog') }}" class="dropdown-item">Blog</a>
                            <a href="{{ route('gallery') }}" class="dropdown-item">Gallery</a>
                            <a href="{{ route('volunteer') }}" class="dropdown-item">Volunteers</a>
                            <a href="#" class="dropdown-item">Donation</a>
                            <a href="#" class="dropdown-item">404 Error</a>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-flex align-items-center flex-nowrap pt-xl-0" style="margin-left: 15px;">
                    <a href="" class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-3">Donate Now</a>
                </div>
                <div class="d-flex align-items-center flex-nowrap pt-xl-0" style="margin-left: 15px;">
                    <a href="http://localhost/ngo-user" class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-3">Sign In</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->