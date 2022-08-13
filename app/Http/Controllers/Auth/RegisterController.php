<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['role'] == 'Renter'){
            return Validator::make($data, [
                'paypal_account' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

                'avatar' => ['required'],
                'govt_issued_id' => ['required'],
                'role' => ['required'],
                'address' => ['required'],
                'contact' => ['required'],
                'gender' => ['required'],
            ]);
        }else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

                'avatar' => ['required'],
                'govt_issued_id' => ['required'],
                'role' => ['required'],
                'address' => ['required'],
                'contact' => ['required'],
                'gender' => ['required'],
            ]);
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

//        $avatar = $data->file('avatar');
        $avatar = $data['avatar'];
        $extension = $avatar->getClientOriginalExtension();
        $avatar_name  = time() . '.' . $extension;
        $avatar->move(base_path('public/templates/images/avatars/'), $avatar_name);

//        $govt_issued_id = $data->file('govt_issued_id');
        $govt_issued_id = $data['govt_issued_id'];
        $extension = $govt_issued_id->getClientOriginalExtension();
        $govt_issued_id_name  = time() . '.' . $extension;
        $govt_issued_id->move(base_path('public/templates/images/govt_issued_id/'), $govt_issued_id_name);

        if ($data['role'] == 'Renter'){
//            $status = 'Pending';
            $status = 'Approved';
        }elseif ($data['role'] == 'Customer') {
            $status = 'Approved';
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            'avatar' => $avatar_name,
            'govt_issued_id' => $govt_issued_id_name,
            'status' => $status,
            'role' => $data['role'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'gender' => $data['gender'],
        ]);
    }
}
