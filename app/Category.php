<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    

    public function parant(){

        return $this->belongsTo(Category::class, 'parant_id');
    }
    public function childs(){

        return $this->hasMany(Category::class, 'parant_id');
    }
}
