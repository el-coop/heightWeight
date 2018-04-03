<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth.shop', 'billable']], function () {
	Route::get('/', 'StoreController@home')->name('home');
	Route::group(['prefix' => 'store'], function () {
		Route::get('/products', 'StoreController@products');
		Route::get('/products/{productId}', 'StoreController@productForm');
		Route::post('/products/{productId}', 'StoreController@updateProduct');
	});
});

Route::get('/billing/process', 'InstallController@ProcessBilling')->name('billing.process');