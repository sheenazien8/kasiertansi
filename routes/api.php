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
Route::post('register', 'API\UserController@register');

// Route::post('logout', 'API\UserController@logout')->name('logout');
Route::get('/api/activating/account', 'API\UserController@activatingAccount')->name('activating.account');
Route::group(['middleware' => ['auth:api', 'employee']], function () {
    Route::post('logout', 'API\UserController@logout');
    Route::put('user/update/{user}', 'API\UserController@update')->name('profile.update');
    Route::get('get/photo/{user}', 'API\UserController@getPhotoProfile')->name('profile.image');
    Route::get('get/data/dashboard', 'API\DashboardController@getDataDashboard')->name('get.data.dashboard');
    Route::post('get/data/income', 'API\DashboardController@getDataIncme')->name('get.data.income');
    Route::get('details', 'API\UserController@details')->name('details');
    Route::resource('category', 'API\CategoryController');
    Route::resource('subsidiary', 'API\SubsidiaryController');
    Route::get('get/subsidiary/{query}', 'API\SubsidiaryController@searchSubsdiary')->name('search.subsidiary');
    Route::resource('unit', 'API\UnitController');
    Route::put('item/{item}/update/stock', 'API\ItemController@updateStock')->name('item.update.stock');
    Route::resource('item', 'API\ItemController');
    Route::get('get/item/getItem', 'API\ItemController@getItem')->name('item.items');
    Route::post('import/item', 'API\ItemController@import')->name('item.import');
    Route::resource('employee', 'API\EmployeeController');
    Route::put('employee/update/{employee}/status', 'API\EmployeeController@updateStatus')->name('update.status.employee');
    Route::put('subsidiary/update/{subsidiary}/status', 'API\SubsidiaryController@updateStatus')->name('subsidiary.update.status');
    Route::resource('supplier', 'API\SupplierController');
    Route::get('get/supplier/{query}', 'API\SupplierController@searchSupplier')->name('supplier.search');
    Route::get('supplier/supplier/getSupplier', 'API\SupplierController@getSupplier')->name('supplier.supplier');
    Route::resource('purchase', 'API\PurchaseController');
    Route::resource('income', 'API\IncomeController');
    Route::post('income/get-income', 'API\IncomeController@getIncome')->name('get.income');
    Route::get('income/get-item/{transaction_id}', 'API\IncomeController@getItem')->name('get.item.by_transaction');
    // Route::get('/income/print/pdf/', 'API\IncomeController@printPdfIncome')->name('pdf.income');
    Route::resource('transaction', 'API\TransactionController');
    Route::get('get/invoice/number', 'API\TransactionController@getInvoiceCode')->name('get.invoice.number');
    Route::resource('role', 'API\ManagementPermissionController');
    Route::resource('shop', 'API\ShopController');
    Route::get('get/role/{role}', 'API\ManagementPermissionController@getUserWhereRole')->name('get.role');
    Route::get('get/role/{role}/name', 'API\ManagementPermissionController@getRoleName')->name('role.name');
    Route::get('get/employee', 'API\ManagementPermissionController@getEmployee')->name('get.employee');
    Route::get('get/permission', 'API\ManagementPermissionController@getPermission')->name('get.permission');
    Route::resource('transaction_detail', 'API\TransactionDetailController');
    Route::post('transaction_detail/session/storage', 'API\TransactionDetailController@sessionStorage')
            ->name('save.session.storage');
    Route::resource('spending', 'API\SpendingController');
    Route::get('spending/get/{purchase}/purchasing_detail/', 'API\SpendingController@getPurchasingDetails')
            ->name('get.purchasing_detail');
    Route::post('spending/get/spending', 'API\SpendingController@getSpending')
            ->name('spending.get-spending');
    Route::put('purchase/{purchase}/payout', 'API\PurchaseController@paidPurchasing')->name('paid_purchase');
    Route::group(['prefix' => '/purchase/{purchase}'], function () {
        Route::resource('purchasing_detail', 'API\PurchasingDetailController');
    });
    Route::group(['prefix' => '/item/{item}'], function () {
        Route::resource('price', 'API\PriceController');
        Route::get('get/price', 'API\PriceController@getPriceByItem')->name('get.price');
    });
    Route::post('/uploadfile/photo/', 'API\UploadFilecontroller@uploadPhotoProfile')->name('uploadfile.photo');
});
