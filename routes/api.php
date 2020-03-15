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

Route::get('master/categories', [
    'uses' => 'Api\Master\CategoryController@data'
]);

Route::post('sys/user/login', [
    'uses' => 'Api\Sys\UserController@login'
]);

Route::post('sys/user/registration', [
    'uses' => 'Api\Sys\UserController@registration'
]);

Route::get('sys/user/data', [
    'uses' => 'Api\Sys\UserController@data'
]);

Route::post('sys/user/update', [
    'uses' => 'Api\Sys\UserController@update'
]);



Route::get('trx/ticket/data', [
    'uses' => 'Api\Trx\TicketController@data'
]);

Route::post('trx/ticket/save', [
    'uses' => 'Api\Trx\TicketController@save'
]);

Route::post('trx/ticket/status/change', [
    'uses' => 'Api\Trx\TicketController@status_change'
]);
