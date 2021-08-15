<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Invoice;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RefundController extends Controller
{
    public function getToken(Request $request){

        //dd($request->token_id);

        
        if($inv = Invoice::find(str_replace(Branch::first()->code, '', $request->token_id))){

            Session::forget('token');
            Session::put('token', $inv->order);

            
            if(session()->has('totalprice')):
                Session::forget('totalprice');
                Session::put('totalprice', $inv->order->total_price);
            else: 
                Session::put('totalprice', $inv->order->total_price);
            endif;

            return redirect()->route('pos.refund', $inv->order->id);
        } else{

            return redirect('pos');
        }  
    }


    public function refund($id){
        
        return view('pos.Refund', ['cur_token' => Order::find($id)]);
    }
}
