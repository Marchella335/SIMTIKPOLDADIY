@extends('layouts.admin')
@section('title', 'Tambah Kegiatan - Admin SIMTIK')
@section('page-title', 'Tambah Kegiatan')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Tambah Kegiatan</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf
            <div class="form-group"><label>Nama Kegiatan *</label><input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}" required>@error('nama_kegiatan')<div class="form-error">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>Tanggal *</label><input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required></div>
<<<<<<< HEAD
            <div class="form-group"><label>Deskripsi *</label><textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi') }}</textarea></div>
            <div class="form-group"><label>Gambar</label><input type="file" name="gambar" class="form-control" accept="image/*"></div>
            <div class="form-group">
                <label>Tampilkan di Website *</label>
                <select name="tampilkan" class="form-control" required>
                    <option value="1" {{ old('tampilkan', '1') == '1' ? 'selected' : '' }}>Ya (Tampilkan di Homepage & Kegiatan)</option>
                    <option value="0" {{ old('tampilkan') == '0' ? 'selected' : '' }}>Tidak (Hanya Simpan di Admin)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hasil Kegiatan</label>
                <textarea name="hasil" class="form-control" rows="3" placeholder="Hasil atau output dari pelaksanaan kegiatan">{{ old('hasil') }}</textarea>
=======
            <div class="form-group"><label>Keterangan *</label><textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi') }}</textarea></div>
            <div class="form-group"><label>Hasil Kegiatan (Hasil Rapat)</label><textarea name="hasil_rapat" class="form-control" rows="5">{{ old('hasil_rapat') }}</textarea></div>
            
            <div class="form-row">
                <div class="form-group"><label>Gambar / Brosur</label><input type="file" name="gambar" class="form-control" accept="image/*"></div>
                <div class="form-group"><label>Foto Dokumentasi</label><input type="file" name="foto" class="form-control" accept="image/*"></div>
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
            </div>
            <div style="display:flex;gap:10px;margin-top:25px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button><a href="{{ route('admin.kegiatan.index') }}" class="btn btn-outline">Batal</a></div>
        </form>
    </div>
</div>
@endsection
