<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\authmiddleware;
use App\Http\Middleware\succesmidlleware;
use App\Http\Controllers\setmenuController;



Route::middleware([succesmidlleware::class])->group(function () {
    Route::match(['get', 'post'], '/layouts', [AuthController::class, 'index'])->name('main');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('setmenu', setmenuController::class);
    Route::get('menu-settings', [setmenuController::class, 'showMenuSettings'])->name('setmenu.showMenuSettings');
    Route::post('menu-settings/{role}', [setmenuController::class, 'updateMenuSettings'])->name('setmenu.updateMenuSettings');
    Route::get('/setmenu', [SetMenuController::class, 'index'])->name('setmenu.index');
    Route::post('/setmenu', [SetMenuController::class, 'store'])->name('setmenu.store');
    Route::get('/setmenu/{menu}/edit', [SetMenuController::class, 'edit'])->name('setmenu.edit');
    Route::put('/setmenu/{menu}', [SetMenuController::class, 'update'])->name('setmenu.update');
    Route::delete('/setmenu/{menu}', [SetMenuController::class, 'destroy'])->name('setmenu.destroy');
    Route::put('/setmenu/role/{role}', [SetMenuController::class, 'updateRoleMenuSettings'])->name('setmenu.updateRoleMenuSettings');
    Route::post('/setmenu/{id}/toggle-approval', [SetMenuController::class, 'toggleApproval'])->name('setmenu.toggleApproval');
    Route::get('/approved-menus', [SetMenuController::class, 'getApprovedMenus'])->name('setmenu.getApprovedMenus');
    
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

