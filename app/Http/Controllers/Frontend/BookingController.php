<?php

namespace App\Http\Controllers\Frontend;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Package;
use App\PackageDuration;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function get_booking_options(Request $request)
    {
        $data['package'] = Package::find($request->package_id);
        $data['package_duration'] = PackageDuration::find($request->duration_id);
        $data['pick_up'] = $request->pick_up;
        $data['drop_off'] = $request->drop_off;
        $data['start_date'] = $request->start_date;
        $data['start_time'] = $request->start_time;
        $data['vehicles'] = Vehicle::where('availability', '=', '1')->where('status','=','Approved')->get();
        if (Auth::user()){
            $data['booking'] = Auth::user()->bookings->where('total_due', '!=', '0')->first();
        }
        return view('frontend.bookings.booking-options', $data);
        return redirect('/booking-options');
    }
    public function booking_session_store(Request $request)
    {

//        Session::put('data', $request->data);
//        Session::get('data');
//        Session::forget('data');
//        $request->session()->get('data');

//        Session::push('user.teams', 'developers'); // Not tested yet!

        $bookings = [
            'bookings' => [
                "vehicle_id" => $request->vehicle_id,
                "package_id" => $request->package_id,
                "pick_up" => $request->pick_up,
                "drop_off" => $request->drop_off,
                "start_date" => $request->start_date,
                "start_time" => $request->start_time,
                "duration" => $request->duration,
                "total_amount" => $request->total_amount,
            ]
        ];

        Session::forget('bookings');

        Session::put('bookings', json_encode($bookings));

        if ($request->session()->get('bookings')){
            return $request->session()->get('bookings');
        }else{
            return "forgot";
        }

    }
    public function booking_due_session_store(Request $request)
        {

            $bookingDues = [
                'bookingDues' => [
                    "booking_id" => $request->booking_id,
                    "total_amount" => $request->total_amount,
                    "total_paid" => $request->total_paid + $request->total_due,
                    "total_due" => 0,
                ]
            ];

            Session::forget('bookingDues');

            Session::put('bookingDues', json_encode($bookingDues));

            if ($request->session()->get('bookingDues')){
                return $request->session()->get('bookingDues');
            }else{
                return "forgot";
            }

        }

    function index()
    {
        $data['bookings'] = Booking::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('frontend.bookings.index', $data);
    }

    function show($id)
    {
        $data['booking'] = Booking::find($id);
        $data['packages'] = Package::all();
        $data['package_duration'] = PackageDuration::where('package_id', Booking::find($id)->packages->id)->where('duration',Booking::find($id)->duration)->first();
        return view('frontend.bookings.show', $data);
    }

}
