<?php

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "front" middleware group. Now create something great!
|
*/

Route::name('front.')->middleware('web')->namespace('Front')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/routes', 'HomeController@genrateRoute');
	
	// Pages
	Route::get('/home', 'PagesController@home')->name('home');
	Route::get('/about', 'PagesController@about')->name('about');
	Route::get('/history', 'PagesController@history')->name('history');
	Route::get('/cities', 'PagesController@cities')->name('cities');
	Route::get('/gallary', 'PagesController@gallary')->name('gallary');
	Route::get('/contact', 'PagesController@contact')->name('contact');
	// Pages end

    // Ticket Booking
    Route::get('/schedules', 'BookingController@schedules')->name('schedules');
    Route::get('/bookticket/{schedule}', 'BookingController@bookticket')->name('bookticket');
    Route::resource('{schedule}/ticket', 'TicketController');
    Route::get('ticket/success', 'TicketController@success')->name('ticket.success');
    // Auth
    Route::get('user', 'UserController@index');
    Route::get('user/login', 'UserController@login')->name('login');
    Route::post('user/login', 'UserController@loginProcess')->name('login');
    Route::get('user/register', 'UserController@register')->name('register');
    Route::post('user/register', 'UserController@registerProcess')->name('register');
    Route::get('user/logout', 'UserController@logout')->name('logout');

    Route::name('user.')->middleware('auth')->group(function(){
        Route::get('user/dashboard', 'UserController@dashboard')->name('dashboard');
        Route::get('user/profile', 'UserController@profile')->name('profile');
        Route::post('user/profile', 'UserController@profileUpdate')->name('profileUpdate');
        Route::get('user/resetpass', 'UserController@resetpass')->name('resetpass');
        Route::post('user/resetpass', 'UserController@resetpassword')->name('resetpassword');
    });



    //ajax routes
    Route::post('/getarrivals', 'AjaxController@GetArriv')->name('getarriv');

    //end ajax



});