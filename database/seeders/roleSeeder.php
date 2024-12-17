<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['nama_role' => 'Admin', 'create_by' => 'System'],
            ['nama_role' => 'Penjual', 'create_by' => 'System'],
            ['nama_role' => 'Pembeli', 'create_by' => 'System'],
        ]);

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['nama_role' => $role['nama_role']], // Kunci pencarian berdasarkan nama_role
                [
                    'create_by' => $role['create_by'],
                    'create_date' => now(),
                    'delete_mark' => 'N', // Jika ada kolom delete_mark
                    'update_by' => 'System',
                    'update_date' => now(),
                ]
            );
        }

        $this->command->info('Roles berhasil ditambahkan atau diperbarui.');
    
    }

}
