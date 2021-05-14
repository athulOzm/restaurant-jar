<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $primaryKey = 'id';

    public function items(){

        return $this->belongsToMany(Addon::class)
            ->withPivot('quantity', 'discount', 'id')
            ->withTimestamps();
    }

}
