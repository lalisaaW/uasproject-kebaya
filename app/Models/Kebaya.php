<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebaya extends Model
{
    use HasFactory;

    protected $table = 'kebayas';
    protected $primaryKey = 'ID_KEBAYA';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_KEBAYA',
        'DESKRIPSI',
        'HARGA_SEWA',
        'UKURAN',
        'WARNA',
        'FOTO_URL',
        'ID_USER',
        'CREATE_BY',
        'CREATE_DATE',
        'DELETE_MARK',
        'UPDATE_BY',
        'UPDATE_DATE',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'ID_USER', 'ID_USER');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'ID_KEBAYA', 'ID_KEBAYA');
    }
}

