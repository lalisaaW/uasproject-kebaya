<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cari ID_JENIS_USER 'admin' dari tabel jenis_users
        $jenisUserAdmin = DB::table('jenis_users')->where('JENIS_USER', 'Admin')->first();

        // Pastikan jenis user 'admin' ditemukan
        if ($jenisUserAdmin) {
            // Insert admin user hanya jika email belum ada (hindari duplikasi)
            DB::table('users')->updateOrInsert(
                ['email' => 'admin@gmail.com'], // Cek berdasarkan email
                [
                    'name' => 'Atmin',
                    'username' => 'adminbaik',
                    'password' => Hash::make('12345678'),
                    'email' => 'admin@gmail.com',
                    'wa' => '081234567890',
                    'ID_JENIS_USER' => $jenisUserAdmin->ID_JENIS_USER, // Pakai ID dari tabel jenis_users
                    'STATUS_USER' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $this->command->info('Admin user berhasil ditambahkan.');
        } else {
            // Jika ID_JENIS_USER 'admin' tidak ditemukan
            $this->command->error('Jenis user "admin" tidak ditemukan di tabel jenis_users.');
        }
    }
}
