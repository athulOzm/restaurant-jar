<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;
use App\Settlement;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $totdd = Order::where('status', 4)->whereDate('delivery_time', '=', '2021-09-21')->get();
        $days_tot=[];
        $totdd->each(function($ord) use(&$days_tot){
            $days_tot[] = $ord->total_price;
        });
        $daytot = number_format(array_sum($days_tot), 3);

        $totdd = Order::where('status', 4)->whereDate('delivery_time', '=', '2021-09-21')->where('delivery_type', 'Take away')->get();
        $days_tot=[];
        $totdd->each(function($ord) use(&$days_tot){
            $days_tot[] = $ord->total_price;
        });
        $ta0 = number_format(array_sum($days_tot), 3);


        $totdd = Order::where('status', 4)->whereDate('delivery_time', '=', '2021-09-21')->where('delivery_type', 'Dinein')->get();
        $days_tot=[];
        $totdd->each(function($ord) use(&$days_tot){
            $days_tot[] = $ord->total_price;
        });
        $di0 = number_format(array_sum($days_tot), 3);

        $totdd = Order::where('status', 4)->whereDate('delivery_time', '=', '2021-09-21')->where('delivery_type', 'Delivery')->get();
        $days_tot=[];
        $totdd->each(function($ord) use(&$days_tot){
            $days_tot[] = $ord->total_price;
        });
        $de0 = number_format(array_sum($days_tot), 3);

        //fast movient day -----------------

        $topitem = OrderProduct::whereHas('order', function($q){

            $q->where('status', 4);

           
            
           
        })
        ->whereHas('categories', function($q){
            // if(isset($_GET['menucat_id']) and $_GET['menucat_id'] != 'All'){

            //     $q->where('categories.id', $_GET['menucat_id']);
            // }
        })
        ->where('updated_at', '>=', '2021-09-21')
        
        ->groupBy('product_id')
        ->select('*', DB::raw('sum(quantity) as quantity_sum, sum(promotion) as promotion_sum, sum(price * quantity + container - promotion) as price_sum'))
       
        ->get()
        ->sortByDesc('price_sum')
        ->take(10);;

        //-----------------------



        $period = CarbonPeriod::create('2021-08-15', '2021-09-21');
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

       

        $ta1 = Order::where('status', 4)
            ->where('delivery_type', 'Take away')
            ->whereBetween('delivery_time', ['2021-08-15','2021-09-21'])
            ->count();
        $ta2 = Order::where('status', 4)
            ->where('delivery_type', 'Take away')
            ->whereBetween('delivery_time', ['2020-04-30','2021-09-21'])
            ->count();

        //dine in
       
        $di1 = Order::where('status', 4)
            ->where('delivery_type', 'Dinein')
            ->whereBetween('delivery_time', ['2021-08-15','2021-09-21'])
            ->count();
        $di2 = Order::where('status', 4)
            ->where('delivery_type', 'Dinein')
            ->whereBetween('delivery_time', ['2020-04-30','2021-09-21'])
            ->count();

        //dine in
       
        $de1 = Order::where('status', 4)
            ->where('delivery_type', 'Delivery')
            ->whereBetween('delivery_time', ['2021-08-15','2021-09-21'])
            ->count();
        $de2 = Order::where('status', 4)
            ->where('delivery_type', 'Delivery')
            ->whereBetween('delivery_time', ['2020-04-30','2021-09-21'])
            ->count();


        $period = CarbonPeriod::create('2020-05-30', '1 month', '2021-09-21');
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

        return view('admin.index', compact('days', 'daytot', 'tot', 'tord', 'tot2', 'tord2', 'days_order', 'days_total', 'month', 'month_order', 'days_total2', 'ta0', 'topitem', 'ta1', 'ta2', 'de1', 'de0', 'di0', 'de2', 'di1', 'di2'));
    }
}
