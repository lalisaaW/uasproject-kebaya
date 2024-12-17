<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\SetMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $roles = Role::with('menus')->get();
        return view('setmenu.index', compact('menus', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:300',
            'menu_link' => 'required|string|max:300',
            'menu_icon' => 'nullable|string|max:300',
            'parent_id' => 'nullable|exists:menus,menu_id'
        ]);

        Menu::create([
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
            'parent_id' => $request->parent_id,
            'created_by' => Auth::check() ? Auth::user()->name : null,

        ]);

        return redirect()->route('setmenu.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        return response()->json($menu);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu_name' => 'required|string|max:300',
            'menu_link' => 'required|string|max:300',
            'menu_icon' => 'nullable|string|max:300',
            'parent_id' => 'nullable|exists:menus,menu_id'
        ]);

        $menu->update($request->all());
        return redirect()->route('setmenu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('setmenu.index')->with('success', 'Menu deleted successfully.');
    }

    public function updateRoleMenuSettings(Request $request, Role $role)
    {
        $request->validate([
            'menus' => 'array',
            'menus.*' => 'integer|exists:menus,menu_id',
        ]);

        SetMenu::where('role_id', $role->role_id)->delete();

        if ($request->has('menus')) {
            foreach ($request->menus as $menu_id) {
                SetMenu::create([
                    'role_id' => $role->role_id,
                    'menu_id' => $menu_id,
                    'created_by' => Auth::user()->name,
                ]);
            }
        }

        return redirect()->route('setmenu.index')->with('success', 'Menu settings updated successfully.');
    }
}

