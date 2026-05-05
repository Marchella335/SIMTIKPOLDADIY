<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $data = $request->all();

        try {
            Mail::to('simtikpoldadiy@gmail.com')->send(new ContactMessage($data));
            return back()->with('success', 'Pesan Anda telah berhasil dikirim ke Admin.');
        } catch (\Exception $e) {
            \Log::error('Mail Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim pesan: ' . $e->getMessage())->withInput();
        }
    }
}
