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

        $orderlist = Order::where('status', '!=', 1)->where('status', 4)->get();

       

        if(isset($_GET['df']) and $_GET['df'] !=''){
            $df = explode('T', $_GET['df']);
            $date_from = $df[0].' '.$df[1].':00';

           // dd($date_from);
            $orderlist = $orderlist->where('delivery_time', '>=', $date_from);
        }

        if(isset($_GET['dt']) and $_GET['dt'] !=''){
            $df = explode('T', $_GET['dt']);
            $date_from = $df[0].' '.$df[1].':00';

           // dd($date_from);
            $orderlist = $orderlist->where('delivery_time', '<=', $date_from);
        }

        if(isset($_GET['branch_id']) && $_GET['branch_id'] != 'All'){
            $orderlist = $orderlist->where('branch_id', $_GET['branch_id']);
        }

    
        if(isset($_GET['memberid']) && $_GET['memberid'] != 'All Member'){
            $orderlist = $orderlist->where('user_id', $_GET['memberid']);
        }

        if(isset($_GET['payment_type_id']) and $_GET['payment_type_id'] != 'All'){
            $orderlist = $orderlist->where('payment_type_id', $_GET['payment_type_id']);
        }

        if(isset($_GET['ord_source']) && $_GET['ord_source'] != 'All'){
            $orderlist = $orderlist->where('reqfrom', $_GET['ord_source']);
        }

        if(isset($_GET['delivery_type']) and $_GET['delivery_type'] != 'All'){
            $orderlist = $orderlist->where('delivery_type', $_GET['delivery_type']);
        }

        if(isset($_GET['deliverylocation_id']) and $_GET['deliverylocation_id'] != 'All'){
            $orderlist = $orderlist->where('deliverylocation_id', $_GET['deliverylocation_id']);
        }

        $orderlist = $orderlist->all();

        return view('order.History', ['orders' => $orderlist]); 
    }

    public function list(){

        $orderlist = Order::where('status', '!=', 1)->where('status', '!=', 4)->get();

        if(isset($_GET['branch_id']) && $_GET['branch_id'] != 'All'){
            $orderlist = $orderlist->where('branch_id', $_GET['branch_id']);
        }

        if(isset($_GET['df']) and $_GET['df'] !=''){
            $df = explode('T', $_GET['df']);
            $date_from = $df[0].' '.$df[1].':00';
            $orderlist = $orderlist->where('delivery_time', '>=', $date_from);
        }

        if(isset($_GET['dt']) and $_GET['dt'] !=''){
            $df = explode('T', $_GET['dt']);
            $date_from = $df[0].' '.$df[1].':00';
            $orderlist = $orderlist->where('delivery_time', '<=', $date_from);
        }

    
        if(isset($_GET['memberid']) && $_GET['memberid'] != 'All Member'){
            $orderlist = $orderlist->where('user_id', $_GET['memberid']);
        }

        if(isset($_GET['ord_source']) && $_GET['ord_source'] != 'All'){
            $orderlist = $orderlist->where('reqfrom', $_GET['ord_source']);
        }

        if(isset($_GET['payment_type_id']) and $_GET['payment_type_id'] != 'All'){
            $orderlist = $orderlist->where('payment_type_id', $_GET['payment_type_id']);
        }

        if(isset($_GET['delivery_type']) and $_GET['delivery_type'] != 'All'){
            $orderlist = $orderlist->where('delivery_type', $_GET['delivery_type']);
        }

        if(isset($_GET['deliverylocation_id']) and $_GET['deliverylocation_id'] != 'All'){
            $orderlist = $orderlist->where('deliverylocation_id', $_GET['deliverylocation_id']);
        }

        $orderlist = $orderlist->all();

        return view('order.List', ['orders' => $orderlist]); 
    }

    public function destroy(Request $request)
    {
        Order::find($request->id)->delete();
        return back();
    }
}
