<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    protected $fillable = ['nama', 'pagu', 'tahun'];

    public function acaras()
    {
        return $this->hasMany(KeuanganAcara::class);
    }
}
