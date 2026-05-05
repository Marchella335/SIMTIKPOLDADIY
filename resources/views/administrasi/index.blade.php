@extends('layouts.public')
@section('title', 'Administrasi - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px;">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Administrasi</div>
            <h2 class="section-title">Layanan Administrasi</h2>
            <p class="section-subtitle">Pilih layanan administrasi yang ingin Anda akses</p>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;max-width:700px;margin:0 auto;">
            <a href="{{ route('administrasi.persuratan') }}" class="feature-card" style="cursor:pointer;">
                <div class="feature-icon"><i class="fas fa-envelope-open-text"></i></div>
                <h3>Persuratan</h3>
                <p>Akses data surat masuk dan surat keluar Bidang TIK Polda DIY</p>
                <div style="margin-top:15px;">
                    <span style="background:#d1fae5;color:#065f46;padding:4px 12px;border-radius:12px;font-size:0.8rem;font-weight:600;">{{ $suratMasuk }} Masuk</span>
                    <span style="background:#fee2e2;color:#991b1b;padding:4px 12px;border-radius:12px;font-size:0.8rem;font-weight:600;">{{ $suratKeluar }} Keluar</span>
                </div>
            </a>
            <a href="{{ route('administrasi.keuangan') }}" class="feature-card" style="cursor:pointer;">
                <div class="feature-icon"><i class="fas fa-chart-bar"></i></div>
                <h3>Keuangan</h3>
                <p>Lihat grafik dan data keuangan Bidang TIK Polda DIY</p>
            </a>
        </div>
    </div>
</section>
@endsection
