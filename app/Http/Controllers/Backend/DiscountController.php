<?php

namespace App\Http\Controllers\Backend;

use App\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;

class DiscountController extends Controller
{
    public function index()
    {
        $data['discounts'] = Discount::orderBy('id','desc')->get();
        return view('backend/discounts/index', $data);
    }
    public function create()
    {
        return view('backend.discounts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'type'          => 'required',
            'amount'        => 'required',
            'coupon_code'   => 'required',
        ]);

        if ($validator->passes()) {

            if ($request->status == 'on'){
                $status = 1;
            }
            else{
                $status = 0;
            }

            /*$file = $request->file('coupon_code');
            $extension = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;

            $file->move(base_path('public/testFile/'), $filename);*/


//            Discount::findOrFail($id)->update([
            Discount::create([
                'name'          => $request->name,
                'type'          => $request->type,
                'amount'        => $request->amount,
                'coupon_code'   => $request->coupon_code,
                'status'        => $status,
            ]);
            $data['discounts'] = Discount::orderBy('id','desc')->get();
            return view('backend.discounts.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function show($id)
    {
        $data['discount'] = Discount::findOrFail($id);
        return view('backend.discounts.show', $data);
    }
    public function edit($id)
    {
        $data['discount']= Discount::find($id);
        return view('backend.discounts.edit', $data);
    }
    public function discountStatusUpdate(Request $request, $id)
    {
        if ($request->status == 'on'){
            $status = 1;
        }
        else{
            $status = 0;
        }
        Discount::findOrFail($id)->update([
            'status'        => $status,
        ]);
        $data['discounts'] = Discount::orderBy('id','desc')->get();
        return view('backend.discounts.index', $data);
    }
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'type'          => 'required',
            'amount'        => 'required',
            'coupon_code'   => 'required',
        ]);

        if ($validator->passes()) {

            if ($request->status == 'on'){
                $status = 1;
            }
            else{
                $status = 0;
            }

            Discount::findOrFail($id)->update([
                'name'          => $request->name,
                'type'          => $request->type,
                'amount'        => $request->amount,
                'coupon_code'   => $request->coupon_code,
                'status'        => $status,
            ]);
            $data['discounts'] = Discount::orderBy('id','desc')->get();
            return view('backend.discounts.index', $data);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function destroy($id)
    {
        Discount::find($id)->delete();
    }
}
