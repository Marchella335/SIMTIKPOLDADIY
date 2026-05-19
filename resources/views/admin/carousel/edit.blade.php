@extends('layouts.admin')
@section('title', 'Edit Banner Carousel - Admin SIMTIK')
@section('page-title', 'Edit Slide Banner')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Form Edit Banner Slide</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.carousel.update', $carousel) }}" enctype="multipart/form-data" style="max-width:800px;">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Judul Banner *</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $carousel->judul) }}" required>
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Judul utama yang akan ditampilkan melayang tebal di atas banner.</small>
            </div>
            
            <div class="form-group">
                <label>Deskripsi Pendek</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $carousel->deskripsi) }}</textarea>
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Penjelasan singkat atau sub-judul (maksimal 160 karakter agar pas).</small>
            </div>

            <div class="form-group">
                <label>Gambar Latar Banner (Background Image)</label>
                <div style="margin-bottom: 12px; max-width: 320px; border-radius: 8px; overflow: hidden; border: 1px solid var(--gray-200); background:#000;">
                    <img src="{{ asset($carousel->gambar) }}" alt="Banner Saat Ini" style="width:100%; height:auto; display:block;">
                </div>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Biarkan kosong jika tidak ingin mengganti gambar. Rekomendasi: 16:9. Maks 5MB.</small>
            </div>

            <div class="form-group">
                <label>Link / URL Tujuan Button (Optional)</label>
                <input type="text" name="link" class="form-control" value="{{ old('link', $carousel->link) }}" placeholder="Contoh: https://simtikpoldadiy.com/kontak atau /kontak">
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Link eksternal maupun internal tujuan saat tombol "Baca Selengkapnya" diklik.</small>
            </div>

            <div style="display:flex; gap:10px; margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbarui Slide</button>
                <a href="{{ route('admin.carousel.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
