<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id','vehicle_id','package_id','pick_up','drop_off','start_date','end_date',
        'start_time','end_time','duration','extra_duration',
        'discount_amount','total_amount','total_paid','total_due',
    ];
    protected $table = 'bookings';
    
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function packages()
    {
        return $this->belongsTo(Package::class,'package_id','id');
    }
    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
    public function ratings()
    {
        return $this->hasOne(Rating::class);
    }
}
