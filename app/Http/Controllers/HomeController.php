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
<<<<<<< HEAD
        $kegiatanTerbaru = Kegiatan::where('tampilkan', true)->orderBy('created_at', 'desc')->take(3)->get();
        $beritaTerbaru = \App\Models\Berita::where('tampilkan', true)->orderBy('created_at', 'desc')->take(3)->get();
=======
        
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
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94

        // Finance Summary (Multi-Fund)
        $paguTotal = \App\Models\SumberDana::where('tahun', date('Y'))->sum('pagu');
        $totalRealisasi = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')->sum('nilai');

<<<<<<< HEAD

=======
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
        return view('home', compact(
            'jumlahKegiatan',
            'jumlahSuratMasuk',
            'jumlahSuratKeluar',
            'kegiatanTerbaru',
            'beritaTerbaru',
            'paguTotal',
<<<<<<< HEAD
            'totalRealisasi'
=======
            'totalRealisasi',
            'showBerita',
            'showKegiatan'
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
        ));
    }
}
