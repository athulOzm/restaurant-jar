<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Branch;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Media;
use App\MenuPrice;
use App\Menutype;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::exists('branch')) {
            
            Session::put('branch', Branch::first());
        }

        return view('product.index', ['products' => Product::get()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStock()
    {
        if (!Session::exists('branch')) {
            
            Session::put('branch', Branch::first());
        }
        
        return view('product.indexStock', ['products' => Product::get()]);
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

    public function createStock(Product $product)
    {
        return view('product.createStock', compact('product'));
    }

    public function logStock(Product $product)
    {
        return view('product.logStock', compact('product'));
    }

    public function storeStock(Request $request)
    {

        if($cqtyl = Product::find($request->id)->menustocks()->latest()->first()){
            $cqty = $cqtyl->qty_total;
            
        }else{
            $cqty = 0;
        }

        $tot = number_format($request->qty + $cqty, 1);

        Product::find($request->id)->menustocks()->create([
            'qty_added' =>  $request->qty,
            'branch_id' => Session::get('branch')->id,
            'qty_total' =>  $tot,
            'body'      =>  $request->body
        ]);
        return back();
    }


    public function updateStoreStock(Request $request)
    {

        if($cqtyl = Product::find($request->id)->menustocks()->latest()->first()){
            $cqty = $cqtyl->qty_total;
            
        }else{
            $cqty = 0;
        }

        if($cqty == $request->qty){

            return back();

        } elseif($cqty > $request->qty){

            $tot = number_format($request->qty - $cqty, 1);

            Product::find($request->id)->menustocks()->create([
                'qty_reduced' =>  abs($tot),
                'branch_id' => Session::get('branch')->id,
                'qty_total' =>  $request->qty,
                'body'      =>  $request->body
            ]);

        }else{
            
            $tot = number_format($request->qty - $cqty, 1);

            Product::find($request->id)->menustocks()->create([
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
        return view('product.updateStock', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        


        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(250, 300)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

        $pic = $request->addon;
        $cats = $request->cat;
        $bra = $request->branch;
        

        $product = Product::create([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'user_id'   => auth()->user()->id,
            'price' =>  $request->price,
            'vat' =>  $request->vat,
            'qty' =>  $request->qty,
            'body'  =>  $request->body,
            'cover' =>  @$fname ? $fname : null,
 //           'category_id'   =>  $request->cat,
            'promotion_id'   =>  $request->promotion,
            'subcategory_id'    =>  @$request->subcat ? $request->subcat :null,
            'status'    => $request->status,
           // 'branch_id'    => $request->branch_id

        ]);

        $product->menuprices()->create([
            'price' =>  $request->price
        ]);

        // $product->menustocks()->create([
        //     'qty' =>  $request->qty
        // ]);

        if($pic != ''){
            $addonitems = Addon::all()->filter(function ($addon) use(&$pic){
                if (in_array($addon->name, $pic)) {
                    return $addon->id;
                }
            });
            $product->addons()->attach($addonitems);
        }

        if($cats != ''){
            $categories = Category::all()->filter(function ($cat) use(&$cats){
                if (in_array($cat->name, $cats)) {
                    return $cat->id;
                }
            });
            $product->categories()->attach($categories);
        }

        if($bra != ''){
            $branches = Branch::all()->filter(function ($cat) use(&$bra){
                if (in_array($cat->name, $bra)) {
                    return $cat->id;
                }
            });
            $product->branches()->attach($branches);
        }


        $product->types()->attach($request->type);
        

        // if($request->hasfile('images')){
        //     foreach($request->file('images') as $image){
        //         $imgName2 = Str::slug($request->name, '-').rand(1, 1000).'.'.$image->extension();
        //         $img = Image::make($image->path());
        //         $img->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save(storage_path('app/public/cover').'/'.$imgName2);

        //         Media::create([
        //             'product_id'    => $product->id,
        //             'name'  =>  $imgName2
        //         ]);
        //     }
        // }

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
        $product = Product::with('types', 'subcategory', 'addons')->find($product->id);

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
            $img->resize(250, 300)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

        $product = Product::find($request->id);

        $product_price = $product->price;
        $product_qty = $product->qty;


        $product->update([

            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'price' =>  $request->price,
            'vat' =>  $request->vat,
            'qty' =>  $request->qty,
            'body'  =>  $request->body,
            'cover' =>  @$fname ? $fname : $request->curimage,
           // 'category_id'   =>  $request->cat,
            'promotion_id'   =>  $request->promotion,
            'subcategory_id'    =>  @$request->subcat ? $request->subcat :null,
           // 'branch_id'    => $request->branch_id,
            'status'    => $request->status
        ]);

        if($product_price != $request->price){
            $product->menuprices()->create([
                'price' =>  $request->price
            ]);
        }

        // if($product_qty != $request->qty){
        //     $product->menustocks()->create([
        //         'qty' =>  number_format($request->qty - $product_qty, 1)
        //     ]);
        // }

        

        $pic = $request->addon;
        if($pic != ''){
            $addonitems = Addon::all()->filter(function ($addon) use(&$pic){
                if (in_array($addon->name, $pic)) {
                    return $addon->id;
                }
            });
        } else{
            $addonitems = [];
        }

        $cats = $request->cat;
        if($cats != ''){
            $categories = Category::all()->filter(function ($addon2) use(&$cats){
                if (in_array($addon2->name, $cats)) {
                    return $addon2->id;
                }
            });
        } else{
            $categories = [];
        }

        $bra = $request->branch;
        if($bra != ''){
            $branches = Branch::all()->filter(function ($branch) use(&$bra){
                if (in_array($branch->name, $bra)) {
                    return $branch->id;
                }
            });
        } else{
            $branches = [];
        }

        //dd($categories);

        Product::find($request->id)->addons()->sync($addonitems);
        Product::find($request->id)->categories()->sync($categories);
        Product::find($request->id)->branches()->sync($branches);
        Product::find($request->id)->types()->sync($request->type);
       



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
            'qty'  =>  'required|numeric',
            'image' =>  'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }


    //api-----------------------------------------------------------------

    public function getInit(Request $request){

        if (!Session::exists('branch')) {
            
            Session::put('branch', Branch::first());
        }

        $tn = Carbon::now()->timezone('Asia/Dubai')->format('H:i:s');
        $mt = Menutype::get();
        if($cmtt = Menutype::where('from', '<', $tn)->where('to', '>', $tn)->where('id', '!=', 1)->first()){
            $cmt = $cmtt;
        } else {
            $cmt = Menutype::where('id', '!=', 1)->first();
        }
        
        //$menus= $cmt->products()->where('status', 1)->get();


      
        //return response(['categories' => $menutype->categories(), 'products' => $menutype->products], 200);

        return response([
            'status'=>true, 
            'data' => [
                'cur_menu_type' => $cmt,
                'menu_type' => $mt,
                'menus' => $cmt->products,
                'categories' => $cmt->categories(),
                'branches'  =>  $request->user()->branches
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
