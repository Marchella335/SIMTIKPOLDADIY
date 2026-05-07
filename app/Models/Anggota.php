<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nrp',
        'pangkat',
        'bidang',
        'jabatan',
        'awal_jabatan',
        'akhir_jabatan',
        'foto',
    ];

    /**
     * Get the sub-bidang group based on jabatan
     */
    public function getSubBidangAttribute(): string
    {
        $jabatan = $this->jabatan;

        $pimpinan = ['Kabid TIK'];
        $kasubbid = ['Kasubbid Renmin', 'Kasubbid Tekkom', 'Kasubbid Tekinfo'];

        $renmin = [
            'Kaurren', 'Kaurmintu', 'PS. Kaur Keu', 'Ps. Pamin 2',
            'Ba. Urkeu', 'BA. Renmin', 'Ba. Urmin'
        ];

        $tekkom = [
            'Kaur Jarkom', 'PS. Paur Urjarkom', 'PS. Kaurharkan',
            'PS. Kauryankom', 'PS. Pauryankom', 'PS. Paur 3 Harkan',
            'Pamin 1', 'PS. Pamin 3', 'Ba. Yankom', 'Ps. Pmain 4', 'Ba. Tekkom'
        ];

        $tekinfo = [
            'Ps. Kaur Yanduknis', 'Kaurtini', 'PS. Kaurpulahta',
            'Ps. Paur Yanduknis', 'Paur 2 Subidtekinfo', 'PS. Paur Subidtekinfo',
            'Ba. Tekinfo', 'PNS Tekinfo'
        ];

        if (in_array($jabatan, $pimpinan)) return 'pimpinan';
        if (in_array($jabatan, $kasubbid)) return 'kasubbid';
        if (in_array($jabatan, $renmin)) return 'renmin';
        if (in_array($jabatan, $tekkom)) return 'tekkom';
        if (in_array($jabatan, $tekinfo)) return 'tekinfo';

        return 'lainnya';
    }
}
