<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'master_lowongan';

    protected $fillable = [
        'dept_id',
        'posisi',
        'quota',
        'deskripsi',
        'user_create',
        'user_update',
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'dept_id');
    }

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class, 'id_lowongan');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'user_update');
    }
}

