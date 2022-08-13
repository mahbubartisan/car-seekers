<?php

namespace App\Http\Controllers\Backend;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index() {
        if (Auth::user()->role == 'Customer')
        {
            return redirect('/');
        }
        else
        {
            $data['vehicles'] = \App\Vehicle::all();
            if (Auth::user()->role == 'Admin')
            {
                $data['bookings'] = Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                                        ->join('users', 'bookings.user_id', 'users.id')
                                        ->select('users.name as customer_name','users.email as customer_email','users.contact as customer_contact', 'bookings.*','vehicles.*')->get();

                $data['ratings'] = Rating::join('bookings', 'ratings.booking_id', 'bookings.id')
                                        ->join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                                        ->leftjoin('users as renters', 'vehicles.user_id', 'renters.id')
                                        ->select('renters.name as renter_name','renters.email as renter_email','renters.contact as renter_contact', 'bookings.*','vehicles.*','ratings.*')->get();
            }
            else
            {
                $data['bookings'] = Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                    ->join('users', 'bookings.user_id', 'users.id')
                    ->where('vehicles.user_id', Auth::user()->id)
                    ->select('users.name as customer_name','users.email as customer_email','users.contact as customer_contact', 'bookings.*','vehicles.*')->get();

                $data['ratings'] = Rating::join('bookings', 'ratings.booking_id', 'bookings.id')
                    ->join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                    ->join('users', 'bookings.user_id', 'users.id')
                    ->where('vehicles.user_id', Auth::user()->id)
                    ->select('users.name as customer_name','users.email as customer_email','users.contact as customer_contact', 'bookings.*','vehicles.*','ratings.*')->get();


                /*$data['bookings'] = Booking::join('vehicles', 'bookings.vehicle_id', 'vehicles.id')
                    ->where('vehicles.user_id', Auth::user()->id)->get();*/
            }
//            dd($bookings);
            return view('backend/dashboard', $data);
        }
    }
}
