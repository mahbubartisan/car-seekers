<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'paypal_account' => 'sb-gm47bl440333@business.example.com',
            'name' => 'Admin',
            'avatar' => 'default-avatar.png',
            'gender' => 'male',
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'status' => 'Approved',
            'password' => Hash::make('111111'),
            'contact' => '01111111111',
            'address' => 'Some address for the user',
            'govt_issued_id' => 'default-id.jpg',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        User::insert([
            'paypal_account' => 'sb-gm47bl440333@business.example.com',
            'name' => 'Renter',
            'avatar' => 'default-avatar.png',
            'gender' => 'male',
            'email' => 'renter@gmail.com',
            'role' => 'Renter',
            'status' => 'Approved',
            'password' => Hash::make('111111'),
            'contact' => '01111111111',
            'address' => 'Some address for the user',
            'govt_issued_id' => 'default-id.jpg',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        User::insert([
            'name' => 'Customer',
            'avatar' => 'default-avatar.png',
            'gender' => 'Female',
            'email' => 'customer@gmail.com',
            'role' => 'Customer',
            'status' => 'Approved',
            'password' => Hash::make('111111'),
            'contact' => '01111111111',
            'address' => 'Some address for the user',
            'govt_issued_id' => 'default-id.jpg',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
    }
}
