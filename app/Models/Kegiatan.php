<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'deskripsi',
        'gambar',
        'tampilkan',
        'hasil',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tampilkan' => 'boolean',
    ];
}
