<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Mail\InvoiceMail;
use App\Package;
use \App\Payment;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function payment(Request $request){
        /*$package=Package::find($request->id);
        return view('payment',compact('package'));*/
    }
    public function paymentInfo(Request $request){

        if($request->tx){
            if($payment= Payment::where('transaction_id',$request->tx)->first()){
                $payment_id=$payment->id;
            }else{
                $payment = Payment::create([
                    'user_id' => Auth::user()->id,
                    'transaction_id'=>$request->tx,
                    'currency_code'=>$request->cc,
                    'payment_status'=>$request->st,
                ]);

                /*Notification::create([
                    'user_id' => Auth::id(),
                    'subject' => 'Purchase',
                    'message' => 'Payment '.$request->st.'! Transaction id is: '.$request->tx,
                ]);*/

                $payment_id=$payment->id;

                /*$payToAdmin = json_decode(Session::get('adminPayments'));

                if ($payToAdmin != null){
                    //
                    Session::forget('adminPayments');
                }*/

                $bookings = json_decode(Session::get('bookings'));
                $bookingDues = json_decode(Session::get('bookingDues'));

                if ($bookingDues != null){
                    foreach ($bookingDues as $bookingDue){
                        Booking::find($bookingDue->booking_id)->update([
                            'total_amount' => $bookingDue->total_amount,
                            'total_paid' => $bookingDue->total_paid,
                            'total_due' => $bookingDue->total_due,
                        ]);
                        $booking = Booking::find($bookingDue->booking_id);
                        $booking->payments()->attach($payment_id);
                    }
                }

                if ($bookingDues == null){
                    foreach ($bookings as $session_booking){
                        $booking = Booking::create([
                            'user_id' => Auth::user()->id,
                            'vehicle_id' => $session_booking->vehicle_id,
                            'package_id' => $session_booking->package_id,

                            'pick_up' => $session_booking->pick_up,
                            'drop_off' => $session_booking->drop_off,

                            'start_date' => $session_booking->start_date,
//                        'end_date' => $session_booking->start_date,
                            'start_time' => $session_booking->start_time,
//                        'end_time' => $session_booking->start_time,
                            'duration' => $session_booking->duration,
//                        'extra_duration' => 0,
//                        'discount_amount' => 0,

                            'total_amount' => $session_booking->total_amount,
                            'total_paid' => $session_booking->total_amount,
//                        'total_due' => 0,
                        ]);

                        $booking = Booking::find($booking->id);
                        $booking->payments()->attach($payment_id);

                        $vehicle = Vehicle::find($session_booking->vehicle_id);
                        $package = Package::find($session_booking->package_id);
                        $start_date =$session_booking->start_date;
                        $start_time =$session_booking->start_time;

                        $data = [
                            'booking_date'          => Carbon::now()->toDayDateTimeString(),
                            'transaction_id'        => $request->tx,
                            'total_paid'            => $session_booking->total_amount,

                            'customer_name'         => Auth::user()->name,
                            'customer_email'        => Auth::user()->email,
                            'customer_contact'      => Auth::user()->contact,
                            'customer_address'      => Auth::user()->address,

                            'total_duration'        => Carbon::parse(date('Y-m-d H:i', strtotime("$start_date $start_time")))->format('d-m-Y H:i').' <span style="color: red !important;">to</span> '.Carbon::parse(date('Y-m-d H:i', strtotime("$start_date $start_time")))->addHours($session_booking->duration)->format('d-m-Y H:i').' ('.$session_booking->duration.' Hours)',
                            'package'               => $package->name,
                            'duration'              => $session_booking->duration,
                            'start_date'            =>'Date: '.$session_booking->start_date.'</br>Time: '.$session_booking->start_time,
                            'pick_up'               => $session_booking->pick_up,
                            'drop_off'              => $session_booking->drop_off,
                            'vehicle'               => $vehicle->Company.' '.$vehicle->model.' -- Reg. '.$vehicle->registration_number.' -- Color: '.$vehicle->color,
                        ];
//                        InvoiceMail::to(Auth::user()->email)->send(new SendMail($data));
                        Mail::to(Auth::user()->email)->send(new InvoiceMail($data));
                    }
                }

                Session::forget('bookingDues');
                Session::forget('bookings');

                /*Notification::create([
                    'user_id' => Auth::id(),
                    'subject' => 'Order',
                    'message' => $cart_item->name.' has been ordered successfully!',
                ]);*/

            }
            //return 'Pyament has been done and your payment id is : '.$payment_id;
//            toastr()->success('Success!','Payment completed!');
//            return redirect('/my-bookings/'.$payment_id);
            return redirect('/my-bookings');

        }else{
            return 'Payment has failed';
        }
    }
}
