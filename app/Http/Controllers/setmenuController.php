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
        $menus = Menu::withoutTrashed()->get();
        $roles = Role::with(['menus' => function($query) {
            $query->withoutTrashed();
        }])->get();
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

        $menu = Menu::create($request->only([
            'menu_name',
            'menu_link',
            'menu_icon',
            'parent_id'
        ]));

        return response()->json(['success' => true, 'message' => 'Menu created successfully.', 'menu' => $menu]);
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }
    
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'menu_name' => 'required|string|max:300',
            'menu_link' => 'required|string|max:300',
            'menu_icon' => 'nullable|string|max:300',
            'parent_id' => 'nullable|exists:menus,menu_id'
        ]);

        $menu->update($request->only([
            'menu_name',
            'menu_link',
            'menu_icon',
            'parent_id'
        ]));

        return response()->json(['success' => true, 'message' => 'Menu updated successfully.', 'menu' => $menu]);
    }
    

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(['success' => true, 'message' => 'Menu deleted successfully.']);
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
                    'created_by' => Auth::user() ? Auth::user()->name : 'System',
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Menu settings updated successfully.'
        ]);
    }


    public function toggleApproval($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->is_approved = !$menu->is_approved;
        $menu->save();

        // Ambil menu yang diperbarui beserta childrennya
        $updatedMenu = Menu::where('is_approved', true)
                           ->where(function($query) use ($menu) {
                               $query->where('menu_id', $menu->menu_id)
                                     ->orWhere('parent_id', $menu->menu_id);
                           })
                           ->with(['children' => function($query) {
                               $query->where('is_approved', true);
                           }])
                           ->get();

        return response()->json([
            'success' => true,
            'message' => $menu->is_approved ? 'Menu approved successfully.' : 'Menu unapproved successfully.',
            'is_approved' => $menu->is_approved,
            'updatedMenu' => $updatedMenu
        ]);
    }

    public function getApprovedMenus()
    {
        $menus = Menu::where('is_approved', true)->whereNull('parent_id')->with(['children' => function($query) {
            $query->where('is_approved', true);
        }])->get();

        return response()->json($menus);
    }
}

