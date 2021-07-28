<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Cors;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/







//for test api
// Route::get('/data', function (){
//     return response()->json('loaded');
// });
//admin.
Route::middleware([Cors::class, 'auth:userapi'])->group(function () {

    Route::get('/init', 'ProductController@getInit');
    
    // Route::post('/makeurl', 'CardController@makeUrl');
    // Route::post('/addcard', 'CardController@add');
    // Route::get('/fetchaddcard', 'CardController@fetchAddCard');
    // Route::get('/fetchcards', 'CardController@all');
    // Route::get("/fetchtype/{card}", 'CardController@type');
    // Route::post('/card/upddp', 'CardController@upddp');

    // Route::get("/fetchcontact/{card}", 'ContactController@contact');
    // Route::post('/card/updcontact', 'ContactController@updcontact');
    
    // Route::get("/fetchsocialmedia/{card}", 'SocialmediaController@socialmedia');
    // Route::post('/card/updsocialmedia', 'SocialmediaController@updsocialmedia');



    
    
});



Route::middleware([Cors::class])->group(function () {

    Route::post('/registeruser', 'UserController@store');
    Route::post('/userlogin', 'Auth\LoginController@userlogin');

    //social login
    // Route::post('/googleauthreg', 'Auth\GoogleController@register');
    // Route::post('/googleauth', 'Auth\GoogleController@auth');

    // Route::post('/fbauthreg', 'Auth\FbController@register');
    // Route::post('/fbauth', 'Auth\FbController@auth');

    // Route::get('/card/{card}', 'CardController@show');

    
    Route::get('/menu/{menutype}', 'ProductController@getByMenutype');


    Route::post('checkout', 'UserController@checkout');
    Route::post('addtocart', 'UserController@addToCart');

  


    
    Route::middleware('auth:userapi')->get('/user', 
        function (Request $request) {
            return $request->user();
        }
    );

});

//admin.

Route::get('getcat/{menutype}', 'PosController@getCatApp');


Route::middleware([Cors::class, 'auth:userapi'])->group(function () {
    
    Route::post('/checkoutapp', 'PosController@checkoutApp');
    Route::post('/cancelorder', 'PosController@cancelorderApp');
 
    
    
});


Route::get('kitchen/getorders', 'KitchenController@getOrders')->name('kitchen.orders');
Route::patch('kitchen/orderready/{order}', 'KitchenController@orderReady')->name('kitchen.ready');




