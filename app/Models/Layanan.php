<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'nama_pemohon',
        'email_pemohon',
        'no_hp',
        'anggota_id',
        'jenis_layanan',
        'deskripsi',
        'status',
        'rating',
        'feedback',
        'token',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
