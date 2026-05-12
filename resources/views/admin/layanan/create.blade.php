@extends('layouts.admin')
@section('title', 'Buat Tiket Layanan - SIMTIK')
@section('page-title', 'Buat Tiket Layanan')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Permintaan Layanan TIK</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.layanan.store') }}" method="POST">
            @csrf
            <div class="form-group" style="margin-bottom:20px;">
                <label style="font-weight:600; margin-bottom:8px; display:block;">Pemohon (Anggota)</label>
                <select name="anggota_id" required style="width:100%; padding:10px 14px; border:1px solid var(--gray-200); border-radius:8px; font-size:0.95rem;">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($anggotas as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_lengkap }} — {{ $a->pangkat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom:20px;">
                <label style="font-weight:600; margin-bottom:8px; display:block;">Jenis Layanan</label>
                <select name="jenis_layanan" required style="width:100%; padding:10px 14px; border:1px solid var(--gray-200); border-radius:8px; font-size:0.95rem;">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Pengembangan Aplikasi">Pengembangan Aplikasi</option>
                    <option value="Jaringan & Infrastruktur">Jaringan & Infrastruktur</option>
                    <option value="Perbaikan Hardware">Perbaikan Hardware</option>
                    <option value="Instalasi Software">Instalasi Software</option>
                    <option value="Keamanan Siber">Keamanan Siber</option>
                    <option value="Dukungan Teknis Lainnya">Dukungan Teknis Lainnya</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:20px;">
                <label style="font-weight:600; margin-bottom:8px; display:block;">Deskripsi Permasalahan</label>
                <textarea name="deskripsi" rows="5" required style="width:100%; padding:10px 14px; border:1px solid var(--gray-200); border-radius:8px; font-size:0.95rem; resize:vertical;" placeholder="Jelaskan detail permasalahan atau permintaan layanan..."></textarea>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Kirim Tiket</button>
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
