<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public function types(){

        return $this->belongsToMany(Menutype::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function getAvailableQty(){

        return $this->qty;
    }

    public function orders(){

        return $this->belongsToMany(Order::class)->withPivot('product_id', 'quantity');
    }
}
