<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaguAnggaran extends Model
{
    protected $fillable = [
        'pagu_anggaran',
        'tahun',
    ];

    protected $casts = [
        'pagu_anggaran' => 'decimal:2',
    ];
}
