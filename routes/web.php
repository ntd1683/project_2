<?php

use App\Http\Controllers\Applicant\HomePageController;
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
Route::get('/lich-trinh/', [HomePageController::class, 'schedule'])->name('applicant.schedule');

//api
Route::get('/api-schedule', [HomePageController::class, 'api_schedule'])->name('api.schedule');

//test
Route::get('/test/', [TestController::class, 'test'])->name('test');
