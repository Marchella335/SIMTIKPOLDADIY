<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganAcaraItem extends Model
{
    protected $fillable = [
        'keuangan_acara_id', 'tanggal', 'uraian', 'kategori', 'tipe', 'nilai', 'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nilai' => 'decimal:2',
    ];

    public function acara()
    {
        return $this->belongsTo(KeuanganAcara::class, 'keuangan_acara_id');
    }
}
