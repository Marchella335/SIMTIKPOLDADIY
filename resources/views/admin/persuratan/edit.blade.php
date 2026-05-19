@extends('layouts.admin')
@section('title', 'Edit Surat - Admin SIMTIK')
@section('page-title', 'Edit Surat')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Edit Surat</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.persuratan.update', $surat) }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf @method('PUT')
            
            <div class="form-group"><label>Bidang *</label>
                <select name="bidang" class="form-control" required>
                    <option value="Renmin" {{ old('bidang', $surat->bidang) == 'Renmin' ? 'selected' : '' }}>Renmin</option>
                    <option value="Tekkom" {{ old('bidang', $surat->bidang) == 'Tekkom' ? 'selected' : '' }}>Tekkom</option>
                    <option value="Tekinfo" {{ old('bidang', $surat->bidang) == 'Tekinfo' ? 'selected' : '' }}>Tekinfo</option>
                </select>
            </div>

            <div class="form-group"><label>Tipe Surat *</label>
                <select name="tipe" id="tipeSurat" class="form-control" required onchange="toggleTipe()">
                    <option value="masuk" {{ old('tipe', $surat->tipe)=='masuk'?'selected':'' }}>Surat Masuk</option>
                    <option value="keluar" {{ old('tipe', $surat->tipe)=='keluar'?'selected':'' }}>Surat Keluar</option>
                </select>
            </div>

            <div class="form-group"><label>Nomor Surat *</label>
                <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
            </div>

            <div class="form-group"><label>Tanggal Surat *</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $surat->tanggal->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group"><label>Jenis Surat *</label>
                <select name="jenis_surat" class="form-control" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Surat Perintah" {{ old('jenis_surat', $surat->jenis_surat)=='Surat Perintah'?'selected':'' }}>Surat Perintah</option>
                    <option value="Jukrah" {{ old('jenis_surat', $surat->jenis_surat)=='Jukrah'?'selected':'' }}>Jukrah</option>
                    <option value="Surat Telegram" {{ old('jenis_surat', $surat->jenis_surat)=='Surat Telegram'?'selected':'' }}>Surat Telegram</option>
                    <option value="Nota Dinas" {{ old('jenis_surat', $surat->jenis_surat)=='Nota Dinas'?'selected':'' }}>Nota Dinas</option>
                    <option value="Surat Biasa" {{ old('jenis_surat', $surat->jenis_surat)=='Surat Biasa'?'selected':'' }}>Surat Biasa</option>
                </select>
            </div>

            <div class="form-group"><label id="labelTentang">Tentang atau Perihal *</label>
                <input type="text" name="perihal" class="form-control" value="{{ old('perihal', $surat->perihal) }}" required>
            </div>

            <div class="form-group" id="groupDari" style="{{ $surat->tipe == 'masuk' ? '' : 'display:none;' }}">
                <label>Dari (Sebutkan Jabatan, Pangkat, Nama - pisahkan dengan Enter) *</label>
                <textarea name="dari" id="inputDari" class="form-control" rows="3">{{ old('dari', $surat->dari) }}</textarea>
            </div>

            <div class="form-group" id="groupKepada" style="{{ $surat->tipe == 'keluar' ? '' : 'display:none;' }}">
                <label>Kepada (Sebutkan Jabatan, Pangkat, Nama - pisahkan dengan Enter) *</label>
                <textarea name="kepada" id="inputKepada" class="form-control" rows="3">{{ old('kepada', $surat->kepada) }}</textarea>
            </div>

            <div class="form-group"><label>Keterangan Tambahan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan', $surat->keterangan) }}</textarea>
            </div>

            <div class="form-group"><label>File PDF</label>
                @if($surat->file_pdf)
                    <p style="font-size:0.85rem;margin-bottom:5px;"><a href="{{ asset($surat->file_pdf) }}" target="_blank">Lihat PDF saat ini</a></p>
                @endif
                <input type="file" name="file_pdf" class="form-control" accept=".pdf">
            </div>

            <div style="display:flex;gap:10px;margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.persuratan.index', ['bidang' => $surat->bidang]) }}" class="btn btn-outline">Batal</a>
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
