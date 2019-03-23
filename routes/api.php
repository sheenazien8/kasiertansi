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
});
