<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Image;

class MaterialController extends Controller
{
    public function index()
    {
        return view('material.product.index', ['products' => Material::where('is_active', true)->get()]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('material.product.create');
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


 

        $product = Material::create([
            'name' => $request->name,
            'price' =>  $request->price,
            'vat' =>  $request->vat,
            
            'body'  =>  $request->body,
            'cover' =>  @$fname ? $fname : null,
            'category_id'   =>  $request->cat,
            'subcategory_id'    =>  @$request->subcat ? $request->subcat :null,
            'unit_id'    => $request->unit_id,
            'punit_id'    => $request->punit_id

        ]);

       // $product->types()->attach($request->type);

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

        return redirect(route('material.index'));
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
    public function edit(Material $material)
    {
        $product = Material::with('subcategory')->find($material->id);

       return view('material.product.update', ['product' => $product]);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $this->validateReq($request);

        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(400, 300)->save(storage_path('app/public/cover').'/'.$fname);
        endif;


        Material::find($request->id)->update([

            'name' => $request->name,
            'price' =>  $request->price,
            'body'  =>  $request->body,
            'cover' =>  @$fname ? $fname : $request->curimage,
            'category_id'   =>  $request->cat,
            'subcategory_id'    =>  @$request->subcat ? $request->subcat :null,
            'vat'    => $request->vat,
            'unit_id'    => $request->unit_id,
            'punit_id'    => $request->punit_id

        ]);

   

        return redirect()->route('material.index');
    }

    public function indexStock()
    {
      
        return view('material.product.indexStock', ['products' => Material::where('is_active', true)->get()]);
    }

 

    public function createStock(Product $product)
    {
        return view('material.product.createStock', compact('product'));
    }

    public function logStock(Product $product)
    {
        return view('material.product.logStock', compact('product'));
    }

    public function storeStock(Request $request)
    {

        if($cqtyl = Material::find($request->id)->menustocks()->latest()->first()){
            $cqty = $cqtyl->qty_total;
            
        }else{
            $cqty = 0;
        }

        $tot = number_format($request->qty + $cqty, 1);

        Material::find($request->id)->menustocks()->create([
            'qty_added' =>  $request->qty,
            'branch_id' => Session::get('branch')->id,
            'qty_total' =>  $tot,
            'body'      =>  $request->body
        ]);
        return back();
    }


    public function updateStoreStock(Request $request)
    {

        if($cqtyl = Material::find($request->id)->menustocks()->latest()->first()){
            $cqty = $cqtyl->qty_total;
            
        }else{
            $cqty = 0;
        }

        if($cqty == $request->qty){

            return back();

        } elseif($cqty > $request->qty){

            $tot = number_format($request->qty - $cqty, 1);

            Material::find($request->id)->menustocks()->create([
                'qty_reduced' =>  abs($tot),
                'branch_id' => Session::get('branch')->id,
                'qty_total' =>  $request->qty,
                'body'      =>  $request->body
            ]);

        }else{
            
            $tot = number_format($request->qty - $cqty, 1);

            Material::find($request->id)->menustocks()->create([
                'qty_added' =>  $tot,
                'branch_id' => Session::get('branch')->id,
                'body'      =>  $request->body,
                'qty_total' =>  $request->qty
            ]);

        
        }

        return back();  
    }



    public function updateStock(Product $product)
    {
        return view('material.product.updateStock', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Material::find($request->id)->update(['is_active' => false]);
        return redirect(route('material.index'));
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
          //  'price' =>  'required|numeric|between:0,9999.999',
            'body'  =>  'nullable',
           // 'qty'  =>  'required|numeric',
            'image' =>  'image|mimes:jpeg,png,jpg,svg|max:2048',
           // 'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

 


    
}
