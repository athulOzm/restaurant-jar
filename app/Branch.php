<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){

        //return $this->name. ' ('.$this->code.')';
        return $this->code;

    }

    public function users(){

        return $this->belongsToMany(User::class);
    }

    public function members(){

        return $this->belongsToMany(User::class);
    }

    public function products(){

        return $this->belongsToMany(Product::class);
    }

}
