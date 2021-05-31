<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RefundController extends Controller
{
    public function getToken(Request $request){

        if($ct = Order::find($request->token_id)){

            Session::forget('token');
            Session::put('token', $ct);

            
            if(session()->has('totalprice')):
                Session::forget('totalprice');
                Session::put('totalprice', $ct->total_price);
            else: 
                Session::put('totalprice', $ct->total_price);
            endif;

            return redirect()->route('pos.refund', $ct->id);
        } else{

            return view('pos.index');
        }  
    }


    public function refund(){

        return view('pos.Refund');
    }
}
