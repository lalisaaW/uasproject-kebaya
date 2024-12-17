<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\role;

class setmenu extends Model
{
    use HasFactory;

    protected $table = 'setting_menus';
    protected $primaryKey = 'no_setting';
    public $incrementing = true;
    public $timestamps = true;
 
    protected $fillable = [
        'role_id',
        'menu_id',
        'created_by',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
