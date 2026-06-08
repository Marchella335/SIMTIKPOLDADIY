<?php

namespace App\Http\Controllers;


use App\Models\Kegiatan;
use App\Models\Surat;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahKegiatan = Kegiatan::count();
        $jumlahSuratMasuk = Surat::where('tipe', 'masuk')->count();
        $jumlahSuratKeluar = Surat::where('tipe', 'keluar')->count();
        
        $showBerita = Setting::get('show_berita', 1);
        $showKegiatan = Setting::get('show_kegiatan', 1);
        
        $kegiatanTerbaru = collect();
        $beritaTerbaru = collect();

        if ($showBerita) {
            $beritaTerbaru = \App\Models\Berita::orderBy('created_at', 'desc')->take(3)->get();
        }
        if ($showKegiatan) {
            $kegiatanTerbaru = Kegiatan::orderBy('created_at', 'desc')->take(3)->get();
        }

        // Finance Summary (Multi-Fund)
        $paguTotal = \App\Models\SumberDana::where('tahun', date('Y'))->sum('pagu');
        $totalRealisasi = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')->sum('nilai');

        return view('home', compact(
            'jumlahKegiatan',
            'jumlahSuratMasuk',
            'jumlahSuratKeluar',
            'kegiatanTerbaru',
            'beritaTerbaru',
            'paguTotal',
            'totalRealisasi',
            'showBerita',
            'showKegiatan'
        ));
    }
}
