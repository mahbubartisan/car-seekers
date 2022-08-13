@extends('layouts.backend')

@section('content')

<?php
$renters = \App\User::where('role', '!=', 'customer')->get();
?>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6" {{ Auth::user()->role == 'Admin' ? '':'hidden' }}>
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Administrator"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Users</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{count(\App\User::where('role','Customer')->get())}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6" {{ Auth::user()->role == 'Admin' ? '':'hidden' }}>
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Checked-User"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Renters</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{count(\App\User::where('role','Renter')->get())}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6" {{ Auth::user()->role == 'Admin' ? '':'hidden' }}>
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Check"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">TotalBookings</p>
                        <p class="text-primary text-24 line-height-1 mb-2">
                            {{ count(\App\Booking::all()) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-File-Clipboard-Text--Image"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">MyBookings</p>
                        <p class="text-primary text-24 line-height-1 mb-2">
                            <?php
                            $earnings = [];
                            foreach (
                                \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                                    ->where('vehicles.user_id', Auth::user()->id)->get() as $vehicle)
                            {
                                $earnings[] = \App\Booking::where('vehicle_id', $vehicle->id)->value('total_paid');
                            }
                            echo count($earnings);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6" {{ Auth::user()->role == 'Admin' ? '':'hidden' }}>
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Money-2"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">TotalEarnings</p>
                        <p class="text-primary text-24 line-height-1 mb-2">
                            ${{ number_format(\App\Booking::sum('total_paid')) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Financial"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">MyEarnings</p>
                        <p class="text-primary text-24 line-height-1 mb-2">
                            <?php
                            $earnings = [];
                            foreach (
                                \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                                    ->where('vehicles.user_id', Auth::user()->id)->get() as $vehicle)
                            {
                                $earnings[] = \App\Booking::where('vehicle_id', $vehicle->id)->value('total_paid');
                            }
                            echo '$'.array_sum($earnings);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6" {{ Auth::user()->role == 'Admin' ? '':'hidden' }}>
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <span class="nav-icon material-icons" style="font-size: 60px; color: #75509a;">
                        commute
                    </span>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">TotalVehicles</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{count(\App\Vehicle::all())}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <span class="nav-icon material-icons" style="font-size: 50px; color: #75509a;">
                        directions_car
                    </span>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">MyVehicles</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{count(\App\Vehicle::where('user_id', Auth::user()->id)->get())}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">My Bookings of last 7 days</div>
                    @if(count(\App\Booking::all()) < 1)
                        Nothing to show!
                    @else
                        <div id="last_7_day_bookings" style="width: 100%; height: 300px;"></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">My Booking Status</div>
                    {{--<div class="row pr-3 pl-3">
                        <div class="col-md-6 text-center alert alert-success">Completed: {{count(\App\Booking::where('end_time','!=',null)->get())}}</div>
                        <div class="col-md-6 text-center alert alert-danger">On Going: {{count(\App\Booking::where('end_time','=',null)->get())}}</div>
                    </div>--}}
                    <div id="complete_ongoing_bookings" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12" {{ Auth::user()->role == 'Admin' ? '':'hidden' }}>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Total Bookings of last 7 days</div>
                    @if(count(\App\Booking::all()) < 1)
                        Nothing to show!
                    @else
                        <div id="all_bookings_of_7_days" style="width: 100%; height: 300px;"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        <div class="row">
                            <div class="col-md-4">Bookings & Earnings</div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-5 text-right">
                                        <div class="input-group">
                                            <span class="text-right small mt-2 mr-3">
                                                From
                                            </span>
                                            <input type="date" name="fromDate" class="date-filter-selector mr-3" id="fromDate">
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-right">
                                        <div class="input-group">
                                            <span class="text-right small mt-2 mr-3">
                                                to
                                            </span>
                                            <input type="date" name="toDate" class="date-filter-selector mr-3" id="toDate">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="JavaScript:void(0)" class="btn btn-outline-info form-control filterBtn" data-route="{{ route('dateFilter') }}">Filter</a>
                                    </div>
                                </div>
                                <script
                                    src="https://code.jquery.com/jquery-3.5.1.min.js"
                                    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                                    crossorigin="anonymous"></script>
                                <script>
                                    // Show Filtered Record
                                    $('.filterBtn').on('click', function () {
                                        let route = $(this).data('route');
                                        let fromDate = $('#fromDate').val();
                                        let toDate = $('#toDate').val();

                                        if (fromDate > toDate){
                                            alert('FromDate cannot be after ToDate')
                                        }else{
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url: route,
                                                data:{
                                                    fromDate: fromDate,
                                                    toDate: toDate,
                                                },
                                                dataType: "html",
                                                type:'post',
                                                success: function (data) {
                                                    // globalModal.find('.loadForm').html(data);
                                                    $('#globalTable').replaceWith($('#globalTable',data));

                                                    $('#datatable').DataTable( {
                                                        "paging":   true,
                                                        "ordering": false,
                                                        "info":     true
                                                    } );
                                                },
                                                error: function (data) {
                                                    //console.log('Error:', data);
                                                }
                                            });
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </h4>

                    <div class="table-responsive" id="globalTable">
                        <table id="datatable" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                @if(Auth::user()->role == 'Admin')
                                    <th>Renter</th>
                                    <th>Renter Email</th>
                                    <th>Renter Contact</th>
                                @endif
                                <th>Customer</th>
                                <th>Customer Email</th>
                                <th>Customer Contact</th>
                                <th>Vehicle</th>
                                <th>Vehicle Reg. no.</th>
                                <th>Total Amount</th>
                                <th>Total Paid</th>
                                <th>Total Due</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count(\App\Booking::all()) > 0)
                                @if (count($vehicles) > 0)
                                    @if(Auth::user()->role == 'Admin')
                                        @foreach(
                                            $bookings as $booking
                                            )
                                            <tr>
                                                <td>{{$booking->users->name}}</td>
                                                <td>{{$booking->users->email}}</td>
                                                <td>{{$booking->users->contact}}</td>
                                                <td>{{$booking->customer_name}}</td>
                                                <td>{{$booking->customer_email}}</td>
                                                <td>{{$booking->customer_contact}}</td>
                                                <td>{{$booking->vehicles->company}} {{$booking->vehicles->model}}</td>
                                                <td>{{$booking->vehicles->registration_number}}</td>
                                                <td>{{ $booking->total_amount }}</td>
                                                <td>{{ $booking->total_paid }}</td>
                                                <td>{{ $booking->total_amount - $booking->total_paid }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td>{{$booking->customer_name}}</td>
                                                <td>{{$booking->customer_email}}</td>
                                                <td>{{$booking->customer_contact}}</td>
                                                <td>{{$booking->vehicles->company}} {{$booking->vehicles->model}}</td>
                                                <td>{{$booking->vehicles->registration_number}}</td>
                                                <td>{{ $booking->total_amount }}</td>
                                                <td>{{ $booking->total_paid }}</td>
                                                <td>{{ $booking->total_amount - $booking->total_paid }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        <div class="row">
                            <div class="col-md-12">Ratings</div>
                        </div>
                    </h4>

                    <div class="table-responsive" id="rating-globalTable">
                        <table id="rating-datatable" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                @if(Auth::user()->role == 'Admin')
                                    <th>Renter</th>
                                    <th>Renter Email</th>
                                    <th>Renter Contact</th>
                                @endif
                                <th>Customer</th>
                                <th>Customer Email</th>
                                <th>Customer Contact</th>
                                <th class="text-center">Rating</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($ratings as $rating)
                                    @if(Auth::user()->role == 'Admin')
                                        <tr>
                                            <td>{{$rating->renter_name}}</td>
                                            <td>{{$rating->renter_email}}</td>
                                            <td>{{$rating->renter_contact}}</td>
                                            <td>{{$rating->bookings->users->name}}</td>
                                            <td>{{$rating->bookings->users->email}}</td>
                                            <td>{{$rating->bookings->users->contact}}</td>
                                            <td class="text-center">
                                                <a href="JavaScript:void(0)" data-toggle="modal" data-target="#rating_{{$rating->id}}">
                                                <span class="material-icons">
                                                    visibility
                                                </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$rating->customer_name}}</td>
                                            <td>{{$rating->customer_email}}</td>
                                            <td>{{$rating->customer_contact}}</td>
                                            <td class="text-center">
                                                <a href="JavaScript:void(0)" data-toggle="modal" data-target="#rating_{{$rating->id}}">
                                                <span class="material-icons">
                                                    visibility
                                                </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="rating_{{$rating->id}}" tabindex="-1" role="dialog" aria-labelledby="rating{{$rating->id}}_ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="title" id="rating{{$rating->id}}_ModalLabel">Rating Feedback</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            @if($rating->rating == 5)
                                                                <h3 class="text-center mb-3">Rating</h3>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>

                                                                <div class="mt-3">
                                                                    <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                                                                </div>

                                                            @elseif($rating->rating == 4)
                                                                <h3 class="text-center mb-3">Rating</h3>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>

                                                                <div class="mt-3">
                                                                    <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                                                                </div>

                                                            @elseif($rating->rating == 3)
                                                                <h3 class="text-center mb-3">Rating</h3>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>

                                                                <div class="mt-3">
                                                                    <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                                                                </div>

                                                            @elseif($rating->rating == 2)
                                                                <h3 class="text-center mb-3">Rating</h3>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>

                                                                <div class="mt-3">
                                                                    <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                                                                </div>

                                                            @elseif($rating->rating == 1)
                                                                <h3 class="text-center mb-3">Rating</h3>
                                                                <label>
                                                                    <span class="material-icons text-warning" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>
                                                                <label>
                                                                    <span class="material-icons" style="font-size: 50px">grade</span>
                                                                </label>

                                                                <div class="mt-3">
                                                                    <p class="text-dark" style="font-size: 16pt;">{{ Str::limit(
                                $rating->comment, 300
                                ) }}</p>
                                                                </div>

                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load("current", {packages:["corechart"]});

        //donut chart
        /*google.charts.setOnLoadCallback(drawDonutChart);
        function drawDonutChart() {
            var data = google.visualization.arrayToDataTable([
                ['Name', 'Value'],
                <?php
                foreach(\App\User::where('role','!=','Customer')->get() as $user){
                foreach($user->bookings as $booking){
//                    foreach(\App\Vehicle::where('user_id', $user->id) as $vehicle){
//                    foreach(\App\Booking::where('vehicle_id', $vehicle->id) as $booking){
                        echo "['".$booking->id."',".count($user->bookings)."],";
                    }
                }
                ?>
            ]);

            var options = {
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('total_booking_by_renter'));
            chart.draw(data, options);
        }*/

        //pie chart
        google.charts.setOnLoadCallback(drawPieChart);
        function drawPieChart() {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'Value'],
                ['Completed',
                    <?php
                    echo count(\App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)->where('bookings.end_time','!=', null)->get());
                    ?>
                ],
                ['On Going',

                    <?php
                    echo count(\App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)->where('bookings.end_time','=', null)->get());
                    ?>

                ],
            ]);

            var options = {
                pieHole: 0,
            };

            var chart = new google.visualization.PieChart(document.getElementById('complete_ongoing_bookings'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}],
                /*["","",""]*/

                [
                    "{{ \Carbon\Carbon::now()->subDays(6)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(6)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(6)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(5)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(5)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(5)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(4)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(4)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(4)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(3)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(3)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(3)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(2)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(2)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(2)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(1)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(1)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(1)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->where('vehicles.user_id', Auth::user()->id)
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(0)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(0)->format('Y-m-d')." 23:59:59"])
                        ->get()
                    ) }}
                    ,
                    "#639"
                ],

            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation",
                },
                2]);

            var options = {
                /*title: "Density of Precious Metals, in g/cm^3",
                width: 600,
                height: 400,*/
                vAxis: {format: '0'},
                beginAtZero: true,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("last_7_day_bookings"));
            chart.draw(view, options);
        }

        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {

            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}],
                /*["","",""]*/

                [
                    "{{ \Carbon\Carbon::now()->subDays(6)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(6)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(6)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(5)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(5)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(5)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(4)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(4)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(4)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(3)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(3)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(3)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(2)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(2)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(2)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->subDays(1)->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(1)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(1)->format('Y-m-d')." 23:59:59"])
                        ->get()
                        ) }}                    ,
                    "#639"
                ],
                [
                    "{{ \Carbon\Carbon::now()->format('d-m-Y') }}",
                    {{ count(
                    \App\Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                        ->whereBetween('bookings.created_at',
                            [\Carbon\Carbon::now()->subDays(0)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::now()->subDays(0)->format('Y-m-d')." 23:59:59"])
                        ->get()
                    ) }}
                    ,
                    "#639"
                ],

            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation",
                },
                2]);

            var options = {
                /*title: "Density of Precious Metals, in g/cm^3",
                width: 600,
                height: 400,*/
                vAxis: {format: '0'},
                beginAtZero: true,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("all_bookings_of_7_days"));
            chart.draw(view, options);
        }

    </script>

@endsection
