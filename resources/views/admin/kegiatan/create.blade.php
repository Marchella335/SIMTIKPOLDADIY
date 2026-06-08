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
            <div class="form-group"><label>Keterangan *</label><textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi') }}</textarea></div>
            <div class="form-group"><label>Hasil Kegiatan (Hasil Rapat)</label><textarea name="hasil_rapat" class="form-control" rows="5">{{ old('hasil_rapat') }}</textarea></div>
            
            <div class="form-row">
                <div class="form-group"><label>Gambar / Brosur</label><input type="file" name="gambar" class="form-control" accept="image/*"></div>
                <div class="form-group"><label>Foto Dokumentasi</label><input type="file" name="foto" class="form-control" accept="image/*"></div>
            </div>
            <div style="display:flex;gap:10px;margin-top:25px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button><a href="{{ route('admin.kegiatan.index') }}" class="btn btn-outline">Batal</a></div>
        </form>
    </div>
</div>
@endsection
