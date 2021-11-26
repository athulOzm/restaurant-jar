<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Material;
use App\PaymentStatus;
use App\Purchase;
use App\PurchaseStatus;
use App\PurchaseStock;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchase.Index', ['purchases' => Purchase::where('status', '!=', 1)->get()]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $suppliers = Supplier::all();
        $purchasestatuses = PurchaseStatus::all();
        $paymentstatuses = PaymentStatus::all();
        $lims_product_list_without_variant = Material::all();


        if (Session::exists('purchasetoken') and $ct = Purchase::find(Session::get('purchasetoken')->id)) {
 
            if($ct->status != 1){
                $ct = Purchase::create(['status'   =>  1, 'user_id' => auth()->user()->id]);
            }
        }
        else{
            $ct = Purchase::create(['status'   =>  1, 'user_id' => auth()->user()->id]);
        }

        Session::put('purchasetoken', $ct);

        return view('purchase.Create', compact('branches', 'suppliers', 'purchasestatuses', 'paymentstatuses', 'lims_product_list_without_variant'));
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

        $tot_price = Purchase::find(Session::get('purchasetoken')->id)->gettotalprice()['price'];

        if ($request->discound_unit == 0) {
            
            $ord_discound =  number_format(str_replace(',', '', $tot_price) * intval(trim($request->discound_value))/ 100, 3);
        } else {

            $ord_discound =  $request->discound_value;
        }

        $tot_price =   number_format(str_replace(',', '', $tot_price) - $ord_discound, 3);

        if($request->shipping_cost != ''){
            $tot_price =   number_format(str_replace(',', '', $tot_price) + intval(trim($request->shipping_cost)), 3);
        }

        if($request->reference == ''){
            $ref = Branch::find($request->branch_id)->code.'-'.Supplier::find($request->supplier_id)->id.'-'.Session::get('purchasetoken')->id;
        }else{
            $ref = $request->reference;
        }

      
        Purchase::find(Session::get('purchasetoken')->id)->update([
            'branch_id' => $request->branch_id,
            'supplier_id' => $request->supplier_id,
            'purchase_status_id' => $request->purchase_status_id,
            'date' => $request->date,
            'reference' => $ref,
            'payment_status_id' => $request->payment_status_id,
            'discount_value' => $request->discount_value,
            'discount_unit' => $request->discount_unit,
            'shipping_cost' => $request->shipping_cost,
            'note' => $request->note,
            'tot_price' => $tot_price,
            'status' => 0
        ]);

        switch ($request->purchase_status_id) {
            case 2:
                
                foreach(Purchase::find(Session::get('purchasetoken')->id)->products as $product){

                   

                    $punit = Unit::find($product->punit_id);
                    if($punit->operator == '*'){
                        $qry = number_format($product->pivot->quantityrec * $punit->operation_value, 3);
                    }else{
                        $qry = number_format($product->pivot->quantityrec / $punit->operation_value, 3);
                    }

                    if($stock = $product->stocks()->where('branch_id', $request->branch_id)->first()){

                        $stock->update([
                            'quantity' => $qry + $stock->quantity
                        ]);

                    } else {
                        $product->stocks()->create([
                            'branch_id' => $request->branch_id,
                            'quantity' => $qry
                        ]);
                    }
                }
                break;

            case 4: 
                foreach(Purchase::find(Session::get('purchasetoken')->id)->products as $product){

                    $punit = Unit::find($product->punit_id);
                    if($punit->operator == '*'){
                        $qry = number_format($product->pivot->quantity * $punit->operation_value, 3);
                    }else{
                        $qry = number_format($product->pivot->quantity / $punit->operation_value, 3);
                    }


                    if($stock = $product->stocks()->where('branch_id', $request->branch_id)->first()){

                        $stock->update([
                            'quantity' => $qry + $stock->quantity
                        ]);

                    } else {
                        $product->stocks()->create([
                            'branch_id' => $request->branch_id,
                            'quantity' => $qry
                        ]);
                    }
                }
            
            default:
                # code...
                break;
        }
 



        return redirect()->route('purchase.index');
    }

    


    //pos get cart
    public function getproducts(){

       

        return response(Purchase::with('purchasematerials')->find(Session::get('purchasetoken')->id), 200);
    }

    //remove cart pos
    public function removecart(Request $request){

        Purchase::find(Session::get('purchasetoken')->id)->products()->detach(['material_id' => $request->id]);
    }

     //pos get tot price
     public function totalprice(){

        $token = Purchase::with('products')->find(Session::get('purchasetoken')->id);
        return response($token->gettotalprice(), 200);
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
    public function edit(Purchase $purchase)
    {
        
        return view('purchase.Edit', compact('purchase'));
    
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

        Purchase::find($request->id)
            ->update($this->validateReq($request));
        
        return redirect()->route('purchase.index');
    }

    //upd quantity
    public function updqty(Request $request){

      
        DB::update('update material_purchase set quantity = '.$request->qty.' where id = ?', [$request->cart_item]);
     }

     //upd quantity
    public function updqtyrec(Request $request){

      
        DB::update('update material_purchase set quantityrec = '.$request->qty.' where id = ?', [$request->cart_item]);
     }


     //upd quantity
    public function updprice(Request $request){

      
        DB::update('update material_purchase set unit_price = '.$request->price.' where id = ?', [$request->cart_item]);
     }

     //add discount
    public function discount(Request $request){

        DB::update('update material_purchase set discount_value = '.$request->dis.', discount_unit = '.$request->dis_unit.' where id = ?', [$request->id]);
    }

    public function tax(Request $request){

        DB::update('update material_purchase set tax_value = '.$request->dis.', tax_unit = '.$request->dis_unit.' where id = ?', [$request->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {


        $purchase = Purchase::find($request->id);

        


        switch ($purchase->purchase_status_id) {
            case 2:
                
                foreach($purchase->products as $product){

                   

                    $punit = Unit::find($product->punit_id);
                    if($punit->operator == '*'){
                        $qry = number_format($product->pivot->quantityrec * $punit->operation_value, 3);
                    }else{
                        $qry = number_format($product->pivot->quantityrec / $punit->operation_value, 3);
                    }

                    if($stock = $product->stocks()->where('branch_id', $purchase->branch_id)->first()){

                        $stock->update([
                            'quantity' => $stock->quantity - $qry
                        ]);

                    }  
                }
                break;

            case 4: 
                foreach($purchase->products as $product){

                    //dd($product);

                    $punit = Unit::find($product->punit_id);


                    if($punit->operator == '*'){
                        $qry = number_format($product->pivot->quantity * $punit->operation_value, 3);
                    }else{
                        $qry = number_format($product->pivot->quantity / $punit->operation_value, 3);
                    }

                    //dd($qry);




                    if($stock = $product->stocks()->where('branch_id', $purchase->branch_id)->first()){

                        $stock->update([
                            'quantity' => $stock->quantity - $qry
                        ]);

                    }  
                }
            
            default:
                # code...
                break;
        }

        Purchase::find($request->id)->delete();



        return back();
    }

    public function validateReq($request){

        return $request->validate([
            'supplier_id'  =>  'required',
            'branch_id' =>  'required'

         
        ]);
    }

 






    //add to cart pos
    public function addtocart(Request $request){

        $pid = $request->id;

        $punit = Material::find($pid)->punit;

        switch ($punit->operator) {
            case '*':
                $price = number_format(Material::find($pid)->price * $punit->operation_value , 3);
                break;

            case '/':
                $price = number_format(Material::find($pid)->price / $punit->operation_value , 3);
                break;
            
            default:
                $price = number_format($punit->operation_value , 3);
                
                break;
        }




        $product = [
            'material_id' => $pid, 'unit_price' => $price
       ];
        
        Purchase::find(Session::get('purchasetoken')->id)->products()->attach([$product]);
 
        
 
         return response(['message' => 'product added successfully'], 201);
     }


      
}
