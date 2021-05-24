<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Card;

use App\Http\Controllers\Controller;
use App\Order;
use App\PaymentType;
use App\Providers\RouteServiceProvider;
use App\Rank;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Image;



class UserController extends Controller
{


    //web ---------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------

    public function index(){

        return view('member.Index', ['members' => User::where('type', 3)->get()]);
    }

    public function create(){
        $ranks = Rank::all();
        $paymenttypes = PaymentType::all();
        return view('member.Create', compact('ranks', 'paymenttypes'));
    }

    public function destroy(Request $request){

        User::find($request->id)->delete();
        return redirect()->route('member.index');
    }
    
    
    public function edit(User $user){
        $ranks = Rank::all();
        $paymenttypes = PaymentType::all();

       // dd($user);

        return view('member.Edit', compact('user', 'ranks', 'paymenttypes'));
    }




    public function storeWeb(Request $request){

        //dd($this->validateReq($request));

        User::create($this->validateReq($request));

        return redirect()->route('member.index');
    }

    public function updateWeb(Request $request){

        //dd($this->validateReq($request));

        User::find($request->id)->update($this->validateReqUpd($request));

        return redirect()->route('member.index');
    }


    public function validateReq($request){

        return $request->validate([
            'name'              =>      'required',
            'email'             =>      'nullable|unique:users|email',
            'phone'             =>      'min:8|unique:users',
            'memberid'          =>      'required|min:3|unique:users',
            'rank_id'           =>      'required',
            'limit'             =>      'nullable',
            'item_limit'        =>      'nullable',
            'payment_type_id'   =>      'required',
            'room_address'      =>      'nullable',
            'location'          =>      'nullable',
            'status'            =>      'nullable'
        ]);
    }

    

    public function validateReqUpd($request){

        return $request->validate([
            'name'              =>      'required',
            'email'             =>      'nullable|email|unique:users,email,'.$request->id,
            'phone'             =>      'min:8|unique:users,phone,'.$request->id,
            'memberid'          =>      'required|min:3|unique:users,memberid,'.$request->id,
            'rank_id'           =>      'required',
            'limit'             =>      'nullable',
            'item_limit'        =>      'nullable',
            'payment_type_id'   =>      'required',
            'room_address'      =>      'nullable',
            'location'          =>      'nullable',
            'status'            =>      'nullable'
        ]);
    }



















    //api---------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------

    public function store(Request $request){

        //return response()->json($request);

        $validation  =   Validator::make($request->all(), [

            'name'              =>      'required|min:3',
            'email'             =>      'required|unique:users|email',
            'phone'             =>      'min:8',
            'memberid'          =>      'required|min:3',

           // 'password'          =>      'required|alpha_num|min:5',
           // 'confirm_password'  =>      'required|same:password'
        ]);

        if($validation->fails()) {
            return response()->json(['status' => false, 'validation' => $validation->errors()]);
        }

        User::create([
            'name'              =>      $request->name,
            'email'             =>      $request->email,
            'phone'             =>      $request->email,
            'memberid'          =>      $request->memberid
        ]);

        if(!is_null($user = User::where('memberid', $request->memberid)->first())) {
            if(Auth::loginUsingId($user->id, true)){
                
                $user = Auth::user();
                $token                  =       $user->createToken('token')->accessToken;
                $success['success']     =       true;
                $success['message']     =       "Success! you are logged in successfully";
                $success['token']       =       $token;
                $success['user']        =       $user;
    
                return response()->json(['status' => true, 'data' => $success]);
            } else{
                return response()->json(['status' => false, 'validation' => 'Invalid login, Please try again']);
            }
        }
        
        //return response()->json( [ 'status' => true, 'user' => $user ] );

    }



    public function upload(Request $request){

        $rname = rand(24525, 25545);

        Image::make($request->file)
            ->save(storage_path('app/public/profile').'/'.$rname.'.jpg');


        $imagename = 'http://reactjsauthwithlaravel.test/server/storage/files/'.$rname.'.jpg';
        $imagename2 = 'http://10.0.2.2/reactJsAuthWithLaravel/server/storage/files/'.$rname.'.jpg';


        return response()->json(['response' => true, 'image' => $imagename, 'image2' => $imagename2]);
    }


    public function get(Request $request){

        //var_dump($request->subdomain);

        $user = Card::where('nam', $request->subdomain)->first();

        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['domain'] = $user->domain;

      
        return response()->json(['data' => $success], 200);
    }


    public function addToCart(Request $request){

        $order = Order::firstOrCreate(
            ['user_id' => $request->user, 'status'   =>  1],
            ['status'   =>  1]
        );

        $product = [
            'product_id' => $request->product, 'quantity'    =>  $request->qty
        ];

        $order->products()->attach([$product]);

        return response(['message' => 'product added successfully'], 201);
       
    }






    public function checkout(Request $request){

        $member = 1;

        //$menues = $request->menus;
        $etime = '10:15';
        $pm = 'swipe card';

        $products = [
            [
                'product_id' => 1, 'quantity'    =>  3
            ],
            [
                'product_id' => 2, 'quantity'    =>  6
            ]
        ];

        $order = Order::create([
            'user_id' => 1,
            'payment_method'    =>  1,
            'dtime' =>  '10:00'
        ]);

        $order->products()->attach($products);


    }


    public function ledger(){

        return view('member.Ledger', ['members' => User::where('type', 3)->get()]);
    }









    //waiter -----------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------

    public function waiterindex(){

        return view('waiter.Index', ['waiters' => User::where('type', 4)->get()]);
    }

    public function waitercreate(){
        return view('waiter.Create');
    }

    public function waiterdestroy(Request $request){

        User::find($request->id)->delete();
        return redirect()->route('waiter.index');
    }
    
    
    public function waiteredit(User $user){
        $ranks = Rank::all();
        $paymenttypes = PaymentType::all();
        return view('waiter.Edit', compact('user', 'ranks', 'paymenttypes'));
    }

    public function waiterstoreWeb(Request $request){

        User::create([
            'name'              =>      $request->name,
            'email'             =>      $request->email,
            'phone'             =>      $request->phone,
            'type'              =>      4
        ]);

        return redirect()->route('waiter.index');
    }



    //waiter -----------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------

    public function userindex(){

        return view('user.Index', ['users' => User::where('type', 5)->get()]);
    }

    public function usercreate(){
        return view('user.Create');
    }

    public function userdestroy(Request $request){

        User::find($request->id)->delete();
        return redirect()->route('user.index');
    }
    
    
    public function useredit(User $user){
        $ranks = Rank::all();
        $paymenttypes = PaymentType::all();
        return view('user.Edit', compact('user', 'ranks', 'paymenttypes'));
    }

    public function userstoreWeb(Request $request){

        User::create([
            'name'              =>      $request->name,
            'email'             =>      $request->email,
            'password'          =>  Hash::make($request->password),
            'type'              =>      5
        ]);

        return redirect()->route('user.index');
    }




    










}
