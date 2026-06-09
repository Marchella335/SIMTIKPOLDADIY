<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'rencana_kegiatan_id',
        'nama_kegiatan',
        'tanggal',
        'deskripsi',
        'hasil_rapat',
        'gambar',
        'foto',
        'tampilkan',
        'hasil',
    ];

    public function rencanaKegiatan()
    {
        return $this->belongsTo(RencanaKegiatan::class, 'rencana_kegiatan_id');
    }

    protected $casts = [
        'tanggal' => 'date',
        'tampilkan' => 'boolean',
    ];
}
