<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pendaftar';

    protected $fillable = [
        'id_lowongan',
        'name',
        'gender',
        'dob',
        'address',
        'no_telp',
        'university',
        'major',
        'ipk',
        'status',
        'path_cv',
    ];

    protected $casts = [
        'dob' => 'date',
        'ipk' => 'decimal:2',
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }
}

