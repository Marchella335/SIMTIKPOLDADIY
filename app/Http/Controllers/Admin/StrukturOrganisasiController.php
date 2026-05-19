<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturs = StrukturOrganisasi::all();
        $mapped = [];
        foreach ($strukturs as $s) {
            $mapped[$s->bidang] = $s;
        }
        return view('admin.struktur_organisasi.index', compact('mapped'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bidang' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $struktur = StrukturOrganisasi::where('bidang', $request->bidang)->first() ?? new StrukturOrganisasi();
        $struktur->bidang = $request->bidang;

        if ($request->hasFile('foto')) {
            if ($struktur->foto && file_exists(public_path($struktur->foto))) {
                unlink(public_path($struktur->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/struktur'), $filename);
            $struktur->foto = 'uploads/struktur/' . $filename;
        }

        $struktur->save();

        return redirect()->route('admin.struktur.index')->with('success', 'Gambar struktur organisasi berhasil diupdate.');
    }

    public function destroy(StrukturOrganisasi $struktur)
    {
        if ($struktur->foto && file_exists(public_path($struktur->foto))) {
            unlink(public_path($struktur->foto));
        }
        $struktur->delete();
        return redirect()->route('admin.struktur.index')->with('success', 'Gambar struktur organisasi berhasil dihapus.');
    }
}
