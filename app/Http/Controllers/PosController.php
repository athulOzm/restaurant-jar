<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Deliverylocation;
use App\Events\Checkout;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\Table;
use App\User;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{

    public function pos(){

        if (Session::exists('token')) {

            $ct = Order::find(Session::get('token')->id);
            if($ct->status != 1){
                $ct = Order::create(['status'   =>  1, 'req' => 0]);
            }
        }
        else{
            $ct = Order::create(['status'   =>  1, 'req' => 0]);
        }

        Session::forget('token');
        Session::put('token', $ct);
        return view('pos.index');
    }



    //add to cart pos
    public function addtocart(Request $request){

       $pid = $request->id;

       $token = Order::find(Session::get('token')->id);

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

        Order::find(Session::get('token')->id)->products()->detach(['product_id' => $request->id]);
    }

    //remove cart addon
    public function removecartaddon(Request $request){

        OrderProduct::find($request->pid)->items()->detach(['addon_id' => $request->id]);
    }

    //minus item cart pos
    public function downcart(Request $request){
       $token = Order::find(Session::get('token')->id);

       if(DB::table('order_product')
       ->where('order_id', $token->id)
       ->where('product_id', $request->id)->first()->quantity == 1){
        Order::find(Session::get('token')->id)->products()->detach(['product_id' => $request->id]);
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

        return response(Order::with('orderproducts')->find(Session::get('token')->id), 200);
    }

    //pos get tot price
    public function totalprice(){

        $token = Order::with('products')->find(Session::get('token')->id);
        return response($token->gettotalprice(), 200);
    }


    public function getmembers(){

        return response(User::where('type', 3)->get(), 200);
    }

    public function getmenus(){

        return response(Product::all(), 200);
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

       $id = Order::find(Session::get('token')->id)->update([
           'status' =>  2,
           'user_id'    =>  User::where('memberid', $memberid)->first()->id,
           'delivery_type' => $delivery_type,
           'payment_type_id'    =>  $payment_type,
           'delivery_time'  =>  $delivery_time,
           'deliverylocation_id'  =>  $location,
           'payment_status' =>  true,
           'table_id'  =>  $table
       ]);

       Session::forget('token');
       Checkout::dispatch($id);
       
       return redirect()->route('pos');
    }


    //get addon by item
    public function getaddon($id){

        return response(OrderProduct::find($id)->items, 200);
    }

    //get addon by item
    public function getaddonava(Product $product){

        return response($product->addons, 200);
    }

    //get member credit status
    public function memberstatus(User $user){

        $token = Order::with('products')->find(Session::get('token')->id);
        $nub = $token->products()->count();
        
        if($user->item_limit < $nub){

            $re = $user->item_limit - $nub;



            return response(['msg' => 'Limit exced! Only '.$user->item_limit.' items allowed for this Member, remove '. $re .' items to continue!'] , 200);
        }
        else{
            return response(['msg' => 'ok'] , 200);
        }

    }
}
