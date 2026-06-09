<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\StrukturOrganisasi;

class ProfilController extends Controller
{
    public function index()
    {
        // Hanya ambil Kabid TIK (bidang tik, jabatan mengandung 'kabid')
        $kabidTik = Anggota::whereRaw('LOWER(bidang) = ?', ['tik'])
            ->whereRaw('LOWER(jabatan) LIKE ?', ['kabid%'])
            ->first();

        // Ambil gambar struktur per bidang yang diupload admin
        $struktur = [];
        foreach (StrukturOrganisasi::all() as $s) {
            $struktur[strtolower($s->bidang)] = $s->foto;
        }

        return view('profil', compact('kabidTik', 'struktur'));
    }
}
