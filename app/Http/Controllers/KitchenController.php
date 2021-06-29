<?php

namespace App\Http\Controllers;

 
use App\Order;
use Illuminate\Support\Facades\Session;

use App\Branch;

class KitchenController extends Controller
{
    public function index(){

        if (!Session::exists('branch')) {
            
            Session::put('branch', Branch::first());
        }
        

        $orders = Order::with('products')->where('made', 0)->where('status', 3)->orWhere('status', 4)->get();

        return view('kitchen.Index', compact('orders'));
    }

    public function getOrders(){

        $orders = Order::with(['products', 'user', 'table', 'location'])
            ->where('made', 0)
            ->where('branch_id', Session::get('branch')->id)
  //          ->where('status', 3)
 //           ->orWhere('status', 4)
              ->where('status', '!=', 1)
            ->get();

        return  response()->json($orders);
    }


    public function orderReady(Order $order){

        $order->update([
            'made' => 1
        ]);

        $orders = Order::with(['products', 'user', 'table', 'location'])
            ->where('made', 0)
            ->where('status', '!=', 1)
            ->where('branch_id', 1)
            ->get();
     return  response()->json($orders);
    }








}
