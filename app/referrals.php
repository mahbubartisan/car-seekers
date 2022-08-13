<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class referrals extends Model
{
    protected $fillable = [
        'referrer_id', 'referenced_id', 'status',
    ];
    public $table = "referrals";
}
