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
Route::controller('users', 'UsersController');
Route::controller('admin', 'AdminController');
Route::resource('transfer', 'TransferController');
Route::resource('payee', 'PayeeController');
Route::controller('account', 'AccountController');
Route::controller('card', 'CardController');
Route::get('account/create/id/{id}', 'AccountController@getCreate');
Route::get('card/create/id/{id}', 'CardController@getCreate');
