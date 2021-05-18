<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $guarded = [];

    public function products(){

        return $this->belongsToMany(Product::class);
    }
}
