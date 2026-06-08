<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class KegiatanPublicController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::where('tampilkan', true)->orderBy('tanggal', 'desc')->paginate(9);
        return view('kegiatan', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::where('tampilkan', true)->findOrFail($id);
        return view('kegiatan-detail', compact('kegiatan'));
    }
}
