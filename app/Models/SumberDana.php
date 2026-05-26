<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    protected $fillable = ['nama', 'pagu', 'tahun'];

    protected $appends = ['total_alokasi', 'sisa_pagu'];

    public function acaras()
    {
        return $this->hasMany(KeuanganAcara::class);
    }

    public function getTotalAlokasiAttribute()
    {
        return $this->acaras()->sum('dana_awal');
    }

    public function getSisaPaguAttribute()
    {
        return $this->pagu - $this->total_alokasi;
    }
}
