<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\BillController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\BusesController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteDriverCarController;
use App\Http\Controllers\TestController;

use App\Http\Controllers\CarriageController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckLogoutMiddleware;
use App\Http\Middleware\CheckStaffMiddleware;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::group([
    'middleware' => CheckLogoutMiddleware::class,
], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('forgot_password');
    Route::get('/reset_password/{token}', [AuthController::class, 'resetPassword'])->name('reset_password');
});

Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/index', [UserController::class, 'index'])->name('index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'show'])->name('profile');
    Route::post('/update/{user}', [UserController::class, 'updateProfile'])->name('update_profile');
    Route::post('/change_password', [UserController::class, 'changePassword'])->name('change_password');
});

Route::post('forgot_password', [AuthController::class, 'processForgotPassword'])->name('process_forgot_password');
Route::post('reset_password', [AuthController::class, 'processResetPassword'])->name('process_reset_password');

Route::group([
    'as' => 'users.',
    'prefix' => 'users',
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::get('/', [UserController::class, 'show_users'])->name('show_users');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::post('/update/{user}', [UserController::class, 'update'])->name('update');

    //    api
    Route::get('/api', [UserController::class, 'api'])->name('api');
    Route::get('/apiNameUsers', [UserController::class, 'apiNameUsers'])->name('api.name_users');
    Route::get('/apiNameDrivers', [UserController::class, 'apiNameDrivers'])->name('api.name_drivers');
    Route::get('/apiProvinces', [UserController::class, 'apiProvinces'])->name('api.provinces');
    Route::get('/apiGetDriverByCar', [UserController::class, 'apiGetDriverByCar'])->name('apiGetDriverByCar');
});
Route::group([
    'as' => 'customers.',
    'prefix' => 'customers',
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('show');
    Route::delete('/destroy/{customer}', [CustomerController::class, 'destroy'])->name('destroy');

    //    api
    Route::get('/api', [CustomerController::class, 'api'])->name('api');
    Route::get('/nameCustomers', [CustomerController::class, 'nameCustomers'])->name('api.nameCustomers');
    Route::get('/emailCustomers', [CustomerController::class, 'emailCustomers'])->name('api.emailCustomers');
    Route::get('/phoneCustomers', [CustomerController::class, 'phoneCustomers'])->name('api.phoneCustomers');

});

Route::group([
    'as' => 'carriages.',
    'prefix' => 'carriages',
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::get('/', [CarriageController::class, 'index'])->name('index');
    Route::get('/create', [CarriageController::class, 'create'])->name('create');
    Route::post('/store', [CarriageController::class, 'store'])->name('store');
    Route::delete('/destroy/{carriage}', [CarriageController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{carriage}', [CarriageController::class, 'edit'])->name('edit');
    Route::post('/update/{carriage}', [CarriageController::class, 'update'])->name('update');
    Route::post('/updateRDC/{carriage}', [CarriageController::class, 'updateRDC'])->name('updateRDC');
    Route::post('/updateCarAndRDC/{carriage}', [CarriageController::class, 'updateCarAndRDC'])->name('updateCarAndRDC');

    //    api
    Route::get('/api', [CarriageController::class, 'api'])->name('api');
    Route::get('/apiNameCarriages', [CarriageController::class, 'apiNameCarriages'])->name('api.nameCarriages');
    Route::get('/apiNumberSeats', [CarriageController::class, 'apiNumberSeats'])->name('api.numberSeats');
    Route::get('/apiCarriageByID', [CarriageController::class, 'apiCarriageByID'])->name('api.carriageByID');

});
//route
Route::group([
    'as' => 'routes.',
    'prefix' => 'routes',
    'middleware' => CheckStaffMiddleware::class,
], function () {
    Route::get('/', [RouteController::class, 'index'])->name('index');
    Route::get('/show/{route}', [RouteController::class, 'show'])->name('show');
    Route::get('/create', [RouteController::class, 'create'])->name('create');
    Route::post('/store', [RouteController::class, 'store'])->name('store');
    Route::get('/edit/{route}', [RouteController::class, 'edit'])->name('edit');
    Route::post('/update/{route}', [RouteController::class, 'update'])->name('update');
    Route::delete('/destroy/{route}', [RouteController::class, 'destroy'])->name('destroy');

    //    api
    Route::get('/api', [RouteController::class, 'api'])->name('api');
    Route::get('/apiNameRoutes', [RouteController::class, 'apiNameRoutes'])->name('api.name_routes');
    Route::get('/apiGetRouteInverse', [RouteController::class, 'apiGetRouteInverse'])->name('apiGetRouteInverse');
    Route::get('/apiCityStart', [RouteController::class, 'apiCityStart'])->name('api.city_start');
    Route::get('/apiCityEnd', [RouteController::class, 'apiCityEnd'])->name('api.city_end');
    Route::get('/apiNameCheck', [RouteController::class, 'apiNameCheck'])->name('api.apiNameCheck');
    Route::get('/apiGetFirstRoute', [RouteController::class, 'apiGetFirstRoute'])->name('api.apiGetFirstRoute');
});

//city
Route::group([
    'as' => 'cities.',
    'prefix' => 'cities',
    'middleware' => CheckStaffMiddleware::class,
], function () {
    Route::post('/store', [CityController::class, 'store'])->name('store');
    //    api
    Route::get('/cities/check/{cityName?}', [CityController::class, 'check'])->name('check');
    Route::get('/apiCity', [CityController::class, 'apiCity'])->name('api.city');
});

//route_driver_Car
Route::group([
    'as' => 'route_driver_car.',
    'prefix' => 'route_driver_car',
    'middleware' => CheckStaffMiddleware::class,
], function () {
    //    api
    Route::get('/api/{id}', [RouteDriverCarController::class, 'api'])->name('api');
});

//bill
Route::group([
    'as' => 'bills.',
    'prefix' => 'bills',
    'middleware' => CheckStaffMiddleware::class,
], function () {
    //    api
    Route::post('/api', [BillController::class, 'apiRevenue'])->name('api.revenue');
    Route::get('/apiCustomersRevenue', [BillController::class, 'apiCustomerRevenue'])->name('api.customers_revenue');
});

//bill_details
Route::group([
    'as' => 'bill_details.',
    'prefix' => 'bill_details',
    'middleware' => CheckStaffMiddleware::class,
], function () {
    //    api
    Route::get('/apiRouteCommons', [BillDetailController::class, 'apiRouteCommons'])->name('api.route_commons');
});

Route::group([
    'as' => 'buses.',
    'prefix' => 'buses',
    'middleware' => CheckStaffMiddleware::class,
], function () {
    Route::get('/index', [BusesController::class, 'index'])->name('index');
    Route::get('/', [BusesController::class, 'calendar'])->name('calendar');
    Route::delete('/show/{buses}', [BusesController::class, 'show'])->name('show');
    Route::get('/create', [BusesController::class, 'create'])->name('create');
    Route::get('/quick-create', [BusesController::class, 'quickCreate'])->name('quickCreate');
    Route::post('/store', [BusesController::class, 'store'])->name('store');
    Route::post('/quick-store', [BusesController::class, 'quickStore'])->name('quickStore');
    Route::get('/edit/{buses}', [BusesController::class, 'edit'])->name('edit');
    Route::post('/update/{buses}', [BusesController::class, 'update'])->name('update');
    Route::delete('/destroy/{buses}', [BusesController::class, 'destroy'])->name('destroy');
    Route::get('/quick-delete', [BusesController::class, 'quickDelete'])->name('quickDelete');
    Route::delete('/quick-destroy', [BusesController::class, 'quickDestroy'])->name('quickDestroy');

    //    api
    Route::get('/api', [BusesController::class, 'api'])->name('api');
    Route::get('/apiCalendar', [BusesController::class, 'apiCalendar'])->name('api.calendar');
    Route::get('/apiGetPrice', [BusesController::class, 'apiGetPrice'])->name('api.apiGetPrice');
    Route::get('/apiGetDay', [BusesController::class, 'apiGetDay'])->name('apiGetDay');
    Route::get('/apiCheckCarriage', [BusesController::class, 'apiCheckCarriage'])->name('apiCheckCarriage');
});

//Tickets
Route::group([
    'as' => 'tickets.',
    'prefix' => 'tickets',
    'middleware' => CheckStaffMiddleware::class,
], function () {
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('show');
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/store', [TicketController::class, 'store'])->name('store');
    Route::get('/edit/{ticket}', [TicketController::class, 'edit'])->name('edit');
    Route::post('/update/{route}', [TicketController::class, 'update'])->name('update');
    //    api
    Route::get('/apiTicket', [TicketController::class, 'api'])->name('api');
    Route::get('/apiGetPhonePassenger', [TicketController::class, 'apiPhonePassenger'])->name('api.phone_passenger');
    Route::get('/apiGetCodeTickets', [TicketController::class, 'apiCodeTickets'])->name('api.code_tickets');
});
