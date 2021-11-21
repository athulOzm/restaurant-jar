<?php 

//web Admin
Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index')->name('home');
//Route::get('/home', );


Route::middleware(['auth:admin'])->group(function () {

    //branches
    Route::get('/branches', 'BranchController@index')->name('branch.index');
    Route::post('/branch', 'BranchController@store')->name('branch.store');
    Route::delete('/branch/drop', 'BranchController@delete')->name('branch.delete');
    Route::get('branch/{branch}', 'BranchController@edit')->name('branch.edit');
    Route::patch('branch', 'BranchController@update')->name('branch.update');
    Route::get('getsubbranch/{branch}', 'BranchController@getSubbranch');


    //suppliers
    Route::get('/suppliers', 'SupplierController@index')->name('supplier.index');
    Route::post('/supplier', 'SupplierController@store')->name('supplier.store');
    Route::delete('/supplier/drop', 'SupplierController@delete')->name('supplier.delete');
    Route::get('supplier/{supplier}', 'SupplierController@edit')->name('supplier.edit');
    Route::patch('supplier', 'SupplierController@update')->name('supplier.update');



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

    //categoryproduct
    Route::get('/pcategories', 'PcategoryController@index')->name('pcategory.index');
    Route::post('/pcategory', 'PcategoryController@store')->name('pcategory.store');
    Route::delete('/pcategory/drop', 'PcategoryController@delete')->name('pcategory.delete');
    Route::get('pcategory/{pcategory}', 'PcategoryController@edit')->name('pcategory.edit');
    Route::patch('pcategory', 'PcategoryController@update')->name('pcategory.update');
    Route::get('pgetsubcategory/{pcategory}', 'PcategoryController@getSubCategory');

    //material
    Route::get('material/images/{material}', 'MaterialController@productImages');
    Route::delete('material/images/{image}', 'MaterialController@imageDelete');
    Route::get('material', 'MaterialController@index')->name('material.index');
    Route::get('material/create', 'MaterialController@create')->name('material.create');
    Route::post('material', 'MaterialController@store')->name('material.store');
    Route::get('material/{material}', 'MaterialController@edit')->name('material.edit');
    Route::patch('material/{material}', 'MaterialController@update')->name('material.update');
    Route::delete('material', 'MaterialController@destroy')->name('material.destroy');

    

    //members
    Route::get('/members', 'UserController@index')->name('member.index');
    Route::post('/member', 'UserController@storeWeb')->name('member.store');
    Route::delete('/member/drop', 'UserController@destroy')->name('member.delete');
    Route::get('member/edit/{user}', 'UserController@edit')->name('member.edit');
    Route::patch('member', 'UserController@updateweb')->name('member.update');
    Route::get('member/create', 'UserController@create')->name('member.create');
    Route::get('/members/ledger', 'UserController@ledger')->name('member.ledger');
    Route::patch('member/renewnow', 'MemberRenewalController@renewnow')->name('member.renew');
    Route::get('/member/renewals', 'MemberRenewalController@index')->name('member.renewals');
    Route::get('/member/downloadid/{user}', 'MemberRenewalController@downloadId')->name('member.download.id');



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
    Route::post('member/debit', 'UserController@memberDebit')->name('member.debit');
    Route::get('user/create', 'UserController@usercreate')->name('user.create');
    Route::post('admin/cashregister', 'UserController@cashregister')->name('user.cashregister');



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

    //unit
    Route::get('pos/units', 'UnitController@index')->name('pos.unit.index');
    Route::post('pos/unit', 'UnitController@store')->name('pos.unit.store');
    Route::delete('pos/unit/drop', 'UnitController@destroy')->name('pos.unit.delete');
    Route::get('pos/unit/{unit}', 'UnitController@edit')->name('pos.unit.edit');
    Route::patch('pos/unit', 'UnitController@update')->name('pos.unit.update');


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


    //stock
    Route::get('stock/menu', 'ProductController@indexStock')->name('product.index.stock');
    Route::get('stock/menu/create/{product}', 'ProductController@createStock')->name('stock.menu.create');
    Route::post('stock/menu/store', 'ProductController@storeStock')->name('stock.menu.store');
    Route::get('stock/menu/update/{product}', 'ProductController@updateStock')->name('stock.menu.update');
    Route::get('stock/menu/log/{product}', 'ProductController@logStock')->name('stock.menu.log');
    Route::patch('stock/menu/update', 'ProductController@updateStoreStock')->name('stock.menu.patch');



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
    //Route::delete('pos/orderdel', 'OrderController@destroy2')->name('order.destroy2');

    Route::get('orders/history', 'OrderController@history')->name('order.history');
    Route::get('orders/list', 'OrderController@list')->name('order.list');




    //kitchen
    Route::get('kitchen', 'KitchenController@index')->name('kitchen');
    Route::get('kitchen/getorders', 'KitchenController@getOrders')->name('kitchen.orders');
    Route::patch('kitchen/orderready/{order}', 'KitchenController@orderReady')->name('kitchen.ready');


    //pos pos/
    Route::get('pos', 'PosController@pos')->name('pos');
    Route::post('pos/addtocart', 'PosController@addtocart')->name('pos.addtocart');
    Route::post('pos/addtocartvariant', 'PosController@addtocartvariant')->name('pos.addtocartvariant');
    Route::post('pos/addtocartbybarcode', 'PosController@addtocartByBarcode');
    Route::post('pos/addtocartbyreceipt', 'PosController@addtocartByReceipt');
    Route::post('pos/downcart', 'PosController@downcart')->name('pos.downcart');
    Route::post('pos/updqty', 'PosController@updqty');
    Route::post('pos/removecart', 'PosController@removecart')->name('pos.removecart');
    Route::post('pos/adddiscount', 'PosController@discount')->name('pos.discount');
    Route::post('pos/addpromo', 'PosController@ordpromo');
    Route::post('pos/addcontainer', 'PosController@container')->name('pos.container');
    Route::get('pos/totalprice', 'PosController@totalprice');
    Route::get('pos/getcart', 'PosController@getcart')->name('pos.getcart');
    Route::get('pos/getmembers', 'PosController@getmembers')->name('pos.getmembers');
    Route::get('/pos/{memberid}/getpaymenttype', 'PosController@getpaymenttypes');
    Route::get('/pos/gettables', 'PosController@gettables');
    Route::get('/pos/locations', 'PosController@getlocations');
    Route::post('/pos/checkout', 'PosController@checkout')->name('pos.checkout');
    Route::post('/pos/checkoutrefund', 'PosController@checkoutrefund')->name('pos.checkoutrefund');
    Route::post('/pos/creditstatus', 'PosController@memberstatus');
    Route::get('/pos/creditstatus2/{user}', 'PosController@memberstatus2');
    Route::get('pos/getmenus', 'PosController@getmenus');
    Route::get('pos/print/{coupon}', 'PosController@getprint')->name('pos.print');
    Route::get('pos/print2/{coupon}', 'PosController@getprint2')->name('pos.print2');
    Route::get('pos/printorder/{coupon}', 'PosController@getprintorder')->name('pos.print.order');
    Route::get('pos/printa4/{coupon}', 'PosController@getprintA4')->name('pos.print.a4');
    Route::get('pos/update/{order}', 'PosController@update')->name('pos.update');
    Route::get('pos/view/{coupon}', 'PosController@getview')->name('pos.view');
    Route::get('pos/clone/{order}', 'PosController@clone')->name('pos.clone');
    Route::get('pos/refundprint/{coupon}', 'PosController@getprintrefund')->name('pos.refundprint');
    Route::patch('/pos/order/pay', 'PosController@ordPay')->name('pos.order.pay');


    //branch
    Route::post('/switchbranch', 'UserController@switchBranch');


    //get member
    Route::get('get/members/{user}', 'PosController@getmember')->name('get.member');




    

    Route::get('setting/vat', 'SettingController@vat')->name('settings.vat');
    Route::patch('setting/vat', 'SettingController@vatupdate')->name('vat.update');
    Route::post('pos/cancel', 'PosController@cancel');
    Route::get('pos/getsettlement', 'PosController@getsettlement');
    Route::post('pos/donesettlement', 'PosController@donesettlement');

    //sales return - refund
    Route::post('pos/gettoken', 'RefundController@getToken')->name('pos.refund.gettoken');
    Route::get('pos/refund/{order}', 'RefundController@refund')->name('pos.refund');



    //addon 
    Route::post('pos/addtocartaddon', 'PosController@addtocartaddon');
    Route::get('pos/getaddon/{id}', 'PosController@getaddon');
    Route::get('pos/getaddonava/{product}', 'PosController@getaddonava');
    Route::post('pos/downcartaddon', 'PosController@downcartaddon');
    Route::post('pos/removecartaddon', 'PosController@removecartaddon');



    //sale report
    Route::get('/report/sale', 'ReportController@sale')->name('report.sale');
    Route::get('/report/salef', 'ReportController@salef')->name('report.salef');
    Route::get('/report/sales', 'ReportController@sales')->name('report.sales');
    Route::get('/report/sale/member', 'ReportController@saleMem')->name('report.salemem');
    Route::get('/report/sale/user', 'ReportController@saleUser')->name('report.saleuser');
    Route::post('/report/sale/search', 'ReportController@saleSearch')->name('report.sale.search');

    //fastmoving
    Route::get('/report/fastmoving', 'ReportController@fastmoving')->name('report.fastmoving');
    Route::post('/report/fastmoving/search', 'ReportController@fastMovingSearch')->name('report.fastmoving.search');

    //sloemoving 
    Route::get('/report/slowmoving', 'ReportController@slowmoving')->name('report.slowmoving');
    Route::post('/report/slowmoving/search', 'ReportController@slowMovingSearch')->name('report.slowmoving.search');

    //settlement report
    Route::get('/report/settlement', 'ReportController@settlement')->name('report.settlement');
    Route::post('/report/settlement/search', 'ReportController@settlementSearch')->name('report.settlement.search');
    

    //member report status
    Route::get('/report/members', 'ReportController@member')->name('report.member');
    Route::get('/members/balance', 'ReportController@memberbalance')->name('report.members.balance');
    Route::get('/member/pay/{user}', 'MemberRenewalController@pay')->name('member.pay');
    Route::patch('member/pay', 'MemberRenewalController@payStore')->name('member.pay.store');
    Route::post('/report/member/search', 'ReportController@memberSearch')->name('report.member.search');




    //promotions
    Route::get('promotions', 'PromotionController@index')->name('promotion.index');
    Route::post('promotion', 'PromotionController@store')->name('promotion.store');
    Route::delete('promotion/drop', 'PromotionController@destroy')->name('promotion.delete');
    Route::get('promotion/{promotion}', 'PromotionController@edit')->name('promotion.edit');
    Route::patch('promotion', 'PromotionController@update')->name('promotion.update');


    //barcode
    Route::get('barcode/menu', 'BarcodeController@index')->name('menu.barcode.index');
    Route::post('barcode/menu', 'BarcodeController@code')->name('barcode.menu.generate');


});














//waiter dash board area
Route::get('waiter/login', 'WaiterController@login')->name('waiter.login');
Route::post('waiter/login', 'Auth\LoginController@waiterlogin')->name('waiter.login.create');

Route::middleware(['auth:waiter'])->group(function () {


    Route::get('waiter', 'WaiterController@index')->name('waiter');


    //pos
 
    Route::post('waiter/pos/addtocart', 'PosController@addtocart')->name('waiter.pos.addtocart');
    Route::post('waiter/pos/addtocartvariant', 'PosController@addtocartvariant')->name('waiter.pos.addtocartvariant');
    Route::post('waiter/pos/addtocartbybarcode', 'PosController@addtocartByBarcode');
    Route::post('waiter/pos/addtocartbyreceipt', 'PosController@addtocartByReceipt');
    Route::post('waiter/pos/downcart', 'PosController@downcart')->name('waiter.pos.downcart');
    Route::post('waiter/pos/updqty', 'PosController@updqty');
    Route::post('waiter/pos/removecart', 'PosController@removecart')->name('waiter.pos.removecart');
    Route::post('waiter/pos/adddiscount', 'PosController@discount')->name('waiter.pos.discount');
    Route::post('waiter/pos/addpromo', 'PosController@ordpromo');
    Route::post('waiter/pos/addcontainer', 'PosController@container')->name('waiter.pos.container');
    Route::get('waiter/pos/totalprice', 'PosController@totalprice');
    Route::get('waiter/pos/getcart', 'PosController@getcart')->name('waiter.pos.getcart');
    Route::get('waiter/pos/getmembers', 'PosController@getmembers')->name('waiter.pos.getmembers');
    Route::get('waiter/pos/{memberid}/getpaymenttype', 'PosController@getpaymenttypes');
    Route::get('waiter/pos/gettables', 'PosController@gettables');
    Route::get('waiter/pos/locations', 'PosController@getlocations');
    Route::post('waiter/pos/checkout', 'PosController@checkout')->name('pos.checkout.waiter');
    Route::post('waiter/pos/checkoutrefund', 'PosController@checkoutrefund')->name('waiter.pos.checkoutrefund');
    Route::post('waiter/pos/creditstatus', 'PosController@memberstatus');
    Route::get('waiter/pos/creditstatus2/{user}', 'PosController@memberstatus2');
    Route::get('waiter/pos/getmenus', 'PosController@getmenus');
    Route::get('waiter/pos/print/{coupon}', 'PosController@getprint')->name('waiter.pos.print');
    Route::get('waiter/pos/print2/{coupon}', 'PosController@getprint2')->name('waiter.pos.print2');
    Route::get('waiter/pos/printorder/{coupon}', 'PosController@getprintorder')->name('waiter.pos.print.order');
    Route::get('waiter/pos/printa4/{coupon}', 'PosController@getprintA4')->name('waiter.pos.print.a4');
   
    
     


    //logout
    Route::get('waiter/logout', 'WaiterController@logout');

});


 