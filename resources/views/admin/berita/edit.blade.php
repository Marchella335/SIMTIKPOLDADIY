@extends('layouts.admin')
@section('title', 'Edit Berita - Admin SIMTIK')
@section('page-title', 'Edit Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Form Edit Berita</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.berita.update', $beritum) }}" enctype="multipart/form-data" style="max-width:800px;">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Judul Berita *</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $beritum->judul) }}" required>
            </div>
            
            <div class="form-group">
                <label>Tanggal *</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $beritum->tanggal) }}" required>
            </div>

            <div class="form-group">
                <label>Foto/Gambar</label>
                @if($beritum->foto)
                    <div style="margin-bottom:10px;">
                        <img src="{{ asset($beritum->foto) }}" alt="Foto Saat Ini" style="max-height:100px; border-radius:4px; border:1px solid var(--gray-200);">
                    </div>
                @endif
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small style="color:var(--gray-500); display:block; margin-top:5px;">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Max 5MB.</small>
            </div>

            <div class="form-group">
                <label>Tampilkan di Website *</label>
                <select name="tampilkan" class="form-control" required>
                    <option value="1" {{ old('tampilkan', $beritum->tampilkan ? '1' : '0') == '1' ? 'selected' : '' }}>Ya (Tampilkan di Homepage & Berita)</option>
                    <option value="0" {{ old('tampilkan', $beritum->tampilkan ? '1' : '0') == '0' ? 'selected' : '' }}>Tidak (Hanya Simpan di Admin)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Konten Berita *</label>
                <textarea name="konten" class="form-control" rows="8" required>{{ old('konten', $beritum->konten) }}</textarea>
            </div>

            <div style="display:flex; gap:10px; margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
