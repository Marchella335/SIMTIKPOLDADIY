<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class KegiatanPublicController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->paginate(9);
        return view('kegiatan', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan-detail', compact('kegiatan'));
    }
}
