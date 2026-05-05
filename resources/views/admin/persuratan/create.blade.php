@extends('layouts.admin')
@section('title', 'Tambah Surat - Admin SIMTIK')
@section('page-title', 'Tambah Surat')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Tambah Surat</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.persuratan.store') }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf
            <div class="form-group"><label>Tipe Surat *</label>
                <select name="tipe" id="tipeSurat" class="form-control" required onchange="toggleTipe()">
                    <option value="masuk" {{ old('tipe')=='masuk'?'selected':'' }}>Surat Masuk</option>
                    <option value="keluar" {{ old('tipe')=='keluar'?'selected':'' }}>Surat Keluar</option>
                </select>
            </div>

            <div class="form-group"><label>Nomor Surat *</label>
                <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}" required>
            </div>

            <div class="form-group"><label>Tanggal Surat *</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>

            <div class="form-group"><label>Jenis Surat *</label>
                <select name="jenis_surat" class="form-control" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Surat Perintah" {{ old('jenis_surat')=='Surat Perintah'?'selected':'' }}>Surat Perintah</option>
                    <option value="Jukrah" {{ old('jenis_surat')=='Jukrah'?'selected':'' }}>Jukrah</option>
                    <option value="Surat Telegram" {{ old('jenis_surat')=='Surat Telegram'?'selected':'' }}>Surat Telegram</option>
                    <option value="Nota Dinas" {{ old('jenis_surat')=='Nota Dinas'?'selected':'' }}>Nota Dinas</option>
                    <option value="Surat Biasa" {{ old('jenis_surat')=='Surat Biasa'?'selected':'' }}>Surat Biasa</option>
                </select>
            </div>

            <div class="form-group"><label id="labelTentang">Tentang atau Perihal *</label>
                <input type="text" name="perihal" class="form-control" value="{{ old('perihal') }}" required>
            </div>

            <div class="form-group" id="groupDari"><label>Dari *</label>
                <input type="text" name="dari" id="inputDari" class="form-control" value="{{ old('dari') }}">
            </div>

            <div class="form-group" id="groupKepada" style="display:none;"><label>Kepada *</label>
                <input type="text" name="kepada" id="inputKepada" class="form-control" value="{{ old('kepada') }}">
            </div>

            <div class="form-group"><label>Keterangan Tambahan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
            </div>

            <div class="form-group"><label>File PDF</label>
                <input type="file" name="file_pdf" class="form-control" accept=".pdf">
            </div>

            <div style="display:flex;gap:10px;margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.persuratan.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
function toggleTipe() {
    const tipe = document.getElementById('tipeSurat').value;
    const gDari = document.getElementById('groupDari');
    const gKepada = document.getElementById('groupKepada');
    const iDari = document.getElementById('inputDari');
    const iKepada = document.getElementById('inputKepada');

    if(tipe === 'masuk') {
        gDari.style.display = 'block';
        gKepada.style.display = 'none';
        iDari.required = true;
        iKepada.required = false;
    } else {
        gDari.style.display = 'none';
        gKepada.style.display = 'block';
        iDari.required = false;
        iKepada.required = true;
    }
}
document.addEventListener('DOMContentLoaded', toggleTipe);
</script>
@endsection
