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

        return $this->belongsToMany(Product::class)->withPivot('product_id', 'quantity', 'discount', 'id');
    }

    public function gettotalprice(){

        $items = $this->belongsToMany(Product::class)->withPivot('product_id', 'quantity', 'discount', 'id');

        $tprice = [];
        $items->each(function($item) use(&$tprice){

            $tprice[] = number_format($item->price * $item->pivot->quantity, 3);
        });

        $dis = [];
        $items->each(function($item) use(&$dis){

            $dis[] = number_format($item->pivot->discount, 3);
        });

        $st = number_format(array_sum($tprice),3) - number_format(array_sum($dis),3);

         

        return [
            'price' => number_format(array_sum($tprice), 3), 
            'discount' => number_format(array_sum($dis), 3),
            'subtotal' => number_format($st, 3)
        ];

         

        
    }

    // public function getDeliveryTime(){

    //     return Carbon::parse($this->delivery_time)->format('g:i A');
    // }
}
