<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;

class CategoryController extends Controller
{
    public function index(\App\Category $category){

        return view('category.Index', ['categories' => $category::with('parant')->orderBy('order', 'DESC')->get()]);
    }

    public function store(Request $request){

         
        Category::create([
            'name'  =>  $request->name,
            'parant_id' =>  $request->parant,
            'slug'  =>  Str::slug($request->name),
            'order'  =>   $request->order
        ]);

        return redirect(route('category.index'));
    }

    public function delete(Request $request){

        Category::find($request->id)->delete();
        return redirect(route('category.index'));
    }

    public function getAll(Category $category){

        return response($category->with('childs')->get(), 200);
    }

    public function getProducts($category){

        if($category == 'all'): 

            return response(Product::with('categories')->latest()->get(), 200);
        else: 

            $category = Category::where('slug', $category)->first();
           // return response($category->products, 200);
        endif;

        
    }
}
