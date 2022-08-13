@extends('layouts.frontend')

@section('content')
    <section class="deals_product_section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="deals_product_container">
                        <div class="section_title">
                            <h2>Choose <span>to Book</span></h2>
                        </div>
                        @foreach($vehicles as $vehicle)
                            <div class="card {{ !$loop->first ? 'mt-3':'' }}">
                                <div class="card-header h3">
                                    {{ $vehicle->company }} {{ $vehicle->model }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('templates/images/vehicles/'.$vehicle->image) }}" alt="" width="100%" style="height: 200px;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    {!! $package_duration->description !!}
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="h3 float-right text-center">
                                                        $ {{ ($vehicle->hourly_charge * $package_duration->duration) + $vehicle->minimum_charge }}
                                                        <br>
                                                        @if(Auth::user())
                                                            <a href="JavaScript:void(0)" class="btn btn-danger"
                                                               data-toggle="modal" data-target="#bookingModal_{{ $loop->iteration }}" data-backdrop="static" data-keyboard="false"
                                                            >
                                                                Book Now
                                                            </a>
                                                        @else
                                                            <a href="JavaScript:void(0)" class="btn btn-danger"
                                                               data-toggle="modal" data-target="#authModal" data-backdrop="static" data-keyboard="false"
                                                            >
                                                                Book Now
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-2 text-info">
                                            <b>Vehicle Details</b>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Color:</b> {{ $vehicle->color }}
                                        </div>
                                        <div class="col-md-2">
                                            <b>Passengers:</b> {{ $vehicle->seat_capacity }} max
                                        </div>
                                        <div class="col-md-2">
                                            <b>Air Condition :</b> {{ $vehicle->air_condition }}
                                        </div>
                                        <div class="col-md-2">
                                            <b>Fuel Type:</b> {{ $vehicle->fuel_type }}
                                        </div>
                                        <div class="col-md-2">
                                            <b>Gear Type:</b> {{ $vehicle->gear_type }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Booking Modal -->
                            <div class="modal fade" id="bookingModal_{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="bookingModalTitle_{{ $loop->iteration }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content row">
                                        <form class="paymentForm_{{$vehicle->id}}" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
                                            @csrf

                                            {{--PayPal info--}}
                                            <input type="hidden" name="business" value="{{ $vehicle->users->paypal_account }}{{--{{/*$paypal_id*/'sb-gm47bl440333@business.example.com'}}--}}">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="upload" value="1">
                                            <input type="hidden" name="currency_code" value="USD">

                                            {{--// for db insert--}}
                                            {{--
                                            <input type="hidden" name="item_number_{{$loop->iteration}}" value="{{$cart_item->id}}">
                                            <input type="hidden" name="item_name_{{$loop->iteration}}" value="{{$cart_item->name}}">
                                            <input type="hidden" name="amount_{{$loop->iteration}}" value="{{$cart_item->price}}">
                                            <input type="hidden" name="quantity_{{$loop->iteration}}" value="{{ $cart_item->quantity }}">
                                            --}}

                                            <input type="hidden" name="item_name_1" value="Package: {{$package->name}} - {{ $package_duration->label }}">
                                            <input type="hidden" name="amount_1" value="{{ ($vehicle->hourly_charge * $package_duration->duration) + $vehicle->minimum_charge }}">

                                            <input type="hidden" name="pick_up" id="pick_up" value="{{$pick_up}}" hidden>
                                            <input type="hidden" name="drop_off" id="drop_off" value="{{$drop_off}}" hidden>

                                            <input type="hidden" name="package_id" id="package_id" value="{{$package->id}}">
                                            <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{$vehicle->id}}">
                                            <input type="hidden" name="start_date" id="start_date" value="{{$start_date}}">
                                            <input type="hidden" name="start_time" id="start_time" value="{{ \Carbon\Carbon::parse($start_time)->toTimeString() }}">
                                            <input type="hidden" name="duration" id="duration" value="{{$package_duration->duration}}">
                                            <input type="hidden" name="total_amount" id="total_amount" value="{{ ($vehicle->hourly_charge * $package_duration->duration) + $vehicle->minimum_charge }}">

                                            {{--PayPal return url's--}}
                                            <input type="hidden" name="cancel_return" value="http://127.0.0.1:8000/payment-cancel">
                                            <input type="hidden" name="return" value="http://127.0.0.1:8000/payment-status">
                                            <input type="hidden" name="notify_url" value="http://127.0.0.1:8000/payment-success">

                                            {{--<input type="hidden" name="cancel_return" value="https://car-seekers.logicbreaker.com/payment-cancel">
                                            <input type="hidden" name="return" value="https://car-seekers.logicbreaker.com/payment-status">
                                            <input type="hidden" name="notify_url" value="https://car-seekers.logicbreaker.com/payment-success">--}}

                                            <div class="col-md-12 p-3">
                                                <h4 class="modal-title" id="bookingModalTitle_{{ $loop->iteration }}">
                                                    Booking Form
                                                    <a class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </a>
                                                </h4>
                                                <div class="print-error-msg" hidden>
                                                    <div class="row mt-3 mb-3 ml-1 mr-1"></div>
                                                </div>
                                                @if(Auth::user())
                                                    @if(Auth::user()->bookings == null || !Auth::user()->bookings)
                                                        <div class="row mt-2">
                                                            <div class="col-md-12 form-group mb-3">
                                                                <label for="email">Package Info</label>
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-map-o mr-2"></i> Name</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $package->name }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-clock-o mr-2"></i> Duration</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $package_duration->duration }} Hours" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group mb-3">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fa fa-car"></i></span>
                                                                            </div>
                                                                            <select name="" id="duration_id" class="form-control" disabled>
                                                                                <option value="">Choose A Duration</option>
                                                                                @foreach($package->durations as $duration)
                                                                                    <option value="{{ $duration->id }}" {{ $duration->id == $package_duration->id ? 'selected':'' }}>{{ $duration->label }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" style="width: 120px"><i class="fa fa-calendar mr-2"></i> Start Date</span>
                                                                                    </div>
                                                                                    <input type="text" name="" class="form-control date-selector" value="{{ $start_date }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="input-group">
                                                                                    <input type="text" name="" class="form-control time-selector" value="{{ $start_time }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Pick Up</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $pick_up }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Drop off</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $drop_off }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 form-group mb-3">
                                                                <div class="float-right text-center">
                                                                    <span class="h4">
                                                                        $ {{ ($vehicle->hourly_charge * $package_duration->duration) + $vehicle->minimum_charge }}
                                                                    </span>
                                                                    <br>
                                                                    <button class="btn btn-success paymentBtn" type="submit" hidden>
                                                                        Pay Now! {{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}
                                                                    </button>
                                                                    <button class="btn btn-success paymentSendBtn" id="paymentSendBtn_{{$vehicle->id}}" data-id="{{$vehicle->id}}" type="button">
                                                                        Pay Now! {{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @if(count(\App\Booking::where('user_id', Auth::user()->id)->where('total_due','!=', '0')->get()) > 0)
                                                            <p class="text-danger p-3 text-center h2">
                                                                Please Clear the remaining due to book again!
                                                            </p>
                                                        @else
                                                            <div class="row mt-2">
                                                                <div class="col-md-12 form-group mb-3">
                                                                    <label for="email">Package Info</label>
                                                                    <div class="row">
                                                                        <div class="col-md-6 form-group">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" style="width: 120px"><i class="fa fa-map-o mr-2"></i> Name</span>
                                                                                </div>
                                                                                <input type="text" name="" class="form-control" value="{{ $package->name }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" style="width: 120px"><i class="fa fa-clock-o mr-2"></i> Duration</span>
                                                                                </div>
                                                                                <input type="text" name="" class="form-control" value="{{ $package_duration->duration }} Hours" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 form-group mb-3">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                                                                </div>
                                                                                <select name="" id="duration_id" class="form-control" disabled>
                                                                                    <option value="">Choose A Duration</option>
                                                                                    @foreach($package->durations as $duration)
                                                                                        <option value="{{ $duration->id }}" {{ $duration->id == $package_duration->id ? 'selected':'' }}>{{ $duration->label }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-8">
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text" style="width: 120px"><i class="fa fa-calendar mr-2"></i> Start Date</span>
                                                                                        </div>
                                                                                        <input type="text" name="" class="form-control date-selector" value="{{ $start_date }}" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="input-group">
                                                                                        <input type="text" name="" class="form-control time-selector" value="{{ $start_time }}" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Pick Up</span>
                                                                                </div>
                                                                                <input type="text" name="" class="form-control" value="{{ $pick_up }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Drop off</span>
                                                                                </div>
                                                                                <input type="text" name="" class="form-control" value="{{ $drop_off }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12 form-group mb-3">
                                                                    <div class="float-right text-center">
                                                                        <span class="h4">
                                                                            $ {{ ($vehicle->hourly_charge * $package_duration->duration) + $vehicle->minimum_charge }}
                                                                        </span>
                                                                        <br>
                                                                        <button class="btn btn-success paymentBtn" type="submit" hidden>
                                                                            Pay Now! {{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}
                                                                        </button>
                                                                        <button class="btn btn-success paymentSendBtn" id="paymentSendBtn_{{$vehicle->id}}" data-id="{{$vehicle->id}}" type="button">
                                                                            Pay Now! {{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                        <div class="row mt-2">
                                                            <div class="col-md-12 form-group mb-3">
                                                                <label for="email">Package Info</label>
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-map-o mr-2"></i> Name</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $package->name }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-clock-o mr-2"></i> Duration</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $package_duration->duration }} Hours" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group mb-3">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fa fa-car"></i></span>
                                                                            </div>
                                                                            <select name="" id="duration_id" class="form-control" disabled>
                                                                                <option value="">Choose A Duration</option>
                                                                                @foreach($package->durations as $duration)
                                                                                    <option value="{{ $duration->id }}" {{ $duration->id == $package_duration->id ? 'selected':'' }}>{{ $duration->label }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" style="width: 120px"><i class="fa fa-calendar mr-2"></i> Start Date</span>
                                                                                    </div>
                                                                                    <input type="text" name="" class="form-control date-selector" value="{{ $start_date }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="input-group">
                                                                                    <input type="text" name="" class="form-control time-selector" value="{{ $start_time }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Pick Up</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $pick_up }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Drop off</span>
                                                                            </div>
                                                                            <input type="text" name="" class="form-control" value="{{ $drop_off }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 form-group mb-3">
                                                                <div class="float-right text-center">
                                                            <span class="h4">
                                                                $ {{ ($vehicle->hourly_charge * $package_duration->duration) + $vehicle->minimum_charge }}
                                                            </span>
                                                                    <br>
                                                                    <button class="btn btn-success paymentBtn" type="submit" hidden>
                                                                        Pay Now! {{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}
                                                                    </button>
                                                                    <button class="btn btn-success paymentSendBtn" type="button" id="paymentSendBtn_{{$vehicle->id}}" data-id="{{$vehicle->id}}">
                                                                        Pay Now! {{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endif
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <script
                                src="https://code.jquery.com/jquery-3.5.1.min.js"
                                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                                crossorigin="anonymous"></script>
                            <script>
                                // bookings
                                $('#paymentSendBtn_{{$vehicle->id}}').on('click', function () {
                                    $.ajax({
                                        url: "{{ route('booking-session-store') }}",
                                        data:new FormData($('.paymentForm_{{$vehicle->id}}')[0]),
                                        // dataType:'json',
                                        async:false,
                                        type:'post',
                                        processData: false,
                                        contentType: false,
                                        // dataType: "html",
                                        success: function (data) {
                                            $('.paymentBtn').trigger('click');
                                            // console.log(data);
                                        },
                                        error: function (data) {
                                            // printErrorMsg(data.responseJSON.errors);
                                            alert('Payment Failed!');
                                            // console.log(data);
                                        }
                                    });
                                });
                            </script>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Auth Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
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
                                    Login {{--{{ Request::segment(1) == 'booking-options' ? 'booking-options':'/' }}--}}
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
                </form>

            </div>
        </div>
    </div>
@endsection
