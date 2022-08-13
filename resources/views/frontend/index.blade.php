@extends('layouts.frontend')

@section('content')

    <!--slider area start-->
    <section class="slider_section mb-50">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="slider_area slider_four owl-carousel">
                        {{--<div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('templates/frontend/img/slider/car-slider-1.png') }}">
                        </div>--}}
                        <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('templates/frontend/img/slider/car-slider-2.jpg') }}">
                            {{--<div class="slider_content slider_content_four content_position_left">
                                <h1>Go Portable <br> Get Productive </h1>
                                <span>Check out the Laptop Collection </span>
                                <a href="shop.html">shop now</a>
                            </div>--}}
                        </div>
                        {{--<div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('templates/frontend/img/slider/car-slider-3.jpg') }}">
                        </div>
                        <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('templates/frontend/img/slider/car-slider-4.jpg') }}">
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--slider area end-->

    <section class="deals_product_section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="deals_product_container">
                        <div class="section_title">
                            <h2>Our <span>Packages</span></h2>
                        </div>
                        <div class="deals_product_inner">
                            <div class="deals_tab_list">
                                <ul class="nav" role="tablist">
                                    @foreach(App\Package::all() as $package)
                                        <li>
                                            <a class="{{ $loop->first ? 'active':'' }}" data-toggle="tab" href="#package_{{ $loop->iteration }}" role="tab" aria-controls="{{ $package->name }}" aria-selected="true">
                                                <i class="zmdi zmdi-boat"></i>
                                                <h3>{{ $package->name }}</h3>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="deals_product_wrapper">
                                <div class="tab-content">
                                    @foreach(App\Package::all() as $package)
                                        <div class="tab-pane fade show {{ $loop->first ? 'active':'' }}" id="package_{{ $loop->iteration }}" role="tabpanel">
                                            <div class="deals_product_list">
                                                <form action="{{ route('get-booking-options') }}" method="post">
                                                    @csrf
                                                    <div class="row p-3">
                                                        <div class="col-md-6 p-3">
                                                            <div class="form-group mb-3" hidden>
                                                                <label for="package_id">Package ID</label><br>
                                                                <input type="text" class="form-control" id="package_id" name="package_id" value="{{ $package->id }}">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                                                </div>
                                                                <select name="duration_id" id="duration_id" class="form-control" required>
                                                                    <option value="">Choose A Duration</option>
                                                                    @foreach($package->durations as $duration)
                                                                        <option value="{{ $duration->id }}">{{ $duration->label }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Pick Up</span>
                                                                </div>
                                                                <input type="text" name="pick_up" class="form-control" placeholder="Pick up Address" required>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Drop off</span>
                                                                </div>
                                                                <input type="text" name="drop_off" class="form-control" placeholder="Drop off Address" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" style="width: 120px"><i class="fa fa-calendar mr-2"></i> Start Date</span>
                                                                        </div>
                                                                        <input type="text" name="start_date" class="form-control date-selector">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-3">
                                                                        <input type="time" name="start_time" id="start_time" class="form-control time-selector" value="12:00">
                                                                        <div class="input-group-prepend">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary mt-2">
                                                                Check Price
                                                            </button>
                                                            {{--@if(Auth::user())
                                                                <button type="submit" class="btn btn-primary mt-2">
                                                                    Check Price
                                                                </button>
                                                            @else
                                                                <a href="JavaScript:void(0)" class="btn btn-danger"
                                                                   data-toggle="modal" data-target="#authModal" data-backdrop="static" data-keyboard="false"
                                                                >
                                                                    Check Price
                                                                </a>
                                                            @endif--}}
                                                        </div>
                                                        <div class="col-md-6 p-3 border-left">
                                                            <h4 class="text-danger">{{ $package->name }} Package Terms</h4>
                                                            {!! $package->description !!}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="slideshow-container">

        <h2 class="text-center mb-5">Our Ratings!</h2>
        @foreach(\App\Rating::all() as $rating)
            <div class="{{ count(\App\Rating::all()) == 1 ? '':'mySlides fade' }} card p-3">
                <div class="numbertext text-danger">{{ $loop->iteration }} / {{ count(\App\Rating::all()) }}</div>
                <div class="row mt-4">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('templates/images/avatars/'.$rating->users->avatar) }}" style="width:90%; height:250px;">
                        <br>
                        <span class="h3">{{ Str::limit($rating->users->name, 23) }}</span>
                    </div>
                    <div class="col-md-8 text-center mt-auto mb-auto">
                        @if($rating->rating == 5)
                            <h3 class="text-center mb-3">Rating</h3>
                            <label>
                                <span class="fa fa-star star_1 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_2 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_3 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_4 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_5 checked" style="font-size: 50px"></span>
                            </label>

                            <div class="mt-3">
                                <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                            </div>

                        @elseif($rating->rating == 4)
                            <h3 class="text-center mb-3">Rating</h3>
                            <label>
                                <span class="fa fa-star star_1 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_2 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_3 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_4 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_5" style="font-size: 50px"></span>
                            </label>

                            <div class="mt-3">
                                <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                            </div>

                        @elseif($rating->rating == 3)
                            <h3 class="text-center mb-3">Rating</h3>
                            <label>
                                <span class="fa fa-star star_1 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_2 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_3 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_4" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_5" style="font-size: 50px"></span>
                            </label>

                            <div class="mt-3">
                                <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                            </div>

                        @elseif($rating->rating == 2)
                            <h3 class="text-center mb-3">Rating</h3>
                            <label>
                                <span class="fa fa-star star_1 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_2 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_3" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_4" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_5" style="font-size: 50px"></span>
                            </label>

                            <div class="mt-3">
                                <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                            </div>

                        @elseif($rating->rating == 1)
                            <h3 class="text-center mb-3">Rating</h3>
                            <label>
                                <span class="fa fa-star star_1 checked" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_2" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_3" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_4" style="font-size: 50px"></span>
                            </label>
                            <label>
                                <span class="fa fa-star star_5" style="font-size: 50px"></span>
                            </label>

                            <div class="mt-3">
                                <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                            </div>

                        @endif
                    </div>
                </div>
                <div class="text text-danger">
                    {{-- some text may go here as footer note --}}
                </div>
            </div>
        @endforeach


        {{--<div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="img_snow_wide.jpg" style="width:100%">
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="img_mountains_wide.jpg" style="width:100%">
            <div class="text">Caption Three</div>
        </div>--}}

    </div>
    <br>

    <div style="text-align:center" hidden="">
        @foreach(\App\Rating::all() as $rating)
            <span class="dot"></span>
        @endforeach
    </div>

    <!-- Auth Modal -->
    {{--<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content row">
                <form action="{{ route('login') }}" id="authForm" method="POST">
                    @csrf

                    <div class="col-md-12 p-3">
                        <h4 class="modal-title" id="loginModalTitle">
                            Account Login
                            <a class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </h4>
                        <div class="print-error-msg">
                            <div class="row mt-3 mb-3 ml-1 mr-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="email">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    <div class="input-group-prepend" onclick="myFunction()">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function myFunction() {
                                    var x = document.getElementById("password");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                            </script>

                            <div class="col-md-12 form-group mb-3">
                                <div class="flex-sb-m w-full p-b-48">
                                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="label-checkbox100" for="ckb1">
                                        Remember me
                                    </label>
                                    <a href="password/reset" class="float-right">
                                        Forgot Password?
                                    </a>
                                </div>

                                <button class="btn btn-success float-left authBtn" type="button">
                                    Login --}}{{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}{{--
                                </button>
                                <div class="float-right mt-2">
                                    or,
                                    <a href="{{ route('register') }}">
                                        Register now!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}{{--<div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>--}}{{--
                </form>

            </div>
        </div>
    </div>--}}

@endsection
