<?php

namespace App\Http\Controllers\Backend;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Package;
use App\PackageDuration;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    function index()
    {
        $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
        $data['bookings'] = Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
            ->join('users', 'bookings.user_id', 'users.id')
            ->where('vehicles.user_id', Auth::user()->id)
            ->select('users.name as customer_name','users.email as customer_email', 'bookings.*')->get();
        return view('backend.bookings.index', $data);
    }

    function show($id)
    {
        $data['booking'] = Booking::find($id);
        $data['packages'] = Package::all();
        $data['package_duration'] = PackageDuration::where('package_id', Booking::find($id)->packages->id)->where('duration',Booking::find($id)->duration)->first();
        return view('backend.bookings.show', $data);
    }

    function endTrip($id)
    {
        $booking = Booking::find($id);

        $startTime = Carbon::parse(date('Y-m-d H:i', strtotime("$booking->start_date $booking->start_time")))->addHours($booking->duration);
        $finishTime = Carbon::now();

        if ($finishTime > $startTime){

            $extraDuration = $finishTime->diffInHours($startTime);

//            $totalDuration = $extraDuration + $booking->duration;

            $total_due = $extraDuration * $booking->vehicles->hourly_charge;

//            dd($extraDuration * $booking->vehicles->hourly_charge);

//            dd($extraDuration);

            Booking::find($id)->update([
                'total_amount'      => $booking->total_amount + $total_due,
                'end_date'          => Carbon::now()->format('Y-m-d'),
                'end_time'          => Carbon::now()->format('h:i:s'),
                'extra_duration'    => $extraDuration,
                'total_due'         => $total_due,
            ]);
        }else{
            dd('less');
        }
        $data['bookings'] = Booking::orderBy('id', 'desc')->get();
        $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
        return back();
    }
}
