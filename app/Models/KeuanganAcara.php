<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganAcara extends Model
{
    protected $fillable = ['sumber_dana_id', 'nama_acara', 'tanggal', 'dana_awal', 'sumber_dana', 'periode_pelaporan'];

    public function source()
    {
        return $this->belongsTo(SumberDana::class, 'sumber_dana_id');
    }

    protected $casts = [
        'tanggal' => 'date',
        'dana_awal' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(KeuanganAcaraItem::class);
    }
}
