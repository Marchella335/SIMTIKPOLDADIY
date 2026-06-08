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
        'nomor_agenda',
        'tanggal_agenda',
        'disposisi',
        'status_terusan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_agenda' => 'date',
    ];
}
