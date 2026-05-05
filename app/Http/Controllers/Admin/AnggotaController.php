<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::orderBy('jabatan')->get();
        return view('admin.anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nrp' => 'nullable|string|max:50',
            'pangkat' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/anggota'), $filename);
            $data['foto'] = 'uploads/anggota/' . $filename;
        }

        Anggota::create($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggotum)
    {
        return view('admin.anggota.show', ['anggota' => $anggotum]);
    }

    public function edit(Anggota $anggotum)
    {
        return view('admin.anggota.edit', ['anggota' => $anggotum]);
    }

    public function update(Request $request, Anggota $anggotum)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nrp' => 'nullable|string|max:50',
            'pangkat' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($anggotum->foto && file_exists(public_path($anggotum->foto))) {
                unlink(public_path($anggotum->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/anggota'), $filename);
            $data['foto'] = 'uploads/anggota/' . $filename;
        }

        $anggotum->update($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggotum)
    {
        if ($anggotum->foto && file_exists(public_path($anggotum->foto))) {
            unlink(public_path($anggotum->foto));
        }
        $anggotum->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
