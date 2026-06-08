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

    public function export(Request $request)
    {
        $query = Surat::query();
        
        if ($request->tipe) {
            $query->where('tipe', $request->tipe);
        }
        if ($request->bidang) {
            $query->where('bidang', $request->bidang);
        }
        
        $surats = $query->orderBy('tanggal', 'desc')->get();
        $bidang = $request->bidang ?? 'Semua Bidang';
        
        $csvFileName = 'Rekap_Surat_' . str_replace(' ', '_', $bidang) . '_' . date('Ymd_His') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
        
        $callback = function() use($surats) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Nomor Surat', 'Agenda Surat', 'Nomor Agenda', 'Tipe', 'Jenis', 'Tanggal', 'Perihal', 'Dari', 'Kepada', 'Disposisi']);
            
            foreach ($surats as $i => $s) {
                fputcsv($file, [
                    $i + 1,
                    $s->nomor_surat,
                    $s->agenda_surat,
                    $s->nomor_agenda,
                    $s->tipe,
                    $s->jenis_surat,
                    $s->tanggal->format('Y-m-d'),
                    $s->perihal,
                    $s->dari,
                    $s->kepada,
                    $s->disposisi
                ]);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        return view('admin.persuratan.create', ['bidang' => request('bidang', 'Renmin')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'agenda_surat' => 'nullable|string|max:255',
            'nomor_agenda' => 'nullable|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'bidang' => 'required|in:Renmin,Tekkom,Tekinfo',
            'jenis_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'dari' => 'nullable|string|max:255',
            'kepada' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'disposisi' => 'nullable|string',
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
            'agenda_surat' => 'nullable|string|max:255',
            'nomor_agenda' => 'nullable|string|max:255',
            'tipe' => 'required|in:masuk,keluar',
            'bidang' => 'required|in:Renmin,Tekkom,Tekinfo',
            'jenis_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'dari' => 'nullable|string|max:255',
            'kepada' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'disposisi' => 'nullable|string',
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
