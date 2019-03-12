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

Route::namespace('Api')->name('api.')->group(function () {

    Route::get('routes', 'RouteController@index');
    Route::get('routes/{route}/info', 'RouteController@info');
    // get schedules
    Route::get('routes/{route}/getSchedules', 'RouteController@getSchedules');
    Route::get('routes/{route}/getStops', 'RouteController@getStops');
    Route::get('routes/{route}/getFare', 'RouteController@getFare');

    Route::post('ticket/store', 'TicketController@store');

});