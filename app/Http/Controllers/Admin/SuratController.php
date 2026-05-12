<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function landing()
    {
        return view('admin.persuratan.landing');
    }

    public function index()
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

        if (request('bidang')) {
            $query->where('bidang', request('bidang'));
        }

        $surats = $query->orderBy('tanggal', 'desc')->paginate(15);
        $bidang = request('bidang', 'Renmin');

        return view('admin.persuratan.index', compact('surats', 'bidang'));
    }

    public function create()
    {
        return view('admin.persuratan.create', ['bidang' => request('bidang', 'Renmin')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'bidang' => 'required|in:Renmin,Tekkom,Tekinfo',
            'jenis_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'dari' => 'nullable|string|max:255',
            'kepada' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
            'tanggal' => 'required|date',
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/surat'), $filename);
            $data['file_pdf'] = 'uploads/surat/' . $filename;
        }

        Surat::create($data);

        return redirect()->route('admin.persuratan.index', ['bidang' => $request->bidang])
            ->with('success', 'Surat berhasil ditambahkan.');
    }

    public function edit(Surat $persuratan)
    {
        return view('admin.persuratan.edit', ['surat' => $persuratan]);
    }

    public function update(Request $request, Surat $persuratan)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'bidang' => 'required|in:Renmin,Tekkom,Tekinfo',
            'jenis_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'dari' => 'nullable|string|max:255',
            'kepada' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
            'tanggal' => 'required|date',
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            if ($persuratan->file_pdf && file_exists(public_path($persuratan->file_pdf))) {
                unlink(public_path($persuratan->file_pdf));
            }
            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/surat'), $filename);
            $data['file_pdf'] = 'uploads/surat/' . $filename;
        }

        $persuratan->update($data);

        return redirect()->route('admin.persuratan.index', ['bidang' => $request->bidang])
            ->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy(Surat $persuratan)
    {
        if ($persuratan->file_pdf && file_exists(public_path($persuratan->file_pdf))) {
            unlink(public_path($persuratan->file_pdf));
        }
        $bidang = $persuratan->bidang;
        $persuratan->delete();

        return redirect()->route('admin.persuratan.index', ['bidang' => $bidang])
            ->with('success', 'Surat berhasil dihapus.');
    }
}
