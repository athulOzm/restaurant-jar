<?php

namespace App\Http\Controllers;

 
use App\Order;
 

class KitchenController extends Controller
{
    public function index(){

        $orders = Order::with('products')->where('status', 2)->get();

        return view('kitchen.Index', compact('orders'));
    }

    public function getOrders(){

        $orders = Order::with(['products', 'user', 'table', 'location'])->where('status', 2)->get();
        return  response()->json($orders);
    }


    public function orderReady(Order $order){

        $order->update([
            'status' => 3
        ]);

        $orders = Order::with(['products', 'user', 'table', 'location'])->where('status', 2)->get();
        return  response()->json($orders);
    }








}
