@extends('layouts.admin')
@section('title', 'Detail Anggota - Admin SIMTIK')
@section('page-title', 'Detail Anggota')

@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div class="ktp-card">
    <div class="ktp-header">
        <h3>BIDANG TIK POLDA DIY</h3>
        <p style="font-size:0.8rem;color:#6b7280;">Kartu Identitas Anggota</p>
    </div>
    <div class="ktp-body">
        <div class="ktp-photo">
            @if($anggota->foto)
                <img src="{{ asset($anggota->foto) }}" alt="{{ $anggota->nama_lengkap }}">
            @else
                <div class="no-photo"><i class="fas fa-user"></i></div>
            @endif
        </div>
        <div class="ktp-info">
            <table>
                <tr><td>Nama</td><td>: {{ $anggota->nama_lengkap }}</td></tr>
                <tr><td>NRP</td><td>: {{ $anggota->nrp ?? '-' }}</td></tr>
                <tr><td>Pangkat</td><td>: {{ $anggota->pangkat }}</td></tr>
                <tr><td>Jabatan</td><td>: {{ $anggota->jabatan }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection
