<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckLogoutMiddleware;
use App\Http\Middleware\CheckStaffMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class,'processLogin'])->name('process_login');

Route::group([
    'middleware'=> CheckLogoutMiddleware::class,
],function(){
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::get('/forgot_password', [AuthController::class,'forgotPassword'])->name('forgot_password');
    Route::get('/reset_password/{token}', [AuthController::class,'resetPassword'])->name('reset_password');
});

Route::group([
    'middleware'=> CheckLoginMiddleware::class,
],function(){
    Route::get('/', [UserController::class,'index'])->name('index');
    Route::get('/index', [UserController::class,'index'])->name('index');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/profile', [UserController::class,'show'])->name('profile');
    Route::post('/update/{user}',[UserController::class,'updateProfile'])->name('update_profile');
    Route::post('/change_password', [UserController::class,'changePassword'])->name('change_password');
});

Route::post('forgot_password', [AuthController::class,'processForgotPassword'])->name('process_forgot_password');
Route::post('reset_password', [AuthController::class,'processResetPassword'])->name('process_reset_password');

Route::group([
    'as' => 'users.',
    'prefix' => 'users',
    'middleware'=> CheckAdminMiddleware::class,
],function(){
    Route::get('/', [UserController::class,'show_users'])->name('show_users');
    Route::get('/create', [UserController::class,'create'])->name('create');
    Route::post('/store', [UserController::class,'store'])->name('store');
    Route::delete('/destroy/{user}',[UserController::class,'destroy'])->name('destroy');
    Route::get('/edit/{user}',[UserController::class,'edit'])->name('edit');
    Route::post('/update/{user}',[UserController::class,'update'])->name('update');

//    api
    Route::get('/api',[UserController::class,'api'])->name('api');
    Route::get('/apiNameUsers',[UserController::class,'apiNameUsers'])->name('api.name_users');
    Route::get('/apiProvinces',[UserController::class,'apiProvinces'])->name('api.provinces');
});
Route::group([
    'as' => 'routes.',
    'prefix' => 'routes',
    'middleware'=> CheckStaffMiddleware::class,
],function(){
    Route::get('/', [RouteController::class,'index'])->name('index');
    Route::delete('/show/{route}',[RouteController::class,'show'])->name('show');
    Route::get('/edit/{route}',[RouteController::class,'edit'])->name('edit');
    Route::post('/update/{route}',[RouteController::class,'update'])->name('update');
    Route::delete('/destroy/{route}',[RouteController::class,'destroy'])->name('destroy');

//    api
    Route::get('/api',[RouteController::class,'api'])->name('api');
});
