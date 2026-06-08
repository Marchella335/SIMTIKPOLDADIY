<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RencanaKegiatan;
use Illuminate\Http\Request;

class RencanaKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = RencanaKegiatan::query();

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $rencanaKegiatans = $query->orderBy('tanggal_rencana', 'asc')->paginate(10)->withQueryString();
        return view('admin.rencana-kegiatan.index', compact('rencanaKegiatans'));
    }

    public function create()
    {
        return view('admin.rencana-kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|string|in:kegiatan,berita',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_rencana' => 'required|date',
            'tempat' => 'required_if:tipe,kegiatan|nullable|string|max:255',
            'kategori' => 'required_if:tipe,berita|nullable|string|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|string|in:dijadwalkan,selesai,batal',
        ]);

        $data = $request->all();
        if ($request->tipe === 'berita') {
            $data['tempat'] = null;
        } else {
            $data['kategori'] = null;
        }

        RencanaKegiatan::create($data);

        return redirect()->route('admin.rencana-kegiatan.index')
            ->with('success', 'Rencana berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rencana = RencanaKegiatan::findOrFail($id);
        return view('admin.rencana-kegiatan.edit', compact('rencana'));
    }

    public function update(Request $request, $id)
    {
        $rencana = RencanaKegiatan::findOrFail($id);

        $request->validate([
            'tipe' => 'required|string|in:kegiatan,berita',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_rencana' => 'required|date',
            'tempat' => 'required_if:tipe,kegiatan|nullable|string|max:255',
            'kategori' => 'required_if:tipe,berita|nullable|string|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|string|in:dijadwalkan,selesai,batal',
        ]);

        $data = $request->all();
        if ($request->tipe === 'berita') {
            $data['tempat'] = null;
        } else {
            $data['kategori'] = null;
        }

        $rencana->update($data);

        return redirect()->route('admin.rencana-kegiatan.index')
            ->with('success', 'Rencana berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rencana = RencanaKegiatan::findOrFail($id);
        $rencana->delete();

        return redirect()->route('admin.rencana-kegiatan.index')
            ->with('success', 'Rencana berhasil dihapus.');
    }
}
