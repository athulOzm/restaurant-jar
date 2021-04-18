<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Card;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

        return view('member.Create');
    }

    public function destroy(Request $request){

        User::find($request->id)->delete();
        return redirect()->route('member.index');
    }
    
    
    public function edit(){

        return view('member.Create');
    }




    public function storeWeb(Request $request){

        User::create($this->validateReq($request));
        return redirect()->route('member.index');
    }


    public function validateReq($request){

        return $request->validate([
            'name'              =>      'required|min:3',
            'email'             =>      'required|unique:users|email',
            'phone'             =>      'min:6|unique:users',
            'memberid'          =>      'required|min:5|unique:users',
            'position'          =>      'max:200'
        ]);
    }



















    //api---------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------

    public function store(Request $request){

        //return response()->json($request);

        $validation  =   Validator::make($request->all(), [

            'name'              =>      'required|min:3',
            'email'             =>      'required|unique:users|email',
            'phone'             =>      'min:6',
            'memberid'          =>      'required|min:6',

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




    










}
