<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_users')->insert([
            [
                'JENIS_USER' => 'Admin',
                'CREATE_BY' => 'system',
                'CREATE_DATE' => now(),
                'DELETE_MARK' => 'N',
            ],
            [

                'JENIS_USER' => 'Regular User',
                'CREATE_BY' => 'system',
                'CREATE_DATE' => now(),
                'DELETE_MARK' => 'N',
            ],
            [
                'JENIS_USER' => 'Penyedia',
                'CREATE_BY' => 'system',
                'CREATE_DATE' => now(),
                'DELETE_MARK' => 'N',
            ]
        ]);
    }
}
