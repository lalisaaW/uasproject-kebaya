<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\menu;
use App\Models\SettingMenu;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Mengirimkan data menu ke sidebar secara otomatis
        View::composer('layouts.sidebar', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $allowedMenus = SettingMenu::where('ID_JENIS_USER', $user->ID_JENIS_USER)
                                    ->pluck('MENU_ID')
                                    ->toArray();

                $menus = menu::whereIn('MENU_ID', $allowedMenus)->get();
            } else {
                $menus = collect(); // Jika tidak ada user login, kosongkan menu
            }

            $view->with('menus', $menus);
        });
    }
    public function register(): void
    {
        //
    }
}
