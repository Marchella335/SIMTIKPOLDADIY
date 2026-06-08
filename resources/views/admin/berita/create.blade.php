@extends('layouts.admin')
@section('title', 'Tambah Berita - Admin SIMTIK')
@section('page-title', 'Tambah Berita Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Form Tambah Berita</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" style="max-width:800px;">
            @csrf
            <div class="form-group">
                <label>Judul Berita *</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
            </div>
            
            <div class="form-group">
                <label>Tanggal *</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label>Foto/Gambar</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Format yang didukung: JPG, JPEG, PNG. Maksimal 5MB.</small>
            </div>

            <div class="form-group">
                <label>Tampilkan di Website *</label>
                <select name="tampilkan" class="form-control" required>
                    <option value="1" {{ old('tampilkan', '1') == '1' ? 'selected' : '' }}>Ya (Tampilkan di Homepage & Berita)</option>
                    <option value="0" {{ old('tampilkan') == '0' ? 'selected' : '' }}>Tidak (Hanya Simpan di Admin)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Konten Berita *</label>
                <textarea name="konten" class="form-control" rows="8" required>{{ old('konten') }}</textarea>
            </div>

            <div style="display:flex; gap:10px; margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
