<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('/apiTest', [TestController::class, 'apiTest'])->name('api.test');


//Route::get('edit_1/{user}',[UserController::class,'edit'])->name('edit_1');
