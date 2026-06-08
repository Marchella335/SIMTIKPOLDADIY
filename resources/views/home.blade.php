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
            <img src="{{ asset('assets/logo_tik_polri.jpeg') }}" alt="Bid TIK Polda DIY" style="padding:40px;background:rgba(255,255,255,0.08);border-radius:20px;">
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">

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


<<<<<<< HEAD
{{-- KEGIATAN TERBARU --}}
=======
{{-- BERITA TERBARU --}}
@if($showBerita)
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Berita</div>
            <h2 class="section-title">Berita Terbaru</h2>
        </div>
        <div class="kegiatan-grid" style="margin-bottom:60px;">
            @forelse($beritaTerbaru as $b)
            <div class="kegiatan-card">
                <div style="position:relative;">
                    @if($b->foto)
                        <img src="{{ asset($b->foto) }}" alt="{{ $b->judul }}">
                    @else
                        <div style="width:100%;height:200px;background:var(--gray-200);display:flex;align-items:center;justify-content:center;color:var(--gray-500);">
                            <i class="fas fa-newspaper fa-3x"></i>
                        </div>
                    @endif
                    <div style="position:absolute;top:15px;left:15px;background:var(--accent);color:white;padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:600;">Berita</div>
                </div>
                <div class="card-body">
                    <div class="card-date"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }} | <i class="far fa-clock"></i> {{ $b->created_at->format('H:i') }} WIB</div>
                    <h3>{{ Str::limit($b->judul, 45) }}</h3>
                    <p>{{ Str::limit(strip_tags($b->konten), 90) }}</p>
                    <a href="{{ route('berita.show', $b->id) }}" style="display:inline-block;margin-top:12px;color:var(--accent);font-weight:600;font-size:0.85rem;">Baca Selengkapnya <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i></a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align:center; padding: 40px; color:var(--gray-500);">
                <i class="fas fa-newspaper fa-3x" style="margin-bottom:15px; opacity:0.3;"></i>
                <p>Belum ada berita yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endif

{{-- KEGIATAN TERBARU --}}
@if($showKegiatan)
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Kegiatan</div>
            <h2 class="section-title">Kegiatan Terbaru</h2>
        </div>
        <div class="kegiatan-grid">
            @forelse($kegiatanTerbaru as $k)
            <div class="kegiatan-card">
                <div style="position:relative;">
                    @if($k->gambar)
                        <img src="{{ asset($k->gambar) }}" alt="{{ $k->nama_kegiatan }}">
                    @else
                        <div style="width:100%;height:200px;background:var(--gray-200);display:flex;align-items:center;justify-content:center;color:var(--gray-500);">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                    @endif
                    <div style="position:absolute;top:15px;left:15px;background:var(--accent);color:white;padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:600;">Terbaru</div>
                </div>
                <div class="card-body">
                    <div class="card-date"><i class="far fa-calendar-alt"></i> {{ $k->tanggal->format('d M Y') }} | <i class="far fa-clock"></i> {{ $k->created_at->format('H:i') }} WIB</div>
                    <h3>{{ Str::limit($k->nama_kegiatan, 45) }}</h3>
                    <p>{{ Str::limit(strip_tags($k->deskripsi), 90) }}</p>
                    <a href="{{ route('kegiatan.show', $k->id) }}" style="display:inline-block;margin-top:12px;color:var(--accent);font-weight:600;font-size:0.85rem;">Baca Selengkapnya <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i></a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align:center; padding: 40px; color:var(--gray-500);">
                <i class="fas fa-calendar-times fa-3x" style="margin-bottom:15px; opacity:0.3;"></i>
                <p>Belum ada kegiatan yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
        <div style="text-align:center;margin-top:30px;">
            <a href="{{ route('kegiatan') }}" class="btn btn-primary">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="cta-section">
    <h2>Mulai Perjalanan Menuju Keamanan Digital</h2>
    <p>Bergabunglah bersama kami dalam mewujudkan transformasi digital kepolisian yang aman dan terpercaya.</p>
    <a href="{{ route('kontak') }}" class="btn btn-primary">Hubungi Kami <i class="fas fa-arrow-right"></i></a>
</section>

<script>
// Real-time Weather — Open-Meteo API (free, no key)
(function() {
    const WMO_CODES = {
        0: ['Cerah', '☀️'], 1: ['Cerah Berawan', '🌤️'], 2: ['Berawan Sebagian', '⛅'],
        3: ['Mendung', '☁️'], 45: ['Berkabut', '🌫️'], 48: ['Kabut Tebal', '🌫️'],
        51: ['Gerimis Ringan', '🌦️'], 53: ['Gerimis', '🌧️'], 55: ['Gerimis Lebat', '🌧️'],
        61: ['Hujan Ringan', '🌦️'], 63: ['Hujan Sedang', '🌧️'], 65: ['Hujan Lebat', '⛈️'],
        71: ['Salju Ringan', '🌨️'], 73: ['Salju', '❄️'], 75: ['Salju Lebat', '❄️'],
        80: ['Hujan Lokal', '🌦️'], 81: ['Hujan Lokal Sedang', '🌧️'], 82: ['Hujan Lokal Lebat', '⛈️'],
        95: ['Badai Petir', '⛈️'], 96: ['Badai + Hujan Es', '⛈️'], 99: ['Badai Besar', '⛈️']
    };

    fetch('https://api.open-meteo.com/v1/forecast?latitude=-7.7956&longitude=110.3695&current=temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m&timezone=Asia%2FBangkok')
        .then(r => r.json())
        .then(data => {
            const c = data.current;
            const code = c.weather_code;
            const [desc, icon] = WMO_CODES[code] || ['Tidak Diketahui', '🌡️'];

            const setEl = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
            const setHtml = (id, val) => { const el = document.getElementById(id); if (el) el.innerHTML = val; };

            setEl('weather-temp-public', Math.round(c.temperature_2m) + '°C');
            setEl('weather-desc-public', desc);
            setEl('weather-icon-public', icon);
            setHtml('weather-wind-public', '<i class="fas fa-wind"></i> ' + Math.round(c.wind_speed_10m) + ' km/h');
            setHtml('weather-humidity-public', '<i class="fas fa-tint"></i> ' + c.relative_humidity_2m + '%');
        })
        .catch(() => {
            const el = document.getElementById('weather-desc-public');
            if (el) el.textContent = 'Gagal memuat cuaca';
        });
})();
</script>
@endsection
