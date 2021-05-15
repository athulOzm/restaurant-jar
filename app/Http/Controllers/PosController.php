<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Deliverylocation;
use App\Events\Checkout;
use App\Order;
use App\OrderProduct;
use App\Table;
use App\User;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{

    public function pos(){

        $token = Order::firstOrCreate(
            ['status'   =>  1, 'req' => 0],
            ['status'   =>  1, 'req' => 0]
        );

        return view('pos.index', compact('token'));
    }



    //add to cart pos
    public function addtocart(Request $request){

       $pid = $request->id;

       $token = Order::where('status', 1)->first();

       $status = Order::whereHas('products', function($q) use($pid){
                        $q->where('product_id', $pid);
                    })
                 ->with('products')->where('id', $token->id)->first();
      
        if($status == ''){

            $product = [
                'product_id' => $request->id, 'quantity'    =>  1
            ];
            $token->products()->attach([$product]);
        } 
        else {

           DB::table('order_product')
            ->where('order_id', $token->id)
            ->where('product_id', $pid)
            ->increment('quantity');
        }

        return response(['message' => 'product added successfully'], 201);
    }


    //addtocart Addon
    public function addtocartaddon(Request $request){

        $pid = $request->pid;
        $id = $request->id;
 
        $pitem = OrderProduct::find($pid);

        if($pitem->items()->where('addon_id', $id)->exists()){

            DB::table('addon_order_product')
                ->where('order_product_id', $pitem->id)
                ->where('addon_id', $request->id)
                ->increment('quantity');
        } else{
            
            $product = [
                 'addon_id' => $request->id, 'quantity'    =>  1
            ];
            $pitem->items()->attach([$product]);
        }
 
         return response(['message' => 'product added successfully'], 201);
     }


    //remove cart pos
    public function removecart(Request $request){

        Order::where('status', 1)->first()->products()->detach(['product_id' => $request->id]);
    }

    //remove cart addon
    public function removecartaddon(Request $request){

        OrderProduct::find($request->pid)->items()->detach(['addon_id' => $request->id]);
    }

    //minus item cart pos
    public function downcart(Request $request){
       $token = Order::where('status', 1)->first();

       if(DB::table('order_product')
       ->where('order_id', $token->id)
       ->where('product_id', $request->id)->first()->quantity == 1){
        Order::where('status', 1)->first()->products()->detach(['product_id' => $request->id]);
       }

       DB::table('order_product')
       ->where('order_id', $token->id)
       ->where('product_id', $request->id)
       ->decrement('quantity');
    }

    //minus item cart addon
    public function downcartaddon(Request $request){
        $token = OrderProduct::find($request->pid);
 
        if(DB::table('addon_order_product')
            ->where('order_product_id', $token->id)
            ->where('addon_id', $request->id)->first()->quantity == 1){

                $token->items()->detach(['addon_id' => $request->id]);
        }
 
        DB::table('addon_order_product')
            ->where('order_product_id', $token->id)
            ->where('addon_id', $request->id)
            ->decrement('quantity');
     }

    //add discount
    public function discount(Request $request){

       DB::update('update order_product set discount = '.$request->dis.' where id = ?', [$request->id]);
    }

    //pos get cart
    public function getcart(){

        return response(Order::with('orderproducts')->where('status', 1)->first(), 200);
    }

    //pos get tot price
    public function totalprice(){

        $token = Order::with('products')->where('status', 1)->first();
        return response($token->gettotalprice(), 200);
    }


    public function getmembers(){

        return response(User::where('type', 3)->get(), 200);
    }

    public function getpaymenttypes($memberid){

        return response(User::find($memberid)->paymenttypes, 200);
    }

    public function gettables(){

        return response(Table::all(), 200);
    }

    public function getlocations(){
        
        return response(Deliverylocation::all(), 200);
    }


    //checkout pos
    public function checkout(Request $request) {

        $id = explode('-', $request->memberid);

        $memberid = $id[0];
        $delivery_type = $request->del;
        $payment_type = $request->pt;
        $delivery_time = $request->dtime;

        if(isset($request->table)){
            $table = $request->table;
            Table::find($table)->update(['status' => false]);
        } else {
            $table = null;
        }

        if(isset($request->location)){
            $location = $request->location;
        } else {
            $location = null;
        }

       $id = Order::where('status', 1)->where('req', 0)->first()->update([
           'status' =>  2,
           'user_id'    =>  User::where('memberid', $memberid)->first()->id,
           'delivery_type' => $delivery_type,
           'payment_type_id'    =>  $payment_type,
           'delivery_time'  =>  $delivery_time,
           'deliverylocation_id'  =>  $location,
           'payment_status' =>  true,
           'table_id'  =>  $table
       ]);

       Checkout::dispatch($id);
       
       return redirect()->route('pos');
    }


    //get addon by item
    public function getaddon($id){

        return response(OrderProduct::find($id)->items, 200);
    }
}
