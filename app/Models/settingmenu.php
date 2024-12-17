<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMenu extends Model
{
    use HasFactory; // Menggunakan trait HasFactory jika Anda ingin menggunakan factory

    protected $table = 'setting_menus'; // Nama tabel
    protected $primaryKey = 'NO_SETTING'; // Primary key
    public $incrementing = true; // Jika NO_SETTING bukan auto increment
    public $timestamps = false; // Jika tidak ada created_at atau updated_at
 
    protected $fillable = [
        'ID_JENIS_USER',
        'MENU_ID',
        'CREATE_BY',
        'CREATE_DATE',
        // Tambahkan kolom lain yang sesuai
    ];


    // Relasi dengan tabel 'menus'
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'MENU_ID', 'MENU_ID');
    }

    // Relasi dengan tabel 'jenis_users' jika diperlukan
    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'ID_JENIS_USER', 'ID_JENIS_USER');
    }
}
