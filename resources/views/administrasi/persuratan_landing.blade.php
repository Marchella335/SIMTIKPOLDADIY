@extends('layouts.public')
@section('title', 'Pilih Bidang Persuratan - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px; min-height: 80vh;">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Persuratan</div>
            <h2 class="section-title">Pilih Bidang</h2>
            <p class="section-subtitle">Silakan pilih bidang untuk melihat data persuratan</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 40px;">
            <!-- RENMIN -->
            <a href="{{ route('administrasi.persuratan', ['bidang' => 'Renmin']) }}" class="feature-card" style="text-align: center; padding: 50px 30px; text-decoration: none; color: inherit;">
                <div class="feature-icon" style="background: rgba(220, 38, 38, 0.1); color: #dc2626; margin: 0 auto 20px;">
                    <i class="bi bi-briefcase"></i>
                </div>
                <h3>RENMIN</h3>
                <p>Urusan Perencanaan dan Administrasi Bid TIK</p>
                <div style="margin-top: 20px; color: #dc2626; font-weight: 600;">Lihat Data <i class="bi bi-arrow-right"></i></div>
            </a>

            <!-- TEKKOM -->
            <a href="{{ route('administrasi.persuratan', ['bidang' => 'Tekkom']) }}" class="feature-card" style="text-align: center; padding: 50px 30px; text-decoration: none; color: inherit;">
                <div class="feature-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; margin: 0 auto 20px;">
                    <i class="bi bi-broadcast"></i>
                </div>
                <h3>TEKKOM</h3>
                <p>Urusan Teknologi Komunikasi Bid TIK</p>
                <div style="margin-top: 20px; color: #3b82f6; font-weight: 600;">Lihat Data <i class="bi bi-arrow-right"></i></div>
            </a>

            <!-- TEKINFO -->
            <a href="{{ route('administrasi.persuratan', ['bidang' => 'Tekinfo']) }}" class="feature-card" style="text-align: center; padding: 50px 30px; text-decoration: none; color: inherit;">
                <div class="feature-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981; margin: 0 auto 20px;">
                    <i class="bi bi-laptop"></i>
                </div>
                <h3>TEKINFO</h3>
                <p>Urusan Teknologi Informasi Bid TIK</p>
                <div style="margin-top: 20px; color: #10b981; font-weight: 600;">Lihat Data <i class="bi bi-arrow-right"></i></div>
            </a>
        </div>
    </div>
</section>
@endsection
