<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\JenisUser;
use App\Models\Menu;
use App\Models\SettingMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

class SettingMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $jenisUsers = JenisUser::where('ID_JENIS_USER', '!=', 1)->get();
        return view('setmenu.index', compact('jenisUsers'));
    }

    public function edit($id_jenis_user)
    {
        $jenisUser = JenisUser::findOrFail($id_jenis_user);
        $menus = Menu::all();
        $selectedMenus = SettingMenu::where('ID_JENIS_USER', $id_jenis_user)
                            ->pluck('MENU_ID')->toArray();

        return view('setmenu.edit', compact('jenisUser', 'menus', 'selectedMenus'));
    }

    public function update(Request $request, $id_jenis_user)
    {
        $request->validate([
            'menus' => 'array',
            'menus.*' => 'integer|exists:menus,MENU_ID',
        ]);
    
        SettingMenu::where('ID_JENIS_USER', $id_jenis_user)->delete();
    
        if ($request->has('menus')) {
            foreach ($request->menus as $menuId) {
                SettingMenu::create([
                    'ID_JENIS_USER' => $id_jenis_user,
                    'MENU_ID' => $menuId,
                    'CREATE_BY' => $user->nama ?? $user->username ?? 'System',
                    'CREATE_DATE' => now(),
                    'DELETE_MARK' => 'N',
                ]);
            }
        }
    
        return redirect()->route('menu_settings.index')->with('success', 'Menu settings updated successfully.');
    }

    public function getApprovedMenus()
    {
        $user = Auth::user();
        $approvedMenus = SettingMenu::where('ID_JENIS_USER', $user->ID_JENIS_USER)
                            ->with('menu')
                            ->get()
                            ->pluck('menu');

        return response()->json($approvedMenus);
    }
}
