@extends('layouts.public')
@section('title', 'SIMTIK POLDA DIY - Bidang TIK')

@section('content')
{{-- HERO SECTION --}}
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <p style="color:var(--accent);font-weight:600;font-size:0.9rem;margin-bottom:10px;">&#9679; Keamanan. Inovasi. Digital.</p>
            <h1>Wujudkan <span class="highlight">Keamanan Digital</span> Bersama Bid TIK Polda DIY</h1>
            <p>Mendukung transformasi digital kepolisian melalui teknologi informasi dan komunikasi yang handal, aman, dan terpercaya.</p>
            <div class="hero-buttons">
                <a href="{{ route('profil') }}" class="btn btn-primary">Profil Kami <i class="fas fa-arrow-right"></i></a>
                <a href="{{ route('kegiatan') }}" class="btn btn-outline">Lihat Kegiatan</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('assets/LOGO_BID_TIK.png') }}" alt="Bid TIK Polda DIY" style="padding:40px;background:rgba(255,255,255,0.08);border-radius:20px;">
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" id="statAnggota">{{ $jumlahAnggota }}</div>
                <div class="stat-label">Anggota Bid TIK</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $jumlahKegiatan }}</div>
                <div class="stat-label">Kegiatan Terlaksana</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $jumlahSuratMasuk + $jumlahSuratKeluar }}</div>
                <div class="stat-label">Total Surat</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" style="font-size: 1.4rem;">Rp {{ number_format($paguTotal, 0, ',', '.') }}</div>
                <div class="stat-label">Total Pagu Anggaran {{ date('Y') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" style="font-size: 1.4rem; color: var(--accent);">Rp {{ number_format($totalRealisasi, 0, ',', '.') }}</div>
                <div class="stat-label">Dana Terrealisasi</div>
            </div>
        </div>
    </div>
</section>

{{-- ABOUT --}}
<section class="section section-dark">
    <div class="container">
        <div class="about-grid">
            <div class="about-image">
                <img src="{{ asset('assets/LOGO_BID_TIK.png') }}" alt="Bid TIK" style="padding:30px;background:rgba(255,255,255,0.05);border-radius:16px;">
            </div>
            <div class="about-content">
                <div class="section-badge" style="margin-bottom:15px;">Tentang Kami</div>
                <h2>Bidang TIK Polda DIY Siap Melayani</h2>
                <p>Bidang Teknologi Informasi dan Komunikasi (Bid TIK) Polda DIY merupakan unsur pelaksana yang bertugas menyelenggarakan teknologi informasi dan komunikasi.</p>
                <p>Kami berkomitmen mendukung tugas-tugas kepolisian melalui pengelolaan infrastruktur TIK yang handal, pengembangan sistem informasi, serta memastikan keamanan siber di lingkungan Polda DIY.</p>
                <a href="{{ route('profil') }}" class="btn btn-primary" style="margin-top:10px;">Selengkapnya <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

{{-- WHY US --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Mengapa Bidang TIK</div>
            <h2 class="section-title">Pelayanan Terbaik untuk Keamanan Digital</h2>
            <p class="section-subtitle">Kami hadir dengan dedikasi tinggi untuk mendukung keamanan dan transformasi digital di lingkungan Polda DIY</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Keamanan Siber</h3>
                <p>Menjaga keamanan sistem informasi dan infrastruktur digital kepolisian dari ancaman siber</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-network-wired"></i></div>
                <h3>Infrastruktur Jaringan</h3>
                <p>Pengelolaan jaringan komunikasi yang handal untuk mendukung operasional kepolisian</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-laptop-code"></i></div>
                <h3>Sistem Informasi</h3>
                <p>Pengembangan dan pengelolaan sistem informasi modern untuk efisiensi pelayanan</p>
            </div>
        </div>
    </div>
</section>

{{-- KEGIATAN TERBARU --}}
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Berita & Kegiatan</div>
            <h2 class="section-title">Kegiatan Terbaru</h2>
        </div>
        <div class="news-list">
            @forelse($kegiatanTerbaru as $k)
            <a href="{{ route('kegiatan.show', $k->id) }}" class="news-item">
                <span class="news-date">{{ $k->tanggal->format('d M Y') }}</span>
                <span class="news-title">{{ $k->nama_kegiatan }}</span>
                <span class="news-arrow"><i class="fas fa-arrow-right"></i></span>
            </a>
            @empty
            <p style="text-align:center;color:var(--gray-500);">Belum ada kegiatan.</p>
            @endforelse
        </div>
        <div style="text-align:center;margin-top:30px;">
            <a href="{{ route('kegiatan') }}" class="btn btn-primary">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <h2>Mulai Perjalanan Menuju Keamanan Digital</h2>
    <p>Bergabunglah bersama kami dalam mewujudkan transformasi digital kepolisian yang aman dan terpercaya.</p>
    <a href="{{ route('kontak') }}" class="btn btn-primary">Hubungi Kami <i class="fas fa-arrow-right"></i></a>
</section>
@endsection
