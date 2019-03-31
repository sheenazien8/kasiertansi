<?php

use Illuminate\Http\Request;

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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register')->name('register');

// Route::post('logout', 'API\UserController@logout')->name('logout');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'API\UserController@details')->name('details');
    Route::resource('category', 'API\CategoryController');
    Route::resource('unit', 'API\UnitController');
    Route::put('item/{item}/update/stock', 'API\ItemController@updateStock')->name('item.update.stock');
    Route::resource('item', 'API\ItemController');
    Route::resource('employee', 'API\EmployeeController');
    Route::resource('supplier', 'API\SupplierController');
    Route::resource('purchase', 'API\PurchaseController');
    Route::put('purchase/{purchase}/payout', 'API\PurchaseController@paidPurchasing')->name('paid_purchase');
    Route::group(['prefix' => '/purchase/{purchase}'], function() {
        Route::resource('purchasing_detail', 'API\PurchasingDetailController');
    });
    Route::group(['prefix' => '/item/{item}'], function() {
        Route::resource('price', 'API\PriceController');
        Route::get('get/price', 'API\PriceController@getPriceByItem')->name('get.price');
    });
});
