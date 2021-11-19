<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function category(){

        return $this->belongsTo(Pcategory::class);
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
}
