<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

use function GuzzleHttp\Promise\each;

class Order extends Model
{

  



    protected $guarded = [];

    protected $appends = ['req_by', 'total_price', 'refund_balance'];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function reqfrom(){

        return $this->belongsTo(User::class, 'reqfrom');
    }

    public function branch(){

        return $this->belongsTo(Branch::class);
    }

    public function menutype(){

        return $this->belongsTo(Menutype::class);
    }
    
    public function invoice(){

        return $this->hasOne(Invoice::class);
    }

    public function location(){

        return $this->belongsTo(Deliverylocation::class, 'deliverylocation_id', 'id');
    }

    public function table(){

        return $this->belongsTo(Table::class);
    }

    public function products(){

        return $this->belongsToMany(Product::class)
            ->withPivot('product_id', 'quantity', 'discount', 'container', 'vat', 'price', 'promotion', 'id')
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

            $tprice[] = $item->price_total;
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

        //promotion
        $promotion = [];
        $cartitems->each(function($item) use(&$promotion){

            $promotion[] = number_format($item->promotion * $item->quantity, 3);

        });

        //container
        $cont = [];
        $cartitems->each(function($item) use(&$cont){

            $cont[] = number_format($item->container, 3);
        });

        //sub total
        $price = number_format(array_sum($tprice) + array_sum($price_addon), 3);
        $tax = number_format(array_sum($tax) + array_sum($addon_tax), 3);
        $dis = number_format(array_sum($dis), 3);
        $promotion = number_format(array_sum($promotion), 3);
        $cont = number_format(array_sum($cont), 3);
        $st = number_format($price + $tax + $cont, 3);
        $reduce = number_format($dis + $promotion ,3);

         

        return [
            'price' => $price,
            'tax' => $tax,
            'discount' => $dis,
            'container' => $cont,
            'promotion' => $promotion,
            'subtotal' => number_format($st - $reduce, 3),
        ];

    }

    public function getReqByAttribute(){

        //return $this->belongsTo(User::class, 'reqfrom', 'id')->name;
        if($re = User::where('id', $this->reqfrom)->first()){

            return $re->name;
        } else { return '';}
    }

    public function getTotalPriceAttribute(){
        
        return $this->gettotalprice()['subtotal'];
    }

    public function getRefundBalanceAttribute(){
        
     
        if(session()->has('totalprice')):

            $ramount = number_format(session()->get('totalprice') - $this->gettotalprice()['subtotal'], 3);

            if($ramount >= 0){
                return 'Refund Amount '. $ramount;
            } else{
                return 'Pay Amount '. abs($ramount);
            }

        else: 
            //return $this->gettotalprice()['subtotal'];
            return Session::get('totalprice');
        endif;
        
    }

    // public function getDeliveryTime(){

    //     return Carbon::parse($this->delivery_time)->format('g:i A');
    // }
}
