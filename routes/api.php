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


Route::post('users/register', 'APIRegisterController@register')->name('api.register');
Route::post('users/login', 'APILoginController@login')->name('api.login');

Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});
