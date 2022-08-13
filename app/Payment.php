<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id','transaction_id','currency_code','payment_status',
    ];
    protected $table = 'payments';
    
    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
