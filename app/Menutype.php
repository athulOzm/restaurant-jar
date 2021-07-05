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

        $products =  $this->products()->with('categories');

        $cat = [];

        $products->each(function($product) use(&$cat){
 

            $product->categories()->each(function($ca) use(&$cat){
                //dd($cat);
                $cat[] = $ca;
            
            });


            
            
        });

     


        $collection = collect($cat);

        

        

        $collection = $collection->filter(function ($value) { return !is_null($value); });

        
        $ddd = (new \Illuminate\Database\Eloquent\Collection($collection))->unique();

        return $ddd;

       // return $collection->unique();

    }
 
}
