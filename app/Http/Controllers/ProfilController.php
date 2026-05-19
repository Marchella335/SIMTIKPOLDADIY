<?php

namespace App\Http\Controllers;

use App\Models\Anggota;

class ProfilController extends Controller
{
    public function index()
    {
        $kabid = Anggota::where('bidang', 'TIK')->get();
        
        $kasubbid = Anggota::where(function($q) {
            $q->where('jabatan', 'like', 'Kasubbid%');
        })->get();

        $renmin = Anggota::where('bidang', 'RENMIN')->where('jabatan', 'not like', 'Kasubbid%')->get();
        $tekkom = Anggota::where('bidang', 'TEKKOM')->where('jabatan', 'not like', 'Kasubbid%')->get();
        $tekinfo = Anggota::where('bidang', 'TEKINFO')->where('jabatan', 'not like', 'Kasubbid%')->get();

        $struktur = [];
        foreach (\App\Models\StrukturOrganisasi::all() as $s) {
            $struktur[$s->bidang] = $s->foto;
        }

        return view('profil', compact('kabid', 'kasubbid', 'renmin', 'tekkom', 'tekinfo', 'struktur'));
    }
}
