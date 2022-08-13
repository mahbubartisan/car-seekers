<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    function index()
    {
        if (Auth::user() && Auth::user()->role != 'Customer'){
            return redirect('/dashboard');
        }
        return view('frontend.index');
    }
    function bookings()
    {
        if (Auth::user() && Auth::user()->role != 'Customer'){
            return redirect('/dashboard');
        }
        return view('frontend.bookings.index');
    }
    function policies()
    {
        if (Auth::user() && Auth::user()->role != 'Customer'){
            return redirect('/dashboard');
        }
        return view('frontend.policies');
    }
    function about()
    {
        if (Auth::user() && Auth::user()->role != 'Customer'){
            return redirect('/dashboard');
        }
        return view('frontend.about');
    }
    function contact()
    {
        if (Auth::user() && Auth::user()->role != 'Customer'){
            return redirect('/dashboard');
        }
        return view('frontend.contact');
    }
}
