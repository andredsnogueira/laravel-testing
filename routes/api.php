<?php

use App\User;
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

Route::group(['prefix' => 'v1'], function () {
    Route::get('users', 'API\UserController@index');
    Route::get('users/{user}', 'API\UserController@show');
    Route::post('users', 'API\UserController@store');
    Route::put('users/{user}', 'API\UserController@update');
    Route::delete('users/{user}', 'API\UserController@destroy');
});
