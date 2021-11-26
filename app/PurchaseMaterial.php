<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseMaterial extends Model
{
    protected $table = 'material_purchase';
    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $appends = ['price', 'discount', 'tax', 'subtotal'];


    public function product(){

        return $this->belongsTo(Material::class, 'material_id');
    }


    

    //discound
    public function getDiscountAttribute()
    {

        if ($this->discount_unit == 0) {
            
            return number_format(intval(trim($this->getPriceAttribute())) * intval(trim($this->discount_value))/ 100, 3);
        } else {

            return intval(trim($this->discount_value));
        }
    }


    //tax
    public function getTaxAttribute()
    {

        if ($this->tax_unit == 0) {

            $tot_pri_with_dis = number_format(intval(trim($this->getPriceAttribute())) - intval(trim($this->getDiscountAttribute())), 3);
            return number_format(str_replace(',', '', $tot_pri_with_dis) * intval(trim($this->tax_value))/ 100, 3);
        } else {

            return intval(trim($this->tax_value));
        }
    }

    


    //price
    public function getPriceAttribute()
    {
        return number_format($this->unit_price * $this->quantity, 3);
    }

    //sub total price
    public function getSubtotalAttribute()
    {
        return number_format(str_replace(',', '', $this->getPriceAttribute()) - str_replace(',', '', $this->getDiscountAttribute()) + str_replace(',', '', $this->getTaxAttribute()), 3);
    }

    
}
