<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'agenda_surat',
        'nomor_agenda',
        'tipe',
        'bidang',
        'jenis_surat',
        'perihal',
        'dari',
        'kepada',
        'keterangan',
        'disposisi',
        'file_pdf',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
