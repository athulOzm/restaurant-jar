<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Deliverylocation;
use App\Events\Checkout;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\Settlement;
use App\Table;
use App\User;
//use Defuse\Crypto\Encoding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Storage;
//use Mike42\Escpos\CapabilityProfile;
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\PrintConnectors\FilePrintConnector;
// use Mike42\Escpos\EscposImage;
// use Mike42\Escpos\PrintConnectors\CupsPrintConnector;

use App\Item;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PosController extends Controller
{




    public function pos(){

        if(!Settlement::where('owner_id', auth()->user()->id)->where('closed_at', null)->first()){

            Settlement::create([
                'owner_id' => auth()->user()->id
            ]);
        }

        if (Session::exists('token')) {

            $ct = Order::find(Session::get('token')->id);
            if($ct->status != 1){
                $ct = Order::create(['status'   =>  1, 'reqfrom' => null]);
            }
        }
        else{
            $ct = Order::create(['status'   =>  1, 'reqfrom' => null]);
        }

        Session::forget('token');
        Session::put('token', $ct);
        $cur_token = Order::with('user', 'table', 'location')->where('id', $ct->id)->first();
        return view('pos.index', compact('cur_token'));
    }

    //update order
    public function update(Order $order){

        Session::forget('token');
        Session::put('token', $order);
        $cur_token = Order::with('user', 'table', 'location')->where('id', $order->id)->first();
        return view('pos.index', compact('cur_token'));
    }


    //clone order
    public function clone(Order $order){


$clone = $order->replicate();
$clone->push();

foreach($order->products as $tag)
{
    $clone->products()->attach($tag);
    // you may set the timestamps to the second argument of attach()
}

// foreach($item->categories as $category)
// {
//     $clone->categories()->attach($category);
//     // you may set the timestamps to the second argument of attach()
// }

$clone->push();



        // $newt = $order->replicate();
        // $newt->push();
        
        // $products = $order->orderproducts;
        // $newt->products()->attach($products);

        Session::forget('token');
        Session::put('token', $clone);
        //$cur_token = Order::with('user', 'table', 'location')->where('id', $newt->id)->first();
        return redirect()->route('pos.update', $clone->id);
    }



    //add to cart pos
    public function addtocart(Request $request){

       $pid = $request->id;

       $product = Product::find($request->id);



       $token = Order::find(Session::get('token')->id);

       $status = Order::whereHas('products', function($q) use($pid){
                        $q->where('product_id', $pid);
                    })
                 ->with('products')->where('id', $token->id)->first();
      
        if($status == ''){

            $product = [
                'product_id' => $request->id, 
                'quantity' =>  1,
                'price' => $product->price,
                'vat' => $product->vat,
                'promotion' => $product->promotion_price,
            ];
            $token->products()->attach([$product]);
        } 
        else {

           DB::table('order_product')
            ->where('order_id', $token->id)
            ->where('product_id', $pid)
            ->increment('quantity');
        }

        return response(['message' => 'product added successfully'], 201);
    }


    //addtocart Addon
    public function addtocartaddon(Request $request){

        $pid = $request->pid;
        $id = $request->id;
 
        $pitem = OrderProduct::find($pid);

        if($pitem->items()->where('addon_id', $id)->exists()){

            DB::table('addon_order_product')
                ->where('order_product_id', $pitem->id)
                ->where('addon_id', $request->id)
                ->increment('quantity');
        } else{
            
            $product = [
                 'addon_id' => $request->id, 'quantity'    =>  1
            ];
            $pitem->items()->attach([$product]);
        }
 
         return response(['message' => 'product added successfully'], 201);
     }


    //remove cart pos
    public function removecart(Request $request){

        Order::find(Session::get('token')->id)->products()->detach(['product_id' => $request->id]);
    }

    //remove cart addon
    public function removecartaddon(Request $request){

        OrderProduct::find($request->pid)->items()->detach(['addon_id' => $request->id]);
    }

    //minus item cart pos
    public function downcart(Request $request){
       $token = Order::find(Session::get('token')->id);

       if(DB::table('order_product')
       ->where('order_id', $token->id)
       ->where('product_id', $request->id)->first()->quantity <= 1){
        Order::find(Session::get('token')->id)->products()->detach(['product_id' => $request->id]);
       }

       DB::table('order_product')
       ->where('order_id', $token->id)
       ->where('product_id', $request->id)
       ->decrement('quantity');
    }


    //upd quantity
    public function updqty(Request $request){

       DB::update('update order_product set quantity = '.$request->qty.' where id = ?', [$request->cart_item]);
    }

    //minus item cart addon
    public function downcartaddon(Request $request){
        $token = OrderProduct::find($request->pid);
 
        if(DB::table('addon_order_product')
            ->where('order_product_id', $token->id)
            ->where('addon_id', $request->id)->first()->quantity == 1){

                $token->items()->detach(['addon_id' => $request->id]);
        }
 
        DB::table('addon_order_product')
            ->where('order_product_id', $token->id)
            ->where('addon_id', $request->id)
            ->decrement('quantity');
     }

    //add discount
    public function discount(Request $request){

        DB::update('update order_product set discount = '.$request->dis.' where id = ?', [$request->id]);
    }

    //add container
    public function container(Request $request){

        DB::update('update order_product set container = '.$request->dis.' where id = ?', [$request->id]);
     }

    //pos get cart
    public function getcart(){

        return response(Order::with('orderproducts', 'user')->find(Session::get('token')->id), 200);
    }

    //pos get tot price
    public function totalprice(){

        $token = Order::with('products')->find(Session::get('token')->id);
        return response($token->gettotalprice(), 200);
    }


    public function getmembers(){

        return response(User::with('rank')->where('type', 3)->where('status', true)->get(), 200);
    }

    public function getmember(User $user){

        return response($user, 200);
    }

    public function getmenus(){

        return response(Product::all(), 200);
    }

    public function getpaymenttypes($memberid){

        return response(User::find($memberid)->paymenttypes, 200);
    }

    public function gettables(){

        return response(Table::all(), 200);
    }

    public function getlocations(){
        
        return response(Deliverylocation::all(), 200);
    }


    public function getprint($id){

        $order = Order::with('orderproducts', 'user')->find($id);

        //dd($order);
        return view('pos.Print', compact('order'));
    }

    public function getprintrefund($id){

        $order = Order::with('orderproducts', 'user')->find($id);

        //dd($order);
        return view('pos.PrintRefund', compact('order'));
    }

    public function getview($id){

        $order = Order::with('orderproducts', 'user')->find($id);

        //dd($order);
        return view('pos.View', compact('order'));
    }


    //checkout pos
    public function checkout(Request $request) {


        $id = explode('|', $request->memberid);

        $memberid = $id[0];
        $delivery_type = $request->del;
        $payment_type = $request->pt;
        $delivery_time = $request->dtime;

        if(isset($request->table)){
            $table = $request->table;
            Table::find($table)->update(['status' => false]);
        } else {
            $table = null;
        }

        if(isset($request->location)){
            $location = $request->location;
        } else {
            $location = null;
        }

        if(isset($request->room_address)){
            $room_addr = $request->room_address;
        } else {
            $room_addr = null;
        }


        



        



        if($request->reqtype == 'kot'){

            $id = Order::find(Session::get('token')->id)->update([
                'status' =>  3,
                'user_id'    =>  User::where('memberid', $memberid)->first()->id,
                'delivery_type' => $delivery_type,
                'payment_type_id'    =>  $payment_type,
                'delivery_time'  =>  $delivery_time,
                'deliverylocation_id'  =>  $location,
                'room_addr'  =>  $room_addr,
                'payment_status' =>  true,
                'table_id'  =>  $table,
                'sn' =>  $request->sn,
                'waiter_id'  => $request->waiter,
                'reqfrom'    =>  auth()->user()->id
            ]);

        } else if($request->reqtype == 'hold'){
            $id = Order::find(Session::get('token')->id)->update([
                'status' =>  2,
                'user_id'    =>  User::where('memberid', $memberid)->first()->id,
                'delivery_type' => $delivery_type,
                'payment_type_id'    =>  $payment_type,
                'delivery_time'  =>  $delivery_time,
                'deliverylocation_id'  =>  $location,
                'room_addr'  =>  $room_addr,
                'payment_status' =>  true,
                'table_id'  =>  $table,
                'sn' =>  $request->sn,
                'waiter_id'  => $request->waiter,
                'reqfrom'    =>  auth()->user()->id
            ]);

        } else{

            $id = Order::find(Session::get('token')->id)->update([
                'status' =>  4,
                'user_id'    =>  User::where('memberid', $memberid)->first()->id,
                'delivery_type' => $delivery_type,
                'payment_type_id'    =>  $payment_type,
                'delivery_time'  =>  $delivery_time,
                'deliverylocation_id'  =>  $location,
                'room_addr'  =>  $room_addr,
                'payment_status' =>  true,
                'table_id'  =>  $table,
                'sn' =>  $request->sn,
                'waiter_id'  => $request->waiter,
                'reqfrom'    =>  auth()->user()->id
            ]);
        }



       

       $tid = Session::get('token')->id;


       if($request->hasfile('file')):

            $fpath = Storage::putFile('pospdf', $request->file('file'));

            $id = Order::find(Session::get('token')->id)->update(['attachment' => $fpath]);

        endif;



       Session::forget('token');

       if($request->reqtype == 'hold'){

            //Checkout::dispatch($tid);
            return redirect()->route('pos');
       } else{

            Checkout::dispatch($tid);
            return redirect()->route('pos.print', $tid);
       }
       




       //print --------------------------------------------------------------------------------------------
//     $connector = new CupsPrintConnector('_USB_Receipt_Printer');
//     $printer = new Printer($connector);



//     /* Information for the receipt */
//     $items = array(
//         new Item("Example item #1", "4.00"),
//         new Item("Another thing", "3.50"),
//         new Item("Something else", "1.00"),
//         new Item("A final item", "4.45"),
//     );
//     $subtotal = new item('Subtotal', '12.95');
//     $tax = new Item('A local tax', '1.30');
//     $total = new Item('Total', '14.25', true);
//     /* Date is kept the same for testing */
//     // $date = date('l jS \of F Y h:i:s A');
//     $date = "Monday 6th of April 2015 02:56:25 PM";

//     /* Start the printer */
//     //$logo = EscposImage::load("resources/escpos-php.png", false);
//     $printer = new Printer($connector);

//     /* Print top logo */
//     $printer -> setJustification(Printer::JUSTIFY_CENTER);
//    // $printer -> graphics($logo);

//     /* Name of shop */
//     $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
//     $printer -> text("Restoapp Ltd.\n");
//     $printer -> selectPrintMode();
//     $printer -> text("Shop No. 42.\n");
//     $printer -> feed();

//     /* Title of receipt */
//     $printer -> setEmphasis(true);
//     $printer -> text("SALES INVOICE\n");
//     $printer -> setEmphasis(false);

//     /* Items */
//     $printer -> setJustification(Printer::JUSTIFY_LEFT);
//     $printer -> setEmphasis(true);
//     //$printer -> text(new Item('', '$'));
//     $printer -> setEmphasis(false);
//     foreach ($items as $item) {
//         $printer -> text($item);
//     }
//     $printer -> setEmphasis(true);
//     $printer -> text($subtotal);
//     $printer -> setEmphasis(false);
//     $printer -> feed();

//     /* Tax and total */
//     $printer -> text($tax);
//     $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
//     $printer -> text($total);
//     $printer -> selectPrintMode();

//     /* Footer */
//     $printer -> feed(2);
//     $printer -> setJustification(Printer::JUSTIFY_CENTER);
//     $printer -> text("Thank you for shopping at ExampleMart\n");
//     $printer -> text("For trading hours, please visit example.com\n");
//     $printer -> feed(2);
//     $printer -> text($date . "\n");

//     /* Cut the receipt and open the cash drawer */
//     $printer -> cut();
//     $printer -> pulse();

//     $printer -> close();


    //-----------------------------------------------------------------------------

    //Redirect::away('/asdf');
    }


    //checkout refund
    public function checkoutrefund(Request $request) {


        $id = explode('-', $request->memberid);

        $memberid = $id[0];
        $delivery_type = $request->del;
        $payment_type = $request->pt;
        $delivery_time = $request->dtime;

        if(isset($request->table)){
            $table = $request->table;
            Table::find($table)->update(['status' => false]);
        } else {
            $table = null;
        }

        if(isset($request->location)){
            $location = $request->location;
        } else {
            $location = null;
        }

        $id = Order::find(Session::get('token')->id)->update([
            'status' =>  4,
            'user_id'    =>  User::where('memberid', $memberid)->first()->id,
            'delivery_type' => $delivery_type,
            'payment_type_id'    =>  $payment_type,
            'delivery_time'  =>  $delivery_time,
            'deliverylocation_id'  =>  $location,
            'payment_status' =>  true,
            'table_id'  =>  $table,
            'sn' =>  $request->sn,
            'waiter_id'  => $request->waiter,
            'reqfrom'    =>  auth()->user()->id
        ]);
        
       $tid = Session::get('token')->id;
       Session::forget('token');

       if($request->reqtype == 'hold'){

            return redirect()->route('pos');
       } else{

            Checkout::dispatch($tid);
            return redirect()->route('pos.refundprint', $tid);
       }
    }


    //get addon by item
    public function getaddon($id){

        return response(OrderProduct::find($id)->items, 200);
    }

    //get addon by item
    public function getaddonava(Product $product){

        return response($product->addons, 200);
    }

    //get member credit status
    // public function memberstatus(User $user){
    //     $token = Order::with('products')->find(Session::get('token')->id);
    //     $nub = $token->products()->count();
    //     if($user->item_limit < $nub){
    //         $re = $user->item_limit - $nub;
    //         return response(['msg' => 'Limit exced! Only '.$user->item_limit.' items allowed for this Member, remove '. $re .' items to continue!'] , 200);
    //     }
    //     else{
    //         return response(['msg' => 'ok'] , 200);
    //     }
    // }

    public function memberstatus(Request $request){

        if($request->pa == 'withid'){
            return User::find($request->id)->getOrderStatus($request->dt);
        } else{
            return User::where('memberid', $request->id)->first()->getOrderStatus($request->dt);
        }
    }

    //get member credit status2
    public function memberstatus2($id){

        $token = Order::with('products')->find(Session::get('token')->id);
        $nub = $token->products()->count();

        $user = User::where('memberid', $id)->first();
        
        if($user->item_limit < $nub){

            $re = $user->item_limit - $nub;



            return response(['msg' => 'Limit exced! Only '.$user->item_limit.' items allowed for this Member, remove '. $re .' items to continue!'] , 200);
        }
        else{
            return response(['msg' => 'ok', 'id' => $user->id] , 200);
        }

    }

    public function cancel(Request $request){

        Order::find($request->token)->products()->detach();
        Order::find($request->token)->update([
            'delivery_type' =>  null,
            'payment_type_id'   =>  null,
            'user_id'   =>  null,
            'delivery_type' =>  null,
            'delivery_time' =>  null
        ]);


        $ct = Order::create(['status'   =>  1, 'reqfrom' => auth()->user()->id]);
        

        Session::forget('token');
        Session::put('token', $ct);
        return response(['msg' => 'ok'] , 200);
    }

    public function getsettlement(){

        $csettle = Settlement::where('owner_id', auth()->user()->id)->where('closed_at', null)->first();

       $ord = Order::where('reqfrom', auth()->user()->id)
            ->where('status', 2)
            ->whereTime('updated_at', '>', $csettle->created_at)
            ->get();

        //total
        $tot_price = [];
        $ord->each(function($item) use(&$tot_price){

            $tot_price[] = number_format($item->total_price, 3);
        });
        $st = number_format(array_sum($tot_price), 3);

        //cache
        $tot_cash = [];
        $ord->where('payment_type_id', 1)->each(function($item) use(&$tot_cash){

            $tot_cash[] = number_format($item->total_price, 3);
        });
        $cash = number_format(array_sum($tot_cash), 3);

        $tot_credit = [];
        $ord->where('payment_type_id', 2)->each(function($item) use(&$tot_credit){

            $tot_credit[] = number_format($item->total_price, 3);
        });
        $credit = number_format(array_sum($tot_credit), 3);

        return response([
            'st'    =>  $st,
            'cash'    =>  $cash,
            'credit'    =>  $credit,
            'drawer'    =>  $cash,

        ], 200);
    }

    public function donesettlement(){

        Settlement::where('owner_id', auth()->user()->id)
            ->where('closed_at', null)
            ->first()
            ->update(['closed_at' => Carbon::now()]);

        //Auth::logout();
        Session::flush();

        return response('done' , 200);
    }
}
 