<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['name','type','amount','coupon_code','status',];
    protected $table = 'discounts';
}
