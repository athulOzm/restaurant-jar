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
    Route::get('/members/ledger', 'UserController@ledger')->name('member.ledger');

    //waiter
    Route::get('/waiters', 'UserController@waiterindex')->name('waiter.index');
    Route::post('/waiter', 'UserController@waiterstoreWeb')->name('waiter.store');
    Route::delete('/waiter/drop', 'UserController@waiterdestroy')->name('waiter.delete');
    Route::get('waiter/edit/{user}', 'UserController@waiteredit')->name('waiter.edit');
    Route::patch('waiter', 'UserController@waiterupdateweb')->name('waiter.update');
    Route::get('waiter/create', 'UserController@waitercreate')->name('waiter.create');

    //user
    Route::get('/users', 'UserController@userindex')->name('user.index');
    Route::post('/user', 'UserController@userstoreWeb')->name('user.store');
    Route::delete('/user/drop', 'UserController@userdestroy')->name('user.delete');
    Route::get('user/edit/{user}', 'UserController@useredit')->name('user.edit');
    Route::patch('user', 'UserController@userupdateweb')->name('user.update');
    Route::get('user/create', 'UserController@usercreate')->name('user.create');


    //ranks
    Route::get('member/ranks', 'RankController@index')->name('member.rank.index');
    Route::post('member/rank', 'RankController@store')->name('member.rank.store');
    Route::delete('member/rank/drop', 'RankController@destroy')->name('member.rank.delete');
    Route::get('member/rank/{rank}', 'RankController@edit')->name('member.rank.edit');
    Route::patch('member/rank', 'RankController@update')->name('member.rank.update');

    //member category
    Route::get('member/categories', 'MemberCategoryController@index')->name('member.category.index');
    Route::post('member/category', 'MemberCategoryController@store')->name('member.category.store');
    Route::delete('member/category/drop', 'MemberCategoryController@destroy')->name('member.category.delete');
    Route::get('member/category/{category}', 'MemberCategoryController@edit')->name('member.category.edit');
    Route::patch('member/category', 'MemberCategoryController@update')->name('member.category.update');

  

    //payment type
    Route::get('pos/paymenttypes', 'PaymentTypeController@index')->name('pos.paymenttype.index');
    Route::post('pos/paymenttype', 'PaymentTypeController@store')->name('pos.paymenttype.store');
    Route::delete('pos/paymenttype/drop', 'PaymentTypeController@destroy')->name('pos.paymenttype.delete');
    Route::get('pos/paymenttype/{paymenttype}', 'PaymentTypeController@edit')->name('pos.paymenttype.edit');
    Route::patch('pos/paymenttype', 'PaymentTypeController@update')->name('pos.paymenttype.update');

    //table
    Route::get('pos/tables', 'TableController@index')->name('pos.table.index');
    Route::post('pos/table', 'TableController@store')->name('pos.table.store');
    Route::delete('pos/table/drop', 'TableController@destroy')->name('pos.table.delete');
    Route::get('pos/table/{table}', 'TableController@edit')->name('pos.table.edit');
    Route::patch('pos/table', 'TableController@update')->name('pos.table.update');


    //delivery locations
    Route::get('pos/deliverylocations', 'DeliverylocationController@index')->name('pos.deliverylocation.index');
    Route::post('pos/deliverylocation', 'DeliverylocationController@store')->name('pos.deliverylocation.store');
    Route::delete('pos/deliverylocation/drop', 'DeliverylocationController@destroy')->name('pos.deliverylocation.delete');
    Route::get('pos/deliverylocation/{deliverylocation}', 'DeliverylocationController@edit')->name('pos.deliverylocation.edit');
    Route::patch('pos/deliverylocation', 'DeliverylocationController@update')->name('pos.deliverylocation.update');




    //products
    Route::get('menu/images/{product}', 'ProductController@productImages');
    Route::delete('menu/images/{image}', 'ProductController@imageDelete');
    Route::get('menus', 'ProductController@index')->name('product.index');
    Route::get('menus/create', 'ProductController@create')->name('product.create');
    Route::post('menu', 'ProductController@store')->name('product.store');
    Route::get('menus/{product}', 'ProductController@edit')->name('product.edit');
    Route::patch('menu', 'ProductController@update')->name('product.update');
    Route::delete('menu', 'ProductController@destroy')->name('product.destroy');

    //addon
    Route::get('addons', 'AddonController@index')->name('addon.index');
    Route::post('addon', 'AddonController@store')->name('addon.store');
    Route::delete('addon/drop', 'AddonController@destroy')->name('addon.delete');
    Route::get('addon/{addon}', 'AddonController@edit')->name('addon.edit');
    Route::patch('addon', 'AddonController@update')->name('addon.update');


    //order
    Route::get('orders/active', 'OrderController@active')->name('order.active');
    Route::get('orders/delivered', 'OrderController@delivered')->name('order.delivered');
    Route::get('orders/all', 'OrderController@all')->name('order.all');
    Route::delete('order', 'OrderController@destroy')->name('order.destroy');



    //kitchen
    Route::get('kitchen', 'KitchenController@index')->name('kitchen');
    Route::get('kitchen/getorders', 'KitchenController@getOrders')->name('kitchen.orders');
    Route::patch('kitchen/orderready/{order}', 'KitchenController@orderReady')->name('kitchen.ready');


    //pos
    Route::get('pos', 'PosController@pos')->name('pos');
    Route::post('pos/addtocart', 'PosController@addtocart')->name('pos.addtocart');
    Route::post('pos/downcart', 'PosController@downcart')->name('pos.downcart');
    Route::post('pos/removecart', 'PosController@removecart')->name('pos.removecart');
    Route::post('pos/adddiscount', 'PosController@discount')->name('pos.discount');
    Route::get('pos/totalprice', 'PosController@totalprice');
    Route::get('pos/getcart', 'PosController@getcart')->name('pos.getcart');
    Route::get('pos/getmembers', 'PosController@getmembers')->name('pos.getmembers');
    Route::get('/pos/{memberid}/getpaymenttype', 'PosController@getpaymenttypes');
    Route::get('/pos/gettables', 'PosController@gettables');
    Route::get('/pos/locations', 'PosController@getlocations');
    Route::post('/pos/checkout', 'PosController@checkout')->name('pos.checkout');
    Route::post('/pos/creditstatus', 'PosController@memberstatus');
    Route::get('/pos/creditstatus2/{user}', 'PosController@memberstatus2');
    Route::get('pos/getmenus', 'PosController@getmenus');
    

    Route::get('setting/vat', 'SettingController@vat')->name('settings.vat');
    Route::patch('setting/vat', 'SettingController@vatupdate')->name('vat.update');

    Route::post('pos/cancel', 'PosController@cancel');
    Route::get('pos/getsettlement', 'PosController@getsettlement');
    Route::post('pos/donesettlement', 'PosController@donesettlement');






    //addon 
    Route::post('pos/addtocartaddon', 'PosController@addtocartaddon');
    Route::get('pos/getaddon/{id}', 'PosController@getaddon');
    Route::get('pos/getaddonava/{product}', 'PosController@getaddonava');
    Route::post('pos/downcartaddon', 'PosController@downcartaddon');
    Route::post('pos/removecartaddon', 'PosController@removecartaddon');



    //report
    Route::get('/report/sale', 'ReportController@sale')->name('report.sale');











});

 