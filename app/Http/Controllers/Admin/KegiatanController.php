<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\RencanaKegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->paginate(10);

        $kegiatansAll = Kegiatan::orderBy('tanggal', 'asc')->get();
        $trendData = $kegiatansAll->groupBy(function ($d) {
            return \Carbon\Carbon::parse($d->tanggal)->format('M Y');
        })->map(function ($row) {
            return $row->count();
        });

        return view('admin.kegiatan.index', compact('kegiatans', 'trendData'));
    }

    public function create()
    {
        // Ambil rencana kegiatan (tipe=kegiatan) yang statusnya dijadwalkan
        // dan belum punya kegiatan yang terhubung
        $rencanaList = RencanaKegiatan::where('tipe', 'kegiatan')
            ->where('status', 'dijadwalkan')
            ->whereDoesntHave('kegiatan')
            ->orderBy('tanggal_rencana', 'asc')
            ->get();

        return view('admin.kegiatan.create', compact('rencanaList'));
    }

    public function exportPdf(Request $request)
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();
        return view('admin.kegiatan.pdf', compact('kegiatans'));
    }

    public function trend(Request $request)
    {
        $by = $request->query('by', 'month');
        $kegiatans = Kegiatan::orderBy('tanggal', 'asc')->get();

        $totalKegiatan = $kegiatans->count();

        $trendData = [];
        foreach ($kegiatans as $k) {
            $date = \Carbon\Carbon::parse($k->tanggal);
            if ($by === 'date') {
                $key   = $date->format('Y-m-d');
                $label = $date->translatedFormat('d M Y');
            } elseif ($by === 'week') {
                $key   = $date->format('o-\Ww');
                $label = 'Minggu Ke-' . $date->format('W') . ' (' . $date->format('Y') . ')';
            } elseif ($by === 'year') {
                $key   = $date->format('Y');
                $label = $date->format('Y');
            } else {
                $key   = $date->format('Y-m');
                $label = $date->translatedFormat('F Y');
            }

            if (!isset($trendData[$key])) {
                $trendData[$key] = ['label' => $label, 'count' => 0];
            }
            $trendData[$key]['count']++;
        }

        ksort($trendData);

        $labels = array_column($trendData, 'label');
        $counts = array_column($trendData, 'count');

        return view('admin.kegiatan.trend', compact('labels', 'counts', 'by', 'totalKegiatan', 'trendData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rencana_kegiatan_id' => 'required|exists:rencana_kegiatans,id',
            'tanggal'             => 'required|date',
            'deskripsi'           => 'required|string',
            'hasil_rapat'         => 'nullable|string',
            'gambar'              => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tampilkan'           => 'required|boolean',
            'hasil'               => 'nullable|string',
            'foto'                => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Ambil nama kegiatan dari rencana
        $rencana = RencanaKegiatan::findOrFail($request->rencana_kegiatan_id);

        $data = $request->except(['gambar', 'foto']);
        $data['nama_kegiatan'] = $rencana->nama_kegiatan;

        if ($request->hasFile('gambar')) {
            $file     = $request->file('gambar');
            $filename = time() . '_g_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['gambar'] = 'uploads/kegiatan/' . $filename;
        }

        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $filename = time() . '_f_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['foto'] = 'uploads/kegiatan/' . $filename;
        }

        Kegiatan::create($data);

        // Otomatis tandai rencana kegiatan sebagai selesai
        $rencana->update(['status' => 'selesai']);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan dan rencana "' . $rencana->nama_kegiatan . '" otomatis ditandai Selesai.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        // Daftar rencana yang dijadwalkan & belum punya kegiatan (kecuali yang sedang diedit)
        $rencanaList = RencanaKegiatan::where('tipe', 'kegiatan')
            ->where('status', 'dijadwalkan')
            ->whereDoesntHave('kegiatan')
            ->orderBy('tanggal_rencana', 'asc')
            ->get();

        // Sertakan rencana yang saat ini terhubung (meski sudah selesai)
        if ($kegiatan->rencana_kegiatan_id) {
            $current = RencanaKegiatan::find($kegiatan->rencana_kegiatan_id);
            if ($current && !$rencanaList->contains('id', $current->id)) {
                $rencanaList = $rencanaList->prepend($current);
            }
        }

        return view('admin.kegiatan.edit', compact('kegiatan', 'rencanaList'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'rencana_kegiatan_id' => 'required|exists:rencana_kegiatans,id',
            'tanggal'             => 'required|date',
            'deskripsi'           => 'required|string',
            'hasil_rapat'         => 'nullable|string',
            'gambar'              => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tampilkan'           => 'required|boolean',
            'hasil'               => 'nullable|string',
            'foto'                => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $oldRencanaId = $kegiatan->rencana_kegiatan_id;
        $newRencanaId = $request->rencana_kegiatan_id;

        // Jika rencana berubah, kembalikan status rencana lama ke dijadwalkan
        if ($oldRencanaId && $oldRencanaId != $newRencanaId) {
            $oldRencana = RencanaKegiatan::find($oldRencanaId);
            if ($oldRencana) {
                $oldRencana->update(['status' => 'dijadwalkan']);
            }
        }

        $newRencana  = RencanaKegiatan::findOrFail($newRencanaId);

        $data = $request->except(['gambar', 'foto']);
        $data['nama_kegiatan'] = $newRencana->nama_kegiatan;

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && file_exists(public_path($kegiatan->gambar))) {
                unlink(public_path($kegiatan->gambar));
            }
            $file     = $request->file('gambar');
            $filename = time() . '_g_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['gambar'] = 'uploads/kegiatan/' . $filename;
        }

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
                unlink(public_path($kegiatan->foto));
            }
            $file     = $request->file('foto');
            $filename = time() . '_f_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['foto'] = 'uploads/kegiatan/' . $filename;
        }

        $kegiatan->update($data);

        // Tandai rencana baru sebagai selesai
        $newRencana->update(['status' => 'selesai']);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        // Kembalikan status rencana ke dijadwalkan saat kegiatan dihapus
        if ($kegiatan->rencana_kegiatan_id) {
            $rencana = RencanaKegiatan::find($kegiatan->rencana_kegiatan_id);
            if ($rencana) {
                $rencana->update(['status' => 'dijadwalkan']);
            }
        }

        if ($kegiatan->gambar && file_exists(public_path($kegiatan->gambar))) {
            unlink(public_path($kegiatan->gambar));
        }
        if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
            unlink(public_path($kegiatan->foto));
        }
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus dan rencana terkait dikembalikan ke status Dijadwalkan.');
    }
}
