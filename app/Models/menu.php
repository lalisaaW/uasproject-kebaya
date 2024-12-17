<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'MENU_ID';  
    public $timestamps = false;
    public $incrementing = true;  

    protected $fillable = [
        'MENU_NAME',
        'MENU_LINK',
        'MENU_ICON',
        'CREATE_BY',
        'CREATE_DATE',
        'DELETE_MARK',
        'UPDATE_BY',
        'UPDATE_DATE',
    ];
    
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'PARENT_ID', 'MENU_ID');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'PARENT_ID', 'MENU_ID');
    }

    public function settingMenus()
    {
        return $this->hasMany(SettingMenu::class, 'MENU_ID', 'MENU_ID');
    }
}
