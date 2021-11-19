<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pcategory extends Model
{
    protected $guarded = [];

    public function parant(){

        return $this->belongsTo(Pcategory::class, 'parant_id');
    }
    public function childs(){

        return $this->hasMany(Pcategory::class, 'parant_id');
    }
}
