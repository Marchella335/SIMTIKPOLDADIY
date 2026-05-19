<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index()
    {
        $pangkats = Pangkat::orderBy('nama_pangkat')->get();
        return view('admin.pangkat.index', compact('pangkats'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_pangkat' => 'required|string|max:100']);
        Pangkat::create($request->all());
        return redirect()->route('admin.pangkat.index')->with('success', 'Pangkat berhasil ditambahkan.');
    }

    public function destroy(Pangkat $pangkat)
    {
        $pangkat->delete();
        return redirect()->route('admin.pangkat.index')->with('success', 'Pangkat berhasil dihapus.');
    }
}
