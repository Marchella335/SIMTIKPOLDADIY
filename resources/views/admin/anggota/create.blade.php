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
                    <input type="text" name="pangkat" class="form-control" value="{{ old('pangkat') }}" required placeholder="Contoh: KOMPOL, BRIPKA, PNS, dll.">
                </div>
            </div>

            <div class="form-group">
                <label>Bidang *</label>
                <select name="bidang" id="selectBidang" class="form-control" required>
                    <option value="">-- Pilih Bidang --</option>
                    <option value="TIK" {{ (old('bidang', $bidang))=='TIK'?'selected':'' }}>TIK</option>
                    <option value="Renmin" {{ (old('bidang', $bidang))=='Renmin'?'selected':'' }}>Renmin</option>
                    <option value="Tekkom" {{ (old('bidang', $bidang))=='Tekkom'?'selected':'' }}>Tekkom</option>
                    <option value="Tekinfo" {{ (old('bidang', $bidang))=='Tekinfo'?'selected':'' }}>Tekinfo</option>
                </select>
                @error('bidang')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Jabatan *</label>
                <select name="jabatan" class="form-control" required>
                    <option value="">-- Pilih Jabatan --</option>
                    @if($jabatans->where('bidang', 'Renmin')->count() > 0)
                        <optgroup label="RENMIN">
                            @foreach($jabatans->where('bidang', 'Renmin') as $j)
                                <option value="{{ $j->nama_jabatan }}" {{ old('jabatan') == $j->nama_jabatan ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                    @if($jabatans->where('bidang', 'Tekkom')->count() > 0)
                        <optgroup label="TEKKOM">
                            @foreach($jabatans->where('bidang', 'Tekkom') as $j)
                                <option value="{{ $j->nama_jabatan }}" {{ old('jabatan') == $j->nama_jabatan ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                    @if($jabatans->where('bidang', 'Tekinfo')->count() > 0)
                        <optgroup label="TEKINFO">
                            @foreach($jabatans->where('bidang', 'Tekinfo') as $j)
                                <option value="{{ $j->nama_jabatan }}" {{ old('jabatan') == $j->nama_jabatan ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                    @if($jabatans->whereNull('bidang')->count() > 0)
                        <optgroup label="GLOBAL / LAINNYA">
                            @foreach($jabatans->whereNull('bidang') as $j)
                                <option value="{{ $j->nama_jabatan }}" {{ old('jabatan') == $j->nama_jabatan ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                </select>
                @error('jabatan')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Awal Jabatan</label>
                    <input type="date" name="awal_jabatan" class="form-control" value="{{ old('awal_jabatan') }}">
                    @error('awal_jabatan')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Akhir Jabatan</label>
                    <input type="date" name="akhir_jabatan" class="form-control" value="{{ old('akhir_jabatan') }}">
                    @error('akhir_jabatan')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                @error('foto')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div style="display:flex;gap:10px;margin-top:25px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.anggota.index', ['bidang' => $bidang]) }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
