<?php
// Route::get('/pdf/print/income', 'IncomeController@printPdfIncome');
Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');
