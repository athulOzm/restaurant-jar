<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $guarded = [];


    public function orders(){

        return $this->hasMany(Order::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function branch(){

        return $this->belongsTo(Branch::class);
    }
}
