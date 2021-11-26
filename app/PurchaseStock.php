<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseStock extends Model
{
    protected $guarded = [];
    

    public function product(){

        return $this->belongsTo(Material::class, 'material_id');
    }

    public function branch(){

        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
