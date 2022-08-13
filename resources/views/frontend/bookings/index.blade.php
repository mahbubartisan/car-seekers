@extends('layouts.frontend')

@section('content')

    <section class="deals_product_section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="deals_product_container">
                        <div class="section_title">
                            <h2>My <span>Bookings</span></h2>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Package Name</th>
                                            <th>Duration</th>
                                            <th>Vehicle</th>
                                            <th>Vehicle Reg. no.</th>
                                            <th>Total Paid</th>
                                            <th>Total Due</th>
                                            <th>Trip Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $booking->packages->name }}</td>
                                                <td>{{ $booking->duration }} Hours</td>
                                                <td>{{ $booking->vehicles->company }} - {{ $booking->vehicles->model }}</td>
                                                <td>{{ $booking->vehicles->registration_number }}</td>
                                                <td>$ {{ $booking->total_paid }}</td>
                                                <td>$ {{ $booking->total_amount - $booking->total_paid == null ? '0':$booking->total_amount - $booking->total_paid }}</td>
                                                <td>{{ $booking->end_date == null ? 'On going':'Completed' }}</td>
                                                <td>
                                                    <a href="JavaScript:Void(0)" class="btn btn-info text-dark showBookingBtn" data-route="{{ route('my-bookings.show', $booking->id) }}"><i class="fa fa-eye"></i></a>
                                                    <a href="JavaScript:Void(0)" class="btn {{ $booking->ratings != null ? 'btn-success':'btn-warning' }}"
                                                       data-toggle="modal" data-target="#ratingModal_{{ $booking->id }}"
                                                       data-backdrop="static" data-keyboard="false" {{ $booking->end_time == null ? 'hidden':'' }}
                                                    >
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    </a>
                                                    @if($booking->total_amount - $booking->total_paid > 0)
                                                        <br>
                                                        <a href="JavaScript:Void(0)" class="btn btn-warning"
                                                           data-toggle="modal" data-target="#bookingDueModal_{{ $booking->id }}" data-backdrop="static" data-keyboard="false"
                                                        >
                                                            Clear Due
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- Booking Due Modal -->
                                            <div class="modal fade" id="bookingDueModal_{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="bookingDueModalTitle_{{ $booking->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content row">

                                                        <form class="duePaymentForm_{{$booking->id}}" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
                                                            @csrf

                                                            {{--PayPal info--}}
                                                            <input type="hidden" name="business" value="{{ $booking->vehicles->users->paypal_account }}{{--{{'sb-gm47bl440333@business.example.com'}}--}}">
                                                            <input type="hidden" name="cmd" value="_cart">
                                                            <input type="hidden" name="upload" value="1">
                                                            <input type="hidden" name="currency_code" value="USD">

                                                            <input type="hidden" name="item_name_1" value="Clear ${{ $booking->total_amount - $booking->total_paid }} due of Package: {{$booking->packages->name}}">
                                                            <input type="hidden" name="amount_1" value="{{ $booking->total_amount - $booking->total_paid }}">

                                                            <input type="text" name="booking_id" id="booking_id" value="{{$booking->id}}" hidden>
                                                            <input type="text" name="total_amount" id="total_amount" value="{{$booking->total_amount}}" hidden>
                                                            <input type="text" name="total_paid" id="total_paid" value="{{$booking->total_paid}}" hidden>
                                                            <input type="text" name="total_due" id="total_due" value="{{$booking->total_amount - $booking->total_paid}}" hidden>

                                                            {{--PayPal return url's--}}
                                                            <input type="hidden" name="cancel_return" value="http://127.0.0.1:8000/payment-cancel">
                                                            <input type="hidden" name="return" value="http://127.0.0.1:8000/payment-status">
                                                            <input type="hidden" name="notify_url" value="http://127.0.0.1:8000/payment-success">

                                                            {{--<input type="hidden" name="cancel_return" value="https://car-seekers.logicbreaker.com/payment-cancel">
                                                            <input type="hidden" name="return" value="https://car-seekers.logicbreaker.com/payment-status">
                                                            <input type="hidden" name="notify_url" value="https://car-seekers.logicbreaker.com/payment-success">--}}

                                                            <div class="col-md-12 p-3">
                                                                <h4 class="modal-title" id="bookingDueModalTitle_{{ $booking->id }}">
                                                                    Booking Form
                                                                    <a class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </a>
                                                                </h4>
                                                                <div class="print-error-msg" hidden>
                                                                    <div class="row mt-3 mb-3 ml-1 mr-1"></div>
                                                                </div>
                                                                <div class="row mt-12">
                                                                    {{--<div class="col-md-12 form-group mb-3">
                                                                        <label for="email">Package Info</label>
                                                                        <div class="row">
                                                                            <div class="col-md-6 form-group">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" style="width: 120px"><i class="fa fa-map-o mr-2"></i> Name</span>
                                                                                    </div>
                                                                                    <input type="text" name="" class="form-control" value="{{ $booking->packages->name }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 form-group">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" style="width: 120px"><i class="fa fa-clock-o mr-2"></i> Duration</span>
                                                                                    </div>
                                                                                    <input type="text" name="" class="form-control" value="{{ $booking->duration }} Hours" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 form-group mb-3">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"><i class="fa fa-car"></i></span>
                                                                                    </div>
                                                                                    <select name="" id="duration_id" class="form-control" disabled>
                                                                                        <option value="">{{ $booking->duration }}</option>
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
                                                                                            <input type="text" name="" class="form-control date-selector" value="{{ $booking->start_date }}" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="input-group">
                                                                                            <input type="text" name="" class="form-control time-selector" value="{{ $booking->start_time }}" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 form-group">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Pick Up</span>
                                                                                    </div>
                                                                                    <input type="text" name="" class="form-control" value="{{ $booking->pick_up }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 form-group">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" style="width: 120px"><i class="fa fa-map-marker mr-2"></i> Drop off</span>
                                                                                    </div>
                                                                                    <input type="text" name="" class="form-control" value="{{ $booking->drop_off }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>--}}

                                                                    <div class="col-md-12 form-group mb-3 text-center">
                                                                        <div class="">
                                                                            <span class="h5">
                                                                                You have a Total Due of: $ {{ $booking->total_amount - $booking->total_paid }}
                                                                            </span>
                                                                            <br>
                                                                            <button class="btn btn-success duePaymentBtn_{{$booking->id}}" type="submit" hidden>
                                                                                Clear Due!
                                                                            </button>
                                                                            <button class="btn btn-success duePaymentSendBtn_{{$booking->id}}" type="button">
                                                                                Clear Due!
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rating Modal -->
                                            <div class="modal fade" id="ratingModal_{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="ratingModalTitle_{{ $booking->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content row">

                                                        <form class="ratingForm_{{$booking->id}}" action="{{ route('ratings.store') }}" method="post" name="frmTransaction" id="frmTransaction">
                                                            @csrf
                                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                            <div class="col-md-12 p-3">
                                                                <h4 class="modal-title" id="ratingModalTitle_{{ $booking->id }}">
                                                                    Rating Form
                                                                    <a class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </a>
                                                                </h4>
                                                                <div class="print-error-msg" hidden>
                                                                    <div class="row mt-3 mb-3 ml-1 mr-1"></div>
                                                                </div>
                                                                <div class="row mt-12">
                                                                    <div class="col-md-12 form-group mb-3 mt-3">
                                                                        <div class="row">
                                                                            @if(\App\Rating::where('booking_id','!=',$booking->id) && $booking->ratings !== null)
                                                                                <div class="form-group ml-auto mr-auto">
                                                                                    <h3 class="text-center mb-3">Your Rating!</h3>
                                                                                    <span class="fa fa-star star_1 {{ $booking->ratings->rating > '0' ? 'checked':'' }}" style="font-size: 50px" disabled=""></span>
                                                                                    <span class="fa fa-star star_2 {{ $booking->ratings->rating > '1' ? 'checked':'' }}" style="font-size: 50px" disabled=""></span>
                                                                                    <span class="fa fa-star star_3 {{ $booking->ratings->rating > '2' ? 'checked':'' }}" style="font-size: 50px" disabled=""></span>
                                                                                    <span class="fa fa-star star_4 {{ $booking->ratings->rating > '3' ? 'checked':'' }}" style="font-size: 50px" disabled=""></span>
                                                                                    <span class="fa fa-star star_5 {{ $booking->ratings->rating > '4' ? 'checked':'' }}" style="font-size: 50px" disabled=""></span>
                                                                                </div>
                                                                                <div class="col-md-12 form-group">
                                                                                    <label for="comment">Comment</label>
                                                                                    <div class="input-group">
                                                                                        <textarea type="text" name="comment" class="form-control" disabled>{{ $booking->ratings->comment }}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                @else
                                                                                <div class="form-group ml-auto mr-auto">
                                                                                    <h3 class="text-center mb-3">Rate your trip!</h3>
                                                                                    <input type="radio" name="rating" id="rating_1_{{$booking->id}}" class="rating_1" value="1" hidden>
                                                                                    <label for="rating_1_{{$booking->id}}">
                                                                                        <span class="fa fa-star star_1" style="font-size: 50px"></span>
                                                                                    </label>
                                                                                    <input type="radio" name="rating" id="rating_2_{{$booking->id}}" class="rating_2" value="2" hidden>
                                                                                    <label for="rating_2_{{$booking->id}}">
                                                                                        <span class="fa fa-star star_2" style="font-size: 50px"></span>
                                                                                    </label>
                                                                                    <input type="radio" name="rating" id="rating_3_{{$booking->id}}" class="rating_3" value="3" hidden>
                                                                                    <label for="rating_3_{{$booking->id}}">
                                                                                        <span class="fa fa-star star_3" style="font-size: 50px"></span>
                                                                                    </label>
                                                                                    <input type="radio" name="rating" id="rating_4_{{$booking->id}}" class="rating_4" value="4" hidden>
                                                                                    <label for="rating_4_{{$booking->id}}">
                                                                                        <span class="fa fa-star star_4" style="font-size: 50px"></span>
                                                                                    </label>
                                                                                    <input type="radio" name="rating" id="rating_5_{{$booking->id}}" class="rating_5" value="5" hidden>
                                                                                    <label for="rating_5_{{$booking->id}}">
                                                                                        <span class="fa fa-star star_5" style="font-size: 50px"></span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-md-12 form-group">
                                                                                    <label for="comment">Comment</label>
                                                                                    <div class="input-group">
                                                                                        <textarea type="text" name="comment" class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 form-group mb-3 text-center">
                                                                        <div class="">
                                                                            @if(\App\Rating::where('booking_id','!=',$booking->id) && $booking->ratings !== null)
                                                                                <a class="btn btn-danger text-white" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">Close This</span>
                                                                                </a>
                                                                            @else
                                                                                <button class="btn btn-success ratingBtn_{{$booking->id}}" type="submit">
                                                                                    Rate Now!
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                // bookingDues
                                                $('body').on('click', '.duePaymentSendBtn_{{$booking->id}}', function () {
                                                    $.ajax({
                                                        url: "{{ route('booking-due-session-store') }}",
                                                        data:new FormData($('.duePaymentForm_{{$booking->id}}')[0]),
                                                        // dataType:'json',
                                                        async:false,
                                                        type:'post',
                                                        processData: false,
                                                        contentType: false,
                                                        // dataType: "html",
                                                        success: function (data) {
                                                            $('.duePaymentBtn_{{$booking->id}}').trigger('click');
                                                            console.log(data);
                                                        },
                                                        error: function (data) {
                                                            // printErrorMsg(data.responseJSON.errors);
                                                            alert('Payment Failed!');
                                                            // console.log(data);
                                                        }
                                                    });
                                                });
                                            </script>

                                            <script>
                                                $(".rating_1").on('click', function () {
                                                    if ($(".rating_1").is(":checked")){
                                                        $('.star_1').addClass('checked');
                                                        $('.star_2').removeClass('checked');
                                                        $('.star_3').removeClass('checked');
                                                        $('.star_4').removeClass('checked');
                                                        $('.star_5').removeClass('checked');
                                                    }
                                                    // alert($('#rating_1').val())
                                                });
                                                $(".rating_2").on('click', function () {
                                                    if ($(".rating_2").is(":checked")){
                                                        $('.star_1').addClass('checked');
                                                        $('.star_2').addClass('checked');
                                                        $('.star_3').removeClass('checked');
                                                        $('.star_4').removeClass('checked');
                                                        $('.star_5').removeClass('checked');
                                                    }
                                                    // alert($('#rating_2').val())
                                                });
                                                $(".rating_3").on('click', function () {
                                                    if ($(".rating_3").is(":checked")){
                                                        $('.star_1').addClass('checked');
                                                        $('.star_2').addClass('checked');
                                                        $('.star_3').addClass('checked');
                                                        $('.star_4').removeClass('checked');
                                                        $('.star_5').removeClass('checked');
                                                    }
                                                    // alert($('#rating_3').val())
                                                });
                                                $(".rating_4").on('click', function () {
                                                    if ($(".rating_4").is(":checked")){
                                                        $('.star_1').addClass('checked');
                                                        $('.star_2').addClass('checked');
                                                        $('.star_3').addClass('checked');
                                                        $('.star_4').addClass('checked');
                                                        $('.star_5').removeClass('checked');
                                                    }
                                                    // alert($('#rating_4').val())
                                                });
                                                $(".rating_5").on('click', function () {
                                                    if ($(".rating_5").is(":checked")){
                                                        $('.star_1').addClass('checked');
                                                        $('.star_2').addClass('checked');
                                                        $('.star_3').addClass('checked');
                                                        $('.star_4').addClass('checked');
                                                        $('.star_5').addClass('checked');
                                                    }
                                                    // alert($('#rating_5').val())
                                                });

                                                // bookingDues
                                                /*$('body').on('click', '.ratingBtn_{{$booking->id}}', function () {
                                                    $.ajax({
                                                        url: "{{ route('ratings.store') }}",
                                                        data:new FormData($('.ratingForm_{{$booking->id}}')[0]),
                                                        // dataType:'json',
                                                        async:false,
                                                        type:'post',
                                                        processData: false,
                                                        contentType: false,
                                                        // dataType: "html",
                                                        success: function (data) {
                                                            console.log(data);
                                                        },
                                                        error: function (data) {
                                                            // printErrorMsg(data.responseJSON.errors);
                                                            alert('Rating Failed!');
                                                            // console.log(data);
                                                        }
                                                    });
                                                });*/
                                            </script>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
