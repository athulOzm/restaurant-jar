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

        //price without tax and dis
        $tprice = [];
        $cartitems->each(function($item) use(&$tprice){

            $tprice[] = $item->price_total_without_dis;
        });
        //price add on without tax
        $price_addon = [];
        $cartitems->each(function($item) use(&$price_addon){

            $price_addon[] = number_format($item->addon_total_without_tax, 3);
        });



        // tax
        $tax = [];
        $cartitems->each(function($item) use(&$tax){

            $tax[] = $item->tax;
        });
        // tax addon
        $addon_tax = [];
        $cartitems->each(function($item) use(&$addon_tax){

            $addon_tax[] = number_format($item->addon_tax, 3);
        });







        //discount
        $dis = [];
        $cartitems->each(function($item) use(&$dis){

            $dis[] = number_format($item->discount, 3);
        });

        //sub total
        $price = number_format(array_sum($tprice) + array_sum($price_addon), 3);
        $tax = number_format(array_sum($tax) + array_sum($addon_tax), 3);
        $dis = number_format(array_sum($dis), 3);
        $st = number_format($price + $tax, 3);

         

        return [
<<<<<<< HEAD
            'price' => number_format(array_sum($tprice) + array_sum($price_addon), 3), 
            'discount' => number_format(array_sum($dis), 3),
            'subtotal' => $st_with_addon
=======
            'price' => $price,
            'tax' => $tax,
            'discount' => $dis,
            'subtotal' => number_format($st - $dis, 3),
>>>>>>> 2adbd25b2407145b5a3f711c2b35242392736a02
        ];

    }

    // public function getDeliveryTime(){

    //     return Carbon::parse($this->delivery_time)->format('g:i A');
    // }
}
