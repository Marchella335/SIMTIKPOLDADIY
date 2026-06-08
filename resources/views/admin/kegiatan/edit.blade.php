@extends('layouts.admin')
@section('title', 'Edit Kegiatan - Admin SIMTIK')
@section('page-title', 'Edit Kegiatan')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Edit Kegiatan</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kegiatan.update', $kegiatan) }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf @method('PUT')
            <div class="form-group"><label>Nama Kegiatan *</label><input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" required></div>
            <div class="form-group"><label>Tanggal *</label><input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $kegiatan->tanggal->format('Y-m-d')) }}" required></div>
<<<<<<< HEAD
            <div class="form-group"><label>Deskripsi *</label><textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea></div>
            <div class="form-group"><label>Gambar</label>@if($kegiatan->gambar)<div style="margin-bottom:10px;"><img src="{{ asset($kegiatan->gambar) }}" style="width:120px;height:80px;object-fit:cover;border-radius:8px;"></div>@endif<input type="file" name="gambar" class="form-control" accept="image/*"></div>
            <div class="form-group">
                <label>Tampilkan di Website *</label>
                <select name="tampilkan" class="form-control" required>
                    <option value="1" {{ old('tampilkan', $kegiatan->tampilkan ? '1' : '0') == '1' ? 'selected' : '' }}>Ya (Tampilkan di Homepage & Kegiatan)</option>
                    <option value="0" {{ old('tampilkan', $kegiatan->tampilkan ? '1' : '0') == '0' ? 'selected' : '' }}>Tidak (Hanya Simpan di Admin)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hasil Kegiatan</label>
                <textarea name="hasil" class="form-control" rows="3" placeholder="Hasil atau output dari pelaksanaan kegiatan">{{ old('hasil', $kegiatan->hasil) }}</textarea>
            </div>
=======
            <div class="form-group"><label>Keterangan *</label><textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea></div>
            <div class="form-group"><label>Hasil Kegiatan (Hasil Rapat)</label><textarea name="hasil_rapat" class="form-control" rows="5">{{ old('hasil_rapat', $kegiatan->hasil_rapat) }}</textarea></div>
            
            <div class="form-row">
                <div class="form-group"><label>Gambar / Brosur</label>@if($kegiatan->gambar)<div style="margin-bottom:10px;"><img src="{{ asset($kegiatan->gambar) }}" style="width:120px;height:80px;object-fit:cover;border-radius:8px;"></div>@endif<input type="file" name="gambar" class="form-control" accept="image/*"></div>
                <div class="form-group"><label>Foto Dokumentasi</label>@if($kegiatan->foto)<div style="margin-bottom:10px;"><img src="{{ asset($kegiatan->foto) }}" style="width:120px;height:80px;object-fit:cover;border-radius:8px;"></div>@endif<input type="file" name="foto" class="form-control" accept="image/*"></div>
            </div>
            
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
            <div style="display:flex;gap:10px;margin-top:25px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button><a href="{{ route('admin.kegiatan.index') }}" class="btn btn-outline">Batal</a></div>
        </form>
    </div>
</div>
@endsection
