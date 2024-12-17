<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Menu;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->users();
            $role = $user->role;

            // Get all menus approved for the user's role
            $approvedMenuIds = $role->setting_menus()->pluck('menu_id')->toArray();
            $approvedMenus = Menu::whereIn('menu_id', $approvedMenuIds)->get();

            // Structure the menus hierarchically
            $menuTree = $this->buildMenuTree($approvedMenus);

            // Share the menu tree with all views
            view()->share('sidebarMenus', $menuTree);
        }

        return $next($request);
    }

    private function buildMenuTree($menus, $parentId = null)
    {
        $tree = [];

        foreach ($menus as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = $this->buildMenuTree($menus, $menu->menu_id);
                if ($children) {
                    $menu->children = $children;
                }
                $tree[] = $menu;
            }
        }

        return $tree;
    }
}
