<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaPublicController extends Controller
{
    public function index()
    {
        $carouselItems = \App\Models\Carousel::orderBy('created_at', 'desc')->get();
        
        if ($carouselItems->isEmpty()) {
            $latestNews = Berita::where('tampilkan', true)->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->take(3)->get();
            $carouselItems = $latestNews->map(function ($news) {
                return (object)[
                    'judul' => $news->judul,
                    'deskripsi' => \Illuminate\Support\Str::limit(strip_tags($news->konten), 160),
                    'gambar' => $news->foto,
                    'link' => route('berita.show', $news->id),
                    'tanggal' => $news->tanggal,
                ];
            });
        }
        
        $beritas = Berita::where('tampilkan', true)->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(9);
        return view('berita.index', compact('beritas', 'carouselItems'));
    }

    public function show($id)
    {
        $berita = Berita::where('tampilkan', true)->findOrFail($id);
        $beritas_lain = Berita::where('tampilkan', true)->where('id', '!=', $id)->orderBy('tanggal', 'desc')->take(4)->get();
        return view('berita.show', compact('berita', 'beritas_lain'));
    }
}
