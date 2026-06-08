@extends('layouts.admin')
@section('title', 'Edit Rencana - Admin SIMTIK')
@section('page-title', 'Edit Rencana')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Edit Rencana</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.rencana-kegiatan.update', $rencana->id) }}" style="max-width:600px;">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Tipe Rencana *</label>
                <select name="tipe" id="tipeSelect" class="form-control" required>
                    <option value="kegiatan" {{ old('tipe', $rencana->tipe) == 'kegiatan' ? 'selected' : '' }}>Rencana Kegiatan</option>
                    <option value="berita" {{ old('tipe', $rencana->tipe) == 'berita' ? 'selected' : '' }}>Rencana Berita</option>
                </select>
                @error('tipe')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label id="nameLabel">Nama Kegiatan *</label>
                <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $rencana->nama_kegiatan) }}" required>
                @error('nama_kegiatan')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label>Tanggal Rencana *</label>
                <input type="date" name="tanggal_rencana" class="form-control" value="{{ old('tanggal_rencana', $rencana->tanggal_rencana->format('Y-m-d')) }}" required>
                @error('tanggal_rencana')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" id="tempatGroup">
                <label>Tempat / Lokasi *</label>
                <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $rencana->tempat) }}">
                @error('tempat')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" id="kategoriGroup" style="display:none;">
                <label>Kategori Berita *</label>
                <select name="kategori" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Informasi" {{ old('kategori', $rencana->kategori) == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                    <option value="Kegiatan" {{ old('kategori', $rencana->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Pengumuman" {{ old('kategori', $rencana->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Prestasi" {{ old('kategori', $rencana->kategori) == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                    <option value="Lainnya" {{ old('kategori', $rencana->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kategori')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Keterangan / Deskripsi</label>
                <textarea name="keterangan" class="form-control" rows="4" placeholder="Detail deskripsi rencana kegiatan atau berita">{{ old('keterangan', $rencana->keterangan) }}</textarea>
                @error('keterangan')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Status *</label>
                <select name="status" class="form-control" required>
                    <option value="dijadwalkan" {{ old('status', $rencana->status) == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                    <option value="selesai" {{ old('status', $rencana->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ old('status', $rencana->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
                @error('status')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div style="display:flex; gap:10px; margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.rencana-kegiatan.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeSelect = document.getElementById('tipeSelect');
        const tempatGroup = document.getElementById('tempatGroup');
        const kategoriGroup = document.getElementById('kategoriGroup');
        const nameLabel = document.getElementById('nameLabel');
        const tempatInput = tempatGroup.querySelector('input');
        const kategoriSelect = kategoriGroup.querySelector('select');

        function toggleFields() {
            if (tipeSelect.value === 'berita') {
                tempatGroup.style.display = 'none';
                kategoriGroup.style.display = 'block';
                nameLabel.textContent = 'Judul Rencana Berita *';
                tempatInput.required = false;
                kategoriSelect.required = true;
            } else {
                tempatGroup.style.display = 'block';
                kategoriGroup.style.display = 'none';
                nameLabel.textContent = 'Nama Kegiatan *';
                tempatInput.required = true;
                kategoriSelect.required = false;
            }
        }

        tipeSelect.addEventListener('change', toggleFields);
        toggleFields(); // Initial call
    });
</script>
@endsection
