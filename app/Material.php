<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function category(){

        return $this->belongsTo(Pcategory::class);
    }

    public function parchases(){

        return $this->belongsToMany(Purchase::class)
            ->withPivot('material_id', 'quantity', 'discount', 'tax', 'tax_unit', 'tax_value', 'price', 'id', 'unit_price', 'discount_unit', 'discount_value')
            ->withTimestamps();
    }

    public function unit(){

        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function punit(){

        return $this->belongsTo(Unit::class, 'punit_id');
    }

    public function subcategory(){

        return $this->belongsTo(Pcategory::class, 'subcategory_id');
    }

    public function stocks(){

        return $this->hasMany(PurchaseStock::class, 'material_id');
    }
}
