<?php

use App\Http\Controllers\Applicant\HomePageController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomePageController::class, 'index'])->name('index');

//book_ticket
Route::get('/mua-ve/', [HomePageController::class, 'book_ticket'])->name('applicant.book_ticket');
Route::post('/order/', [HomePageController::class, 'order'])->name('applicant.order');
Route::post('/thanh-toan/', [HomePageController::class, 'payment'])->name('applicant.payment');
Route::get('/tuyen-duong/', [HomePageController::class, 'schedule'])->name('applicant.schedule');
Route::get('/kiem-tra-ve/', [HomePageController::class, 'check_ticket'])->name('applicant.check_ticket');
Route::get('/booking', [HomePageController::class, 'booking'])->name('applicant.booking');

//api
Route::get('/api-schedule', [HomePageController::class, 'api_schedule'])->name('api.schedule');
Route::get('/apiCityStart', [RouteController::class, 'apiCityStart'])->name('api.routes.city_start');
Route::get('/apiCityEnd', [RouteController::class, 'apiCityEnd'])->name('api.routes.city_end');
Route::get('/apiNameRoutes', [RouteController::class, 'apiNameRoutes'])->name('api.routes.name_routes');

//test
Route::get('/test/', [TestController::class, 'test'])->name('test');
Route::post('/test1/', [TestController::class, 'get_test'])->name('get_test');
