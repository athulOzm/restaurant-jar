<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Menutype extends Model
{
    protected $guarded = [];

    public function products(){

        return $this->belongsToMany(Product::class);
    }
 
}
