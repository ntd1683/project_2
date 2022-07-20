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
Route::get('/mua-ve/', [HomePageController::class, 'book_ticket'])->name('applicant.book_ticket');


Route::get('/test/', [TestController::class, 'test1'])->name('test');
;


//Route::get('edit_1/{user}',[UserController::class,'edit'])->name('edit_1');
