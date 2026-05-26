<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Layanan;
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
        $beritaTerbaru = \App\Models\Berita::orderBy('created_at', 'desc')->take(3)->get();

        // Finance Summary (Multi-Fund)
        $paguTotal = \App\Models\SumberDana::where('tahun', date('Y'))->sum('pagu');
        $totalRealisasi = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')->sum('nilai');

        // Rating Layanan Summary
        $ratingData = [
            'avg' => round(Layanan::whereNotNull('rating')->avg('rating'), 1) ?: 0,
            'total' => Layanan::whereNotNull('rating')->count(),
            'completed' => Layanan::where('status', 'Completed')->count(),
            'distribution' => [],
        ];
        for ($i = 5; $i >= 1; $i--) {
            $ratingData['distribution'][$i] = Layanan::where('rating', $i)->count();
        }
        // Recent testimonials (rating >= 4 with feedback)
        $testimonials = Layanan::whereNotNull('rating')
            ->whereNotNull('feedback')
            ->where('feedback', '!=', '')
            ->where('rating', '>=', 4)
            ->orderBy('updated_at', 'desc')
            ->take(6)
            ->get();

        return view('home', compact(
            'jumlahAnggota',
            'jumlahKegiatan',
            'jumlahSuratMasuk',
            'jumlahSuratKeluar',
            'kegiatanTerbaru',
            'beritaTerbaru',
            'paguTotal',
            'totalRealisasi',
            'ratingData',
            'testimonials'
        ));
    }
}
