<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Surat;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahAnggota = Anggota::count();
        $jumlahKegiatan = Kegiatan::count();
        $jumlahSuratMasuk = Surat::where('tipe', 'masuk')->count();
        $jumlahSuratKeluar = Surat::where('tipe', 'keluar')->count();
        $kegiatanTerbaru = Kegiatan::orderBy('created_at', 'desc')->take(3)->get();

        // Finance Summary (Multi-Fund)
        $paguTotal = \App\Models\SumberDana::where('tahun', date('Y'))->sum('pagu');
        $totalRealisasi = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')->sum('nilai');

        return view('home', compact(
            'jumlahAnggota',
            'jumlahKegiatan',
            'jumlahSuratMasuk',
            'jumlahSuratKeluar',
            'kegiatanTerbaru',
            'paguTotal',
            'totalRealisasi'
        ));
    }
}
