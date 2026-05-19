<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaPublicController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(9);
        return view('berita.index', compact('beritas'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $beritas_lain = Berita::where('id', '!=', $id)->orderBy('tanggal', 'desc')->take(4)->get();
        return view('berita.show', compact('berita', 'beritas_lain'));
    }
}
