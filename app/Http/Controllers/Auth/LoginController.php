<?php

namespace App\Http\Controllers\Auth;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function userlogin(Request $request){

        $validation  =   Validator::make($request->all(), [
            'memberid'          =>      'required',
            'code'  =>  'required'
        ]);

        if($validation->fails()) {
            return response(['status' => false, 'validation' => $validation->errors()], 401);
        }

        if(!is_null($user = User::where('memberid', $request->memberid)->first())) {

            if (!Session::exists('branch')) {
            
                Session::put('branch', Branch::first());
            }

            if($user->code != $request->code){
                return response(['status' => false, 'validation' => 'Invalid Code, Please try again'], 401);

            }else{

                if(Auth::loginUsingId($user->id, true)){
                    
                    $user = Auth::user();
                    $token                  =       $user->createToken('token')->accessToken;
                    $success['success']     =       true;
                    $success['message']     =       "Success! you are logged in successfully";
                    $success['token']       =       $token;
                    $success['user']        =       $user;
                    $success['orders']        =       $user->orders;
        
                    return response(['status' => true, 'data' => $success], 200);
                } 

            }


        }
        else{

            return response(['status' => false, 'validation' => 'Invalid Member ID, Please try again'], 401);
        }
 
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        // if(!is_null($user = User::where('email', $request->email)->first())) {

        // }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            if(auth()->user()->type == 1):

                if (!Session::exists('branch')) {
        
                    Session::put('branch', Branch::first());
                }
                
                

                return redirect()->route('home');

            elseif(auth()->user()->type == 2):

                return redirect()->route('kitchen');
    
            elseif(auth()->user()->type == 5):

                Session::put('branch', Branch::find(auth()->user()->branch_id));
                return redirect()->route('pos');
            endif;
        }

        return back()->withInput($request->only('email', 'remember'));
    }


    //waiter login with id
    public function waiterlogin(Request $request)
    {
        $this->validate($request, [
            'memberid' => 'required'
        ]);

        if(!is_null($user = User::where('memberid', $request->memberid)->first())) {

            if(Auth::guard('waiter')->loginUsingId($user->id, true)){
                
                $user = Auth::user();
                // $token                  =       $user->createToken('token')->accessToken;
                // $success['success']     =       true;
                // $success['message']     =       "Success! you are logged in successfully";
                // $success['token']       =       $token;
                // $success['user']        =       $user;

                //dd(auth('waiter')->user());
    
                //return response(['status' => true, 'data' => $success], 200);
                Session::put('branch', Branch::find(auth('waiter')->user()->branch_id));
                return redirect()->route('waiter');
            } 
        }
        else{

            return back();
        }

         

        return back()->withInput($request->only('email', 'remember'));
    }


}
