<?php 

//web Admin
Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index')->name('home');
//Route::get('/home', );


Route::middleware(['auth'])->group(function () {

    //menutype
    Route::get('menutypes', 'MenutypeController@index')->name('menutype.index');
    Route::post('menutype', 'MenutypeController@store')->name('menutype.store');
    Route::delete('menutype/drop', 'MenutypeController@destroy')->name('menutype.delete');
    Route::get('menutype/{menutype}', 'MenutypeController@edit')->name('menutype.edit');
    Route::patch('menutype', 'MenutypeController@update')->name('menutype.update');

    //category 
    Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::post('/category', 'CategoryController@store')->name('category.store');
    Route::delete('/category/drop', 'CategoryController@delete')->name('category.delete');
    Route::get('category/{category}', 'CategoryController@edit')->name('category.edit');
    Route::patch('category', 'CategoryController@update')->name('category.update');
    Route::get('getsubcategory/{category}', 'CategoryController@getSubCategory');

    //members
    Route::get('/members', 'UserController@index')->name('member.index');
    Route::post('/member', 'UserController@storeWeb')->name('member.store');
    Route::delete('/member/drop', 'UserController@destroy')->name('member.delete');
    Route::get('member/edit/{user}', 'UserController@edit')->name('member.edit');
    Route::patch('member', 'UserController@updateweb')->name('member.update');
    Route::get('member/create', 'UserController@create')->name('member.create');

    //ranks
    Route::get('member/ranks', 'RankController@index')->name('member.rank.index');
    Route::post('member/rank', 'RankController@store')->name('member.rank.store');
    Route::delete('member/rank/drop', 'RankController@destroy')->name('member.rank.delete');
    Route::get('member/rank/{rank}', 'RankController@edit')->name('member.rank.edit');
    Route::patch('member/rank', 'RankController@update')->name('member.rank.update');

    //payment type
    Route::get('pos/paymenttypes', 'PaymentTypeController@index')->name('pos.paymenttype.index');
    Route::post('pos/paymenttype', 'PaymentTypeController@store')->name('pos.paymenttype.store');
    Route::delete('pos/paymenttype/drop', 'PaymentTypeController@destroy')->name('pos.paymenttype.delete');
    Route::get('pos/paymenttype/{paymenttype}', 'PaymentTypeController@edit')->name('pos.paymenttype.edit');
    Route::patch('pos/paymenttype', 'PaymentTypeController@update')->name('pos.paymenttype.update');




    //products
    Route::get('menu/images/{product}', 'ProductController@productImages');
    Route::delete('menu/images/{image}', 'ProductController@imageDelete');
    Route::get('menus', 'ProductController@index')->name('product.index');
    Route::get('menus/create', 'ProductController@create')->name('product.create');
    Route::post('menu', 'ProductController@store')->name('product.store');
    Route::get('menus/{product}', 'ProductController@edit')->name('product.edit');
    Route::patch('menu', 'ProductController@update')->name('product.update');
    Route::delete('menu', 'ProductController@destroy')->name('product.destroy');


    //order
    Route::get('orders/active', 'OrderController@active')->name('order.active');
    Route::get('orders/delivered', 'OrderController@delivered')->name('order.delivered');
    Route::get('orders/all', 'OrderController@all')->name('order.all');


    //kitchen
    Route::get('kitchen', 'KitchenController@index')->name('kitchen');
    Route::get('kitchen/getorders', 'KitchenController@getOrders')->name('kitchen.orders');
    Route::patch('kitchen/orderready/{order}', 'KitchenController@orderReady')->name('kitchen.ready');


    //pos
    Route::get('pos', 'KitchenController@pos')->name('pos');
    Route::post('pos/addtocart', 'KitchenController@addtocart')->name('pos.addtocart');
    Route::post('pos/downcart', 'KitchenController@downcart')->name('pos.downcart');
    Route::post('pos/removecart', 'KitchenController@removecart')->name('pos.removecart');

    Route::get('pos/getcart', 'KitchenController@getcart')->name('pos.getcart');








});

 