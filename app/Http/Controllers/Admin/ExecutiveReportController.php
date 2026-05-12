<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Surat;
use App\Models\SumberDana;
use App\Models\KeuanganAcaraItem;
use App\Models\Kegiatan;
use App\Models\Layanan;

class ExecutiveReportController extends Controller
{
    /**
     * Executive Intelligence Hub — Data Warehouse & ERP Integration
     * Mengintegrasikan seluruh modul ke dalam satu laporan strategis
     */
    public function index()
    {
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;

        // === MODUL SDM (ERP: Human Resource) ===
        $totalAnggota = Anggota::count();
        $anggotaByBidang = Anggota::selectRaw('bidang, count(*) as total')
            ->groupBy('bidang')
            ->pluck('total', 'bidang')
            ->toArray();

        // === MODUL PERSURATAN (ERP: Document Management) ===
        $suratMasukThisYear = Surat::where('tipe', 'masuk')
            ->whereYear('created_at', $currentYear)->count();
        $suratKeluarThisYear = Surat::where('tipe', 'keluar')
            ->whereYear('created_at', $currentYear)->count();
        $suratMasukLastYear = Surat::where('tipe', 'masuk')
            ->whereYear('created_at', $lastYear)->count();
        $suratKeluarLastYear = Surat::where('tipe', 'keluar')
            ->whereYear('created_at', $lastYear)->count();

        // Monthly trend for current year
        $suratTrend = [];
        for ($m = 1; $m <= 12; $m++) {
            $suratTrend[] = [
                'bulan' => date('M', mktime(0, 0, 0, $m, 1)),
                'masuk' => Surat::where('tipe', 'masuk')
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $m)->count(),
                'keluar' => Surat::where('tipe', 'keluar')
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $m)->count(),
            ];
        }

        // === MODUL KEUANGAN (ERP: Financial Management) ===
        $sumberDanas = SumberDana::where('tahun', $currentYear)->get();
        $totalPagu = $sumberDanas->sum('pagu');
        $totalRealisasi = 0;
        foreach ($sumberDanas as $sd) {
            $sd->total_realisasi = KeuanganAcaraItem::where('tipe', 'Pengeluaran')
                ->whereHas('acara', fn($q) => $q->where('sumber_dana_id', $sd->id))
                ->sum('nilai');
            $totalRealisasi += $sd->total_realisasi;
        }
        $efisiensiAnggaran = $totalPagu > 0 ? round(($totalRealisasi / $totalPagu) * 100, 1) : 0;

        // === MODUL KEGIATAN (ERP: Project Management) ===
        $kegiatanThisYear = Kegiatan::whereYear('created_at', $currentYear)->count();
        $kegiatanLastYear = Kegiatan::whereYear('created_at', $lastYear)->count();

        // === MODUL CRM (Customer Relationship) ===
        $layananTotal = Layanan::count();
        $layananCompleted = Layanan::where('status', 'Completed')->count();
        $avgRating = Layanan::whereNotNull('rating')->avg('rating') ?? 0;
        $completionRate = $layananTotal > 0 ? round(($layananCompleted / $layananTotal) * 100, 1) : 0;

        // === DATA WAREHOUSE: Cross-Module KPI ===
        $kpiData = [
            'produktivitas' => $kegiatanThisYear > 0 && $totalPagu > 0
                ? 'Rp ' . number_format($totalRealisasi / max($kegiatanThisYear, 1), 0, ',', '.')
                : 'N/A',
            'efisiensi_surat' => $suratMasukThisYear + $suratKeluarThisYear,
            'rasio_sdm_kegiatan' => $totalAnggota > 0
                ? round($kegiatanThisYear / $totalAnggota, 2)
                : 0,
        ];

        return view('admin.executive-report', compact(
            'currentYear', 'lastYear',
            'totalAnggota', 'anggotaByBidang',
            'suratMasukThisYear', 'suratKeluarThisYear',
            'suratMasukLastYear', 'suratKeluarLastYear',
            'suratTrend',
            'sumberDanas', 'totalPagu', 'totalRealisasi', 'efisiensiAnggaran',
            'kegiatanThisYear', 'kegiatanLastYear',
            'layananTotal', 'layananCompleted', 'avgRating', 'completionRate',
            'kpiData'
        ));
    }
}
