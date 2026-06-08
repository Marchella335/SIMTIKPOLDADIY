<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->paginate(10);
        
        $kegiatansAll = Kegiatan::orderBy('tanggal', 'asc')->get();
        $trendData = $kegiatansAll->groupBy(function($d) {
            return \Carbon\Carbon::parse($d->tanggal)->format('M Y');
        })->map(function($row) {
            return $row->count();
        });
        
        return view('admin.kegiatan.index', compact('kegiatans', 'trendData'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'hasil_rapat' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->except(['gambar', 'foto']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_g_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['gambar'] = 'uploads/kegiatan/' . $filename;
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_f_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['foto'] = 'uploads/kegiatan/' . $filename;
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'hasil_rapat' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->except(['gambar', 'foto']);

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && file_exists(public_path($kegiatan->gambar))) {
                unlink(public_path($kegiatan->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_g_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['gambar'] = 'uploads/kegiatan/' . $filename;
        }

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
                unlink(public_path($kegiatan->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_f_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['foto'] = 'uploads/kegiatan/' . $filename;
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar && file_exists(public_path($kegiatan->gambar))) {
            unlink(public_path($kegiatan->gambar));
        }
        if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
            unlink(public_path($kegiatan->foto));
        }
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
