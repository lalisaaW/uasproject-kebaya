<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/layout', [AuthController::class, 'layout'])->name('main');
    Route::post('/layout', [AuthController::class, 'layout'])->name('main');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'FormRegis'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'FormLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

