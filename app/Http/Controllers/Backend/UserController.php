<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('role', '!=', 'admin')->orderBy('id', 'desc')->get();
        return view('backend/users/index', $data);
    }
    public function create()
    {
        return view('backend/users/create');
    }
    public function store(Request $request)
    {

        if ($request->role == 'Renter'){
            $validator = Validator::make($request->all(), [
                'paypal_account'    => 'required',
                'name'              => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'avatar'            => 'required',
                'gender'            => 'required',
                'contact'           => 'required',
                'address'           => 'required',
                'govt_issued_id'    => 'required',
                'status'            => 'required',
                'role'              => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name'              => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'avatar'            => 'required',
                'gender'            => 'required',
                'contact'           => 'required',
                'address'           => 'required',
                'govt_issued_id'    => 'required',
                'status'            => 'required',
                'role'              => 'required',
            ]);
        }


        if ($validator->passes()) {

            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension();
            $avatar_name  = time() . '.' . $extension;
            $avatar->move(base_path('public/templates/images/avatars/'), $avatar_name);

            $govt_issued_id = $request->file('govt_issued_id');
            $extension = $govt_issued_id->getClientOriginalExtension();
            $govt_issued_id_name  = time() . '.' . $extension;
            $govt_issued_id->move(base_path('public/templates/images/govt_issued_id/'), $govt_issued_id_name);

            if ($request->paypal_account){
                User::create([
                    'paypal_account'=> $request->paypal_account,
                ]);
            }
            User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'avatar'            => $avatar_name,
                'gender'            => $request->gender,
                'contact'           => $request->contact,
                'address'           => $request->address,
                'govt_issued_id'    => $govt_issued_id_name,
                'status'            => $request->status,
                'role'              => $request->role,
            ]);

            $data['users'] = User::where('role', '!=', 'admin')->orderBy('id', 'desc')->get();
            return view('backend.users.index', $data);

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }
    public function show($id)
    {
        $data['user'] = User::find($id);
        return view('backend/users/show', $data);
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('backend/users/edit', $data);
    }
    public function userStatusUpdate(Request $request, $id)
    {
        User::findOrFail($id)->update([
            'status'        => $request->status,
        ]);
        $data['users'] = User::orderBy('id','desc')->get();
        return view('backend.users.index', $data);
    }
    public function update(Request $request, $id)
    {

        if ($request->role == 'Renter'){
            $validator = Validator::make($request->all(), [
                'paypal_account'    => 'required',
                'name'              => 'required',
                'email'             => 'required',
                'gender'            => 'required',
                'contact'           => 'required',
                'address'           => 'required',
                'status'            => 'required',
                'role'              => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name'              => 'required',
                'email'             => 'required',
                'gender'            => 'required',
                'contact'           => 'required',
                'address'           => 'required',
                'status'            => 'required',
                'role'              => 'required',
            ]);
        }



        if ($validator->passes()) {

            if ($request->govt_issued_id != '')
            {
                $this->validate($request, [
                    'govt_issued_id' => 'required|file|mimes:png,jpg,jpeg',
                ]);

                $govt_issued_id = $request->file('govt_issued_id');
                $extension = $govt_issued_id->getClientOriginalExtension();
                $filename  = time() . '.' . $extension;
                $govt_issued_id->move(base_path('public/templates/images/govt_issued_id/'), $filename);

                User::findOrFail($id)->update([
                    'govt_issued_id' => $filename,
                ]);
            }
            if ($request->avatar != '')
            {
                $this->validate($request, [
                    'avatar' => 'required|file|mimes:png,jpg,jpeg',
                ]);

                $avatar = $request->file('avatar');
                $extension = $avatar->getClientOriginalExtension();
                $filename  = time() . '.' . $extension;
                $avatar->move(base_path('public/templates/images/avatars/'), $filename);

                User::findOrFail($id)->update([
                    'avatar' => $filename,
                ]);
            }

            if ($request->password != ''){
                User::create([
                    'password'          => Hash::make($request->password),
                ]);
            }

            if ($request->paypal_account){
                User::findOrFail($id)->update([
                    'paypal_account'=> $request->paypal_account,
                ]);
            }

            User::findOrFail($id)->update([
                'name'              => $request->name,
                'email'             => $request->email,
                'gender'            => $request->gender,
                'contact'           => $request->contact,
                'address'           => $request->address,
                'status'            => $request->status,
                'role'              => $request->role,
            ]);

            $data['users'] = User::where('role', '!=', 'admin')->orderBy('id', 'desc')->get();
            return view('backend.users.index', $data);

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }
    public function destroy($id)
    {
        User::find($id)->delete();
    }

}
