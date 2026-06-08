<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use App\Models\PaguAnggaran;
use App\Models\KeuanganAcara;
use App\Models\KeuanganAcaraItem;
use App\Models\SumberDana;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $sumberDanas = SumberDana::orderBy('tahun', 'desc')->orderBy('nama', 'asc')->get();
        return view('admin.keuangan.index', compact('sumberDanas'));
    }

    public function getSumberDana()
    {
        $sumberDanas = SumberDana::orderBy('tahun', 'desc')->orderBy('nama', 'asc')->get();
        return response()->json($sumberDanas);
    }

    public function storeSumberDana(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pagu' => 'required|numeric|min:0',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $sumberDana = SumberDana::create($request->all());
        return response()->json($sumberDana);
    }

    public function destroySumberDana($id)
    {
        SumberDana::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function getAcarasBySource($id)
    {
        $sumberDana = SumberDana::findOrFail($id);
        $acaras = KeuanganAcara::with('items')
            ->where('sumber_dana_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'sumber_dana' => $sumberDana,
            'acaras' => $acaras
        ]);
    }

    public function getAcaraData()
    {
        $acaras = KeuanganAcara::with('items')->orderBy('created_at', 'desc')->get();
        return response()->json($acaras);
    }

    public function storeAcara(Request $request)
    {
        $request->validate([
            'sumber_dana_id' => 'required|exists:sumber_danas,id',
            'nama_acara' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'dana_awal' => 'required|numeric|min:0',
            'periode_pelaporan' => 'nullable|string|max:255',
        ]);

        $sumberDana = SumberDana::findOrFail($request->sumber_dana_id);
        
        if ($request->dana_awal > $sumberDana->sisa_pagu) {
            return response()->json(['message' => 'Dana awal melebihi sisa pagu anggaran.'], 422);
        }

        $acara = KeuanganAcara::create($request->only('sumber_dana_id', 'nama_acara', 'tanggal', 'dana_awal', 'periode_pelaporan'));

        // Auto-insert first transaction for Dana Awal
        $acara->items()->create([
            'tanggal' => $request->tanggal ?? now()->format('Y-m-d'),
            'uraian' => 'Dana Awal Acara',
            'kategori' => 'Lain-lain',
            'tipe' => 'Pemasukan',
            'nilai' => $request->dana_awal
        ]);

        return response()->json($acara->load('items'));
    }

    public function addDanaToSheet(Request $request, $id)
    {
        $request->validate([
            'tambahan_dana' => 'required|numeric|min:0'
        ]);

        $acara = KeuanganAcara::findOrFail($id);
        $sumberDana = $acara->source;

        if ($request->tambahan_dana > $sumberDana->sisa_pagu) {
            return response()->json(['message' => 'Tambahan dana melebihi sisa pagu anggaran.'], 422);
        }

        $acara->update([
            'dana_awal' => $acara->dana_awal + $request->tambahan_dana
        ]);

        // Auto-insert transaction for Tambahan Dana
        $acara->items()->create([
            'tanggal' => now()->format('Y-m-d'),
            'uraian' => 'Tambahan Dana Acara',
            'kategori' => 'Lain-lain',
            'tipe' => 'Pemasukan',
            'nilai' => $request->tambahan_dana
        ]);

        return response()->json($acara->load('items'));
    }

    public function updateAcara(Request $request, $id)
    {
        $acara = KeuanganAcara::findOrFail($id);
        $acara->update($request->only('nama_acara', 'tanggal', 'periode_pelaporan', 'sumber_dana_id'));
        return response()->json($acara);
    }

    public function destroyAcara($id)
    {
        KeuanganAcara::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function syncAcaraItems(Request $request, $id)
    {
        $acara = KeuanganAcara::findOrFail($id);
        $items = $request->input('items', []);

        // Get existing item IDs to know which ones to delete
        $existingIds = $acara->items()->pluck('id')->toArray();
        $receivedIds = collect($items)->pluck('id')->filter()->toArray();

        $idsToDelete = array_diff($existingIds, $receivedIds);
        if (!empty($idsToDelete)) {
            $acara->items()->whereIn('id', $idsToDelete)->delete();
        }

        // Update or Create
        foreach ($items as $itemData) {
            $data = [
                'tanggal' => $itemData['tanggal'] ? date('Y-m-d', strtotime($itemData['tanggal'])) : null,
                'uraian' => $itemData['uraian'] ?? null,
                'kategori' => $itemData['kategori'] ?? null,
                'tipe' => $itemData['tipe'] ?? 'Pengeluaran',
                'nilai' => $itemData['nilai'] ?? 0,
                'keterangan' => $itemData['keterangan'] ?? null,
            ];

            if (isset($itemData['id']) && in_array($itemData['id'], $existingIds)) {
                $item = $acara->items()->find($itemData['id']);
                if ($item) $item->update($data);
            } else {
                $acara->items()->create($data);
            }
        }

        return response()->json([
            'success' => true, 
            'items' => $acara->items()->get()
        ]);
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'uraian_kegiatan' => 'required|string|max:255',
            'jenis' => 'required|in:perangkat,jaringan,sistem',
            'kode' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:100',
            'nilai' => 'required|numeric|min:0',
        ]);

        Keuangan::create($request->all());

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil ditambahkan.');
    }

    public function edit(Keuangan $keuangan)
    {
        return view('admin.keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'uraian_kegiatan' => 'required|string|max:255',
            'jenis' => 'required|in:perangkat,jaringan,sistem',
            'kode' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:100',
            'nilai' => 'required|numeric|min:0',
        ]);

        $keuangan->update($request->all());

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil dihapus.');
    }

    public function pagu(Request $request)
    {
        $request->validate([
            'pagu_anggaran' => 'required|numeric|min:0',
        ]);

        PaguAnggaran::updateOrCreate(
            ['tahun' => date('Y')],
            ['pagu_anggaran' => $request->pagu_anggaran]
        );

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Pagu anggaran berhasil diperbarui.');
    }

    public function rekap(Request $request)
    {
        $periode = $request->query('periode', 'bulanan');
        $tahun = $request->query('tahun', date('Y'));

        $query = KeuanganAcaraItem::query();

        $dbDriver = \Illuminate\Support\Facades\DB::connection()->getDriverName();

        if ($periode === 'mingguan') {
            if ($dbDriver === 'sqlite') {
                $data = $query->selectRaw("strftime('%Y-W%W', tanggal) as periode, SUM(CASE WHEN tipe='Pemasukan' THEN nilai ELSE 0 END) as pemasukan, SUM(CASE WHEN tipe='Pengeluaran' THEN nilai ELSE 0 END) as pengeluaran")
                    ->whereRaw("strftime('%Y', tanggal) = ?", [$tahun])
                    ->groupByRaw("strftime('%Y-W%W', tanggal)")
                    ->orderByRaw("strftime('%Y-W%W', tanggal)")
                    ->get();
            } else {
                $data = $query->selectRaw('YEARWEEK(tanggal, 1) as periode, SUM(CASE WHEN tipe="Pemasukan" THEN nilai ELSE 0 END) as pemasukan, SUM(CASE WHEN tipe="Pengeluaran" THEN nilai ELSE 0 END) as pengeluaran')
                    ->whereYear('tanggal', $tahun)
                    ->groupByRaw('YEARWEEK(tanggal, 1)')
                    ->orderByRaw('YEARWEEK(tanggal, 1)')
                    ->get();
            }
        } elseif ($periode === 'tahunan') {
            if ($dbDriver === 'sqlite') {
                $data = $query->selectRaw("strftime('%Y', tanggal) as periode, SUM(CASE WHEN tipe='Pemasukan' THEN nilai ELSE 0 END) as pemasukan, SUM(CASE WHEN tipe='Pengeluaran' THEN nilai ELSE 0 END) as pengeluaran")
                    ->groupByRaw("strftime('%Y', tanggal)")
                    ->orderByRaw("strftime('%Y', tanggal)")
                    ->get();
            } else {
                $data = $query->selectRaw('YEAR(tanggal) as periode, SUM(CASE WHEN tipe="Pemasukan" THEN nilai ELSE 0 END) as pemasukan, SUM(CASE WHEN tipe="Pengeluaran" THEN nilai ELSE 0 END) as pengeluaran')
                    ->groupByRaw('YEAR(tanggal)')
                    ->orderByRaw('YEAR(tanggal)')
                    ->get();
            }
        } else { // bulanan
            if ($dbDriver === 'sqlite') {
                $data = $query->selectRaw("strftime('%Y-%m', tanggal) as periode, SUM(CASE WHEN tipe='Pemasukan' THEN nilai ELSE 0 END) as pemasukan, SUM(CASE WHEN tipe='Pengeluaran' THEN nilai ELSE 0 END) as pengeluaran")
                    ->whereRaw("strftime('%Y', tanggal) = ?", [$tahun])
                    ->groupByRaw("strftime('%Y-%m', tanggal)")
                    ->orderByRaw("strftime('%Y-%m', tanggal)")
                    ->get();
            } else {
                $data = $query->selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as periode, SUM(CASE WHEN tipe="Pemasukan" THEN nilai ELSE 0 END) as pemasukan, SUM(CASE WHEN tipe="Pengeluaran" THEN nilai ELSE 0 END) as pengeluaran')
                    ->whereYear('tanggal', $tahun)
                    ->groupByRaw('DATE_FORMAT(tanggal, "%Y-%m")')
                    ->orderByRaw('DATE_FORMAT(tanggal, "%Y-%m")')
                    ->get();
            }
        }

        $totalPemasukan = $data->sum('pemasukan');
        $totalPengeluaran = $data->sum('pengeluaran');

        return view('admin.keuangan.rekap', compact('data', 'periode', 'tahun', 'totalPemasukan', 'totalPengeluaran'));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = KeuanganAcaraItem::with('acara.source');
        if ($startDate) $query->where('tanggal', '>=', $startDate);
        if ($endDate) $query->where('tanggal', '<=', $endDate);

        $items = $query->orderBy('tanggal', 'desc')->get();
        $totalPemasukan = $items->where('tipe', 'Pemasukan')->sum('nilai');
        $totalPengeluaran = $items->where('tipe', 'Pengeluaran')->sum('nilai');

        return view('admin.keuangan.pdf', compact('items', 'startDate', 'endDate', 'totalPemasukan', 'totalPengeluaran'));
    }
}
