<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    public function products(){

        return $this->belongsToMany(Material::class)
            ->withPivot('material_id', 'quantity', 'discount', 'tax', 'tax_unit', 'tax_value', 'price', 'id', 'unit_price', 'discount_unit', 'discount_value')
            ->withTimestamps();
    }

    public function supplier(){

       return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function purchasestatus(){

        return $this->belongsTo(PurchaseStatus::class, 'purchase_status_id');
     }

     public function paymentstatus(){

        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
     }


    public function purchasematerials(){

        return $this->hasMany(PurchaseMaterial::class)->with('product');
    }


    //discound
    public function getOrderDiscountAttribute()
    {

        if ($this->discount_unit == 0) {
            
            return number_format(intval(trim($this->gettotalprice()['price'])) * intval(trim($this->discount_value))/ 100, 3);
        } else {

            return intval(trim($this->discount_value));
        }
    }


    public function gettotalprice(){

        $cartitems = $this->purchasematerials;

        //price
        $tprice = [];
        $cartitems->each(function($item) use(&$tprice){

            $tprice[] = str_replace(',', '', $item->subtotal);
        });

        // tax
        $tax = [];
        $cartitems->each(function($item) use(&$tax){

            $tax[] = str_replace(',', '', $item->tax,);
        });

        //discount
        $dis = [];
        $cartitems->each(function($item) use(&$dis){

            $dis[] = number_format(str_replace(',', '', $item->discount), 3);
        });

      

        

        //sub total
        $price = number_format(array_sum($tprice), 3);
        $tax = number_format(array_sum($tax), 3);
         $dis = number_format(array_sum($dis), 3);
        // $promotion = number_format(array_sum($promotion), 3);
        // $cont = number_format(array_sum($cont), 3);
       //  $subtt = number_format($price - $this->getOrderDiscountAttribute(), 3);
        // $reduce = number_format($dis + $promotion ,3);

 


         

        return [
            'price' => $price,
             'tax' => $tax,
             'discount' => $dis,
            // 'container' => $cont,
            // 'ordpromotion' => $subttv,
            // 'promotion' => $promotion,
            // 'subtotal' => $subtt,
        ];

    }

    

    

}
