<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Product extends Model
{
    protected $guarded = [];

    protected $appends  = ['promotion_price'];


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
                    return number_format($this->price - $promo_price, 3);

                endif;

            else: 
                return $this->price;  
            endif;

        else: 
            return $this->price;
        endif;
    }

    public function subcategory(){

        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function getAvailableQty(){

        return $this->qty;
    }

    public function orders(){

        return $this->belongsToMany(Order::class)
            ->withPivot('product_id', 'quantity', 'discount')
            ->withTimestamps();
    }

    public function addons(){

        return $this->belongsToMany(Addon::class);
    }

    //categories
    public function categories(){

        return $this->belongsToMany(Category::class);
    }
}
