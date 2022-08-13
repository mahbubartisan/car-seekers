@extends('layouts.backend')

@section('content')

    <section class="deals_product_section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="deals_product_container">
                        <h2>Bookings</h2>
                        <div class="table-responsive" id="globalTable">
                            <table id="datatable" class="display table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Customer</th>
                                    <th>Package Name</th>
                                    <th>Duration</th>
                                    <th>Vehicle</th>
                                    <th>Vehicle Reg. no.</th>
                                    <th>Total Amount</th>
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
                                            <td>
                                                {{ $booking->customer_name }}
                                                <br>
                                                {{ $booking->customer_email }}
                                            </td>
                                            <td>{{ $booking->packages->name }}</td>
                                            <td>{{ $booking->duration }} Hours</td>
                                            <td>{{ $booking->vehicles->company }} - {{ $booking->vehicles->model }}</td>
                                            <td>{{ $booking->vehicles->registration_number }}</td>
                                            <td>$ {{ $booking->total_amount }}</td>
                                            <td>$ {{ $booking->total_paid }}</td>
                                            <td>$ {{ $booking->total_amount - $booking->total_paid == null ? '0':$booking->total_amount - $booking->total_paid }}</td>
                                            <td>{{ $booking->end_date == null ? 'On going':'Completed' }}</td>
                                            <td class="text-center">
                                                <a href="JavaScript:void(0)"
                                                   class="showBtn"
                                                   data-route="{{ route('bookings.show', $booking->id) }}"
                                                   data-formtype="modal"
                                                   data-formsize="large">
                                                    <span class="material-icons">remove_red_eye</span>
                                                </a>
                                                @if(\Carbon\Carbon::now()->format('Y-m-d H:i') > \Carbon\Carbon::parse(date('Y-m-d H:i', strtotime("$booking->start_date $booking->start_time")))->addHours($booking->duration)->format('Y-m-d H:i') && $booking->end_date == null)
                                                    <br>
                                                    <a href="{{ route('bookings.endTrip', $booking->id) }}"
                                                       class="btn btn-outline-warning">
                                                        End Trip - {{$booking->id}}
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
