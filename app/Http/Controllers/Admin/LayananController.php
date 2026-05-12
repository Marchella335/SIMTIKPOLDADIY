<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\ActivityLog;
use App\Mail\LayananStatusUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->get();
        $stats = [
            'total' => Layanan::count(),
            'pending' => Layanan::where('status', 'Pending')->count(),
            'in_progress' => Layanan::where('status', 'In Progress')->count(),
            'completed' => Layanan::where('status', 'Completed')->count(),
            'avg_rating' => Layanan::whereNotNull('rating')->avg('rating') ?? 0,
        ];
        return view('admin.layanan.index', compact('layanans', 'stats'));
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $oldStatus = $layanan->status;
        $newStatus = $request->status;
        $layanan->update(['status' => $newStatus]);

        ActivityLog::log('Update', 'Layanan', $layanan->id, [
            'status_change' => $oldStatus . ' → ' . $newStatus,
            'pemohon' => $layanan->nama_pemohon,
        ]);

        // Kirim email ke pemohon jika status berubah ke In Progress atau Completed
        if ($oldStatus !== $newStatus && in_array($newStatus, ['In Progress', 'Completed'])) {
            try {
                Mail::to($layanan->email_pemohon)->send(new LayananStatusUpdate($layanan, $oldStatus));
            } catch (\Exception $e) {
                // Silent fail
            }
        }

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Status layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        ActivityLog::log('Delete', 'Layanan', $layanan->id, [
            'pemohon' => $layanan->nama_pemohon,
        ]);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
