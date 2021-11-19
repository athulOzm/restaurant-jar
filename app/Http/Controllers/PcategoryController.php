<?php
namespace App\Http\Controllers;

use App\Pcategory;
use Illuminate\Http\Request;

class PcategoryController extends Controller
{
    public function index(Pcategory $category){

        return view('material.category.Index', ['categories' => Pcategory::with('parant')->orderBy('order', 'DESC')->get()]);
    }

    public function store(Request $request){


        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(100, 100)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

         
        Pcategory::create([
            'name'  =>  $request->name,
            'parant_id' =>  $request->parant,
            'order'  =>   $request->order,
            'cover' =>  @$fname ? $fname : null
        ]);

        return redirect(route('pcategory.index'));
    }

    public function delete(Request $request){

        Pcategory::find($request->id)->update(['is_active' => false]);
        return redirect(route('pcategory.index'));
    }

    public function getAll(Pcategory $category){

        return response($category->with('childs')->get(), 200);
    }

    public function getProducts($category){

        if($category == 'all'): 

            return response(Product::with('categories')->latest()->get(), 200);
        else: 

            $category = Pcategory::where('slug', $category)->first();
           // return response($category->products, 200);
        endif;

        
    }

    public function edit(Pcategory $pcategory)
    {
        return view('material.category.Edit', compact('pcategory'));
    }

    public function update(Request $request)
    {

        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(100, 100)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

        Pcategory::find($request->id)
            ->update([
                'name'  =>  $request->name,
                'parant_id' =>  $request->parant,
                'order'  =>   $request->order,
                'cover' =>  @$fname ? $fname : $request->curimage
            ]);
        
        return redirect()->route('pcategory.index');
    }

    public function getSubCategory(Pcategory $category){

        return response($category->childs, 201);
    }
}
