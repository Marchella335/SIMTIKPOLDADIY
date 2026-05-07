<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenureExpirationAlert;

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
            'bidang' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'awal_jabatan' => 'nullable|date',
            'akhir_jabatan' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/anggota'), $filename);
            $data['foto'] = 'uploads/anggota/' . $filename;
        }

        $anggota = Anggota::create($data);

        // Send notification if tenure is ending in less than 3 months
        if ($anggota->akhir_jabatan) {
            $expiry = \Carbon\Carbon::parse($anggota->akhir_jabatan);
            if ($expiry->isFuture() && $expiry->diffInMonths(now()) < 3) {
                Mail::to('simtikpoldadiy@gmail.com')->send(new TenureExpirationAlert($anggota));
            }
        }

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
            'bidang' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'awal_jabatan' => 'nullable|date',
            'akhir_jabatan' => 'nullable|date',
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

        // Send notification if tenure is ending in less than 3 months
        if ($anggotum->akhir_jabatan) {
            $expiry = \Carbon\Carbon::parse($anggotum->akhir_jabatan);
            if ($expiry->isFuture() && $expiry->diffInMonths(now()) < 3) {
                Mail::to('simtikpoldadiy@gmail.com')->send(new TenureExpirationAlert($anggotum));
            }
        }

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
