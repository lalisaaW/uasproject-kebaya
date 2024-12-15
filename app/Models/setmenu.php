<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setmenu extends Model
{
    use HasFactory;

    protected $table = 'setting_menus'; // Nama tabel
    protected $primaryKey = 'no_setting'; // Primary key
    public $incrementing = true; // Primary key auto increment
    public $timestamps = true; // Jika tidak menggunakan created_at dan updated_at
 
    protected $fillable = [
        'role_id',
        'menu_id',
        'create_by',
        'create_date',
        // Tambahkan kolom lain yang sesuai
    ];

    // Relasi dengan tabel 'menus'
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }

    // Relasi dengan tabel 'roles'
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
