<?php 

//web Admin
Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {

//products
Route::get('products', 'ProductController@index')->name('product.index');
Route::get('products/create', 'ProductController@create')->name('product.create');
Route::post('product', 'ProductController@store')->name('product.store');

Route::get('products/{product}', 'ProductController@edit')->name('product.edit');
Route::patch('product', 'ProductController@update')->name('product.update');

Route::get('products/{product}', 'ProductController@destroy');





});

