<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menus';
    protected $primaryKey = 'menu_id';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'menu_name',
        'menu_link',
        'menu_icon',
        'parent_id',
        'is_approved',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            if (!$menu->created_by) {
                $menu->created_by = Auth::check() ? Auth::user()->nama : 'System';
            }
        });
    }

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
        return $this->hasMany(SetMenu::class, 'menu_id', 'menu_id');
    }

    public function getRouteKeyName()
    {
        return 'menu_id';
    }
}
