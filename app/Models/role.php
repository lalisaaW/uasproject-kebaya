<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class role extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama tabel sesuai konvensi)
    protected $table = 'roles';

    // Primary key (opsional jika primary key sesuai konvensi)
    protected $primaryKey = 'role_id';

    // Mass assignable attributes
    protected $fillable = [
        'nama_role',
    ];

    // Relationship dengan User
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
    
    public function setting_menus()
    {
        return $this->hasMany(setmenu::class, 'role_id');
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'setting_menus', 'role_id', 'menu_id');
    }
        
}
