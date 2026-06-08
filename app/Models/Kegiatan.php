<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'deskripsi',
        'hasil_rapat',
        'gambar',
<<<<<<< HEAD
        'tampilkan',
        'hasil',
=======
        'foto',
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tampilkan' => 'boolean',
    ];
}
