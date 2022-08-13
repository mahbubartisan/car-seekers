<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Package;
use App\PackageDuration;
use Illuminate\Http\Request;

use Validator;

class DurationController extends Controller
{
    public function index()
    {
        $data['packages'] = Package::orderBy('id','desc')->get();
        $data['durations'] = PackageDuration::orderBy('id','desc')->get();
        return view('backend/durations/index', $data);
    }
    public function create()
    {
        $data['packages'] = Package::orderBy('id','desc')->get();
        return view('backend.durations.create', $data);
    }

    public function store(Request $request)
    {

//        return $request->all();

        $validator = Validator::make($request->all(), [
            'package_id'    => 'required',
            'description'   => 'required',
            'label'         => 'required',
            'duration'      => 'required',
        ]);

        if ($validator->passes()) {

            PackageDuration::create([
                'package_id'    => $request->package_id,
                'label'         => $request->label,
                'duration'      => $request->duration,
                'description'  => $request->description,
            ]);

            $data['packages'] = Package::orderBy('id','desc')->get();
            $data['durations'] = PackageDuration::orderBy('id','desc')->get();
            return view('backend.durations.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function show($id)
    {
        $data['packages'] = Package::orderBy('id','desc')->get();
        $data['duration'] = PackageDuration::findOrFail($id);
        return view('backend.durations.show', $data);
    }
    public function edit($id)
    {
        $data['packages'] = Package::orderBy('id','desc')->get();
        $data['duration'] = PackageDuration::findOrFail($id);
        return view('backend.durations.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'package_id'    => 'required',
            'description'   => 'required',
            'label'         => 'required',
            'duration'      => 'required',
        ]);

        if ($validator->passes()) {

            PackageDuration::find($id)->update([
                'package_id'    => $request->package_id,
                'label'         => $request->label,
                'duration'      => $request->duration,
                'description'  => $request->description,
            ]);

            $data['packages'] = Package::orderBy('id','desc')->get();
            $data['durations'] = PackageDuration::orderBy('id','desc')->get();
            return view('backend.durations.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function destroy($id)
    {
        PackageDuration::find($id)->delete();
    }
}
