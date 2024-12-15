<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->where('nama_role', 'Admin')->value('role_id');

        DB::table('users')->insert([
            'role_id' => $adminRoleId,
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'no_hp' => '08987654321',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
