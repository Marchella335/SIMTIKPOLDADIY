<?php

namespace App\Http\Controllers;

use App\Models\Anggota;

class ProfilController extends Controller
{
    public function index()
    {
        $allAnggota = Anggota::all();

        $kabid = $allAnggota->filter(fn($a) => $a->sub_bidang === 'pimpinan');
        $kasubbid = $allAnggota->filter(fn($a) => $a->sub_bidang === 'kasubbid');
        $renmin = $allAnggota->filter(fn($a) => $a->sub_bidang === 'renmin');
        $tekkom = $allAnggota->filter(fn($a) => $a->sub_bidang === 'tekkom');
        $tekinfo = $allAnggota->filter(fn($a) => $a->sub_bidang === 'tekinfo');

        return view('profil', compact('kabid', 'kasubbid', 'renmin', 'tekkom', 'tekinfo'));
    }
}
