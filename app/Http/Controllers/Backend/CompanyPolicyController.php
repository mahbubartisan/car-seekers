<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Policy;
use Illuminate\Http\Request;

use Validator;

class CompanyPolicyController extends Controller
{
    public function index()
    {
        $data['policies'] = Policy::orderBy('id','desc')->get();
        return view('backend.companyPolicies.index', $data);
    }
    public function create()
    {
        return view('backend.companyPolicies.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'description'  => 'required',
        ]);

        if ($validator->passes()) {

            Policy::create([
                'name'         => $request->name,
                'description'  => $request->description,
            ]);
            $data['policies'] = Policy::orderBy('id','desc')->get();
            return view('backend.companyPolicies.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function show($id)
    {
        $data['policy'] = Policy::findOrFail($id);
        return view('backend.companyPolicies.show', $data);
    }
    public function edit($id)
    {
        $data['policy']= Policy::find($id);
        return view('backend.companyPolicies.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'description'  => 'required',
        ]);

        if ($validator->passes()) {

            Policy::findOrFail($id)->update([
                'name'         => $request->name,
                'description'  => $request->description,
            ]);
            $data['policies'] = Policy::orderBy('id','desc')->get();
            return view('backend.companyPolicies.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function destroy($id)
    {
        Policy::find($id)->delete();
    }
}
