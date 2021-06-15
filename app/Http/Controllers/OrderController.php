<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function active(){

        return view('order.active', ['orders' => Order::where('status', 3)->get()]);
    }

    public function delivered(){

        return view('order.delivered', ['orders' => Order::where('status', 4)->get()]);
        
    }
    public function all(){

        return view('order.all', ['orders' => Order::where('status', '!=', 1)->get()]); 
    }

    public function history(){

        return view('order.History', ['orders' => Order::where('status', 4)->get()]); 
    }

    public function list(){

        return view('order.List', ['orders' => Order::where('status', '!=', 1)->where('status', '!=', 4)->get()]); 
    }

    public function destroy(Request $request)
    {
        Order::find($request->id)->delete();
        return back();
    }
}
