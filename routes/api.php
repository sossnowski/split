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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('bill', 'BillsController@create');
Route::get('bills', 'BillsController@getBills');
Route::get('bill/{id}', 'BillsController@getBill');
Route::put('bill/{id}', 'BillsController@upadateBill');
