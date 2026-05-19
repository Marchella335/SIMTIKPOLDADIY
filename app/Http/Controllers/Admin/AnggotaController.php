<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenureExpirationAlert;

class AnggotaController extends Controller
{
    public function landing()
    {
        return view('admin.anggota.landing');
    }

    public function index()
    {
        $query = Anggota::query();
        
        if (request('bidang')) {
            $query->where('bidang', request('bidang'));
        }

        $anggotas = $query->orderBy('jabatan')->get();
        $bidang = request('bidang');
        
        return view('admin.anggota.index', compact('anggotas', 'bidang'));
    }

    public function create()
    {
        $bidang = request('bidang');
        $jabatans = \App\Models\Jabatan::orderBy('nama_jabatan')->get();
        return view('admin.anggota.create', compact('bidang', 'jabatans'));
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

        $data['akhir_jabatan_notif'] = $request->akhir_jabatan;

        $anggota = Anggota::create($data);

        ActivityLog::log('Create', 'Anggota', $anggota->id, [
            'nama' => $anggota->nama_lengkap,
            'pangkat' => $anggota->pangkat,
        ]);

        // Send notification if tenure is ending in less than 3 months
        if ($anggota->akhir_jabatan) {
            $expiry = \Carbon\Carbon::parse($anggota->akhir_jabatan);
            if ($expiry->isFuture() && $expiry->diffInMonths(now()) < 3) {
                Mail::to('simtikpoldadiy@gmail.com')->send(new TenureExpirationAlert($anggota));
            }
        }

        return redirect()->route('admin.anggota.index', ['bidang' => $anggota->bidang])
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggotum)
    {
        return view('admin.anggota.show', ['anggota' => $anggotum]);
    }

    public function edit(Anggota $anggotum)
    {
        $jabatans = \App\Models\Jabatan::orderBy('nama_jabatan')->get();
        return view('admin.anggota.edit', ['anggota' => $anggotum, 'jabatans' => $jabatans]);
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

        $data['akhir_jabatan_notif'] = $request->akhir_jabatan;

        $anggotum->update($data);

        ActivityLog::log('Update', 'Anggota', $anggotum->id, [
            'nama' => $anggotum->nama_lengkap,
        ]);

        // Send notification if tenure is ending in less than 3 months
        if ($anggotum->akhir_jabatan) {
            $expiry = \Carbon\Carbon::parse($anggotum->akhir_jabatan);
            if ($expiry->isFuture() && $expiry->diffInMonths(now()) < 3) {
                Mail::to('simtikpoldadiy@gmail.com')->send(new TenureExpirationAlert($anggotum));
            }
        }

        return redirect()->route('admin.anggota.index', ['bidang' => $anggotum->bidang])
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggotum)
    {
        if ($anggotum->foto && file_exists(public_path($anggotum->foto))) {
            unlink(public_path($anggotum->foto));
        }
        ActivityLog::log('Delete', 'Anggota', $anggotum->id, [
            'nama' => $anggotum->nama_lengkap,
        ]);
        $bidang = $anggotum->bidang;
        $anggotum->delete();

        return redirect()->route('admin.anggota.index', ['bidang' => $bidang])
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
