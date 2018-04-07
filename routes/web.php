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
	\

	Route::group(['prefix' => 'store'], function () {

			Route::group(['prefix' => 'products'], function () {
				Route::get('/', 'StoreController@products');
				Route::get('/{productId}', 'ProductController@productForm');
				Route::post('/{productId}', 'ProductController@updateProduct');
				Route::put('/visible/{productId}', 'ProductController@toggleProductVisibility');
				Route::put('/copy/{product}', 'ProductController@copyProduct');
			});

		});
});

Route::get('/billing/process', 'InstallController@ProcessBilling')->name('billing.process');