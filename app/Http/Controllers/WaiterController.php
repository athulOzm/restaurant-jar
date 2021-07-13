<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class WaiterController extends Controller
{
    public function login(){

        return view('auth.WaiterLogin');
    }

    public function index(){


        if (Session::exists('token')) {

            $ct = Order::find(Session::get('token')->id);
            if($ct->status != 1){
                $ct = Order::create(['status'   =>  1, 'reqfrom' => auth()->user()->id]);
            }
        }
        else{
            $ct = Order::create(['status'   =>  1, 'reqfrom' => auth()->user()->id]);
        }


        Session::forget('token');
        Session::put('token', $ct);

        return view('pos.Waiter');
    }



    public function logout( Request $request ){
        if(Auth::guard('waiter')->check()) // this means that the admin was logged in.
        {
            Auth::guard('waiter')->logout();
            
        }

        Auth::logout();
    Session::flush();
    return redirect()->route('waiter.login');
        // $this->guard()->logout();
        // $request->session()->invalidate();

        // return $this->loggedOut($request) ?: redirect('/');
    }


}
