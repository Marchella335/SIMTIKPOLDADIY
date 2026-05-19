@extends('layouts.admin')
@section('title', 'Tambah Banner Carousel - Admin SIMTIK')
@section('page-title', 'Tambah Slide Banner Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Form Tambah Banner Slide</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.carousel.store') }}" enctype="multipart/form-data" style="max-width:800px;">
            @csrf
            
            <div class="form-group">
                <label>Judul Banner *</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required placeholder="Contoh: Layanan Hubungi Kami Bid TIK">
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Judul utama yang akan ditampilkan melayang tebal di atas banner.</small>
            </div>
            
            <div class="form-group">
                <label>Deskripsi Pendek</label>
                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Contoh: Kami siap melayani pengaduan dan keluhan teknis instansi secara cepat...">{{ old('deskripsi') }}</textarea>
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Penjelasan singkat atau sub-judul (maksimal 160 karakter agar pas).</small>
            </div>

            <div class="form-group">
                <label>Gambar Latar Banner (Background Image) *</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Rasio rekomendasi: 16:9 (lebar). Format: JPG, JPEG, PNG. Maksimal 5MB.</small>
            </div>

            <div class="form-group">
                <label>Link / URL Tujuan Button (Optional)</label>
                <input type="text" name="link" class="form-control" value="{{ old('link') }}" placeholder="Contoh: https://simtikpoldadiy.com/kontak atau /kontak">
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Link eksternal maupun internal tujuan saat tombol "Baca Selengkapnya" diklik.</small>
            </div>

            <div style="display:flex; gap:10px; margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Slide</button>
                <a href="{{ route('admin.carousel.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
