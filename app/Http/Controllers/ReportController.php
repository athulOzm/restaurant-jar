<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Settlement;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //sale index
    public function sale(){

        // $ord = Order::where('status', 2)
        //            ->whereDate('delivery_time', '>', Carbon::now()->subDays(30))
        //            ->get()
        //            ->groupBy(function($val) {
        //                 return Carbon::parse($val->delivery_time)->format('d');
        //            });

        $period = CarbonPeriod::create('2021-04-30', '2021-05-30');
        $days=[];
        $days_order=[];
        foreach ($period as $date) {

            $days[] =  $date->format('Y-m-d');
            $days_order[] = Order::where('status', 2)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->count();
            $tot = Order::where('status', 2)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->get();
            $days_tot=[];
            $tot->each(function($ord) use(&$days_tot){
                $days_tot[] = $ord->total_price;
            });
            $days_total[] = number_format(array_sum($days_tot), 3);
        }

        //take away
        $ta1 = Order::where('status', 2)
            ->where('delivery_type', 'Take away')
            ->whereBetween('delivery_time', ['2021-04-30','2021-05-30'])
            ->count();
        $ta2 = Order::where('status', 2)
            ->where('delivery_type', 'Take away')
            ->whereBetween('delivery_time', ['2020-04-30','2021-05-30'])
            ->count();

        //dine in
        $di1 = Order::where('status', 2)
            ->where('delivery_type', 'Dinein')
            ->whereBetween('delivery_time', ['2021-04-30','2021-05-30'])
            ->count();
        $di2 = Order::where('status', 2)
            ->where('delivery_type', 'Dinein')
            ->whereBetween('delivery_time', ['2020-04-30','2021-05-30'])
            ->count();

        //dine in
        $de1 = Order::where('status', 2)
            ->where('delivery_type', 'Delivery')
            ->whereBetween('delivery_time', ['2021-04-30','2021-05-30'])
            ->count();
        $de2 = Order::where('status', 2)
            ->where('delivery_type', 'Delivery')
            ->whereBetween('delivery_time', ['2020-04-30','2021-05-30'])
            ->count();


        $period = CarbonPeriod::create('2020-05-30', '1 month', '2021-05-30');
        $month=[];
        $month_order=[];
        foreach ($period as $date) {

            $month[] =  $date->format('Y-M');
            $month_order[] = Order::where('status', 2)
                ->whereYear('delivery_time', '=', $date->format('Y'))
                ->whereMonth('delivery_time', '=', $date->format('m'))
                ->count();

            $tot = Order::where('status', 2)
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
            $days_order[] = Order::where('status', 2)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->count();
            $tot = Order::where('status', 2)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->get();
            $days_tot=[];
            $tot->each(function($ord) use(&$days_tot){
                $days_tot[] = $ord->total_price;
            });
            $days_total[] = number_format(array_sum($days_tot), 3);
        }

        $res = Order::where('status', 2)
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

        $period = CarbonPeriod::create('2021-04-30', '2021-05-30');
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

        


        $period = CarbonPeriod::create('2020-05-30', '1 month', '2021-05-30');
        $month=[];
        $month_order=[];
        foreach ($period as $date) {

            $month[] =  $date->format('Y-M');
            $month_order[] = Order::where('status', 2)
                ->whereYear('delivery_time', '=', $date->format('Y'))
                ->whereMonth('delivery_time', '=', $date->format('m'))
                ->count();

            $tot = Order::where('status', 2)
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
            $days_order[] = Order::where('status', 2)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->count();
            $tot = Order::where('status', 2)->whereDate('delivery_time', '=', $date->format('Y-m-d'))->get();
            $days_tot=[];
            $tot->each(function($ord) use(&$days_tot){
                $days_tot[] = $ord->total_price;
            });
            $days_total[] = number_format(array_sum($days_tot), 3);
        }

        $res = Order::where('status', 2)
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

        return view('report.Member');
    }




}
