<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function active(){

        return view('order.active', ['orders' => Order::where('status', 1)->get()]);
    }

    public function delivered(){

        return view('order.delivered', ['orders' => Order::where('status', 2)->get()]);
        
    }
    public function all(){

        return view('order.all', ['orders' => Order::get()]);
        
    }
}
