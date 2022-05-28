<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class,'index'])->name('index')->middleware('CheckLogin');
Route::get('/login', [AuthController::class,'login'])->name('login')->middleware('CheckLogout');
Route::post('login', [AuthController::class,'processLogin'])->name('process_login');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/forgot_password', [AuthController::class,'forgotPassword'])->name('forgot_password');
Route::get('/reset_password/{token}', [AuthController::class,'resetPassword'])->name('reset_password');
Route::post('forgot_password', [AuthController::class,'processForgotPassword'])->name('process_forgot_password');
Route::post('reset_password', [AuthController::class,'processResetPassword'])->name('process_reset_password');
