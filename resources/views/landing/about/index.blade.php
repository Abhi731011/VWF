@extends('landing.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">About Us</h3>
        <p class="fs-5 text-white mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">About Us</li>
        </ol>    
    </div>
</div>
<!-- Header End -->

<!-- About Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-5">
                <div class="h-100">
                    <img src="{{ asset('assetslanding/img/about-1.jpg') }}" class="img-fluid w-100 h-100" alt="Image">
                </div>
            </div>
            <div class="col-xl-7">
                <h5 class="text-uppercase text-primary">About Us</h5>
                <h1 class="mb-4">Serving the world Alike</h1>
                <p class="fs-5 mb-4">At Vaishvik Welfare Foundation, we believe that humans, animals, and nature are deeply connected — and so should be our approach to welfare. While most NGOs work in silos, focusing on just one issue, we’re bridging those gaps to create a holistic, sustainable future for all.</p>
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
                                            {{-- <h5 class="text-uppercase mb-3">Lorem Ipsum 1</h5> --}}
                                            <p class="mb-4">At Vaishvik Welfare Foundation, we believe that humans, animals, and nature are deeply connected — and so should be our approach to welfare. While most NGOs work in silos, focusing on just one issue, we’re bridging those gaps to create a holistic, sustainable future for all.</p>
                                            <div class="d-flex align-items-center justify-content-start">
                                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
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
                                            {{-- <h5 class="text-uppercase mb-3">Lorem Ipsum 2</h5> --}}
                                            <p class="mb-4">Vaishvik Welfare Foundation pioneers integrated welfare — serving rural communities, conserving nature, and uplifting animals through compassionate service, ecological innovation, and inclusive development. With a special focus on cow protection.</p>
                                            <div class="d-flex align-items-center justify-content-start">
                                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
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
                                            {{-- <h5 class="text-uppercase mb-3">Lorem Ipsum 3</h5> --}}
                                            <p class="mb-4">To lead a new era of social transformation where rural communities thrive, animals are protected with dignity, and nature is preserved — all through compassion-driven action, inclusive growth, and sustainable innovation for generations ahead.</p>
                                            <div class="d-flex align-items-center justify-content-start">
                                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
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


<!-- Team Start -->
<div class="container-fluid team">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="text-uppercase text-primary">Directors & Leadership</h1>
            <h5 class="mb-4">The Guiding Force</h5>
        </div>
        <div class="row g-4">
            <!-- Team Member 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                    <img src="{{ asset('assets/img/baba.JPG') }}" class="card-img-top team-img" alt="John Doe">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Mr. C.B.Singh</h5>
                        <p class="text-muted mb-2">Founder & Chief Patron, Retired Bank Manager</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            Mr. C.B. Singh, Founder & Chief Patron of Vaishvik Welfare Foundation, combines decades in banking and social service. His vision of welfare as justice guides and inspires the foundation’s mission daily.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                    <img src="{{ asset('assets/img/Vikrant.jpeg') }}" class="card-img-top team-img" alt="Sarah Lee">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Vikrant Singh</h5>
                        <p class="text-muted mb-2">Director – Branding & Development</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            Vikrant is the creative force behind Vaishvik Welfare Foundation’s identity and outreach. He ensures that our message of compassion and service reaches hearts through powerful storytelling, digital branding, and innovative campaigns.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                   <img src="{{ asset('assets/img/Suryansh.JPG') }}" class="card-img-top team-img" alt="David Smith">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Suryansh Tiwari</h5>
                        <p class="text-muted mb-2">Director – Operations & Field Programs</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            Suryansh blends rural wisdom with modern execution, uniting community trust and real estate expertise. His empathetic, practical leadership ensures Vaishvik Welfare Foundation’s initiatives are locally accepted, environmentally conscious, and sustainably built from the ground up.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                  <img src="{{ asset('assets/img/Aditya.JPG') }}" class="card-img-top team-img" alt="Emma Johnson">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Aditya Dixit</h5>
                        <p class="text-muted mb-2">Director – Strategy & Governance</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            Aditya ensures that Vaishvik Welfare Foundation remains accountable, transparent, and future-ready. He leads our efforts in governance, compliance, and partnerships — making sure that every project aligns with both our values and regulatory frameworks.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Team End -->

<div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="text-uppercase text-primary">Core Team</h1>
            <h5 class="mb-4">The Change Maker</h5>
        </div>
        <div class="row g-4">
            <!-- Team Member 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                    <img src="{{ asset('assets/img/Tanishka.JPG') }}" class="card-img-top team-img" alt="John Doe">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Tanishka Awasthi</h5>
                        <p class="text-muted mb-2">HR & People Engagement Bank Manager</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            
                            Coordinator at Vaishvik Welfare Foundation, I focus on building a positive, inclusive, and purpose-driven culture. My role blends talent management, volunteer engagement, and team development with the larger mission of the foundation — serving humanity, nature, and animals together through holistic initiatives.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                    <img src="{{ asset('assets/img/Abhi.jpeg') }}" class="card-img-top team-img" alt="Sarah Lee">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Abhishek Tripathi</h5>
                        <p class="text-muted mb-2">Digital Infrastructure & IT Services Manager</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            Abhishek ensures that Vaishvik Welfare Foundation’s digital ecosystem runs smoothly, securely, and smartly. From managing the website and backend systems to implementing tech tools that support daily operations, he is the architect of our digital foundation.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                   <img src="{{ asset('assets/img/Utkarsh.JPG') }}" class="card-img-top team-img" alt="David Smith">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Utkarsh Saxena</h5>
                        <p class="text-muted mb-2">Accounting and Compliance Coordinator</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            As Accounting & Compliance Coordinator at Vaishvik Welfare Foundation, I ensure every rupee is managed with transparency and purpose. From budgets to regulations, I keep our initiatives aligned, accountable, and impactful—proud to drive change where it truly matters
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 4 -->
            {{-- <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-3 h-100 team-card">
                  <img src="{{ asset('assets/img/Aditya.JPG') }}" class="card-img-top team-img" alt="Emma Johnson">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title mb-1">Aditya Dixit</h5>
                        <p class="text-muted mb-2">Director – Strategy & Governance</p>
                        <p class="small mb-0 flex-grow-1" style="text-align: justify;">
                            Aditya ensures that Vaishvik Welfare Foundation remains accountable, transparent, and future-ready. He leads our efforts in governance, compliance, and partnerships — making sure that every project aligns with both our values and regulatory frameworks.
                        </p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<!-- Volunteers Start -->
<div class="container-fluid volunteer py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="volunteer-img">
                            <img src="{{ asset('assetslanding/img/volunteers-1.jpg') }}" class="img-fluid w-100" alt="Image">
                            <div class="volunteer-title">
                                <h5 class="mb-2 text-white">Michel Brown</h5>
                                <p class="mb-0 text-white">Communicator</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="volunteer-img">
                            <img src="{{ asset('assetslanding/img/volunteers-3.jpg') }}" class="img-fluid w-100" alt="Image">
                            <div class="volunteer-title">
                                <h5 class="mb-2 text-white">Michel Brown</h5>
                                <p class="mb-0 text-white">Communicator</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="volunteer-img">
                            <img src="{{ asset('assetslanding/img/volunteers-2.jpg') }}" class="img-fluid w-100" alt="Image">
                            <div class="volunteer-title">
                                <h5 class="mb-2 text-white">Michel Brown</h5>
                                <p class="mb-0 text-white">Communicator</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="volunteer-img">
                            <img src="{{ asset('assetslanding/img/volunteers-4.jpg') }}" class="img-fluid w-100" alt="Image">
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
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipiscing elit eiusmod tempor.</p>
                <p class="text-dark"><i class="fa fa-check text-primary me-2"></i> We are friendly to each other.</p>
                <p class="text-dark"><i class="fa fa-check text-primary me-2"></i> If you join with us, we will give you free training.</p>
                <p class="text-dark"><i class="fa fa-check text-primary me-2"></i> It's an opportunity to help poor environments.</p>
                <p class="text-dark"><i class="fa fa-check text-primary me-2"></i> No goal requirements.</p>
                <p class="text-dark mb-5"><i class="fa fa-check text-primary me-2"></i> Joining is totally free. We don't need any money from you.</p>
                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Join With Us</a>
            </div>
        </div>
    </div>
</div>
<!-- Volunteers End -->

<style>
.team-card {
    display: flex;
    flex-direction: column;
    height: 100%;
    min-height: 500px; /* Adjust as needed for your design */
}

.team-img {
    height: 280px; /* Fixed height for images */
    object-fit: containt; /* Ensures images scale properly without distortion */
    width: 100%;
}

.team-card .card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>
@endsection