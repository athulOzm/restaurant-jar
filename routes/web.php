<?php 

//web Admin
Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index')->name('home');
//Route::get('/home', );


Route::middleware(['auth'])->group(function () {

//products
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


});

