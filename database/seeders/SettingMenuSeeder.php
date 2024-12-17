<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingMenuSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID_JENIS_USER untuk Admin
        $jenisUserAdmin = DB::table('jenis_users')->where('JENIS_USER', 'Admin')->first();
        
        // Pastikan ID_JENIS_USER ditemukan
        if (!$jenisUserAdmin) {
            $this->command->error('Jenis user "Admin" tidak ditemukan di tabel jenis_users.');
            return;
        }

        // Ambil MENU_ID yang valid dari tabel menus
        $menuId = DB::table('menus')->where('MENU_NAME', 'Absen')->value('MENU_ID');

        // Pastikan MENU_ID ditemukan
        if (!$menuId) {
            $this->command->error('Menu "Absen" tidak ditemukan di tabel menus.');
            return;
        }

        // Insert data ke tabel setting_menus
        DB::table('setting_menus')->insert([
            [
                'ID_JENIS_USER' => $jenisUserAdmin->ID_JENIS_USER, // Ambil ID_JENIS_USER di sini
                'MENU_ID' => $menuId,
                'CREATE_BY' => 'Atmin',
                'CREATE_DATE' => now(),
                'DELETE_MARK' => 'N',
            ],
        ]);

        $this->command->info('Setting menu berhasil ditambahkan.');
    }
}
