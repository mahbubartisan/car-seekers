<?php

namespace App\Http\Controllers\Frontend;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
//        dd($request->all());
        Rating::create([
            'booking_id'    => $request->booking_id,
            'user_id'       => Auth::user()->id,
            'rating'        => $request->rating,
            'comment'       => $request->comment,
        ]);
        return back()->with('Success', 'Thank you for your rating!');
    }
    public function show($id)
    {
        return view('frontend.ratings.show');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
