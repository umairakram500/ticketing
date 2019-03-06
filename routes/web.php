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

//Route::get('/', 'LoginController@index');
// Route::name('admin.')->domain('booking.newkhan.pk')->namespace('Admin')->group(function () {
    // Route::get('/', 'LoginController@index');

Route::name('admin.')->prefix('admin')->namespace('Admin')->group(function () {

    Route::name('login.')->group(function () {

        Route::get('login', 'LoginController@index')->name('form');
        Route::post('login', 'LoginController@auth')->name('process');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Auth
        Route::middleware('auth')->group(function () {
            Route::view('changePassword', 'admin.auth.changePassword')->name('changePass.form');
            Route::post('changePassword', 'LoginController@changePassword')->name('changePass.save');
        });
        // Auth end
    });

    Route::resource('users', 'UserController');

    Route::middleware('auth')->group(function () {

        Route::view('dashboard', 'admin.home')->name('dashboard');
        Route::view('profile', 'admin.profile.show')->name('profile');
        Route::view('editprofile', 'admin.profile.edit')->name('profile.edit');
        Route::post('editprofile', 'ProfileController@update')->name('profile.update');

        // Destinations
        Route::post('city/{city}/status', 'CityController@status')->name('city.status');
        Route::resource('city', 'CityController');

        // Route
        Route::namespace('Route')->group(function () {
            Route::get('fares', 'FareController@index')->name('fares.index');
            Route::get('fares/{route}/edit', 'FareController@edit')->name('fares.edit');
            Route::post('fares/{route}/update', 'FareController@update')->name('fares.update');
            Route::name('route.')->group(function () {
                Route::resource('route/{route}/stopover', 'StopoverController');
                Route::post('route/{route}/status', 'RouteController@status')->name('status');
            });
            Route::get('route/getStops/{route?}', 'RouteController@getStops')->name('route.getStops');
            Route::resource('route', 'RouteController');
        });



        // Route
        Route::post('terminal/{terminal}/status', 'TerminalController@status')->name('terminal.status');
        Route::resource('terminal', 'TerminalController');

        // Buses
        Route::namespace('Bus')->group(function () {
            Route::name('bus.')->group(function () {
                Route::post('bus/luxurytype/{luxurytype}/status', 'LuxuryTypeController@status')->name('luxurytype.status');
                Route::resource('bus/luxurytype', 'LuxuryTypeController');
                Route::post('bus/{bus}/status', 'BusController@status')->name('status');
            });
            Route::resource('bus', 'BusController');
        });

        // Staff
        Route::namespace('Staff')->group(function () {
            Route::name('staff.')->prefix('staff')->group(function () {
                Route::post('{staff}/status', 'StaffController@status')->name('status');
                Route::post('stafftype/{stafftype}/status', 'StaffTypeController@status')->name('stafftype.status');
                Route::resource('stafftype', 'StaffTypeController');
            });
            Route::resource('staff', 'StaffController');
        });



        // Schedule
        //Route::get('schedule', 'ScheduleController@index')->name('schedules');
        Route::get('schedule/routes', 'ScheduleController@routes')->name('schedule.routes');
        Route::get('schedule/routes/{route}/buses', 'ScheduleController@routeBuses')->name('schedule.route.buses');
        Route::get('schedule/buses', 'ScheduleController@buses')->name('schedule.buses');
        Route::get('schedule/bus/{bus}/create', 'ScheduleController@create')->name('schedule.create');
        Route::post('schedule/bus/{bus}/create', 'ScheduleController@store')->name('schedule.store');
        Route::post('schedule/{schedule}/status', 'ScheduleController@status')->name('schedule.status');
        Route::post('schedule/{departure}/departure', 'ScheduleController@departure')->name('schedule.departure');
        Route::post('schedule/{arrive}/arrive', 'ScheduleController@arrive')->name('schedule.arrive');
        Route::get('schedule/{schedule}/bookTicket', 'ScheduleController@bookTicket')->name('schedule.bookTicket');

        /*-- Schedule new --*/
        Route::get('schedules/getStops/{route?}', 'ScheduleController@getStops')->name('schedules.getStops');
        Route::resource('schedules', 'ScheduleController');

        // get route fare on the base of selected route
        Route::get('schedule/getRouteFare/{luxury}/{route}', 'ScheduleController@getRouteFare')->name('schedule.getFare');

        // pending vouchers list
        Route::get('schedule/vouchers', 'ScheduleController@voucherList')->name('schedule.vouchers');
        // voucher add rows, expenses
        Route::get('schedule/{schedule}/voucher', 'ScheduleController@voucher')->name('schedule.voucher');
        // voucher number save
        Route::post('schedule/{schedule}/saveVoucherNo', 'ScheduleController@saveVoucherNumber')->name('schedule.saveVoucherNo');
        // save Voucher row
        Route::post('schedule/{schedule}/saveVoucherRow', 'ScheduleController@saveVoucherRow')->name('schedule.saveVoucherRow');
        // close voucher
        Route::post('schedule/{schedule}/close', 'ScheduleController@close')->name('schedule.close');

        Route::resource('schedule', 'ScheduleController')->except([
            'index', 'create', 'store'
        ]);

        /*-- Ticket --*/
        //Route::post('ticket/{ticket}/paid', 'TicketController@paid')->name('ticket.paid');
        //Route::resource('{schedule}/ticket', 'TicketController');
        Route::post('ticket/getInfo/{ticket?}', 'TicketController@cancel')->name('ticket.cancel');
        Route::get('ticket/cancelAll', 'TicketController@cancelAll')->name('ticket.cancelAll');
        Route::get('ticket/getSchedules', 'TicketController@getSchedules')->name('ticket.getSchedules');
        Route::get('ticket/getBusSeats', 'TicketController@getBusSeats')->name('ticket.getBusSeats');
        Route::get('ticket/booking', 'TicketController@booking')->name('ticket.booking');
        Route::get('ticket/ticketing', 'TicketController@ticketing')->name('ticket.ticketing');
        Route::get('ticket/booklist/{schedule?}/{bookingdate?}', 'TicketController@booklist')->name('ticket.booklist');
        Route::get('ticket/issuelist/{schedule?}/{bookingdate?}', 'TicketController@issuelist')->name('ticket.issuelist');
        Route::get('ticket/issueByID/{id?}', 'TicketController@issueByID')->name('ticket.issueByID');
        Route::resource('ticket', 'TicketController');


        //Expense Type
        Route::post('expense_type/{expense_type}/status', 'ExpenseTypeController@status')->name('expense_type.status');
        Route::resource('expense_type', 'ExpenseTypeController');

        // Expense
        Route::resource('schedule/{schedule}/expense', 'ExpenseController');

        // Reports
        Route::get('reports/{schedule}/schedules', 'ReportController@schedules')->name('reports.schedules');

        // Cargo
        Route::namespace('Cargo')->group(function () {


            Route::name('cargo.')->prefix('cargo')->group(function () {
                // Cargo Category
                Route::post('category/{category}/status', 'CategoryController@status')->name('category.status');
                Route::resource('category', 'CategoryController');
                // Cargo Shipment Status
                Route::post('shipment/{shipment}/status', 'ShipmentStatusController@status')->name('shipment.status');
                Route::resource('shipment', 'ShipmentStatusController');
                // Cargo Packing Types
                Route::post('packing/{packing}/status', 'PackingController@status')->name('packing.status');
                Route::resource('packing', 'PackingController');
                // Cargo Goods Types
                Route::post('goodstype/{goodsType}/status', 'GoodsTypeController@status')->name('goodstype.status');
                Route::resource('goodstype', 'GoodsTypeController');
            });
            Route::resource('cargo', 'CargoController');
        });

        // Roles & Permissions
        Route::resource('roles', 'RoleController');

        // Customer
        Route::get('getCustomerInfo/{cnic}', 'CustomerController@getCustomerInfo')->name('getCustomerInfo');

        // Designation
        Route::post('designation/{designation}/status', 'DesignationController@status')->name('designation.status');
        Route::resource('designation', 'DesignationController');

        // Department
        Route::post('department/{department}/status', 'DepartmentController@status')->name('department.status');
        Route::resource('department', 'DepartmentController');

        // Boarding
        Route::resource('boarding', 'BoardingController');

        // New UI
        Route::get('ui/route', 'UiController@route');
        Route::get('ui/schedule', 'UiController@schedule');
        Route::get('ui/fares', 'UiController@fares');
        Route::get('ui/show', 'UiController@show');
        Route::view('boarding', 'admin.board.fieldsdummy');
        Route::view('route_exp', 'admin.board.route_exp');

        // Boarding
        Route::get('departure/getInfo/{id?}', 'BoardingController@getInfo')->name('departure.getInfo');
        Route::resource('departure', 'BoardingController');

        // Voucher
        Route::resource('voucher', 'VoucherController');

        // Cashier
        Route::get('cashier/closing/voucher/create', 'CashierController@create')->name('cashier.close.voucher');
        Route::get('cashier/closing/voucher/print', 'CashierController@show')->name('cashier.close.print');
    });


});



Route::get('login', 'Admin\LoginController@index')->name('login');








