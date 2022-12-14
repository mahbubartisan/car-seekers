<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id','image','company','model','seat_capacity',
        'color','gear_type','fuel_type','registration_number',
        'availability','air_condition','minimum_charge','hourly_charge',
        'status', 'status_note',
        ];
    protected $table = 'vehicles';
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class,'vehicle_id','id');
    }
}
                                 
