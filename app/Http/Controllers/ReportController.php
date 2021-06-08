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

        // $ord = Order::where('status', 4)
        //            ->whereDate('delivery_time', '>', Carbon::now()->subDays(30))
        //            ->get()
        //            ->groupBy(function($val) {
        //                 return Carbon::parse($val->delivery_time)->format('d');
        //            });

        $current_date = Carbon::now()->toDateString();
        $sub_month_date = Carbon::now()->subMonth()->toDateString();
        $sub_year_date = Carbon::now()->subYear()->toDateString();

        $period = CarbonPeriod::create($sub_month_date, $current_date);
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

        //take away
        $ta1 = Order::where('status', 4)
            ->where('delivery_type', 'Take away')
            ->whereBetween('delivery_time', [$sub_month_date, $current_date])
            ->count();
        $ta2 = Order::where('status', 4)
            ->where('delivery_type', 'Take away')
            ->whereBetween('delivery_time', [$sub_year_date, $current_date])
            ->count();

        //dine in
        $di1 = Order::where('status', 4)
            ->where('delivery_type', 'Dinein')
            ->whereBetween('delivery_time', [$sub_month_date, $current_date])
            ->count();
        $di2 = Order::where('status', 4)
            ->where('delivery_type', 'Dinein')
            ->whereBetween('delivery_time', [$sub_year_date, $current_date])
            ->count();

        //dine in
        $de1 = Order::where('status', 4)
            ->where('delivery_type', 'Delivery')
            ->whereBetween('delivery_time', [$sub_month_date, $current_date])
            ->count();
        $de2 = Order::where('status', 4)
            ->where('delivery_type', 'Delivery')
            ->whereBetween('delivery_time', [$sub_year_date, $current_date])
            ->count();


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

        return view('report.SaleReport', compact('days', 'tot', 'tord', 'tot2', 'tord2', 'days_order', 'days_total', 'month', 'month_order', 'days_total2', 'ta1', 'ta2', 'de1', 'de2', 'di1', 'di2'));
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

        return view('report.SaleSearch', 
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

        return view('report.Member', ['users' => User::where('type', 3)->get()]);
    }


    //sale search
    public function memberSearch(Request $request){

        $date_from = str_replace('T', ' ', $request->df).':00';
        $date_to = str_replace('T', ' ', $request->dt).':00';

        //dd($date_from);

        $user = User::where('memberid', $request->memberid)->first();

        $rec = Order::where('status', 4)
            ->whereBetween('delivery_time', [$date_from, $date_to])
            ->where('user_id', $user->id)
            ->get();

        

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




}
