@extends('layouts.admin')
@section('title', 'Tambah Anggota - Admin SIMTIK')
@section('page-title', 'Tambah Anggota')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Tambah Anggota</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.anggota.store') }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                @error('nama_lengkap')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>NRP</label>
                    <input type="text" name="nrp" class="form-control" value="{{ old('nrp') }}">
                </div>
                <div class="form-group">
                    <label>Pangkat *</label>
                    <input type="text" name="pangkat" class="form-control" value="{{ old('pangkat') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label>Jabatan *</label>
                <select name="jabatan" class="form-control" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <optgroup label="Pimpinan">
                        <option {{ old('jabatan')=='Kabid TIK'?'selected':'' }}>Kabid TIK</option>
                    </optgroup>
                    <optgroup label="Kasubbid">
                        <option {{ old('jabatan')=='Kasubbid Renmin'?'selected':'' }}>Kasubbid Renmin</option>
                        <option {{ old('jabatan')=='Kasubbid Tekkom'?'selected':'' }}>Kasubbid Tekkom</option>
                        <option {{ old('jabatan')=='Kasubbid Tekinfo'?'selected':'' }}>Kasubbid Tekinfo</option>
                    </optgroup>
                    <optgroup label="Subbid Renmin">
                        @foreach(['Kaurren','Kaurmintu','PS. Kaur Keu','Ps. Pamin 2','Ba. Urkeu','BA. Renmin','Ba. Urmin'] as $j)
                        <option {{ old('jabatan')==$j?'selected':'' }}>{{ $j }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Subbid Tekkom">
                        @foreach(['Kaur Jarkom','PS. Paur Urjarkom','PS. Kaurharkan','PS. Kauryankom','PS. Pauryankom','PS. Paur 3 Harkan','Pamin 1','PS. Pamin 3','Ba. Yankom','Ps. Pmain 4','Ba. Tekkom'] as $j)
                        <option {{ old('jabatan')==$j?'selected':'' }}>{{ $j }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Subbid Tekinfo">
                        @foreach(['Ps. Kaur Yanduknis','Kaurtini','PS. Kaurpulahta','Ps. Paur Yanduknis','Paur 2 Subidtekinfo','PS. Paur Subidtekinfo','Ba. Tekinfo','PNS Tekinfo'] as $j)
                        <option {{ old('jabatan')==$j?'selected':'' }}>{{ $j }}</option>
                        @endforeach
                    </optgroup>
                </select>
                @error('jabatan')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                @error('foto')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
