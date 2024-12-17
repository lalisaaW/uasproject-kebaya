<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'rentals';
    protected $primaryKey = 'ID_RENTAL';
    public $timestamps = false;

    protected $fillable = [
        'ID_KEBAYA',
        'ID_USER',
        'TANGGAL_MULAI',
        'TANGGAL_SELESAI',
        'TOTAL_HARGA',
        'STATUS',
        'CREATE_BY',
        'CREATE_DATE',
        'DELETE_MARK',
        'UPDATE_BY',
        'UPDATE_DATE',
    ];

    protected $casts = [
        'TANGGAL_MULAI' => 'date',
        'TANGGAL_SELESAI' => 'date',
    ];

    public function kebaya()
    {
        return $this->belongsTo(Kebaya::class, 'ID_KEBAYA', 'ID_KEBAYA');
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'ID_USER', 'ID_USER');
    }
}

