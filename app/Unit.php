<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = [];


    public function base(){

        return $this->belongsTo(Unit::class, 'base_unit');
    }


}
