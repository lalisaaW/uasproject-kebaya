<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Controllers\SetMenuController;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next)
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $role = $user->role;

            if ($role) {
                $setMenuController = new SetMenuController();
                $approvedMenus = $setMenuController->getApprovedMenus()->original;

                $roleMenus = $approvedMenus->filter(function ($menu) use ($role) {
                    return $menu->setting_menus->contains('role_id', $role->role_id);
                });

                Log::info('Sharing menus with view', ['menus' => $roleMenus]);
                view()->share('sidebarMenus', $roleMenus);
            } else {
                Log::warning('User does not have a role', ['user_id' => $user->id]);
                return redirect()->route('login')->with('error', 'You do not have a valid role.');
            }
        }
        return $next($request);
    }
}
