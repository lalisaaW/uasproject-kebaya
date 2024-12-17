<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class JenisUser extends Model
{
    use HasFactory;

    protected $table = 'jenis_users'; // Tabel jenis_users
    protected $primaryKey = 'ID_JENIS_USER';
    public $incrementing = false; // Karena primary key-nya bukan integer
    protected $keyType = 'string';

    protected $fillable = [
        'ID_JENIS_USER',
        'JENIS_USER', 
        'CREATE_BY',
        'CREATE_DATE',
        'DELETE_MARK', 
        'UPDATE_BY', 
        'UPDATE_DATE'
    ];

    public $timestamps = false; 

    public function jenis()
    {
        return $this->belongsTo(jenisUser::class, 'ID_JENIS_USER', 'ID_JENIS_USER');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'ID_JENIS_USER', 'ID_JENIS_USER');
    }
}
