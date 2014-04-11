<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@home');
Route::get('/atm', 'CardController@getAtm');
Route::get('/pos', 'CardController@getPos');
Route::controller('users', 'UsersController');
Route::controller('admin', 'AdminController');
Route::resource('transfer', 'TransferController');
Route::resource('payee', 'PayeeController');
Route::resource('investment', 'InvestmentController');
Route::controller('account', 'AccountController');
Route::controller('card', 'CardController');
Route::resource('billing-accounts', 'BillingAccountController');

//Dynamic Route
Route::get('account/create/id/{id}', 'AccountController@getCreate');
Route::get('card/create/id/{id}', 'CardController@getCreate');
Route::get('account/index/id/{id}', 'AccountController@getIndex');
Route::controller('payment', 'PaymentController');
Route::get('payment/', 'PaymentController@index');
Route::get('admin/userdetails/id/{id}', 'AdminController@getDetails');
Route::get('account/withdraw/id/{id}', 'AccountController@getWithdraw');
Route::get('account/deposit/id/{id}', 'AccountController@getDeposit');
Route::get('account/approve/id/{id}', 'AccountController@getApprove');



