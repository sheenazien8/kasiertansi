<?php
// Auth::routes();
// Route::get('/', function () {
//     return redirect()->route('register');
// });
// Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
// Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
// Route::group(['middleware' => 'auth'], function () {
    // Route::get('/{any}', 'DashboardController@index')->where('any', '.*');
// });

Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');
