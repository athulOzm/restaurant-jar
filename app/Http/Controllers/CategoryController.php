<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use Image;


class CategoryController extends Controller
{
    public function index(\App\Category $category){

        return view('category.Index', ['categories' => $category::with('parant')->orderBy('order', 'DESC')->get()]);
    }

    public function store(Request $request){


        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(100, 100)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

         
        Category::create([
            'name'  =>  $request->name,
            'parant_id' =>  $request->parant,
            'order'  =>   $request->order,
            'cover' =>  @$fname ? $fname : null
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

    public function edit(Category $category)
    {
        return view('category.Edit', compact('category'));
    }

    public function update(Request $request)
    {

        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(100, 100)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

        Category::find($request->id)
            ->update([
                'name'  =>  $request->name,
                'parant_id' =>  $request->parant,
                'order'  =>   $request->order,
                'cover' =>  @$fname ? $fname : $request->curimage
            ]);
        
        return redirect()->route('category.index');
    }

    public function getSubCategory(Category $category){

        return response($category->childs, 201);
    }
}
