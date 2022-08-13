<?php

namespace App\Http\Controllers\Backend;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class DriverController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Admin')
        {
            $data['drivers'] = Driver::orderBy('id','desc')->get();
        }
        else
        {
            $data['drivers'] = Driver::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        }
        $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
        return view('backend.drivers.index', $data);
    }
    public function create()
    {
        $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
        return view('backend.drivers.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id'      => 'required',
            'driver_name'     => 'required',
            'contact'         => 'required',
            'email'           => 'required',
            'address'         => 'required',
            'avatar'          => 'required',
            'driving_license' => 'required',
            'contract_paper'  => 'required',
        ]);

        if ($validator->passes()) {

            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension();
            $avatar_name  = time() . '.' . $extension;
            $avatar->move(base_path('public/templates/images/avatars'), $avatar_name);

            $driving_license = $request->file('driving_license');
            $extension = $driving_license->getClientOriginalExtension();
            $driving_license_name  = time() . '.' . $extension;
            $driving_license->move(base_path('public/templates/images/driving_license'), $driving_license_name);

            $contract_paper = $request->file('contract_paper');
            $extension = $contract_paper->getClientOriginalExtension();
            $contract_paper_name  = time() . '.' . $extension;
            $contract_paper->move(base_path('public/templates/images/contract_paper'), $contract_paper_name);

            Driver::create([
                'user_id'         => Auth::user()->id,
                'vehicle_id'      => $request->vehicle_id,
                'driver_name'     => $request->driver_name,
                'contact'         => $request->contact,
                'email'           => $request->email,
                'address'         => $request->address,
                'avatar'          => $avatar_name,
                'driving_license' => $driving_license_name,
                'contract_paper'  => $contract_paper_name,
            ]);
            if (Auth::user()->role == 'Admin')
            {
                $data['drivers'] = Driver::orderBy('id','desc')->get();
            }
            else
            {
                $data['drivers'] = Driver::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
            }
            $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
            return view('backend.drivers.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function show($id)
    {
        $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
        $data['driver'] = Driver::findOrFail($id);
        return view('backend.drivers.show', $data);
    }
    public function edit($id)
    {
        $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
        $data['driver']= Driver::find($id);
        return view('backend.drivers.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id'      => 'required',
            'driver_name'     => 'required',
            'contact'         => 'required',
            'email'           => 'required',
            'address'         => 'required',
        ]);

        if ($validator->passes()) {

            if ($request->hasFile('avatar'))
            {
                $avatar = $request->file('avatar');
                $extension = $avatar->getClientOriginalExtension();
                $avatar_name  = time() . '.' . $extension;
                $avatar->move(base_path('public/templates/images/avatars'), $avatar_name);
                Driver::findOrFail($id)->update([
                    'avatar'          => $avatar_name,
                ]);
            }
            if ($request->hasFile('driving_license'))
            {
                $driving_license = $request->file('driving_license');
                $extension = $driving_license->getClientOriginalExtension();
                $driving_license_name  = time() . '.' . $extension;
                $driving_license->move(base_path('public/templates/images/driving_license'), $driving_license_name);
                Driver::findOrFail($id)->update([
                    'driving_license' => $driving_license_name,
                ]);
            }
            if ($request->hasFile('contract_paper'))
            {
                $contract_paper = $request->file('contract_paper');
                $extension = $contract_paper->getClientOriginalExtension();
                $contract_paper_name  = time() . '.' . $extension;
                $contract_paper->move(base_path('public/templates/images/contract_paper'), $contract_paper_name);
                Driver::findOrFail($id)->update([
                    'contract_paper'  => $contract_paper_name,
                ]);
            }

            Driver::findOrFail($id)->update([
                'user_id'         => Auth::user()->id,
                'vehicle_id'      => $request->vehicle_id,
                'driver_name'     => $request->driver_name,
                'contact'         => $request->contact,
                'email'           => $request->email,
                'address'         => $request->address,
            ]);
            if (Auth::user()->role == 'Admin')
            {
                $data['drivers'] = Driver::orderBy('id','desc')->get();
            }
            else
            {
                $data['drivers'] = Driver::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
            }
            $data['vehicles'] = Vehicle::where('user_id', Auth::user()->id)->get();
            return view('backend.drivers.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }
    public function destroy($id)
    {
        Driver::find($id)->delete();
    }
}
