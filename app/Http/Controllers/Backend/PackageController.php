<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Package;
use App\PackageDuration;
use Illuminate\Http\Request;

use Validator;

class PackageController extends Controller
{
    public function index()
    {
        $data['packages'] = Package::orderBy('id','desc')->get();
        return view('backend/packages/index', $data);
    }
    public function create()
    {
        return view('backend.packages.create');
    }

    public function store(Request $request)
    {

//        return $request->all();
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
            /*'label'         => 'required',
            'duration'      => 'required',*/
        ]);

        if ($validator->passes()) {

            $package = Package::create([
                'name'         => $request->name,
                'description'  => $request->description,
            ]);
            /*foreach ($request->label as $key => $label){
                PackageDuration::create([
                    'package_id'    => $package->id,
                    'label'          => $label,
                    'duration'      => $request->duration[$key],
                    'description'  => $request->description[$key],
                ]);
            }*/
            $data['packages'] = Package::orderBy('id','desc')->get();
            return view('backend.packages.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function show($id)
    {
        $data['package'] = Package::findOrFail($id);
        return view('backend.packages.show', $data);
    }
    public function edit($id)
    {
        $data['package']= Package::find($id);
        return view('backend.packages.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
            /*'label'         => 'required',
            'duration'      => 'required',*/
        ]);

        if ($validator->passes()) {

            Package::findOrFail($id)->update([
                'name'         => $request->name,
                'description'  => $request->description,
            ]);
            /*PackageDuration::where('package_id', $id)->delete();
            foreach ($request->label as $key => $label){
                PackageDuration::create([
                    'package_id'    => $id,
                    'label'         => $label,
                    'duration'      => $request->duration[$key],
                    'description'  => $request->description[$key],
                ]);
            }*/

            $data['packages'] = Package::orderBy('id','desc')->get();
            return view('backend.packages.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function destroy($id)
    {
        Package::find($id)->delete();
    }
}
