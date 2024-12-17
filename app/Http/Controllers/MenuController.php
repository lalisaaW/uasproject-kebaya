<?php

namespace App\Http\Controllers;

use App\Models\jenisUser;
use App\Models\menu;
use App\Models\SettingMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
{
    public function index()
    {
    
        $user = Auth::user();

        if ($user) {
            if ($user->ID_JENIS_USER == 1) {
                $menus = menu::all();
            } else {
                // Untuk role lain, hanya tampilkan menu yang sesuai dengan setting mereka
                $allowedMenus = SettingMenu::where('ID_JENIS_USER', $user->ID_JENIS_USER)
                                            ->pluck('MENU_ID')
                                            ->toArray();
        
                $menus = menu::whereIn('MENU_ID', $allowedMenus)->get();
            }
        
            return view('menu.index', compact('menus'));
        } else {
            // Jika user tidak terautentikasi, redirect ke halaman login atau halaman lain yang sesuai
            return redirect()->route('login');
        }
    }        
    
    
    public function create()
    {
        // Ambil data jenis users dari database
        $jenisUsers = JenisUser::all(); // Ambil semua jenis user dari tabel jenis_users

        // Kirim data ke view
        return view('menu.create', compact('jenisUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'MENU_NAME' => 'required|string|max:300',
            'MENU_LINK' => 'required|string|max:300',
            'MENU_ICON' => 'nullable|string|max:300',
        ]);
    
        try {
            DB::beginTransaction();
    
            $user = Auth::user();
            if (!$user) {
                throw new \Exception('User tidak terautentikasi');
            }
    
            $menu = Menu::create([
                'MENU_NAME' => $request->MENU_NAME,
                'MENU_LINK' => $request->MENU_LINK,
                'MENU_ICON' => $request->MENU_ICON,
                'CREATE_BY' => $user->nama ?? $user->username ?? 'System', // Gunakan nama atau username, atau 'System' jika keduanya tidak ada
                'CREATE_DATE' => now(),
                'DELETE_MARK' => 'N',
            ]);
    
            DB::commit();
    
            return redirect()->route('menus.index')->with('success', 'Menu berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'MENU_NAME' => 'required|string|max:300',
            'MENU_LINK' => 'required|string|max:300',
            'MENU_ICON' => 'nullable|string|max:300',
            // 'PARENT_ID' => 'nullable|string|max:30',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
