<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
})->name('index')->middleware('CheckLogin');

Route::get('/login', [AuthController::class,'login'])->name('login')->middleware('CheckLogout');
Route::get('/forgot_password', [AuthController::class,'forgotPassword'])->name('forgot_password');
Route::post('login', [AuthController::class,'processLogin'])->name('process_login');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
