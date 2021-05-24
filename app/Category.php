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

        return $this->hasMany(Product::class);
    }

    public function productsbytype($pt){

        return Menutype::find($pt)->products()->where('category_id', $this->id)->get();

    }
}
