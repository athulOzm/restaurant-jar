<?php

namespace App\Http\Controllers;

 
use App\Order;
 

class KitchenController extends Controller
{
    public function index(){

        $orders = Order::with('products')->where('made', false)->where('status', 3)->orWhere('status', 4)->get();

        return view('kitchen.Index', compact('orders'));
    }

    public function getOrders(){

        $orders = Order::with(['products', 'user', 'table', 'location'])->where('made', false)->where('status', 3)->orWhere('status', 4)->get();
        return  response()->json($orders);
    }


    public function orderReady(Order $order){

        $order->update([
            'made' => true
        ]);

        $orders = Order::with(['products', 'user', 'table', 'location'])->where('made', false)->where('status', 4)->get();
        return  response()->json($orders);
    }








}
