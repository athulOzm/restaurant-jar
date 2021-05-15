<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use function GuzzleHttp\Promise\each;

class Order extends Model
{

  



    protected $guarded = [];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function location(){

        return $this->belongsTo(Deliverylocation::class, 'deliverylocation_id', 'id');
    }

    public function table(){

        return $this->belongsTo(Table::class);
    }

    public function products(){

        return $this->belongsToMany(Product::class)
            ->withPivot('product_id', 'quantity', 'discount', 'id')
            ->withTimestamps();
    }

    public function orderproducts(){

        // return $this->belongsTo(Product::class)
        //     ->withPivot('product_id', 'quantity', 'discount', 'id')
        //     ->withTimestamps();

        return $this->hasMany(OrderProduct::class)->with('items', 'product');
    }

    public function gettotalprice(){

        $cartitems = $this->orderproducts;

        //price
        $tprice = [];
        $cartitems->each(function($item) use(&$tprice){

            $tprice[] = number_format($item->product->price * $item->quantity, 3);
        });

        //price add on
        $price_addon = [];
        $cartitems->each(function($item) use(&$price_addon){

            $price_addon[] = number_format($item->addon_total, 3);
        });

        //discount
        $dis = [];
        $cartitems->each(function($item) use(&$dis){

            $dis[] = number_format($item->discount, 3);
        });

        //sub total
        $st = number_format(array_sum($tprice),3) - number_format(array_sum($dis),3);
        $st_with_addon = number_format($st + array_sum($price_addon), 3);

         

        return [
            'price' => number_format(array_sum($tprice), 3), 
            'discount' => number_format(array_sum($dis), 3),
            'subtotal' => $st_with_addon
        ];

    }

    // public function getDeliveryTime(){

    //     return Carbon::parse($this->delivery_time)->format('g:i A');
    // }
}
