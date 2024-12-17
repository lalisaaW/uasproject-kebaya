<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingMenuSeeder extends Seeder
{
    public function run()
    {
        // Ambil role_id untuk Admin
        $roleAdmin = DB::table('roles')->where('nama_role', 'Admin')->first();
        
        // Pastikan role_id ditemukan
        if (!$roleAdmin) {
            $this->command->error('Role "Admin" tidak ditemukan di tabel roles.');
            return;
        }

        // Ambil MENU_ID yang valid dari tabel menus
        $menuId = DB::table('menus')->where('menu_name', 'Absen')->value('menu_id');

        // Pastikan MENU_ID ditemukan
        if (!$menuId) {
            $this->command->error('Menu "Absen" tidak ditemukan di tabel menus.');
            return;
        }

        // Insert data ke tabel setting_menus
        DB::table('setting_menus')->insert([
            [
                'role_id' => $roleAdmin->role_id,  // Ambil role_id untuk Admin
                'menu_id' => $menuId,
                'create_by' => 'Atmin',
                'create_date' => now(),
                'delete_mark' => 'N',
            ],
        ]);

        $this->command->info('Setting menu berhasil ditambahkan.');
    }
}
