<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Media;
use App\Menutype;
use Carbon\Carbon;

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
            'qty' =>  $request->qty,
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
            'qty' =>  $request->qty,
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


    //api-----------------------------------------------------------------

    public function getInit(){

        $tn = Carbon::now()->timezone('Asia/Dubai')->format('H:i:s');
        $mt = Menutype::get();
        if($cmtt = Menutype::where('from', '<', $tn)->where('to', '>', $tn)->first()){
            $cmt = $cmtt;
        } else {
            $cmt = Menutype::first();
        }
        
        $menus= $cmt->products()->where('status', 1)->get();

        return response([
            'status'=>true, 
            'data' => [
                'cur_menu_type' => $cmt,
                'menu_type' => $mt,
                'menus' => $menus,
                'categories' => Category::has('products')->with('childs')->get()
                ]
        ], 201);
    }


    public function getByMenutype(Menutype $menutype){

        $menus= $menutype->products()->where('status', 1)->with('category')->get();

        $cats =array();
        $cats[] = 'sdsdff';
        $cats[] = 'sdf';

        Product::all()->each(function($menu, $key) use($cats){
            echo  'aaa';
            $cats[] = 'sdsdddddff';
        });

        var_dump($cats);

        // return response([
        //     'status'=>true, 
        //     'data' => [
        //         'menus' => $menus,
        //         'categories' => $cats
        //         ]
        // ], 201);
    }


    


}
