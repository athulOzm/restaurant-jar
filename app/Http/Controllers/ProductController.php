<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Media;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index', ['products' => Product::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validateReq($request);

        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(400, 300)->save(storage_path('app/public/cover').'/'.$fname);
        endif;


 

        $product = Product::create([
            'name' => $request->name,
            'user_id'   => auth()->user()->id,
            'price' =>  $request->price,
            'body'  =>  $request->body,
            'cover' =>  @$fname ? $fname : null,
            'category_id'   =>  $request->cat,
            'subcategory_id'    =>  @$request->subcat ? $request->subcat :null,
            'status'    => $request->status

        ]);

        $product->types()->attach($request->type);

        if($request->hasfile('images')){
            foreach($request->file('images') as $image){
                $imgName2 = Str::slug($request->name, '-').rand(1, 1000).'.'.$image->extension();
                $img = Image::make($image->path());
                $img->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save(storage_path('app/public/cover').'/'.$imgName2);

                Media::create([
                    'product_id'    => $product->id,
                    'name'  =>  $imgName2
                ]);
            }
        }

        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product = Product::with('types')->find($product->id);

       return view('product.update', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validateReq($request);

        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(400, 300)->save(storage_path('app/public/cover').'/'.$fname);
        endif;


        Product::find($request->id)->update([

            'name' => $request->name,
            'price' =>  $request->price,
            'body'  =>  $request->body,
            'cover' =>  @$fname ? $fname : $request->curimage,
            'category_id'   =>  $request->cat,
            'subcategory_id'    =>  @$request->subcat ? $request->subcat :null,
            'status'    => $request->status

        ]);

        Product::find($request->id)->types()->sync($request->cat);


        if($request->hasfile('images')){
            foreach($request->file('images') as $image){
                $imgName2 = Str::slug($request->name, '-').rand(1, 1000).'.'.$image->extension();
                $img = Image::make($image->path());
                $img->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save(storage_path('app/public/cover').'/'.$imgName2);

                Media::create([
                    'product_id'    => $request->id,
                    'name'  =>  $imgName2
                ]);
            }
        }

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect(route('product.index'));
    }

    public function productImages($product){

        return  response()->json(Media::where('product_id', $product)->get());
    }

    public function imageDelete($image){

        Media::find($image)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }


    public function validateReq($request){

        return $request->validate([
            'name' => 'required',
           // 'user_id'   => 'required',
            'price' =>  'required|numeric|between:0,9999.999',
            'body'  =>  'nullable',
            'image' =>  'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }


}
