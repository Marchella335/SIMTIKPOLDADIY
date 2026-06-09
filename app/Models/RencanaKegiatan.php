<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaKegiatan extends Model
{
    protected $table = 'rencana_kegiatans';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_rencana',
        'tempat',
        'kategori',
        'keterangan',
        'status',
        'tipe',
    ];

    public function kegiatan()
    {
        return $this->hasOne(\App\Models\Kegiatan::class, 'rencana_kegiatan_id');
    }

    protected $casts = [
        'tanggal_rencana' => 'date',
    ];
}
