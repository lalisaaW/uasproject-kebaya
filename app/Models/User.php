<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='users';
    protected $primaryKey ='ID_USER';
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'wa',
        'ID_JENIS_USER',
        'STATUS_USER',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'ID_JENIS_USER', 'ID_JENIS_USER');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'MENU_ID', 'MENU_ID');
    }

    public function settingMenus()
    {
        return $this->hasMany(SettingMenu::class, 'ID_JENIS_USER', 'ID_JENIS_USER'); // Assuming 'id' is the user's identifier
    }
}
    
