<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $primaryKey = 'id';

    public $itemtotal = 10.000;

    protected $appends = ['addon_total', 'addon_tax', 'addon_total_without_tax', 'price_total', 'price_total_without_dis', 'price_total_with_tax', 'tax', 'available_addons'];


   




    public function items(){

        return $this->belongsToMany(Addon::class)
            ->withPivot('quantity', 'discount', 'id')
            ->withTimestamps();
    }

    public function getAvailableAddonsAttribute(){

        return $this->product->addons;
    }

    public function product(){

        return $this->belongsTo(Product::class);
    }

    public function getAddonTotalAttribute()
    {
        $tprice = [];
        $this->items->each(function($item) use(&$tprice){

            $tprice[] = number_format($item->price * $item->pivot->quantity, 3);
            $tp = number_format($item->price * $item->pivot->quantity, 3);
            $tprice[] = number_format($tp * $item->vat / 100, 3);

        });

        return number_format(array_sum($tprice), 3);
    }

    //addon tax
    public function getAddonTaxAttribute()
    {
        $tprice = [];
        $this->items->each(function($item) use(&$tprice){

            $tp = number_format($item->price * $item->pivot->quantity, 3);
            $tprice[] = number_format($tp * $item->vat / 100, 3);
        });

        return number_format(array_sum($tprice), 3);
    }

    //addon without tax
    public function getAddonTotalWithoutTaxAttribute()
    {
        $tprice = [];
        $this->items->each(function($item) use(&$tprice){

            $tprice[] = number_format($item->price * $item->pivot->quantity, 3);
        });

        return number_format(array_sum($tprice), 3);
    }


    public function getPriceTotalAttribute()
    {
        $tp = number_format($this->product->price * $this->quantity, 3);
        return number_format($tp - $this->discount, 3);
    }

    public function getPriceTotalWithoutDisAttribute()
    {
        return  number_format($this->product->price * $this->quantity, 3);
     
    }

    public function getPriceTotalWithTaxAttribute()
    {
        $tp = number_format($this->product->price * $this->quantity, 3);
        $vat = number_format($tp * $this->product->vat/ 100, 3);
        $st = number_format($tp + $vat, 3);
        return number_format($st - $this->discount, 3);
    }

    public function getTaxAttribute()
    {
        $tp = number_format($this->product->price * $this->quantity, 3);
        $vat = number_format($tp * $this->product->vat/ 100, 3);
       // $st = number_format($tp + $vat, 3);
        return number_format($vat, 3);
    }


}
