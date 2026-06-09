<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $bidang = $request->query('bidang');

        if ($bidang !== null) {
            if ($bidang === 'Global') {
                $jabatans = Jabatan::whereNull('bidang')->orderBy('nama_jabatan')->get();
            } else {
                $jabatans = Jabatan::where('bidang', $bidang)->orderBy('nama_jabatan')->get();
            }

            // Hitung total anggota & kuota untuk bidang ini
            $totalKuota   = $jabatans->sum('kuota');
            $totalAnggota = $jabatans->sum(function ($j) {
                return \App\Models\Anggota::where('jabatan', $j->nama_jabatan)->count();
            });

            return view('admin.jabatan.index', compact('jabatans', 'bidang', 'totalKuota', 'totalAnggota'));
        }

        // Hitung ringkasan per bidang untuk landing page
        $bidangs = ['Renmin', 'Tekkom', 'Tekinfo'];
        $summary = [];
        foreach ($bidangs as $b) {
            $jabatanList = Jabatan::where('bidang', $b)->get();
            $kuota   = $jabatanList->sum('kuota');
            $anggota = $jabatanList->sum(function ($j) {
                return \App\Models\Anggota::where('jabatan', $j->nama_jabatan)->count();
            });
            $summary[$b] = [
                'total_jabatan' => $jabatanList->count(),
                'total_kuota'   => $kuota,
                'total_anggota' => $anggota,
            ];
        }

        return view('admin.jabatan.landing', compact('summary'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'bidang' => 'required|string|in:Renmin,Tekkom,Tekinfo',
            'kuota' => 'required|integer|min:0'
        ]);
        
        $data = $request->all();
        
        Jabatan::create($data);
        
        return redirect()->route('admin.jabatan.index', ['bidang' => $request->bidang])
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'kuota' => 'required|integer|min:0'
        ]);

        $jabatan->update($request->only('nama_jabatan', 'kuota'));

        return redirect()->route('admin.jabatan.index', ['bidang' => $jabatan->bidang])
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function sendAlert(Request $request)
    {
        $jabatans = Jabatan::all();
        $alertData = [];

        foreach ($jabatans as $j) {
            $count = \App\Models\Anggota::where('jabatan', $j->nama_jabatan)->count();
            if ($count < $j->kuota) {
                $alertData[] = [
                    'bidang' => $j->bidang ?? 'Global',
                    'nama_jabatan' => $j->nama_jabatan,
                    'kuota' => $j->kuota,
                    'jumlah_sekarang' => $count,
                    'selisih' => $j->kuota - $count
                ];
            }
        }

        if (count($alertData) > 0) {
            $email = env('MAIL_FROM_ADDRESS', 'admin@simtikpoldadiy.com');
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\KuotaJabatanAlert($alertData));
            return redirect()->back()->with('success', 'Email notifikasi kekurangan kuota berhasil dikirim ke ' . $email);
        }

        return redirect()->back()->with('info', 'Semua jabatan telah memenuhi kuota. Tidak ada email yang dikirim.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $bidang = $jabatan->bidang ?? 'Global';
        $jabatan->delete();
        return redirect()->route('admin.jabatan.index', ['bidang' => $bidang])
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}
