<?php

namespace App\Http\Controllers;

use App\Models\Anggota;

class ProfilController extends Controller
{
    public function index()
    {
        $kabid = Anggota::whereRaw('LOWER(bidang) = ?', ['tik'])->get();
        
        $kasubbid = Anggota::whereRaw('LOWER(jabatan) LIKE ?', ['kasubbid%'])->get();

        $renmin = Anggota::whereRaw('LOWER(bidang) = ?', ['renmin'])
            ->whereRaw('LOWER(jabatan) NOT LIKE ?', ['kasubbid%'])
            ->get();
            
        $tekkom = Anggota::whereRaw('LOWER(bidang) = ?', ['tekkom'])
            ->whereRaw('LOWER(jabatan) NOT LIKE ?', ['kasubbid%'])
            ->get();
            
        $tekinfo = Anggota::whereRaw('LOWER(bidang) = ?', ['tekinfo'])
            ->whereRaw('LOWER(jabatan) NOT LIKE ?', ['kasubbid%'])
            ->get();

        $struktur = [];
        foreach (\App\Models\StrukturOrganisasi::all() as $s) {
            $struktur[$s->bidang] = $s->foto;
        }

        return view('profil', compact('kabid', 'kasubbid', 'renmin', 'tekkom', 'tekinfo', 'struktur'));
    }
}
