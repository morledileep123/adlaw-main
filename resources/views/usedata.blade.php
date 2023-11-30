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
                <a href="{{ route('about.us') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                <a href="{{ route('contact.us') }}" class="nav-item nav-link">Contact Us</a>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block"><i class="fa fa-arrow-left ms-3"></i>&nbsp Previous page</a>
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
                <img class="img-fluid" src="{{ asset('lawyer/img/banner.jpg') }}" style="width:100%; height:500px;" alt="">
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
                <img class="img-fluid" src="{{ asset('lawyer/img/slider2.jpeg') }}" style="width:100%; height:500px;" alt="">
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
                <img class="img-fluid" src="{{ asset('lawyer/img/slider-1.jpg') }}" style="width:100%; height:500px;" alt="">
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
    <!-- Team End -->
    <!-- Team Start -->
    <section class="section" style="padding: 0px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title section-title-border" style="margin-bottom:22px;"><u>Users Details By Cities</u></h2>
                </div>
                <!-- service item -->
                <div class="col-lg-12 col-sm-12 mb-5 mb-lg-0">
                    <div class="card text-center">
                        <div class="container">
                            <div class="block" style="margin-bottom: 40px; margin-top: 10px;">
                                <table class="table" id="example">
                                    @foreach ($cityData as $data)
                                        <tbody>
                                            <tr class="row ml-0 mr-0 mt-4 table-bordered">
                                                <td class="col-md-6 col-sm-12 " style="padding: 18px;">
                                                    <div class="row mt-4 profile-div">
                                                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 pb-2" id="user_img">
                                                            @if ($data->photo_path !=null)   
                                                            <img src="/public/profile-image/{{ $data->photo_path }}" class="w-100" style="width:200px !important; height:190px;">
                                                            @else
                                                                @if ($data->gender =='M')   
                                                                <img src="{{ asset('lawyer/img/testimonial-3.jpg') }}" class="w-100" style="width:200px !important; height:190px;">
                                                                @else
                                                                <img src="{{ asset('lawyer/img/testimonial-1.jpg') }}" class="w-100" style="width:200px !important; height:190px;">
                                                                @endif
                                                            @endif
                                                            
                                                        </div>
                                                        <div class="col-md-7 col-lg-7 col-xs-12 col-sm-12">
                                                            <div class="details" style="display:inline">
                                                                <h3 class="font-weight-bold text-capitalize" style="margin:1px 0;font-size:16px;">
                                                                    @if (!empty($cityData) && count($cityData) > 0)   
                                                                    <h5 class="name" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Name - {{ $data->firstname }} {{ $data->middlename }} {{ $data->lastname }}</h5>
                                                                    @else
                                                                    <h5 class="name" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Name - </h5>
                                                                    @endif
                                                                    <br>
                                                                </h3>
                                                            </div>
                                                            <!-- <div class="details" style="display:inline;">
                                                                <h5 class="" style="margin:1px 0;font-size:16px;">
                                                                    @if (!empty($cityData) && count($cityData) > 0)   
                                                                    <h5 class="licence_no" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Licence no - {{ $data->licence_no }}</h5>
                                                                    @else
                                                                    <h5 class="licence_no" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Licence no - </h5>
                                                                    @endif
                                                                    <br>
                                                                </h5>
                                                            </div>
                                                            <div class="details" style="display:inline;">
                                                                <h5 class="" style="margin:1px 0;font-size:16px;"> 
                                                                    @if (!empty($cityData) && count($cityData) > 0)   
                                                                    <h5 class="estd_year" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Estd year - {{ $data->estd_year }}</h5>
                                                                    @else
                                                                    <h5 class="estd_year" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Estd year -</h5>
                                                                    @endif
                                                                    <br>
                                                                </h5>
                                                            </div> -->
                                                            <div class="details" style="display:inline;">
                                                                <h5 class="" style="margin:1px 0;font-size:16px;">
                                                                    @if (!empty($cityData) && count($cityData) > 0)   
                                                                    <h5 class="mobile" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Mobile no - {{ $data->mobile }}</h5>
                                                                    @else
                                                                    <h5 class="mobile" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Mobile no -</h5>
                                                                    @endif 
                                                                    <br>
                                                                </h5>
                                                            </div>
                                                            <div class="details" style="display:inline;">
                                                                <h5 class="" style="margin:1px 0;font-size:16px;"> 
                                                                @if (!empty($cityData) && count($cityData) > 0)   
                                                                <h5 class="address" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Address - {!! strip_tags($data->address) !!}</h5>
                                                                @else
                                                                <h5 class="address" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Address - </h5>
                                                                @endif
                                                                    <br>
                                                                </h5>
                                                            </div>
                                                            <div class="details" style="display:inline;">
                                                                <h5 class="" style="margin:1px 0;font-size:16px;">                        
                                                                <i class="text-success" style="font-size:18px;"></i> &nbsp;
                                                                @if (!empty($cityData) && count($cityData) > 0)   
                                                                <h5 class="city" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">City - {{ $data->city_name }}</h5>
                                                                @else
                                                                <h5 class="city" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">City - </h5>
                                                                @endif
                                                                </h5>
                                                            </div>
                                                            <h6 class="">
                                                               <i class="text-success" style="margin:1px 0;font-size:16px;"></i> &nbsp;
                                                               @if (!empty($cityData) && count($cityData) > 0)   
                                                               </h6><h5 class="state" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">State - {{ $data->state_name }}</h5>
                                                               @else
                                                               </h6><h5 class="state" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">State - </h5>
                                                               @endif
                                                            <h6 class="">
                                                               <i class="fa fa-map-marker text-success" style="font-size:16px;"></i> &nbsp;
                                                               @if (!empty($cityData) && count($cityData) > 0)   
                                                               </h6><h5 class="country" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Country - {{ $data->country_name }}</h5>
                                                               @else
                                                               </h6><h5 class="country" style="margin:1px 0;font-weight:800; font-size:14px;float:left;">Country -</h5>
                                                               @endif 
                                                            </h6>
                                                            <!--  -->
                                                            <h1>
                                                               <a href="javascript:void(0)" onclick="loginChecked('16')" style="text-decoration: none" class="btn btn-sm text-info border-info"><i class="fa fa-envelope"></i> Message</a>
                                                            </h1>
                                                        </div>
                                                        <div class="col-md-12">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-md-6 col-sm-6" id="book_desktop" style="padding: 18px;">
                                                    <h6 class="">
                                                    </h6>
                                                    <h6 class="">  
                                                    </h6>
                                                    @foreach($qualData as $qual)
                                                    <h6 class=""> 
                                                        @if (!empty($qualData) && count($cityData) > 0 && $qual->user_id == $data->user_id )   
                                                        </h6><h5 class="state" style="margin:1px 0;font-weight:800; font-size:14px;float:left;"><i class="fa fa-graduation-cap text-info"></i> Education - {{ $qual->qual_desc}}&nbsp;</h5>
                                                        @endif 
                                                    </h6>
                                                    @endforeach
                                                    <br>
                                                    <h6 class=""  style="margin:auto; text-align:left;">  
                                                        @if (!empty($cityData) && count($cityData) > 0)  
                                                         <i class="text-info fa fa-user"><span style="color:#000; ">&nbsp;&nbsp;Profile Description: {!! strip_tags($data->detl_profile) !!}</span></i>
                                                        
                                                        @else
                                                        <i class="text-info fa fa-user"><span style="color:#000;">&nbsp;Profile Description:</span></i>
                                                        <p style="margin:auto;">An advocate by profession deals in civil, criminal and matrimonial cases, Intellectual Property Law, Arbitration, Family Law, Banking &amp; Finance, Litigation cases,
                                                        An articulate, focused professional who has a proven history of gathering and analysing information and then using the results of that analysis to make effective decisions and find innovative solutions to legal problems. Shweta possesses strong post qualification experience which allows her to play an important and visible role in all areas of her profession. She has superb communication skills which are vital when representing the client in business to establish her suitability to provide the necessary advice...</p>
                                                        @endif 
                                                    </h6>
                                                    <br>
                                                    <div class="row" style="">
                                                        <div class="col-md-4 col-xm-12 col-sm-12">
                                                            <a href="{{ route('lawyers.details', $data->user_id) }}" class="btn btn-md text-primary border-primary">Detail Profile</a> 
                                                        </div>
                                                        <div class="col-md-4 col-xm-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-md-6 col-xm-12 col-sm-12 viewP text-uppercase">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-xm-12 col-sm-12">
                                                            <p class="m-0"></p>
                                                            <div><i class="ng-binding">0 Review</i></div>
                                                            <span class="star-rating">
                                                                <i class="fa fa-star-o" style="color:chocolate"></i>
                                                            </span>
                                                            <!--  -->
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!-- Team End -->
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

</body>
</html>