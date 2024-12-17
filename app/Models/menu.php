<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; // Nama tabel
    protected $primaryKey = 'menu_id';  
    public $timestamps = true;
    public $incrementing = true;  

    protected $fillable = [
        'menu_name',
        'menu_link',
        'menu_icon',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
    ];
    
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'menu_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'menu_id');
    }

    public function setting_menus()
    {
        return $this->hasMany(setmenu::class, 'menu_id', 'menu_id');
    }
    public function getRouteKeyName()
    {
        return 'menu_id'; // Primary key di database
    }

}
