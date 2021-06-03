<?php

namespace App;

use App\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    

    public function parant(){

        return $this->belongsTo(Category::class, 'parant_id');
    }
    public function childs(){

        return $this->hasMany(Category::class, 'parant_id');
    }

    public function products(){

        return $this->belongsToMany(Product::class);
    }

    public function productsbytype($pt){

        //return Menutype::find($pt)->products()->get();
       return $this->products->filter(function($product) use(&$pt){

            if(Menutype::find($pt)->products->contains($product)){
                return $product;
            }
        });

    }
}
