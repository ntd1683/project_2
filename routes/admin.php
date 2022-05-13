<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login');

Route::get('/forgot_password', function () {
    return view('admin.auth.forgot_password');
})->name('forgot_password');
