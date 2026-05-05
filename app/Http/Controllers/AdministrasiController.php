<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Keuangan;
use App\Models\PaguAnggaran;

class AdministrasiController extends Controller
{
    public function index()
    {
        $suratMasuk = Surat::where('tipe', 'masuk')->count();
        $suratKeluar = Surat::where('tipe', 'keluar')->count();
        return view('administrasi.index', compact('suratMasuk', 'suratKeluar'));
    }

    public function persuratan()
    {
        $query = Surat::query();

        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('jenis_surat', 'like', "%{$search}%")
                  ->orWhere('perihal', 'like', "%{$search}%");
            });
        }

        if (request('tipe')) {
            $query->where('tipe', request('tipe'));
        }

        $surats = $query->orderBy('tanggal', 'desc')->paginate(15);
        $suratMasuk = Surat::where('tipe', 'masuk')->count();
        $suratKeluar = Surat::where('tipe', 'keluar')->count();

        return view('administrasi.persuratan', compact('surats', 'suratMasuk', 'suratKeluar'));
    }

    public function keuangan()
    {
        $selectedSourceId = request('sumber_dana_id');
        $sumberDanas = \App\Models\SumberDana::where('tahun', date('Y'))->get();
        
        foreach($sumberDanas as $sd) {
            $sd->total_realisasi = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')
                ->whereHas('acara', function($q) use ($sd) {
                    $q->where('sumber_dana_id', $sd->id);
                })->sum('nilai');
        }

        // Stats Logic
        $query = \App\Models\SumberDana::where('tahun', date('Y'));
        if ($selectedSourceId) { $query->where('id', $selectedSourceId); }
        $paguTotal = $query->sum('pagu');
        
        $itemQuery = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')->whereYear('tanggal', date('Y'));
        if ($selectedSourceId) {
            $itemQuery->whereHas('acara', function($q) use ($selectedSourceId) {
                $q->where('sumber_dana_id', $selectedSourceId);
            });
        }
        $totalRealisasi = $itemQuery->sum('nilai');

        // Acara Comparison for Chart
        $acaraQuery = \App\Models\KeuanganAcara::withSum(['items as total_pengeluaran' => function($q) {
                $q->where('tipe', 'Pengeluaran');
            }], 'nilai')
            ->whereYear('tanggal', date('Y'));
        if ($selectedSourceId) { $acaraQuery->where('sumber_dana_id', $selectedSourceId); }
        $acaraComparison = $acaraQuery->get();

        return view('administrasi.keuangan', compact('paguTotal', 'totalRealisasi', 'acaraComparison', 'sumberDanas', 'selectedSourceId'));
    }
}
