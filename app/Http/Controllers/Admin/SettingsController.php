<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $showBerita   = Setting::get('show_berita', 1);
        $showKegiatan = Setting::get('show_kegiatan', 1);

        return view('admin.settings', compact('showBerita', 'showKegiatan'));
    }

    public function update(Request $request)
    {
        Setting::set('show_berita',   $request->has('show_berita')   ? 1 : 0);
        Setting::set('show_kegiatan', $request->has('show_kegiatan') ? 1 : 0);

        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
