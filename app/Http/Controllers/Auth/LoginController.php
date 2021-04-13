<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;



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
            'memberid'          =>      'required|min:6',
        ]);

        if($validation->fails()) {
            return response(['status' => false, 'validation' => $validation->errors()], 401);
        }

        if(!is_null($user = User::where('memberid', $request->memberid)->first())) {

            if(Auth::loginUsingId($user->id, true)){
                
                $user = Auth::user();
                $token                  =       $user->createToken('token')->accessToken;
                $success['success']     =       true;
                $success['message']     =       "Success! you are logged in successfully";
                $success['token']       =       $token;
                $success['user']        =       $user;
    
                return response(['status' => true, 'data' => $success], 200);
            } 
        }
        else{

            return response(['status' => false, 'validation' => 'Invalid login, Please try again'], 401);
        }
 
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(!is_null($user = User::where('email', $request->email)->first())) {

        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect()->route('home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


}
