<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Settlement;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //sale index
    public function sale(){

        if(isset($_GET['df']) and $_GET['df'] !=''){
            $df = explode('T', $_GET['df']);
            $date_from = $df[0].' '.$df[1].':00';
        } else{
            $date_from = '2011-06-30 17:03:07';
        }

        if(isset($_GET['dt']) and $_GET['dt'] !=''){
            $df = explode('T', $_GET['dt']);
            $date_to = $df[0].' '.$df[1].':00';
        } else{
            $date_to = '2041-06-30 17:03:07';
        }

        $items = OrderProduct::whereHas('order', function($q){

            $q->where('status', 4);

            if(isset($_GET['branch_id']) and $_GET['branch_id'] != 'All'){
                
                $q->where('branch_id', $_GET['branch_id']);
            }
            
            if(isset($_GET['menutype_id']) and $_GET['menutype_id'] != 'All'){

                $q->where('menutype_id', $_GET['menutype_id']);
            }
        })
        ->whereHas('categories', function($q){
            if(isset($_GET['menucat_id']) and $_GET['menucat_id'] != 'All'){

                $q->where('categories.id', $_GET['menucat_id']);
            }
        })
        ->where('updated_at', '>=', $date_from)
        ->where('updated_at', '<=', $date_to)
        ->groupBy('product_id')
        ->select('*', DB::raw('sum(quantity) as quantity_sum, sum(promotion) as promotion_sum, sum(price * quantity + container - promotion) as price_sum'))
        ->get();

        return view('report.SaleReport', compact('items'));
    }

    public function salef(){

        if(isset($_GET['df']) and $_GET['df'] !=''){
            $df = explode('T', $_GET['df']);
            $date_from = $df[0].' '.$df[1].':00';
        } else{
            $date_from = '2011-06-30 17:03:07';
        }

        if(isset($_GET['dt']) and $_GET['dt'] !=''){
            $df = explode('T', $_GET['dt']);
            $date_to = $df[0].' '.$df[1].':00';
        } else{
            $date_to = '2041-06-30 17:03:07';
        }

        $items = OrderProduct::whereHas('order', function($q){

            $q->where('status', 4);

            if(isset($_GET['branch_id']) and $_GET['branch_id'] != 'All'){
                
                $q->where('branch_id', $_GET['branch_id']);
            }
            
            if(isset($_GET['menutype_id']) and $_GET['menutype_id'] != 'All'){

                $q->where('menutype_id', $_GET['menutype_id']);
            }
        })
        ->whereHas('categories', function($q){
            if(isset($_GET['menucat_id']) and $_GET['menucat_id'] != 'All'){

                $q->where('categories.id', $_GET['menucat_id']);
            }
        })
        ->where('updated_at', '>=', $date_from)
        ->where('updated_at', '<=', $date_to)
        ->groupBy('product_id')
        ->select('*', DB::raw('sum(quantity) as quantity_sum, sum(promotion) as promotion_sum, sum(price * quantity + container - promotion) as price_sum'))
        ->get();

        return view('report.SaleReportF', compact('items'));
    }

    public function sales(){

        if(isset($_GET['df']) and $_GET['df'] !=''){
            $df = explode('T', $_GET['df']);
            $date_from = $df[0].' '.$df[1].':00';
        } else{
            $date_from = '2011-06-30 17:03:07';
        }

        if(isset($_GET['dt']) and $_GET['dt'] !=''){
            $df = explode('T', $_GET['dt']);
            $date_to = $df[0].' '.$df[1].':00';
        } else{
            $date_to = '2041-06-30 17:03:07';
        }

        $items = OrderProduct::whereHas('order', function($q){

            $q->where('status', 4);

            if(isset($_GET['branch_id']) and $_GET['branch_id'] != 'All'){
                
                $q->where('branch_id', $_GET['branch_id']);
            }
            
            if(isset($_GET['menutype_id']) and $_GET['menutype_id'] != 'All'){

                $q->where('menutype_id', $_GET['menutype_id']);
            }
        })
        ->whereHas('categories', function($q){
            if(isset($_GET['menucat_id']) and $_GET['menucat_id'] != 'All'){

                $q->where('categories.id', $_GET['menucat_id']);
            }
        })
        ->where('updated_at', '>=', $date_from)
        ->where('updated_at', '<=', $date_to)
        ->groupBy('product_id')
        ->select('*', DB::raw('sum(quantity) as quantity_sum, sum(promotion) as promotion_sum, sum(price * quantity + container - promotion) as price_sum'))
        ->get();

        return view('report.SaleReportS', compact('items'));
    }


    //sale index
    public function saleMem(){

        if(isset($_GET['df']) and $_GET['df'] !=''){
            $df = explode('T', $_GET['df']);
            $date_from = $df[0].' '.$df[1].':00';
        } else{
            $date_from = '2011-06-30 17:03:07';
        }

        if(isset($_GET['dt']) and $_GET['dt'] !=''){
            $df = explode('T', $_GET['dt']);
            $date_to = $df[0].' '.$df[1].':00';
        } else{
            $date_to = '2041-06-30 17:03:07';
        }

        $items = Order::where(function($q){

            $q->where('status', 4);

            if(isset($_GET['user_id']) and $_GET['user_id'] != 'All'){
                
                $q->where('user_id', $_GET['user_id']);
            }
            
            if(isset($_GET['menutype_id']) and $_GET['menutype_id'] != 'All'){

                $q->where('menutype_id', $_GET['menutype_id']);
            }
        })
        ->where('updated_at', '>=', $date_from)
        ->where('updated_at', '<=', $date_to)
        ->groupBy('user_id')
        ->select('*', DB::raw('count(id) as bill_sum, sum(amount) as amount_sum'))
        ->get();

   
        return view('report.SaleReportMem', compact('items'));
    }

    //sale index
    public function saleUser(){

        if(isset($_GET['df']) and $_GET['df'] !=''){
            $df = explode('T', $_GET['df']);
            $date_from = $df[0].' '.$df[1].':00';
        } else{
            $date_from = '2011-06-30 17:03:07';
        }

        if(isset($_GET['dt']) and $_GET['dt'] !=''){
            $df = explode('T', $_GET['dt']);
            $date_to = $df[0].' '.$df[1].':00';
        } else{
            $date_to = '2041-06-30 17:03:07';
        }

        $items = Order::where(function($q){

            $q->where('status', 4);

            if(isset($_GET['ord_source']) and $_GET['ord_source'] != 'All'){
                
                $q->where('reqfrom', $_GET['ord_source']);
            }
            
            if(isset($_GET['menutype_id']) and $_GET['menutype_id'] != 'All'){

                $q->where('menutype_id', $_GET['menutype_id']);
            }
        })
        ->where('updated_at', '>=', $date_from)
        ->where('updated_at', '<=', $date_to)
        ->groupBy('reqfrom')
        ->select('*', DB::raw('count(id) as bill_sum, sum(amount) as amount_sum'))
        ->get();

        return view('report.SaleReportUser', compact('items'));
    }




    //sale search
    public function saleSearch(Request $request){

        $date_from = str_replace('T', ' ', $request->df).':00';
        $date_to = str_replace('T', ' ', $request->dt).':00';

        //dd($date_from);
 
        $period = CarbonPeriod::create($date_from, $date_to);
        $days=[];
        $days_order=[];
        foreach ($period as $date) {

            $days[] =  $date->format('Y-m-d');
            $days_order[] = Order::where('status', 4)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->count();
            $tot = Order::where('status', 4)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->get();
            $days_tot=[];
            $tot->each(function($ord) use(&$days_tot){
                $days_tot[] = $ord->total_price;
            });
            $days_total[] = number_format(array_sum($days_tot), 3);
        }

        $res = Order::where('status', 4)
            ->whereBetween('delivery_time', [$date_from, $date_to])
            ->get();

        $ta1 = $res->where('delivery_type', 'Take away')->count();
        $di1 = $res->where('delivery_type', 'Dinein')->count();
        $de1 = $res->where('delivery_type', 'Delivery')->count();

        $tot = number_format(array_sum($days_total), 3);
        $tord = array_sum($days_order);

        return view('report.SaleReport', 
        compact('days', 'days_order', 'days_total', 'ta1', 'di1', 'de1', 'date_from', 'date_to', 'tot', 'tord'));
    }






    //------------------------------------------------------------------------------------------------------------------------------------------fast moving


    public function fastmoving(){
 
        $menus = DB::table('order_product')
                 ->leftJoin('products', 'order_product.product_id', '=', 'products.id')
                 ->select('product_id', DB::raw('count(*) as tot'), 'products.name')
                 ->groupBy('product_id')
                 ->get()
                 ->sortByDesc('tot')
                 ->take(10);

         $product_id = $menus->pluck('name')->toArray();
         $product_count = $menus->pluck('tot')->toArray();

        return view('report.FastMoving', compact('product_id', 'product_count'));
    }

    //sale search
    public function fastMovingSearch(Request $request){

        $date_from = str_replace('T', ' ', $request->df).':00';
        $date_to = str_replace('T', ' ', $request->dt).':00';

         

        $menus = DB::table('order_product')
                 ->leftJoin('products', 'order_product.product_id', '=', 'products.id')
                 ->select('product_id', DB::raw('count(*) as tot'), 'products.name')
                 ->groupBy('product_id')
                 ->get()
                 ->sortByDesc('tot')
                 ->take(10);

         $product_id = $menus->pluck('name')->toArray();
         $product_count = $menus->pluck('tot')->toArray();

        return view('report.FastMovingSer', compact('product_id', 'product_count'));
    }


      //----------------------------------------------------slow fast moving


      public function slowmoving(){
 
        $menus = DB::table('order_product')
                 ->leftJoin('products', 'order_product.product_id', '=', 'products.id')
                 ->select('product_id', DB::raw('count(*) as tot'), 'products.name')
                 ->groupBy('product_id')
                 ->get()
                 ->sortBy('tot')
                 ->take(10);

         $product_id = $menus->pluck('name')->toArray();
         $product_count = $menus->pluck('tot')->toArray();

        return view('report.SlowMoving', compact('product_id', 'product_count'));
    }

    //sale search
    public function slowMovingSearch(Request $request){

        $date_from = str_replace('T', ' ', $request->df).':00';
        $date_to = str_replace('T', ' ', $request->dt).':00';

         

        $menus = DB::table('order_product')
                 ->leftJoin('products', 'order_product.product_id', '=', 'products.id')
                 ->select('product_id', DB::raw('count(*) as tot'), 'products.name')
                 ->groupBy('product_id')
                 ->get()
                 ->sortBy('tot')
                 ->take(10);

         $product_id = $menus->pluck('name')->toArray();
         $product_count = $menus->pluck('tot')->toArray();

        return view('report.SlowMovingSer', compact('product_id', 'product_count'));
    }









    //----------------------------------------------------------------------------------------------------------------------settlement -----------
    public function settlement(){

        $current_date = Carbon::now()->toDateString();
        $sub_month_date = Carbon::now()->subMonth()->toDateString();
        $sub_year_date = Carbon::now()->subYear()->toDateString();

        $period = CarbonPeriod::create($sub_month_date, $current_date);
        $days=[];
        $days_order=[];
        foreach ($period as $date) {

            $days[] =  $date->format('Y-m-d');
            $days_order[] = Settlement::where('closed_at', '!=', null)->whereDate('closed_at', '=', $date->format('Y-m-d'))->count();
            $tot = Settlement::where('closed_at', '!=', null)->whereDate('closed_at', '=', $date->format('Y-m-d'))->get();
            $days_tot=[];
            $tot->each(function($ord) use(&$days_tot){
                $days_tot[] = $ord->total_price;
            });
            $days_total[] = number_format(array_sum($days_tot), 3);
        }

        


        $period = CarbonPeriod::create('2020-05-30', '1 month', $current_date);
        $month=[];
        $month_order=[];
        foreach ($period as $date) {

            $month[] =  $date->format('Y-M');
            $month_order[] = Order::where('status', 4)
                ->whereYear('delivery_time', '=', $date->format('Y'))
                ->whereMonth('delivery_time', '=', $date->format('m'))
                ->count();

            $tot = Order::where('status', 4)
                ->whereYear('delivery_time', '=', $date->format('Y'))
                ->whereMonth('delivery_time', '=', $date->format('m'))
                ->get();
            $days_tot2=[];
            $tot->each(function($ord) use(&$days_tot2){
                $days_tot2[] = $ord->total_price;
            });
            $days_total2[] = number_format(array_sum($days_tot2), 3);
        }

        $tot = number_format(array_sum($days_total), 3);
        $tord = array_sum($days_order);

        $tot2 = number_format(array_sum($days_total2), 3);
        $tord2 = array_sum($month_order);

        return view('report.Settlement', compact('days', 'tot', 'tord', 'tot2', 'tord2', 'days_order', 'days_total', 'month', 'month_order', 'days_total2'));
    }

    //settlement search
    public function settlementSearch(Request $request){

        $date_from = str_replace('T', ' ', $request->df).':00';
        $date_to = str_replace('T', ' ', $request->dt).':00';

        //dd($date_from);
 
        $period = CarbonPeriod::create($date_from, $date_to);
        $days=[];
        $days_order=[];
        foreach ($period as $date) {

            $days[] =  $date->format('Y-m-d');
            $days_order[] = Order::where('status', 4)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->count();
            $tot = Order::where('status', 4)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->get();
            $days_tot=[];
            $tot->each(function($ord) use(&$days_tot){
                $days_tot[] = $ord->total_price;
            });
            $days_total[] = number_format(array_sum($days_tot), 3);
        }

        $res = Order::where('status', 4)
            ->whereBetween('delivery_time', [$date_from, $date_to])
            ->get();

        $ta1 = $res->where('delivery_type', 'Take away')->count();
        $di1 = $res->where('delivery_type', 'Dinein')->count();
        $de1 = $res->where('delivery_type', 'Delivery')->count();

        $tot = number_format(array_sum($days_total), 3);
        $tord = array_sum($days_order);

        return view('report.SettlementSearch', 
        compact('days', 'days_order', 'days_total', 'ta1', 'di1', 'de1', 'date_from', 'date_to', 'tot', 'tord'));
    }


    //---------------------------------------------------------------------------------------------------------member

    public function member(){

        return view('report.MemberSearch', ['users' => User::where('type', 3)->get()]);
    }


    //sale search
    public function memberSearch(Request $request){

        

        //dd($date_from);

        $user = User::where('memberid', $request->memberid)->first();

        $rec = Order::where('status', 4)
            ->where('user_id', $user->id)
            ->get();

           // dd($request->df);

        if($request->df != null){

            $date_from = str_replace('T', ' ', $request->df).':00';
            $rec = $rec->where('delivery_time', '>', $date_from);
        }

        if($request->dt != null){
            
            $date_to = str_replace('T', ' ', $request->dt).':00';
            $rec = $rec->where('delivery_time', '<', $date_to);
        }

        //payment type
        if($request->payment_type_id != null){
            
            $rec = $rec->where('payment_type_id', $request->payment_type_id);
        }

        //delivery type
        if($request->delivery_type != null){
            
            $rec = $rec->where('delivery_type', $request->delivery_type);
        }

        

        $tot_ord = $rec->count();



        $pricet = [];
        $rec->each(function($ord) use(&$pricet){
            $pricet[] = $ord->total_price;
        });
        $tot_price = number_format(array_sum($pricet), 3);

        $pricetc = [];
        $rec->where('payment_type_id', 1)->each(function($ord) use(&$pricetc){
            $pricetc[] = $ord->total_price;
        });
        $tot_pricec = number_format(array_sum($pricetc), 3);

        $pricetca = [];
        $rec->where('payment_type_id', 2)->each(function($ord) use(&$pricetca){
            $pricetca[] = $ord->total_price;
        });
        $tot_priceca = number_format(array_sum($pricetca), 3);




        $users = User::where('type', 3)->get();

        
 
        

        return view('report.MemberSearch', 
        compact('rec', 'tot_ord', 'tot_price','tot_pricec','tot_priceca', 'users', 'user'));
    }


    public function memberBalance(){

        return view('report.MemberBalance', ['members' => User::where('type', 3)->get()]);
    }




}
