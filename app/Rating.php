<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id','booking_id','rating','comment',
    ];
    protected $table = 'ratings';
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function bookings()
    {
        return $this->belongsTo(Booking::class,'booking_id','id');
    }
}
