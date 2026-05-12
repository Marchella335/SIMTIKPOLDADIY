<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Mail\LayananNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LayananPublicController extends Controller
{
    /**
     * Show the public service request form
     */
    public function index()
    {
        return view('layanan');
    }

    /**
     * Store a new service request from a public user
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'email_pemohon' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'jenis_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $layanan = Layanan::create([
            'nama_pemohon' => $request->nama_pemohon,
            'email_pemohon' => $request->email_pemohon,
            'no_hp' => $request->no_hp,
            'jenis_layanan' => $request->jenis_layanan,
            'deskripsi' => $request->deskripsi,
            'status' => 'Pending',
            'token' => Str::random(40),
        ]);

        // Send email notification to admin
        try {
            Mail::to('simtikpoldadiy@gmail.com')->send(new LayananNotification($layanan));
        } catch (\Exception $e) {
            // Silent fail for email
        }

        return redirect()->route('layanan.form')
            ->with('success', 'Permintaan layanan berhasil dikirim! Kami akan segera menghubungi Anda. Kode tiket: #' . $layanan->id);
    }

    /**
     * Show the rating page (accessed via unique token)
     */
    public function rate($token)
    {
        $layanan = Layanan::where('token', $token)->firstOrFail();
        return view('layanan-rate', compact('layanan'));
    }

    /**
     * Submit rating
     */
    public function submitRate(Request $request, $token)
    {
        $layanan = Layanan::where('token', $token)->firstOrFail();

        if ($layanan->status !== 'Completed') {
            return redirect()->route('layanan.rate', $token)
                ->with('error', 'Layanan belum selesai, rating belum bisa diberikan.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
        ]);

        $layanan->update([
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('layanan.rate', $token)
            ->with('success', 'Terima kasih atas penilaian Anda! Rating berhasil disimpan.');
    }
}
