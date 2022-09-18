<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('frontEnd.home.homeContent')->middleware('auth');
//});

Route::get('/register', 'WelcomeController@reg')->middleware('auth');
Route::get('/registration', 'WelcomeController@reg2')->middleware('auth');

Route::get('/', 'WelcomeController@index')->middleware('auth');

// For Welcome Controller List
Route::get('/supplierInfo', 'WelcomeController@supplierInfo')->middleware('auth');
Route::get('/purchases', 'WelcomeController@purchases')->middleware('auth');

// For Customer Controller List
Route::get('/customerInfo/{id}', 'CustomerController@customerInfo')->middleware('auth');
Route::post('/customerInfo/create', 'CustomerController@createCustomerInfo')->middleware('auth');

// For Product Controller List
Route::get('/product/{id}', 'ProductController@product')->middleware('auth');
Route::post('/product/create', 'ProductController@createProduct')->middleware('auth');

// For Received Payment Controller List
Route::get('/receive-payments', 'ReceivedPaymentController@receivePayments')->middleware('auth');
Route::get('/payments-history/{id}', 'ReceivedPaymentController@paymentsHistory')->middleware('auth');
Route::post('/payment-history-view', 'ReceivedPaymentController@paymentHistoryView')->middleware('auth');
Route::post('/customer-receive', 'ReceivedPaymentController@customerReceive')->middleware('auth');
Route::post('/duesByAjax', 'ReceivedPaymentController@duesById')->name('search.duesById')->middleware('auth');

// For Sales Budget Controller List
Route::get('/sales-budget', 'SalesBudgetController@salesBudget')->middleware('auth');
Route::post('/sales-budget/create', 'SalesBudgetController@createSalesBudget')->middleware('auth');
Route::post('/salesBudgetViewDataByAjax', 'SalesBudgetController@budgetByYear')->name('search.budgetByYear')->middleware('auth');

// For Sales Controller List
Route::get('/sales', 'SalesController@sales')->middleware('auth');
Route::post('/sales-record', 'SalesController@salesRecordInsert')->middleware('auth');
Route::get('/sales-table-analysis', 'SalesController@salesTableAnalysis')->middleware('auth');
Route::post('/salesTableAnalysisViewDataByAjax', 'SalesController@salesByYear')->name('search.salesByYear')->middleware('auth');
Route::post('/customerBillByAjax', 'SalesController@customerBillTo')->name('search.customerBillTo')->middleware('auth');
Route::post('/customerShipByAjax', 'SalesController@customerShipTo')->name('search.customerShipTo')->middleware('auth');
Route::post('/itemNameByAjax', 'SalesController@itemName')->name('search.itemName')->middleware('auth');
Route::post('/itemCodeByAjax', 'SalesController@itemCode')->name('search.itemCode')->middleware('auth');
Route::post('/othersByAjax', 'SalesController@others')->name('search.others')->middleware('auth');

// For PDF Controller List
Route::get('/payment-report/{id}/{fDate}/{tDate}', 'PdfController@paymentReport')->middleware('auth');


Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
