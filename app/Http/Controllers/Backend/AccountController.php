<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib\Crypt\Hash;

class AccountController extends Controller
{
    public function index()
    {
        if(Auth::user()->role != 'Customer')
        {
            return view('backend/accounts/index');
        }
        else
        {
            return view('frontend/accounts/index');
        }
    }
    /*public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $user = Auth::user();
        if(Auth::user()->role != 'Customer')
        {
            return view('backend/accounts/show', compact('user'));
        }
        else
        {
            return view('frontend/accounts/show', compact('user'));
        }
    }
    */
    public function edit()
    {
        $user = Auth::user();
        if(Auth::user()->role != 'Customer')
        {
            return view('backend/accounts/edit', compact('user'));
        }
        else
        {
            return view('frontend/accounts/edit', compact('user'));
        }
    }
    public function update(Request $request)
    {
        if ($request->govt_issued_id != '')
        {
            $this->validate($request, [
                    'govt_issued_id' => 'required|file|mimes:png,jpg,jpeg',
                ]);

            $govt_issued_id = $request->file('govt_issued_id');
            $extension = $govt_issued_id->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;

            $govt_issued_id->move(base_path('public/templates/images/govt_issued_id/'), $filename);

            User::findOrFail(Auth::user()->id)->update([
            'govt_issued_id' => $filename,
        ]);
        }
        if ($request->avatar != '')
        {
            $this->validate($request, [
                    'avatar' => 'required|file|mimes:png,jpg,jpeg',
                ]);

            $avatar = $request->avatar;

            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;

            $avatar->move(base_path('public/templates/images/avatars/'), $filename);

            User::findOrFail(Auth::user()->id)->update([
                'avatar' => $filename,
            ]);
        }
        User::findOrFail(Auth::user()->id)->update([
            'paypal_account' => $request->paypal_account,
            'name' => $request->name,
            'gender' => $request->gender,
            'contact' =>$request->contact,
            'address' => $request->address,
        ]);
        return back()->with('success','Information Updated!');
    }
    /*public function destroy($id)
    {
        //
    }*/
}
