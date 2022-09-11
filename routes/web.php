<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('frontEnd.home.homeContent');
});

// For Welcome Controller List
Route::get('/supplierInfo', 'WelcomeController@supplierInfo');
Route::get('/purchases', 'WelcomeController@purchases');

// For Customer Controller List
Route::get('/customerInfo/{id}', 'CustomerController@customerInfo');
Route::post('/customerInfo/create', 'CustomerController@createCustomerInfo');

// For Product Controller List
Route::get('/product/{id}', 'ProductController@product');
Route::post('/product/create', 'ProductController@createProduct');

// For Received Payment Controller List
Route::get('/receive-payments', 'ReceivedPaymentController@receivePayments');
Route::post('/customer-receive', 'ReceivedPaymentController@customerReceive');
Route::post('/duesByAjax', 'ReceivedPaymentController@duesById')->name('search.duesById');

// For Sales Budget Controller List
Route::get('/sales-budget', 'SalesBudgetController@salesBudget');
Route::post('/sales-budget/create', 'SalesBudgetController@createSalesBudget');
Route::post('/salesBudgetViewDataByAjax', 'SalesBudgetController@budgetByYear')->name('search.budgetByYear');

// For Sales Controller List
Route::get('/sales', 'SalesController@sales');
Route::post('/sales-record', 'SalesController@salesRecordInsert');
Route::get('/sales-table-analysis', 'SalesController@salesTableAnalysis');
Route::post('/salesTableAnalysisViewDataByAjax', 'SalesController@salesByYear')->name('search.salesByYear');
Route::post('/customerBillByAjax', 'SalesController@customerBillTo')->name('search.customerBillTo');
Route::post('/customerShipByAjax', 'SalesController@customerShipTo')->name('search.customerShipTo');
Route::post('/itemNameByAjax', 'SalesController@itemName')->name('search.itemName');
Route::post('/itemCodeByAjax', 'SalesController@itemCode')->name('search.itemCode');
Route::post('/othersByAjax', 'SalesController@others')->name('search.others');



