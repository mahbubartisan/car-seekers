<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CarSeekers - {{ Request::segment(1) == '' ? 'Home': ucfirst(Request::segment(1)) }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('templates/images/favicon.png') }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS
    ========================= -->

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('templates/frontend/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('templates/frontend/css/style.css') }}">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .checked {
            color: orange;
        }
    </style>

    {{--    Rating Slider--}}
    <style>
        * {box-sizing: border-box;}

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 1.6s ease;
        }

        .slider-active {
            background-color: #717171;
        }

        /* Fading animation */
        .slideshow-container .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 4.7s;
            animation-name: fade;
            animation-duration: 4.7s;
        }

        @-webkit-keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .text {font-size: 11px}
        }
    </style>
</head>

<body>

<!--header area start-->
<header class="header_area">
    <!--header center area start-->
    <div class="header_middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 ml-auto mr-auto">
                    <div class="logo">
                        <a href="{{ route('/') }}"><h1><span class="text-danger">Car</span>Seekers</h1></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header center area end-->

    <!--header middel start-->
    <div class="header_bottom sticky-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="main_menu header_position">
                        <nav>
                            <ul>
                                <li><a href="{{ route('/') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                                <li><a href="{{ route('policies') }}"><i class="zmdi zmdi-star"></i> Our Policies</a></li>
                                <li><a href="{{ route('about') }}"><i class="zmdi zmdi-comments"></i> About Us</a></li>
                                <li><a href="{{ route('contact') }}"><i class="zmdi zmdi-account-box-mail"></i> Contact Us</a></li>
                                @if(Auth::user())
                                    <li class="float-right"><a href="#"><img src="{{ asset('templates/images/avatars/'.Auth::user()->avatar) }}" alt="" class="mr-1" style="width:30px !important; height:30px !important; border-radious:50%;"> {{ Auth::user()->name}} <i class="zmdi zmdi-caret-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="{{ route('account-settings') }}"><i class="fa fa-user fa-lg"></i> &nbsp;My Account</a></li>
                                            <li><a href="{{ route('my-bookings.index') }}"><i class="fa fa-list"></i> &nbsp;My Bookings</a></li>
                                            <li><a href="{{ route('password.update') }}"><i class="fa fa-lock fa-lg"></i> &nbsp;Reset Password</a></li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out fa-lg"></i> {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="float-right"><a href="#"><i class="zmdi zmdi-account"></i> My account <i class="zmdi zmdi-caret-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                            <li><a href="{{ route('register') }}">Register</a></li>
                                        </ul>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->

</header>
<!--header area end-->

<!--Offcanvas menu area start-->

<div class="off_canvars_overlay">

</div>
<div class="Offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <span>MENU</span>
                    <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                </div>
                <div class="Offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                    </div>
                    <div class="welcome_text">
                        <p>Welcome to <span>CarSeekers</span> </p>
                    </div>

                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            @if(Auth::user())
                                <li class="menu-item-has-children">
                                    <a href="#"><img src="{{ asset('templates/images/avatars/'.Auth::user()->avatar) }}" alt="" class="mr-1" style="width:30px !important; height:30px !important; border-radious:50%;"> {{ Auth::user()->name}} </a>
                                    <ul class="sub-menu">
                                        <li><a href="JavaScript:void(0)">My Account</a></li>
                                        <li><a href="JavaScript:void(0)">My Bookings</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out fa-lg"></i> {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="menu-item-has-children">
                                    <a href="#"><i class="zmdi zmdi-account"></i> My account </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li class="menu-item-has-children"><a href="{{ route('/') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="menu-item-has-children"><a href="{{ route('policies') }}"><i class="zmdi zmdi-star"></i> Our Policies</a></li>
                            <li class="menu-item-has-children"><a href="{{ route('about') }}"><i class="zmdi zmdi-comments"></i> About Us</a></li>
                            <li class="menu-item-has-children"><a href="{{ route('contact') }}"><i class="zmdi zmdi-account-box-mail"></i> Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="Offcanvas_footer">
                        <span><a href="#"><i class="fa fa-envelope-o"></i> info@yourdomain.com</a></span>
                        <ul>
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Offcanvas menu area end-->

@yield('content')

<!--footer area start-->
<footer class="footer_widgets border-top mt-3">
    <div class="container">
        <div class="footer_top">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="widgets_container contact_us">
                        <a href="{{ route('/') }}"><h1><span class="text-danger">Car</span>Seekers</h1></a>
                        <div class="footer_contact">
                            <ul>
                                <li><i class="zmdi zmdi-home"></i><span>Addresss:</span> 2 Fauconberg Rd,Chiswick, London</li>
                                <li><i class="zmdi zmdi-phone-setting"></i><span>Phone:</span><a href="tel:(+1) 866-540-3229">(+1) 866-540-3229</a> </li>
                                <li><i class="zmdi zmdi-email"></i><span>Email:</span>  info@plazathemes.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="widgets_container widget_menu">
                                <h3>CUSTOMER SERVICE</h3>
                                <div class="footer_menu">
                                    <ul>
                                        <li><a href="{{ route('/') }}">Home</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="widgets_container widget_menu">
                                <h3>Information</h3>
                                <div class="footer_menu">
                                    <ul>
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="widgets_container widget_menu">
                                <h3>Policies</h3>
                                <div class="footer_menu">
                                    <ul>
                                        <li><a href="{{ route('policies') }}">Our Policies</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="copyright_area">
                        <p>&copy; {{ \Carbon\Carbon::now()->format('Y') }} <a href="{{ route('/') }}"> <b><span class="text-danger">Car</span>Seekers</b> </a> |  All Right Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="footer_payment text-right">
                        <p><img src="{{ asset('templates/frontend/img/icon/payment.png') }}" alt=""></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->

<!-- JS
============================================ -->

<!-- Plugins JS -->
<script src="{{ asset('templates/frontend/js/plugins.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('templates/frontend/js/main.js') }}"></script>

{{--<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>--}}

<!-- Datepicker CSS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    // time formatting
    $('#start_time').on('change', function () {
        // alert($('#start_time').val());

        /*var time = new Date();
        console.log(
            time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
        );*/

        var time = $('#start_time').val();
        console.log(
            time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
        );
        var strTime = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        // $('.formating').html(strTime);
    })
</script>

<script>
    $(".date-selector").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        defaultDate: "today",
        minDate: "today",
        maxDate: "{{ \Carbon\Carbon::now()->addMonths(1) }}",
    });
    $(".time-selector").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K",
        time_24hr: false,
        // defaultDate: "12:00 AM"
    });
    /*$("body").on('change', '.time-selector', function f() {
        alert($('.time-selector').val())
    });*/
</script>

<script>

    // Error message for storing data
    function printErrorMsg (msg) {
        $(".print-error-msg").find(".row").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find('.row').append(
                '<div class="col-md-12 ml-auto mr-auto pt-1 pb-1 mt-1 mb-1 alert alert-danger">' +
                '    <a type="button" class="close pt-1" data-dismiss="alert" aria-label="Close">\n' +
                '        <i class="material-icons">close</i>\n' +
                '    </a>' +
                '    <span>\n' +
                '        <b>' +value+ '</b>'+
                '    </span>' +
                '</div>'
            );
        });
    }

    // Authentication
    $('body').on('click', '.authBtn', function(e) {
        e.preventDefault();

        /*let package_id = $('#package_id');
        let duration_id = $('#duration_id');
        let pick_up = $('#pick_up');
        let drop_off = $('#drop_off');*/
        // console.log(package_id);

        let authForm = $('#authForm');
        let action = authForm.attr('action');
        let authModal = $('#authModal');
        $.ajax({
            url: action,
            data:new FormData(authForm[0]),
            // dataType:'json',
            async:false,
            type:'post',
            processData: false,
            contentType: false,
            // dataType: "html",
            success: function (data) {
                if($.isEmptyObject(data.error)){
                    authModal.trigger("reset");
                    authModal.modal('hide');

                    $(".error").attr('hidden', true);

                    window.location = "/";

                }else{
                    printErrorMsg(data.error);
                    setTimeout(function(){
                        $(".print-error-msg").fadeOut(3*1000);
                    }, 5*1000);
                }
            },
            error: function (data) {
                printErrorMsg(data.responseJSON.errors);
                // alert('Operation Failed!');
                // console.log(data);
            }
        });
    });
</script>



<div id="globalModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content custom-modal">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="btn btn-round btn-white btn-fab text-danger close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <span class="loadForm"></span>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Show record
    $('body').on('click', '.showBookingBtn', function() {
        let route = $(this).data('route');
        let globalModal = $('#globalModal');
        let modalTitle = $(".modal-title");
        let closeBtn = $("#closeBtn");
        let submitBtn = $("#submitBtn");

        globalModal.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalTitle.html('Show Record');
        closeBtn.html('Close');
        submitBtn.remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            dataType: 'html',
            success: function (data) {
                globalModal.find('.loadForm').html(data);
                //console.log(response);
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });
</script>

{{--Rating Slider--}}
<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active slider-active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active slider-active";
        setTimeout(showSlides, 5*1000); // Change image every 2 seconds
    }
</script>

</body>


</html>
