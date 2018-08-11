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
			
			Route::group(['prefix' => 'products'], function () {
				Route::get('/', 'StoreController@products');
				Route::get('/{productId}', 'ProductController@productForm');
				Route::post('/contact', 'StoreController@contact');
				Route::post('/size-name', 'StoreController@updateSizeName');
				Route::post('/language', 'StoreController@updateLanguage');
				Route::post('/button', 'StoreController@updateButton');
				Route::post('/{productId}', 'ProductController@updateProduct');
				Route::put('/visible/{productId}', 'ProductController@toggleProductVisibility');
				Route::put('/copy/{product}', 'ProductController@copyProduct');
			});
			
		});
});

Route::get('/billing/process', 'InstallController@ProcessBilling')->name('billing.process');

Route::group(['prefix' => 'client'], function () {
	Route::get('/check/{productId}', 'ClientSideController@checkProduct');
	
	Route::get('/{product}', 'ClientSideController@product');
});