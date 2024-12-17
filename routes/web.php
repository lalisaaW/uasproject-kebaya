<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LoginController as ControllersLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegisterController as ControllersRegisterController;
use App\Http\Controllers\SettingMenuController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BerhasilMiddleware;
use App\Http\Middleware\gagalMiddleware;
use App\Http\Middleware\MenuMiddleware;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\KebayaController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;

Route::middleware(MenuMiddleware::class)->group(function () {
    // Routes that don't require authentication
    Route::get('/', [KebayaController::class, 'landingPage'])->name('kebayas.landing');

    Route::middleware(BerhasilMiddleware::class)->group(function () {
        Route::get('/login', [ControllersLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ControllersLoginController::class, 'login']);

        Route::get('/register', [ControllersRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [ControllersRegisterController::class, 'register']);
    });

    Route::get('/profile/settings', 'ProfileController@settings')->name('profile.settings');

    Route::middleware(gagalMiddleware::class)->group(function () {
        // Menambahkan nama route "main" yang mengarah ke view layouts.main
        Route::get('/layouts', function () {
            return view('layouts.main');
        })->name('main');  // Menetapkan nama route sebagai 'main'

        // Main route yang mengecek apakah user sudah login
        Route::get('/dashboard', function () {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user && $user->jenisUser) {
                    return view('layouts.main');
                } else {
                    Auth::logout();
                    return redirect('/login')->with('error', 'User role not found. Please contact administrator.');
                }
            }
            return redirect('/login');
        })->name('main');  // Pastikan nama route 'main' sudah diterapkan di sini

        Route::post('/logout', [ControllersLoginController::class, 'logout'])->name('logout');

        // Routes for setting menus
        Route::get('/setmenu', [SettingMenuController::class, 'index'])->name('setmenu.index');
        Route::post('/setmenu', [SettingMenuController::class, 'store'])->name('setmenu.store');
        Route::get('/setmenu/{menu}/edit', [SettingMenuController::class, 'edit'])->name('setmenu.edit');
        Route::put('/setmenu/{menu}', [SettingMenuController::class, 'update'])->name('setmenu.update');
        Route::delete('/setmenu/{menu}', [SettingMenuController::class, 'destroy'])->name('setmenu.destroy');

        Route::middleware(['auth', 'admin'])->group(function () {
            Route::get('/menu-settings', [SettingMenuController::class, 'index'])->name('menu_settings.index');
            Route::get('/menu-settings/{id_jenis_user}/edit', [SettingMenuController::class, 'edit'])->name('menu_settings.edit');
            Route::put('/menu-settings/{id_jenis_user}', [SettingMenuController::class, 'update'])->name('menu_settings.update');
        });
        
        Route::get('/approved-menus', [SettingMenuController::class, 'getApprovedMenus'])->name('menu_settings.approved_menus');

        // User routes
        Route::resource('users', UserController::class);
        Route::get('users/{user_id}/edit', [UserController::class, 'edit'])->name('users.edit');

        // Menu routes
        Route::resource('menus', MenuController::class);
        Route::resource('kebayas', KebayaController::class);

        // Rental routes
        Route::resource('rentals', RentalController::class);
        Route::get('kebayas/{kebaya}/rent', [RentalController::class, 'rent'])->name('kebayas.rent');
        Route::post('kebayas/{kebaya}/rent', [RentalController::class, 'store'])->name('kebayas.store');
    
        // Cart routes
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{kebaya}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/remove/{kebaya}', [CartController::class, 'remove'])->name('cart.remove');
        Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    });
});