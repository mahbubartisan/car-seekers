<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name','description'];
    protected $table = 'packages';
    public function durations(){
        return $this->hasMany(PackageDuration::class,'package_id','id');
    }
}
