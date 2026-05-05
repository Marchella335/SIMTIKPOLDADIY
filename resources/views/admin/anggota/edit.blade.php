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
                <label>Jabatan *</label>
                <select name="jabatan" class="form-control" required>
                    <option value="">-- Pilih Jabatan --</option>
                    @php $allJabatan = ['Kabid TIK','Kasubbid Renmin','Kasubbid Tekkom','Kasubbid Tekinfo','Kaurren','Kaurmintu','PS. Kaur Keu','Ps. Pamin 2','Ba. Urkeu','BA. Renmin','Ba. Urmin','Kaur Jarkom','PS. Paur Urjarkom','PS. Kaurharkan','PS. Kauryankom','PS. Pauryankom','PS. Paur 3 Harkan','Pamin 1','PS. Pamin 3','Ba. Yankom','Ps. Pmain 4','Ba. Tekkom','Ps. Kaur Yanduknis','Kaurtini','PS. Kaurpulahta','Ps. Paur Yanduknis','Paur 2 Subidtekinfo','PS. Paur Subidtekinfo','Ba. Tekinfo','PNS Tekinfo']; @endphp
                    @foreach($allJabatan as $j)
                    <option value="{{ $j }}" {{ old('jabatan', $anggota->jabatan)==$j?'selected':'' }}>{{ $j }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Foto</label>
                @if($anggota->foto)<div style="margin-bottom:10px;"><img src="{{ asset($anggota->foto) }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;"></div>@endif
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <div style="display:flex;gap:10px;margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
