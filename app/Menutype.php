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

    public function categories(){

        $products =  $this->belongsToMany(Product::class)->with('categories');

        $cat = [];

        $products->each(function($product) use(&$cat){

            $cat[] = $product->category;
        });

        $collection = collect($cat);

        //$collection = $collection->filter(function ($value) { return !is_null($value); });

        return $collection->unique();

    }
 
}
