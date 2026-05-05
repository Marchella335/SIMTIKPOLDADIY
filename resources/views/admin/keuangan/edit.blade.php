@extends('layouts.admin')
@section('title', 'Edit Keuangan - Admin SIMTIK')
@section('page-title', 'Edit Data Keuangan')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Edit Data Keuangan</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.keuangan.update', $keuangan) }}" style="max-width:600px;">
            @csrf @method('PUT')
            <div class="form-row">
                <div class="form-group"><label>Tanggal *</label><input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $keuangan->tanggal->format('Y-m-d')) }}" required></div>
                <div class="form-group"><label>Jenis *</label><select name="jenis" class="form-control" required><option value="perangkat" {{ $keuangan->jenis=='perangkat'?'selected':'' }}>Perangkat</option><option value="jaringan" {{ $keuangan->jenis=='jaringan'?'selected':'' }}>Jaringan</option><option value="sistem" {{ $keuangan->jenis=='sistem'?'selected':'' }}>Sistem</option></select></div>
            </div>
            <div class="form-group"><label>Uraian Kegiatan *</label><input type="text" name="uraian_kegiatan" class="form-control" value="{{ old('uraian_kegiatan', $keuangan->uraian_kegiatan) }}" required></div>
            <div class="form-row">
                <div class="form-group"><label>Kode</label><input type="text" name="kode" class="form-control" value="{{ old('kode', $keuangan->kode) }}"></div>
                <div class="form-group"><label>Status</label><input type="text" name="status" class="form-control" value="{{ old('status', $keuangan->status) }}"></div>
            </div>
            <div class="form-group"><label>Nilai (Rp) *</label><input type="number" name="nilai" class="form-control" value="{{ old('nilai', $keuangan->nilai) }}" required step="0.01" min="0"></div>
            <div style="display:flex;gap:10px;margin-top:25px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button><a href="{{ route('admin.keuangan.index') }}" class="btn btn-outline">Batal</a></div>
        </form>
    </div>
</div>
@endsection
