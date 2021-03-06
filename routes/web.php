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



Auth::routes();

Route::group( ['middleware' => 'auth'], function()

{

 
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


//Requests
Route::get('requests','VoucherController@index');
Route::post('new-request','VoucherController@newRequest');
Route::get('voucher-print/{id}','VoucherController@voucherPrint');
Route::get('report-daily-reimbursement','VoucherController@reportDailyReimbursement');
Route::get('accounting-monitoring','VoucherController@accountingMonitoring');
Route::post('edit-request/{id}','VoucherController@editRequest');

// Route::get('for-verifications','RequestController@forVerifications');


}
);
