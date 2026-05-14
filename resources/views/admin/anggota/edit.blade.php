@extends('layouts.admin')
@section('title', 'Edit Anggota - Admin SIMTIK')
@section('page-title', 'Edit Anggota')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Edit Anggota</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.anggota.update', $anggota) }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>NRP</label>
                    <input type="text" name="nrp" class="form-control" value="{{ old('nrp', $anggota->nrp) }}">
                </div>
                <div class="form-group">
                    <label>Pangkat *</label>
                    <input type="text" name="pangkat" class="form-control" value="{{ old('pangkat', $anggota->pangkat) }}" required>
                </div>
            </div>
            <div class="form-group">
                <label>Bidang *</label>
                <select name="bidang" id="selectBidang" class="form-control" required onchange="updateJabatan()">
                    <option value="">-- Pilih Bidang --</option>
                    <option value="TIK" {{ old('bidang', $anggota->bidang)=='TIK'?'selected':'' }}>TIK</option>
                    <option value="Renmin" {{ old('bidang', $anggota->bidang)=='Renmin'?'selected':'' }}>Renmin</option>
                    <option value="Tekkom" {{ old('bidang', $anggota->bidang)=='Tekkom'?'selected':'' }}>Tekkom</option>
                    <option value="Tekinfo" {{ old('bidang', $anggota->bidang)=='Tekinfo'?'selected':'' }}>Tekinfo</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jabatan *</label>
                <select name="jabatan" id="selectJabatan" class="form-control" required>
                    <option value="">-- Pilih Jabatan --</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Awal Jabatan</label>
                    <input type="date" name="awal_jabatan" class="form-control" value="{{ old('awal_jabatan', $anggota->awal_jabatan) }}">
                    @error('awal_jabatan')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Akhir Jabatan</label>
                    <input type="date" name="akhir_jabatan" class="form-control" value="{{ old('akhir_jabatan', $anggota->akhir_jabatan) }}">
                    @error('akhir_jabatan')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label>Foto</label>
                @if($anggota->foto)<div style="margin-bottom:10px;"><img src="{{ asset($anggota->foto) }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;"></div>@endif
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

            <div style="display:flex;gap:10px;margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.anggota.index', ['bidang' => $anggota->bidang]) }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
const jabatanOptions = {
    'TIK': ['Kabid TIK'],
    'Renmin': ['Kasubbid Renmin', 'Kaurren', 'Kaurmintu', 'PS. Kaur Keu', 'Ps. Pamin 2', 'Ba. Urkeu', 'BA. Renmin', 'Ba. Urmin'],
    'Tekkom': ['Kasubbid Tekkom', 'Kaur Jarkom', 'PS. Paur Urjarkom', 'PS. Kaurharkan', 'PS. Kauryankom', 'PS. Pauryankom', 'PS. Paur 3 Harkan', 'Pamin 1', 'PS. Pamin 3', 'Ba. Yankom', 'Ps. Pmain 4', 'Ba. Tekkom'],
    'Tekinfo': ['Kasubbid Tekinfo', 'Ps. Kaur Yanduknis', 'Kaurtini', 'PS. Kaurpulahta', 'Ps. Paur Yanduknis', 'Paur 2 Subidtekinfo', 'PS. Paur Subidtekinfo', 'Ba. Tekinfo', 'PNS Tekinfo']
};

function updateJabatan() {
    const bidang = document.getElementById('selectBidang').value;
    const selectJabatan = document.getElementById('selectJabatan');
    const currentJabatan = "{{ old('jabatan', $anggota->jabatan) }}";
    
    // Clear existing options
    selectJabatan.innerHTML = '<option value="">-- Pilih Jabatan --</option>';
    
    if (bidang && jabatanOptions[bidang]) {
        jabatanOptions[bidang].forEach(j => {
            const option = document.createElement('option');
            option.value = j;
            option.text = j;
            if (j === currentJabatan) option.selected = true;
            selectJabatan.appendChild(option);
        });
    }
}

// Trigger on load
document.addEventListener('DOMContentLoaded', updateJabatan);
</script>
@endsection
