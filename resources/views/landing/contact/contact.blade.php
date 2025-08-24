@extends('landing.master')
@section('content')
  <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->
         <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Contact Us</h1>
                <p class="fs-5 text-white mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Contact</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->
  <!-- Contact Start -->
        <div class="container-fluid bg-light py-5">
            <div class="container py-5">
                <div class="contact p-5">
                    <div class="row g-4">
                        <div class="col-xl-5">
                            <h1 class="mb-4">Get in touch</h1>
                            <p class="mb-4">Every message we receive carries a spark of hope. At Vaishvik Welfare Foundation, we see it as another heartbeat joining our mission of compassion. Whether you wish to volunteer, support, or simply share your thoughts, we’d love to hear from you. Together, let’s create a kinder world.
                                 {{-- <a class="text-dark fw-bold" href="https://htmlcodex.com/contact-form">Download Now</a> --}}
                                </p>
                            <form>
                                <div class="row gx-4 gy-3">
                                    <div class="col-xl-6">
                                        <input type="text" class="form-control bg-white border-0 py-3 px-4" placeholder="Your First Name">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="email" class="form-control bg-white border-0 py-3 px-4" placeholder="Your Email">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="text" class="form-control bg-white border-0 py-3 px-4" placeholder="Your Phone">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="text" class="form-control bg-white border-0 py-3 px-4" placeholder="Subject">
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control bg-white border-0 py-3 px-4" rows="7" cols="10" placeholder="Your Message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn-hover-bg btn btn-primary w-100 py-3 px-5" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-7">
                            <div>
                                <div class="row g-4">
                                    <div class="col-lg-5">
                                        <div class="bg-white p-4">
                                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                                            <h4>Address</h4>
                                            <p class="mb-0">Plot No - 149,150 Kuber Ganj Shankar Bazar Karwi Chitrakoot - 210205</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="bg-white p-4">
                                            <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                                            <h4>Reach Out To Us</h4>
                                            <p class="mb-0">info@vaishvikwelfare.org</p>
                                                                                        <p class="mb-0">(+91) 7860333385</p>

                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-5">
                                        <div class="bg-white p-4">
                                            <i class="fa fa-phone-alt fa-2x text-primary mb-2"></i>
                                            <h4>Telephone</h4>
                                            <p class="mb-0">(+91) 7860333385</p>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.4958242227235!2d80.91515337555823!3d25.220219730767443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3984af3f01e15845%3A0x42f1766064c39383!2sACHIEVERS%20WELLNESS!5e0!3m2!1sen!2sin!4v1756058040519!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
@endsection