<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\setmenu;
use App\Models\Menu;

class role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'nama_role',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
    
    public function setting_menus()
    {
        return $this->hasMany(SetMenu::class, 'role_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'setting_menus', 'role_id', 'menu_id');
    }
}
