<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $primaryKey = 'id';

    public $itemtotal = 10.000;

    protected $appends = ['addon_total'];


   




    public function items(){

        return $this->belongsToMany(Addon::class)
            ->withPivot('quantity', 'discount', 'id')
            ->withTimestamps();
    }

    public function product(){

        return $this->belongsTo(Product::class);
    }

    public function getAddonTotalAttribute()
    {
        $tprice = [];
        $this->items->each(function($item) use(&$tprice){

            $tprice[] = number_format($item->price * $item->pivot->quantity, 3);
        });
        return number_format(array_sum($tprice), 3);
    }


}
