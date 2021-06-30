<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    protected $guarded = [];

    protected $appends  = ['promotion_price', 'order_received', 'stock_available'];


    public function types(){

        return $this->belongsToMany(Menutype::class);
    }

    

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function promotion(){

        return $this->belongsTo(Promotion::class);
    }

    
    


    //check promotion and get 
    public function getPromotion(){

        if($this->promotion  and $this->promotion->status == true): 

            
            if(Carbon::parse($this->promotion->to)->gte(Carbon::now()) and Carbon::parse($this->promotion->from)->lte(Carbon::now())): 

                if($this->promotion->amount_type == 2): 

                    return $this->promotion->value;
                else: 
                    return number_format($this->promotion->value, 0).'%';
                endif;

            else: 
                return false;
            endif;

        else: 
            return false;
        endif;
    }

    //get price after promo
    public function getPromotionPriceAttribute(){
        if($this->promotion and $this->promotion->status == true): 

            if(Carbon::parse($this->promotion->to)->gte(Carbon::now()) and Carbon::parse($this->promotion->from)->lte(Carbon::now())): 

                if($this->promotion->amount_type == 2): 

                    return number_format($this->price - $this->promotion->value, 3);
                else: 
                    $promo_price = number_format($this->price * $this->promotion->value / 100, 3);
                    return number_format($promo_price, 3);

                endif;

            else: 
                return 0;
            endif;

        else: 
            return 0;
        endif;
    }

 

    public function subcategory(){

        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function getAvailableQty(){

        return $this->qty;
    }

    public function branches(){

        return $this->belongsToMany(Branch::class);
    }

    public function orders(){

        return $this->belongsToMany(Order::class)
            ->withPivot('product_id', 'quantity', 'discount')
            ->withTimestamps();
    }

    public function menuprices(){

        return $this->hasMany(MenuPrice::class);
    }

    public function menustocks(){

        return $this->hasMany(MenuStock::class);
    }

    public function getmenustocks(){

        return $this->menustocks()->where('branch_id', Session::get('branch')->id)->latest();
    }

    public function addons(){

        return $this->belongsToMany(Addon::class);
    }

    //categories
    public function categories(){

        return $this->belongsToMany(Category::class);
    }

    //stock

    public function getStockAvailableAttribute(){

        //return 22;
        if($cqtyl = $this->getmenustocks()->first()){
            return $cqtyl->qty_total;
            
        }else{
            return 0;
        }
    }

    //ord rec
    public function getOrderReceivedAttribute(){

        $orders = Order::with(['products'])
            ->where('made', 0)
            ->where('status', '!=', 1)
            ->where('branch_id', Session::get('branch')->id)
            ->get();
 
        $qty = [];

         $this->orders()
            ->where('made', 0)
            ->where('branch_id', Session::get('branch')->id)
            ->get()->each(function($ord) use(&$qty){

            $qty[] = $ord->orderproducts()->where('product_id', $this->id)->first()->quantity;

        

         });

         //return Session::get('branch')->id;



        return number_format(array_sum($qty), 1);

        
    }
}
