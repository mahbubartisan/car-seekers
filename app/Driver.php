<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id','vehicle_id','driver_name','avatar','contact',
        'email','address','driving_license','contract_paper',
    ];
    protected $table = 'drivers';
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
}
