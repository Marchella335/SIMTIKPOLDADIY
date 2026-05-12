<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'tipe',
        'bidang',
        'jenis_surat',
        'perihal',
        'dari',
        'kepada',
        'keterangan',
        'file_pdf',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
