<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Surat;
use App\Models\Keuangan;
use App\Models\PaguAnggaran;
use App\Models\Kegiatan;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAnggota = Anggota::count();
        $suratMasuk = Surat::where('tipe', 'masuk')->count();
        $suratKeluar = Surat::where('tipe', 'keluar')->count();
        $jumlahKegiatan = Kegiatan::count();
        
        $paguTotal = \App\Models\SumberDana::where('tahun', date('Y'))->sum('pagu');
        $totalRealisasi = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')->sum('nilai');

        $acaraComparison = \App\Models\KeuanganAcara::withSum(['items as total_pengeluaran' => function($query) {
                $query->where('tipe', 'Pengeluaran');
            }], 'nilai')
            ->whereYear('tanggal', date('Y'))
            ->get();

        $expiringAnggotas = Anggota::whereNotNull('akhir_jabatan')
            ->where('akhir_jabatan', '<=', now()->addMonths(3))
            ->where('akhir_jabatan', '>=', now()->subDays(30)) // Show recently expired too
            ->orderBy('akhir_jabatan', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'jumlahAnggota', 'suratMasuk', 'suratKeluar',
            'jumlahKegiatan', 'paguTotal', 'totalRealisasi', 'acaraComparison',
            'expiringAnggotas'
        ));
    }
}
