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
            return view('admin.jabatan.index', compact('jabatans', 'bidang'));
        }
        
        return view('admin.jabatan.landing');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'bidang' => 'required|string|in:Renmin,Tekkom,Tekinfo'
        ]);
        
        $data = $request->all();
        
        Jabatan::create($data);
        
        return redirect()->route('admin.jabatan.index', ['bidang' => $request->bidang])
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $bidang = $jabatan->bidang ?? 'Global';
        $jabatan->delete();
        return redirect()->route('admin.jabatan.index', ['bidang' => $bidang])
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}
