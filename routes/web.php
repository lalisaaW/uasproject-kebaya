<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\authmiddleware;
use App\Http\Middleware\succesmidlleware;



Route::middleware([succesmidlleware::class])->group(function () {
    Route::match(['get', 'post'], '/layouts', [AuthController::class, 'index'])->name('main');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'FormRegis'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'FormLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/', function () {
        return view('welcome');
    });
});
