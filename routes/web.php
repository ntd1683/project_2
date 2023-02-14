<?php

use App\Http\Controllers\Applicant\CheckoutPaymentController;
use App\Http\Controllers\Applicant\HomePageController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TestController;
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
Route::get('/kiem-tra-hoa-don/', [HomePageController::class, 'check_bill'])->name('applicant.check_bill');
Route::post('/booking', [HomePageController::class, 'booking'])->name('applicant.booking');
Route::post('/hoa-don', [HomePageController::class, 'bill'])->name('applicant.bill');

//redirect book ticket step 1
Route::get('/book-ticket-step-1/', [HomePageController::class, 'book_ticket_step_1'])
    ->name('applicant.book_ticket_1');

//redirect book ticket step 2
Route::get('/book-ticket-step-2/', [HomePageController::class, 'book_ticket_step_2'])
    ->name('applicant.book_ticket_2');
//redirect book ticket payment
Route::get('/phuong-thuc-thanh-toan', [HomePageController::class, 'payment_methods'])
    ->name('applicant.payment_methods');

//Checkout Payment-VNPAY
Route::post('/Checkout-VNPAY/', [CheckoutPaymentController::class, 'CheckoutVNPAY'])
    ->name('applicant.checkout_vnpay');
Route::get('/Processing-Checkout-VNPAY/', [CheckoutPaymentController::class, 'ProcessingVNPAY'])
    ->name('applicant.processing_checkout_vnpay');

//api
Route::get('/api-schedule', [HomePageController::class, 'api_schedule'])->name('api.schedule');
Route::get('/apiCityStart', [RouteController::class, 'apiCityStart'])->name('api.routes.city_start');
Route::get('/apiCityEnd', [RouteController::class, 'apiCityEnd'])->name('api.routes.city_end');
Route::get('/apiNameRoutes', [RouteController::class, 'apiNameRoutes'])->name('api.routes.name_routes');

//test
Route::group(['middleware' => ['web']], function()
{
    Route::get('/test/', [TestController::class, 'test'])->name('test');
    Route::get('/test1/', [TestController::class, 'test1'])->name('test1');
    Route::get('/test2/', [TestController::class, 'test2'])->name('test2');
});
