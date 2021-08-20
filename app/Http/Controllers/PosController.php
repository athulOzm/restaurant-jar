<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

use App\Deliverylocation;
use App\Events\Checkout;
use App\Invoice;
use App\Order;
use Illuminate\Support\Facades\Auth;

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
use App\Menutype;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PosController extends Controller
{




    public function pos(){

        // if(!Settlement::where('owner_id', auth()->user()->id)->where('closed_at', null)->first()){

        //     Settlement::create([
        //         'owner_id' => auth()->user()->id
        //     ]);
        // }

        if (Session::exists('token')) {

            $ct = Order::find(Session::get('token')->id);
            if($ct->status != 1){
                $ct = Order::create(['status'   =>  1, 'reqfrom' => auth()->user()->id]);
            }
        }
        else{
            $ct = Order::create(['status'   =>  1, 'reqfrom' => auth()->user()->id]);
        }

        if (!Session::exists('branch')) {
            
            Session::put('branch', Branch::first());
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
            $clone->products()->attach($tag, ['price' => $tag->pivot->price, 'quantity' => $tag->pivot->quantity, 'vat' => $tag->pivot->vat, 'promotion' => $tag->pivot->promotion]);
            // you may set the timestamps to the second argument of attach()
        }

        $clone->push();

        Session::forget('token');
        Session::put('token', $clone);
        //$cur_token = Order::with('user', 'table', 'location')->where('id', $newt->id)->first();
        return redirect()->route('pos.update', $clone->id);
    }



    //add to cart pos
    public function addtocart(Request $request){

       $pid = $request->id;
       $va = $request->va;
       $price = $request->price;
       $vat = $request->vat;
       $promotion_price = $request->promotion_price;

       //$product = Product::find($request->id);



       $token = Order::find(Session::get('token')->id);

       $status = Order::whereHas('orderproducts', function($q) use($pid, $va, $token){
                        $q->where('product_id', $pid);
                        $q->where('order_id', $token->id);
                        $q->where('variant', $va);
                    })
                 ->with('products')
                 ->first();
      
        if($status == ''){

            $product = [
                'product_id' => $request->id, 
                'quantity' =>  1,
                'price' => $price,
                'variant' => $va,
                'vat' => $vat,
                'promotion' => $promotion_price,
            ];
            $token->products()->attach([$product]);
        } 
        else {

           DB::table('order_product')
            ->where('order_id', $token->id)
            ->where('variant', $va)
            ->where('product_id', $pid)
            ->increment('quantity');
        }

        return response(['message' => 'product added successfully'], 201);
    }


        //add to cart va pos
        public function addtocartvariant(Request $request){

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

    //add to cart pos
    public function addtocartByBarcode(Request $request){


        $pid = explode('-', $request->item)[1];
        $qty = explode('-', $request->item)[2];
 
        $product = Product::find($pid);
 
        $token = Order::find(Session::get('token')->id);
 
        $status = Order::whereHas('products', function($q) use($pid){
                         $q->where('product_id', $pid);
                     })
                  ->with('products')->where('id', $token->id)->first();
       
         if($status == ''){
 
             $product = [
                 'product_id' => $product->id, 
                 'quantity' =>  $qty,
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
             ->update(['quantity' => $qty]);
         }
 
         return response(['message' => 'product added successfully'], 201);
     }


     //add to cart pos
    public function addtocartByReceipt(Request $request){


        $token = explode('-', $request->item)[1];

        $order = Order::find($token);


        $clone = Order::find(Session::get('token')->id);

        //dd($order->products);

        $clone->products()->detach();

        foreach($order->products as $tag)
        {
            $clone->products()->attach($tag, ['price' => $tag->pivot->price, 'quantity' => $tag->pivot->quantity, 'vat' => $tag->pivot->vat, 'promotion' => $tag->pivot->promotion]);
            // you may set the timestamps to the second argument of attach()
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

    //pos messid field
    public function getmembers(){

       // $members = User::with('rank')->where('type', 3)->where('status', true)->get();
        $members = Branch::find(Session::get('branch')->id)->members()->with('rank')->where('type', 3)->where('status', true)->get();
        return response($members, 200);
    }

    public function getmember($user){

        if(User::find($user)): 
            return response(User::find($user), 200);
        else: 
            return response(User::where('memberid', $user)->first(), 200);
        endif;
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

        $order = Order::with('orderproducts', 'user', 'branch', 'invoice')->find($id);

        //dd($order);
        return view('pos.Print', compact('order'));
    }

    public function getprint2($id){

        $order = Order::with('orderproducts', 'user', 'branch', 'invoice')->find($id);

        //dd($order);
        return view('pos.Print2', compact('order'));
    }

    public function getprintorder($id){

        $order = Order::with('orderproducts', 'user', 'branch')->find($id);

        //dd($order);
        return view('pos.PrintOrder', compact('order'));
    }

    public function getprintA4($id){

        $order = Order::with('orderproducts', 'user')->find($id);

        //dd($order);
        return view('pos.PrintA4', compact('order'));
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


    //order pay
    public function ordPay(Request $request) {



        $ord = Order::find($request->order_id);

        $ord->update([
            'receipt_id'    =>  $request->receipt_id,
            'payment_status'    =>  true,
            'status'    =>  4
        ]);

        Invoice::create([
            'order_id'  =>  $ord->id,
            'branch_id' =>  $ord->branch_id,
            'amount'    =>  $ord->total_price,
            'status'    =>  1
        ]);



        return redirect()->route('pos.print2', $ord->id);

    }


    //checkout app
    public function checkoutApp(Request $request) {

	if (!Session::exists('branch')) {
            
            Session::put('branch', Branch::first());
        }

 
        $ord = Order::create([
            'status'   =>  1, 
            'reqfrom' => 2, 
            'branch_id' =>  Branch::first()->id,
             'menutype_id'   =>  $request->cart['menutype'],
             'delivery_type' =>   'Take away',
             'delivery_time' => str_replace('T', ' ', $request->cart['time']),
            'payment_type_id'   =>  1,
	    'user_id' => $request->user()->id
        ]);


	

foreach($request->cart['items'] as $item){

 
 
$product = Product::find($item['id']);

$product = [
    'product_id' => $item['id'], 
    'quantity' =>  $item['qty'],
    'price' => $product->price,
    'vat' => $product->vat,
    'promotion' => $product->promotion_price
];
$ord->products()->attach([$product]);


}

$ord->update([
	'status' => 3
]);
 Checkout::dispatch($ord);

 
return response($request->user()->orders, 200);
        
}


    //cancel order app 

    public function cancelorderApp(Request $request) {

        if (!Session::exists('branch')) {

            Session::put('branch', Branch::first());
        }

//return $request;

        Order::find($request->order)->delete();
        return response($request->user()->orders, 200);
    }


    //checkout pos
    public function checkout(Request $request) {


        $tn = Carbon::now()->timezone('Asia/Dubai')->format('H:i:s');

        //dd($request->paymenttype);
     
        if($cmtt = Menutype::where('id', '!=', 1)->where('from', '<', $tn)->where('to', '>', $tn)->first()){
            $cmt = $cmtt;
        } else {
            $cmt = Menutype::find(2);
        }
   

       // $id = explode('|', $request->memberid);

       // $memberid = $id[0];

       
        $delivery_type = $request->del;

        if($request->del == 'Dinein'){
            
            $table = $request->dine_table;
            $waiter = $request->dine_waiter;
            $del_type = null;
            $del_loc = null;

        }
        if($request->del == 'Delivery'){

            $del_type = $request->del_type;
            $del_loc = $request->del_loc;
            $table = null;
            $waiter = null;

        } else{
            $table = null;
            $waiter = null;
            $del_type = null;
            $del_loc = null;

        }

        // if($request->del_type != ''){
        //     $payment_type = 3;
        // }else{
        //     $payment_type = $request->paymenttype;
        // }


        
        $delivery_time = $request->dtime;

        

        // if(isset($request->location)){
        //     $location = $request->location;
        // } else {
        //     $location = null;
        // }

        // if(isset($request->room_address)){
        //     $room_addr = $request->room_address;
        // } else {
        //     $room_addr = null;
        // }

        $memberid = $request->customer;

        //dd($memberid);

        if(isset($request->vn)){
            $vn = $request->vn;
        } else {
            $vn = null;
        }



        if($request->reqtype == 'kot'){

            if(isset($request->dine_table)){
                $table = $request->dine_table;
                Table::find($table)->update(['status' => false]);
            } else {
                $table = null;
            }

            $id = Order::find(Session::get('token')->id)->update([
                'status' =>  3,
                'user_id'    =>  User::find($memberid)->id,
                'delivery_type' => $delivery_type,
                //'payment_type_id'    =>  $payment_type,
                'delivery_time'  =>  $delivery_time,
                'deliverylocation_id'  =>  $del_type,
                'room_addr'  =>  $del_loc,
                'vn'  =>  $vn,
                'payment_status' =>  false,
                'table_id'  =>  $table,
                'sn' =>  $request->sn,
                'waiter_id'  => $request->waiter,
                'branch_id'  => $request->branch_id,
                'reqfrom'    =>  auth()->user()->id,
                'menutype_id'   =>  MenuType::first()->id
            ]);

        } else if($request->reqtype == 'hold'){

            if(isset($request->dine_table)){
                $table = $request->dine_table;
               // Table::find($table)->update(['status' => false]);
            } else {
                $table = null;
            }


            $id = Order::find(Session::get('token')->id)->update([
                'status' =>  2,
                'user_id'    =>  User::find($memberid)->id,
                'delivery_type' => $delivery_type,
                //'payment_type_id'    =>  $payment_type,
                'delivery_time'  =>  $delivery_time,
                'deliverylocation_id'  =>  $del_type,
                'room_addr'  =>  $del_loc,
                'vn'  =>  $vn,
                'payment_status' =>  false,
                'table_id'  =>  $table,
                'sn' =>  $request->sn,
                'waiter_id'  => $waiter,
                'branch_id'  => $request->branch_id,
                'reqfrom'    =>  auth()->user()->id,
                'menutype_id'   =>  MenuType::first()->id
            ]);

        } else{

            if(isset($request->dine_table)){
                $table = $request->dine_table;
                Table::find($table)->update(['status' => true]);
            } else {
                $table = null;
            }
 

            $id = Order::find(Session::get('token')->id)->update([
                'status' =>  4,
                'user_id'    =>  User::find($memberid)->id,
                'delivery_type' => $delivery_type,
                'payment_type_id'    =>  $request->paymenttype,
                'delivery_time'  =>  $delivery_time,
                'deliverylocation_id'  =>  $del_type,
                'room_addr'  =>  $del_loc,
                'payment_status' =>  true,
                'table_id'  =>  $table,
                'vn'  =>  $vn,
                'sn' =>  $request->sn,
                'waiter_id'  => $request->waiter,
                'branch_id'  => $request->branch_id,
                'reqfrom'    =>  auth()->user()->id,
                'menutype_id'   =>  MenuType::first()->id,
                'amount'    =>  Order::find(Session::get('token')->id)->total_price,
                'settlement_id' =>  auth()->user()->biller()->first()->id
            ]);

            

            Invoice::create([
                'order_id'  =>  Session::get('token')->id,
                'branch_id' =>  $request->branch_id,
                'amount'    =>  Order::find(Session::get('token')->id)->total_price,
                'status'    =>  1
            ]);
        }



       

       $tid = Session::get('token')->id;


    //    if($request->hasfile('file')):

    //         $fpath = Storage::putFile('pospdf', $request->file('file'));

    //         $id = Order::find(Session::get('token')->id)->update(['attachment' => $fpath]);

    //     endif;


        //manage stock
        // Order::find(Session::get('token')->id)->orderproducts()->each(function($product){

        //     $mnustock = Product::find($product->product_id)->getmenustocks()->first()->qty_total;

        //     $tot = number_format($mnustock - $product->quantity, 1);
        //     Product::find($product->product_id)->getmenustocks()->first()->update([
        //         'qty_total' => $tot
        //     ]);


        // });



       Session::forget('token');

       if($request->reqtype == 'hold'){

            //Checkout::dispatch($tid);
            return redirect()->route('pos');
       } else if($request->reqtype == 'kot'){

        if(auth()->user()->type == 4){
            Auth::guard('waiter')->logout();
            Auth::logout();
            Session::flush();
            return redirect()->route('waiter.login');
        }

            //Checkout::dispatch($tid);
            return redirect()->route('pos.print.order', $tid);
       }
       
       else{

            //Checkout::dispatch($tid);
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

        //dd($request);

        $id = Order::find(Session::get('token')->id)->update([
            'status' =>  4,
            //'user_id'    =>  User::where('memberid', $memberid)->first()->id,
            'reqfrom'    =>  auth()->user()->id
        ]);
        
        $tid = Session::get('token')->id;
        Session::forget('token');


        //Checkout::dispatch($tid);
        return redirect()->route('pos.refundprint', $tid);
    }


    //get addon by item
    public function getaddon($id){

        return response(OrderProduct::find($id)->items, 200);
    }

    //get addon by item
    public function getaddonava(Product $product){

        return response($product->addons, 200);
    }

    // //get member credit status
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

        $cash_register = auth()->user()->biller()->first();

       

       $ord = $cash_register->orders;

        //total
        $tot_price = [];
        $ord->each(function($item) use(&$tot_price){

            $tot_price[] = number_format($item->total_price, 3);
        });
        $stotal = number_format(array_sum($tot_price), 3);

        //cache
        $tot_cash = [];
        $ord->where('payment_type_id', 2)->each(function($item) use(&$tot_cash){

            $tot_cash[] = number_format($item->total_price, 3);
        });
        $cash = number_format(array_sum($tot_cash), 3);

        //card
        $tot_card = [];
        $ord->where('payment_type_id', 1)->each(function($item) use(&$tot_card){

            $tot_card[] = number_format($item->total_price, 3);
        });
        $card = number_format(array_sum($tot_card), 3);

        //card
        $tot_online = [];
        $ord->where('payment_type_id', 3)->each(function($item) use(&$tot_online){

            $tot_online[] = number_format($item->total_price, 3);
        });
        $online = number_format(array_sum($tot_online), 3);

        $drawer = number_format($cash + $cash_register->cash_in_hand, 3);


        //sold items
        $cash_register_id = $cash_register->id;
        $sold_items = OrderProduct::whereHas('order', function($q) use(&$cash_register_id){

            $q->where('status', 4);
            $q->where('settlement_id', $cash_register_id);
        })
        ->groupBy('product_id')
        ->select('*', DB::raw('sum(quantity) as quantity_sum, sum(promotion) as promotion_sum, sum(price * quantity + container - promotion) as price_sum'))
        ->get();


        $deli_team = Deliverylocation::where('branch_id', Session::get('branch')->id)->get();

      
            //cache
            $tot_cash = [];
            $ord->where('deliverylocation_id', 1)->each(function($item) use(&$tot_cash){

                $tot_cash[] = number_format($item->total_price, 3);
            });
            $talabat = number_format(array_sum($tot_cash), 3);


            //cache
            $tot_cash = [];
            $ord->where('deliverylocation_id', 2)->each(function($item) use(&$tot_cash){

                $tot_cash[] = number_format($item->total_price, 3);
            });
            $akeed = number_format(array_sum($tot_cash), 3);


            //cache
            $tot_cash = [];
            $ord->where('deliverylocation_id', 3)->each(function($item) use(&$tot_cash){

                $tot_cash[] = number_format($item->total_price, 3);
            });
            $other = number_format(array_sum($tot_cash), 3);

    


        

    

        return response([
            'st'    =>  $stotal,
            'cash'    =>  $cash,
            'card'    =>  $card,
            'online'    =>  $online,
            'drawer'    =>  $drawer,
            'items' =>  $sold_items,
            'talabat' => $talabat,
            'akeed' => $akeed,
            'other' => $other

        ], 200);
    }

    public function donesettlement(){

        auth()->user()->biller()->first()->update([
            'status' => false
        ]);
        return back();
    }


    public function getCatApp(Menutype $menutype){

        if (!Session::exists('branch')) {
            
            Session::put('branch', Branch::first());
        }

        return response(['categories' => $menutype->categories(), 'products' => $menutype->products], 200);
    }
}
 