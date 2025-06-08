<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

// نمایش فرم ها
Route::get('/login', [Authcontroller::class, 'showloginform'])->name('showlogin');
Route::get('/register', [Authcontroller::class, 'showregisterform'])->name('showregister');

// پردازش فرم ها

Route::post('/login', [Authcontroller::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');

// مسیر محافظت شده

Route::get('/dashboard', function (){
    return 'به صفحه داشبورد خوش آمدید';
})->middleware('auth')->name('dashboard');
