<?php
Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');
