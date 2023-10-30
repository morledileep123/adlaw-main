<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Adlaw - Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
  
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lawyer/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lawyer/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lawyer/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('lawyer/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('lawyer/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>Laxyo House, County Park, Indore</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center  me-4">
                    <small class="fa fa-envelope text-primary me-2"></small>
                    <small>info@adlaw.in</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small> 0731 404 3798</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    @if (Route::has('login'))
                        @auth
                        <a class="btn btn-square btn-link rounded-0" href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                        <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
                        @if (Route::has('register'))
                        <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="{{ route('register') }}"><i class="fa fa-registered"></i></a>
                        @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="{{ url('') }}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h2 class="m-0 text-primary"> <img src="{{ asset('dist/img/adlaw-logo.png') }}" alt="Adlaw Logo" style="width:150px; height:60px;"></a></h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('') }}" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                <!-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="feature.html" class="dropdown-item">Feature</a>
                        <a href="quote.html" class="dropdown-item">Free Quote</a>
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div> -->
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Get A Quote<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    @if(Session::has('success'))
    <p class="alert alert-info">{{ Session::get('success') }}</p>
    @endif
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative" data-dot="<img src='{{ asset('lawyer/img/banner.jpg') }}'>">
                <img class="img-fluid" src="{{ asset('lawyer/img/banner.jpg') }}" style="width:100%; height:600px;" alt="">
                <!-- <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Read More</a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='{{ asset('lawyer/img/slider2.jpeg') }}'>">
                <img class="img-fluid" src="{{ asset('lawyer/img/slider2.jpeg') }}" style="width:100%; height:600px;" alt="">
                <!-- <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Read More</a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='{{ asset('lawyer/img/slider-1.jpg') }}'>">
                <img class="img-fluid" src="{{ asset('lawyer/img/slider-1.jpg') }}" style="width:100%; height:600px;" alt="">
                <!-- <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Read More</a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Team Start -->
    <section class="lawyers mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm card-border-top">
                        <div class="card-header text-center p-2">
                            <h5 class="card-title text-primary">Number of Lawyers in all States ({{ count($allStates) }})</h5>
                        </div>
                        <div class="card-body p-5 bg-gray">
                            <div class="row" id="stateRow">
                            @foreach ($states as $state)
                            <div class="col-md-4">
                            <a href="javascript:void(0)" class="text-primary stateView" id="{{ $state->state_code }}" data-id="{{ $state->state_code }}"><i class="fa fa-map-marker"></i>&nbsp;{{ $state->state_name }}</a><br>
                            </div>
                            @endforeach
                            </div>

                            <div class="row d-none" id="cityRow">
                                <!-- City listings will be loaded here using AJAX -->
                            </div>

                            <div class="row d-none" id="cityRow1">
                                <div class="col-md-12 mt-1 text-center">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary p-2" id="backStateBtn">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Testimonial</h6>
                <h1 class="mb-4">What Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                    <div class="testimonial-img position-relative">
                        <img class="img-fluid rounded-circle mx-auto mb-5" src="{{ asset('lawyer/img/testimonial-1.jpg') }}">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                        <h5 class="mb-1">Client Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-img position-relative">
                        <img class="img-fluid rounded-circle mx-auto mb-5" src="{{ asset('lawyer/img/testimonial-2.jpg') }}">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                        <h5 class="mb-1">Client Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-img position-relative">
                        <img class="img-fluid rounded-circle mx-auto mb-5" src="{{ asset('lawyer/img/testimonial-3.jpg') }}">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                        <h5 class="mb-1">Client Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container bg-dark text-body footer wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6">
                    <h5 class="text-white mb-2">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Laxyo House, County Park, Indore</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+0731 404 3798</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@adlaw.in</p>
                </div>
                <div class="col-md-6 text-left text-md-end" >
                    <h5 class="text-white mb-2">Quick Links</h5>
                    <a class="btn btn-link text-left text-md-end" href="">About Us</a>
                    <a class="btn btn-link text-left text-md-end" href="">Contact Us</a>
                    <a class="btn btn-link text-left text-md-end" href="">Our Services</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Adlaw.in</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="">Laxyo Solution soft</a>
                        <br>Distributed By: <a href="" target="_blank">Laxyo energy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lawyer/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lawyer/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lawyer/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lawyer/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lawyer/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lawyer/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('lawyer/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('lawyer/js/main.js') }}"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function(){
    $('.stateView').on('click', function(e){
        e.preventDefault();
        var state_code = $(this).attr('id');
        var state_name = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: "/lawyers/" + state_code,
            success: function(res){
                $('#cityRow').removeClass('d-none');
                $('#cityRow1').removeClass('d-none');
                $('#stateRow').addClass('d-none');
                $('#cityRow').empty();

                // Extract unique city names from the response data
                var uniqueCities = [];
                $.each(res, function(i, v) {
                    if (uniqueCities.indexOf(v.city_name) === -1) {
                        uniqueCities.push(v.city_name);
                    }
                });

                // Display unique city names
                $.each(uniqueCities, function(i, city) {
                    $('#cityRow').append('<div class="col-md-4"><a href="/search/lawyers/' + state_code + '/' + city + '" class="text-primary stateView"><i class="fa fa-map-marker"></i> ' + city + ' (' + getCountForCity(res, city) + ')</a><br/><br/></div>');
                });
            }
        });
    });

    $(document).on('click', '#backStateBtn', function(e){
        e.preventDefault();
        $('#cityRow').addClass('d-none');
        $('#cityRow1').addClass('d-none');
        $('#stateRow').removeClass('d-none');
        $('#cityRow').empty();
    });
});

function getCountForCity(data, city) {
    var count = 0;
    $.each(data, function(i, v) {
        if (v.city_name === city) {
            count++;
        }
    });
    return count;
}
</script>
</body>
</html>