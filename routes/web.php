<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group (function() {
Route::get('/home', 'HomeController@index')->name('home');

// adminuser
Route::get('/adminuser', 'UserController@index')->name('adminuser');
Route::post('createadmin', 'UserController@store')->name('createadmin');
Route::post('destroy/{id}', 'UserController@destroy')->name('destroy');
Route::post('update/{id}', 'UserController@update')->name('update');

// clients
Route::get('/clients', 'ClientController@index')->name('clients');
Route::post('createclient', 'ClientController@store')->name('createclient');
Route::get('viewclient/{id}', 'ClientController@show')->name('viewclient');
Route::get('addclient', 'ClientController@create')->name('addclient');
Route::post('updateclient/{id}', 'ClientController@update')->name('updateclient');
Route::get('editclient/{id}', 'ClientController@edit')->name('editclient');
Route::post('destroy/{id}', 'ClientController@destroy')->name('destroy');

// intenure
Route::get('/clientsintenure', 'InTenureController@index')->name('clientsintenure');
Route::get('viewclientintenure', 'InTenureController@show')->name('viewclientintenure');
Route::get('makepayment/{id}', 'InTenureController@makepayment')->name('makepayment');
Route::post('paynow/{id}', 'InTenureController@paynow')->name('paynow');

// loan
Route::get('/loan', 'LoanController@index')->name('loan');
Route::get('requestloan', 'LoanController@create')->name('requestloan');
Route::post('createloan', 'LoanController@store')->name('createloan');
Route::post('disburseloan', 'LoanController@disburse')->name('disburse.loan');
Route::get('editloan/{id}', 'LoanController@edit')->name('editloan');
Route::post('updateloan/{id}', 'LoanController@update')->name('updateloan');

// payment
Route::get('/payment', 'PaymentController@index')->name('payment');
Route::get('/payout', 'PaymentController@payout')->name('payout');
Route::get('viewclientintenure', 'InTenureController@show')->name('viewclientintenure');

// monthly
Route::get('/monthly', 'MonthlyController@index')->name('monthly');
});