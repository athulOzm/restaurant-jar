<?php

namespace App\Http\Controllers;

use App\Deliverylocation;
use App\Order;
use App\Table;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
    public function index(){

        $orders = Order::with('products')->where('status', 2)->get();

        return view('kitchen.Index', compact('orders'));
    }

    public function getOrders(){

        $orders = Order::with(['products', 'user'])->where('status', 2)->get();
        return  response()->json($orders);
    }


    public function orderReady(Order $order){

        $order->update([
            'status' => 3
        ]);

        $orders = Order::with(['products', 'user'])->where('status', 2)->get();
        return  response()->json($orders);
    }

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


    //remove cart pos
    public function removecart(Request $request){

        Order::where('status', 1)->first()->products()->detach(['product_id' => $request->id]);
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

    //pos get cart
    public function getcart(){

        return response(Order::with('products')->where('status', 1)->first(), 200);
    }


    public function getmembers(){

        return response(User::where('type', 3)->get(), 200);
    }

    public function getpaymenttypes($memberid){

        return response(User::where('memberid', $memberid)->first()->paymenttypes, 200);
    }

    public function gettables(){

        return response(Table::all(), 200);
    }

    public function getlocations(){
        
        return response(Deliverylocation::all(), 200);
    }



}
