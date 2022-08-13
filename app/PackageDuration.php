<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDuration extends Model
{
    protected $fillable = ['label','duration','package_id','description'];
    protected $table = 'package_durations';
    public function packages(){
        return $this->belongsTo(Package::class,'package_id','id');
    }
}
