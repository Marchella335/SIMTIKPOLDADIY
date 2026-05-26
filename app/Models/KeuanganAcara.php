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

    protected $appends = ['total_pemasukan', 'total_pengeluaran', 'saldo_sheet'];

    public function items()
    {
        return $this->hasMany(KeuanganAcaraItem::class);
    }

    public function getTotalPemasukanAttribute()
    {
        return $this->items()->where('tipe', 'Pemasukan')->sum('nilai');
    }

    public function getTotalPengeluaranAttribute()
    {
        return $this->items()->where('tipe', 'Pengeluaran')->sum('nilai');
    }

    public function getSaldoSheetAttribute()
    {
        return $this->total_pemasukan - $this->total_pengeluaran;
    }
}
