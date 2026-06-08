<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Surat;
use App\Models\Kegiatan;
use App\Models\Berita;
use App\Models\KeuanganAcaraItem;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Defaults to current month
        if (!$startDate) {
            $startDate = date('Y-m-01');
        }
        if (!$endDate) {
            $endDate = date('Y-m-t');
        }

        // 1. Anggota summary
        $totalAnggota = Anggota::count();
        $anggotaPerBidang = Anggota::selectRaw('bidang, count(*) as count')
            ->groupBy('bidang')
            ->get();

        // 2. Persuratan summary
        $suratQuery = Surat::query();
        if ($startDate) $suratQuery->where('tanggal', '>=', $startDate);
        if ($endDate) $suratQuery->where('tanggal', '<=', $endDate);
        
        $suratMasuk = (clone $suratQuery)->where('tipe', 'masuk')->count();
        $suratKeluar = (clone $suratQuery)->where('tipe', 'keluar')->count();
        $suratPerBidang = (clone $suratQuery)->selectRaw('bidang, count(*) as count')
            ->groupBy('bidang')
            ->get();

        // 3. Keuangan summary
        $keuanganQuery = KeuanganAcaraItem::query();
        if ($startDate) $keuanganQuery->where('tanggal', '>=', $startDate);
        if ($endDate) $keuanganQuery->where('tanggal', '<=', $endDate);

        $totalPemasukan = (clone $keuanganQuery)->where('tipe', 'Pemasukan')->sum('nilai');
        $totalPengeluaran = (clone $keuanganQuery)->where('tipe', 'Pengeluaran')->sum('nilai');

        // 4. Kegiatan summary
        $kegiatanQuery = Kegiatan::query();
        if ($startDate) $kegiatanQuery->where('tanggal', '>=', $startDate);
        if ($endDate) $kegiatanQuery->where('tanggal', '<=', $endDate);

        $totalKegiatan = (clone $kegiatanQuery)->count();
        $totalKegiatanTampilkan = (clone $kegiatanQuery)->where('tampilkan', true)->count();

        // 5. Berita summary
        $beritaQuery = Berita::query();
        if ($startDate) $beritaQuery->where('created_at', '>=', $startDate . ' 00:00:00');
        if ($endDate) $beritaQuery->where('created_at', '<=', $endDate . ' 23:59:59');

        $totalBerita = (clone $beritaQuery)->count();
        $totalBeritaTampilkan = (clone $beritaQuery)->where('tampilkan', true)->count();

        return view('admin.rekap.index', compact(
            'startDate', 'endDate',
            'totalAnggota', 'anggotaPerBidang',
            'suratMasuk', 'suratKeluar', 'suratPerBidang',
            'totalPemasukan', 'totalPengeluaran',
            'totalKegiatan', 'totalKegiatanTampilkan',
            'totalBerita', 'totalBeritaTampilkan'
        ));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // 1. Anggota summary
        $totalAnggota = Anggota::count();
        $anggotaPerBidang = Anggota::selectRaw('bidang, count(*) as count')
            ->groupBy('bidang')
            ->get();

        // 2. Persuratan list
        $suratQuery = Surat::query();
        if ($startDate) $suratQuery->where('tanggal', '>=', $startDate);
        if ($endDate) $suratQuery->where('tanggal', '<=', $endDate);
        $surats = $suratQuery->orderBy('tanggal', 'desc')->get();

        // 3. Keuangan list
        $keuanganQuery = KeuanganAcaraItem::with('acara.source');
        if ($startDate) $keuanganQuery->where('tanggal', '>=', $startDate);
        if ($endDate) $keuanganQuery->where('tanggal', '<=', $endDate);
        $keuangans = $keuanganQuery->orderBy('tanggal', 'desc')->get();

        // 4. Kegiatan list
        $kegiatanQuery = Kegiatan::query();
        if ($startDate) $kegiatanQuery->where('tanggal', '>=', $startDate);
        if ($endDate) $kegiatanQuery->where('tanggal', '<=', $endDate);
        $kegiatans = $kegiatanQuery->orderBy('tanggal', 'desc')->get();

        // 5. Berita list
        $beritaQuery = Berita::query();
        if ($startDate) $beritaQuery->where('created_at', '>=', $startDate . ' 00:00:00');
        if ($endDate) $beritaQuery->where('created_at', '<=', $endDate . ' 23:59:59');
        $beritas = $beritaQuery->orderBy('created_at', 'desc')->get();

        return view('admin.rekap.pdf', compact(
            'startDate', 'endDate',
            'totalAnggota', 'anggotaPerBidang',
            'surats', 'keuangans', 'kegiatans', 'beritas'
        ));
    }
}
