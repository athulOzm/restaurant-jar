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








//products
Route::get('product/images/{product}', 'ProductController@productImages');
Route::delete('product/images/{image}', 'ProductController@imageDelete');
Route::get('products', 'ProductController@index')->name('product.index');
Route::get('products/create', 'ProductController@create')->name('product.create');
Route::post('product', 'ProductController@store')->name('product.store');
Route::get('products/{product}', 'ProductController@edit')->name('product.edit');
Route::patch('product', 'ProductController@update')->name('product.update');
Route::delete('product', 'ProductController@destroy')->name('product.destroy');



//category 
Route::get('/categories', 'CategoryController@index')->name('category.index');
Route::post('/category', 'CategoryController@store')->name('category.store');
Route::delete('/category/drop', 'CategoryController@delete')->name('category.delete');
Route::get('category/{category}', 'CategoryController@edit')->name('category.edit');
Route::patch('category', 'CategoryController@update')->name('category.update');


//order
Route::get('orders/active', 'OrderController@active')->name('order.active');
Route::get('orders/delivered', 'OrderController@delivered')->name('order.delivered');
Route::get('orders/all', 'OrderController@all')->name('order.all');




});

 