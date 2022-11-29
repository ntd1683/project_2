<?php

use App\Http\Controllers\DriverController;
use App\Http\Middleware\CheckDriverMiddleware;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function () {
    Route::get('/', [DriverController::class, 'index'])->name('index');
});
