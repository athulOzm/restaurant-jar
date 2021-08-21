<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverylocation extends Model
{
    protected $guarded = [];

    public function branch(){

        return $this->belongsTo(Branch::class);
    }

   
}
