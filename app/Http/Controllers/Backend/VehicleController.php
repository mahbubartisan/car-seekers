<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;

class VehicleController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Admin')
        {
            $data['vehicles'] = Vehicle::orderBy('id','desc')->get();
        }
        else
        {
            $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        }
        return view('backend.vehicles.index', $data);
    }
    public function create()
    {
        return view('backend.vehicles.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'                 => 'required',
            'company'               => 'required',
            'model'                 => 'required',
            'seat_capacity'         => 'required',
            'color'                 => 'required',
            'gear_type'             => 'required',
            'fuel_type'             => 'required',
            'registration_number'   => 'required',
            'air_condition'         => 'required',
            'minimum_charge'        => 'required',
            'hourly_charge'         => 'required',
        ]);

        if ($validator->passes()) {

            if ($request->availability == 'on'){
                $availability = 1;
            }
            else{
                $availability = 0;
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name  = time() . '.' . $extension;
            $image->move(base_path('public/templates/images/vehicles'), $image_name);

            if (Auth::user()->role == 'Admin'){
                $status = 'Approved';
            }else{
                $status = 'Pending';
            }

            Vehicle::create([
                'user_id'               => Auth::user()->id,
                'image'                 => $image_name,
                'company'               => $request->company,
                'model'                 => $request->model,
                'seat_capacity'         => $request->seat_capacity,
                'color'                 => $request->color,
                'gear_type'             => $request->gear_type,
                'fuel_type'             => $request->fuel_type,
                'registration_number'   => $request->registration_number,
                'availability'          => $availability,
                'air_condition'         => $request->air_condition,
                'minimum_charge'        => $request->minimum_charge,
                'hourly_charge'         => $request->hourly_charge,
                'status'         => $status,
            ]);
            if (Auth::user()->role == 'Admin')
            {
                $data['vehicles'] = Vehicle::orderBy('id','desc')->get();
            }
            else
            {
                $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
            }
            return view('backend.vehicles.index', $data);
            return view('backend.vehicles.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function show($id)
    {
        $data['vehicle'] = Vehicle::findOrFail($id);
        return view('backend.vehicles.show', $data);
    }
    public function edit($id)
    {
        $data['vehicle'] = Vehicle::findOrFail($id);
        return view('backend.vehicles.edit', $data);
    }
    public function vehicleStatusUpdate(Request $request, $id)
    {
        if ($request->availability == 'on'){
            $status = 1;
        }
        else{
            $status = 0;
        }
        Vehicle::findOrFail($id)->update([
            'availability'        => $status,
        ]);
        if (Auth::user()->role == 'Admin')
        {
            $data['vehicles'] = Vehicle::orderBy('id','desc')->get();
        }
        else
        {
            $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        }
        return view('backend.vehicles.index', $data);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company'               => 'required',
            'model'                 => 'required',
            'seat_capacity'         => 'required',
            'color'                 => 'required',
            'gear_type'             => 'required',
            'fuel_type'             => 'required',
            'registration_number'   => 'required',
            'air_condition'         => 'required',
            'minimum_charge'        => 'required',
            'hourly_charge'         => 'required',
        ]);

        if ($validator->passes()) {

            if ($request->availability == 'on'){
                $availability = 1;
            }
            else{
                $availability = 0;
            }

            if ($request->hasFile('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $image_name  = time() . '.' . $extension;
                $image->move(base_path('public/templates/images/vehicles'), $image_name);

                Vehicle::findOrFail($id)->update([
                    'image'                 => $image_name,
                ]);
            }

            if (Auth::user()->role == 'Admin'){
                $status = 'Approved';
            }else{
                $status = 'Pending';
            }

            Vehicle::findOrFail($id)->update([
                'user_id'               => Auth::user()->id,
                'company'               => $request->company,
                'model'                 => $request->model,
                'seat_capacity'         => $request->seat_capacity,
                'color'                 => $request->color,
                'gear_type'             => $request->gear_type,
                'fuel_type'             => $request->fuel_type,
                'registration_number'   => $request->registration_number,
                'availability'          => $availability,
                'air_condition'         => $request->air_condition,
                'minimum_charge'        => $request->minimum_charge,
                'hourly_charge'         => $request->hourly_charge,
                'status'                => $status,
            ]);
            if (Auth::user()->role == 'Admin')
            {
                $data['vehicles'] = Vehicle::orderBy('id','desc')->get();
            }
            else
            {
                $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
            }
            return view('backend.vehicles.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function approval(Request $request, $id)
    {
//        return "status-".$request->status." --- ".$id;
        if ($request->status == 'Approved')
        {
            Vehicle::find($id)->update([
                'status'  => 'Approved',
            ]);

            $data['vehicles'] = Vehicle::orderBy('id','desc')->get();
            return view('backend.vehicles.index', $data);
        }
        if ($request->status == 'Disapproved')
        {
            $validator = Validator::make($request->all(), [
                'status'      => 'required',
                'status_note' => 'required',
            ]);
            if ($validator->passes()) {
                Vehicle::find($id)->update([
                    'status'        => $request->status,
                    'status_note'   => $request->status_note,
                ]);

                $data['vehicles'] = Vehicle::orderBy('id','desc')->get();
                return view('backend.vehicles.index', $data);
            }
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        /*else
        {
            Vehicle::find($id)->update([
                'status'  => 'Approved',
            ]);
            $data['vehicles'] = Vehicle::orderBy('id','desc')->get();
            return view('backend.vehicles.index', $data);
        }*/
    }
    public function destroy($id)
    {
        Vehicle::find($id)->delete();
    }
}
