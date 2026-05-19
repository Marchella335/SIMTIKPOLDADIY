<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'link' => 'nullable|string|max:255',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/carousel'), $filename);
            $data['gambar'] = 'uploads/carousel/' . $filename;
        }

        Carousel::create($data);

        return redirect()->route('admin.carousel.index')->with('success', 'Banner carousel berhasil ditambahkan.');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'link' => 'nullable|string|max:255',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($carousel->gambar && file_exists(public_path($carousel->gambar))) {
                unlink(public_path($carousel->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/carousel'), $filename);
            $data['gambar'] = 'uploads/carousel/' . $filename;
        }

        $carousel->update($data);

        return redirect()->route('admin.carousel.index')->with('success', 'Banner carousel berhasil diupdate.');
    }

    public function destroy(Carousel $carousel)
    {
        if ($carousel->gambar && file_exists(public_path($carousel->gambar))) {
            unlink(public_path($carousel->gambar));
        }
        $carousel->delete();
        return redirect()->route('admin.carousel.index')->with('success', 'Banner carousel berhasil dihapus.');
    }
}
