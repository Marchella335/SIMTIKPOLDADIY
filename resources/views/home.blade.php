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

{{-- RATING LAYANAN --}}
<section class="section section-dark" id="rating-layanan">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Indeks Kepuasan Layanan</div>
            <h2 class="section-title">Hasil Rating Layanan TIK</h2>
            <p class="section-subtitle">Penilaian langsung dari pengguna layanan Bidang TIK Polda DIY</p>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start; margin-bottom:50px;">
            {{-- LEFT: Big Rating Overview --}}
            <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:20px; padding:40px; text-align:center; position:relative; overflow:hidden;">
                {{-- Decorative glow --}}
                <div style="position:absolute; top:-60px; right:-60px; width:180px; height:180px; background:radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%); border-radius:50%;"></div>
                <div style="position:absolute; bottom:-40px; left:-40px; width:120px; height:120px; background:radial-gradient(circle, rgba(245,158,11,0.1) 0%, transparent 70%); border-radius:50%;"></div>

                <div style="position:relative; z-index:1;">
                    <div style="font-size:4.5rem; font-weight:900; font-family:'Poppins',sans-serif; background:linear-gradient(135deg, #f59e0b, #f97316); -webkit-background-clip:text; -webkit-text-fill-color:transparent; line-height:1;">
                        {{ $ratingData['avg'] > 0 ? number_format($ratingData['avg'], 1) : '—' }}
                    </div>
                    <div style="display:flex; justify-content:center; gap:4px; margin:12px 0 8px;">
                        @for($s = 1; $s <= 5; $s++)
                            <i class="bi bi-star-fill" style="font-size:1.5rem; color:{{ $s <= round($ratingData['avg']) ? '#f59e0b' : 'rgba(255,255,255,0.12)' }};"></i>
                        @endfor
                    </div>
                    <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin-bottom:20px;">dari <strong style="color:rgba(255,255,255,0.8);">{{ $ratingData['total'] }}</strong> penilaian</p>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:20px;">
                        <div style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2); padding:16px; border-radius:12px;">
                            <div style="font-size:1.6rem; font-weight:800; color:#10b981; font-family:'Poppins',sans-serif;">{{ $ratingData['completed'] }}</div>
                            <div style="font-size:0.78rem; color:rgba(255,255,255,0.45); margin-top:4px;">Layanan Selesai</div>
                        </div>
                        <div style="background:rgba(99,102,241,0.1); border:1px solid rgba(99,102,241,0.2); padding:16px; border-radius:12px;">
                            <div style="font-size:1.6rem; font-weight:800; color:#6366f1; font-family:'Poppins',sans-serif;">{{ $ratingData['total'] > 0 ? round(($ratingData['total'] / max($ratingData['completed'],1)) * 100) : 0 }}%</div>
                            <div style="font-size:0.78rem; color:rgba(255,255,255,0.45); margin-top:4px;">Response Rate</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Rating Distribution Bars --}}
            <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:20px; padding:40px;">
                <h4 style="font-weight:700; font-family:'Poppins',sans-serif; margin-bottom:24px; font-size:1.1rem;">
                    <i class="bi bi-bar-chart-fill" style="color:var(--accent); margin-right:8px;"></i> Distribusi Rating
                </h4>
                @php $maxCount = max(1, max($ratingData['distribution'])); @endphp
                @foreach($ratingData['distribution'] as $star => $count)
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:14px;">
                    <div style="display:flex; align-items:center; gap:4px; min-width:44px; justify-content:flex-end;">
                        <span style="font-weight:700; font-size:0.95rem; color:rgba(255,255,255,0.85);">{{ $star }}</span>
                        <i class="bi bi-star-fill" style="color:#f59e0b; font-size:0.85rem;"></i>
                    </div>
                    <div style="flex:1; background:rgba(255,255,255,0.06); border-radius:8px; height:14px; overflow:hidden; position:relative;">
                        @php
                            $pct = $ratingData['total'] > 0 ? round(($count / $ratingData['total']) * 100) : 0;
                            $barColors = [5 => '#10b981', 4 => '#34d399', 3 => '#f59e0b', 2 => '#f97316', 1 => '#ef4444'];
                        @endphp
                        <div style="height:100%; width:{{ $pct }}%; background:{{ $barColors[$star] }}; border-radius:8px; transition:width 1.2s cubic-bezier(0.22,1,0.36,1); min-width:{{ $count > 0 ? '6px' : '0' }};"></div>
                    </div>
                    <div style="min-width:50px; text-align:right;">
                        <span style="font-weight:600; font-size:0.85rem; color:rgba(255,255,255,0.7);">{{ $count }}</span>
                        <span style="font-size:0.7rem; color:rgba(255,255,255,0.35); margin-left:2px;">({{ $pct }}%)</span>
                    </div>
                </div>
                @endforeach

                {{-- Satisfaction Summary --}}
                @php
                    $satisfied = ($ratingData['distribution'][5] ?? 0) + ($ratingData['distribution'][4] ?? 0);
                    $satisfiedPct = $ratingData['total'] > 0 ? round(($satisfied / $ratingData['total']) * 100) : 0;
                @endphp
                <div style="margin-top:24px; padding:16px 20px; background:rgba(16,185,129,0.08); border:1px solid rgba(16,185,129,0.15); border-radius:12px; display:flex; align-items:center; justify-content:space-between;">
                    <div>
                        <div style="font-weight:700; font-size:0.9rem; color:rgba(255,255,255,0.85);">Tingkat Kepuasan</div>
                        <div style="font-size:0.78rem; color:rgba(255,255,255,0.45);">Rating 4-5 bintang</div>
                    </div>
                    <div style="font-size:1.8rem; font-weight:900; color:#10b981; font-family:'Poppins',sans-serif;">{{ $satisfiedPct }}%</div>
                </div>
            </div>
        </div>

        {{-- Testimonials Slider --}}
        @if($testimonials->count() > 0)
        <div style="margin-top:10px;">
            <h4 style="font-weight:700; font-family:'Poppins',sans-serif; margin-bottom:24px; text-align:center; font-size:1.1rem;">
                <i class="bi bi-chat-quote-fill" style="color:var(--accent); margin-right:8px;"></i> Testimoni Pengguna Layanan
            </h4>
            <div id="testimonialTrack" style="display:flex; gap:24px; overflow-x:auto; scroll-snap-type:x mandatory; -webkit-overflow-scrolling:touch; padding-bottom:16px; scrollbar-width:thin; scrollbar-color:rgba(255,255,255,0.15) transparent;">
                @foreach($testimonials as $t)
                <div style="min-width:340px; max-width:380px; flex-shrink:0; scroll-snap-align:start; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:16px; padding:28px; position:relative; transition:all 0.3s;">
                    {{-- Quote icon --}}
                    <div style="position:absolute; top:16px; right:20px; font-size:2rem; color:rgba(99,102,241,0.15);">
                        <i class="bi bi-quote"></i>
                    </div>
                    {{-- Stars --}}
                    <div style="display:flex; gap:3px; margin-bottom:14px;">
                        @for($s = 1; $s <= 5; $s++)
                            <i class="bi bi-star-fill" style="font-size:0.9rem; color:{{ $s <= $t->rating ? '#f59e0b' : 'rgba(255,255,255,0.1)' }};"></i>
                        @endfor
                    </div>
                    {{-- Feedback --}}
                    <p style="color:rgba(255,255,255,0.7); font-size:0.92rem; line-height:1.65; margin-bottom:18px; font-style:italic;">"{{ Str::limit($t->feedback, 150) }}"</p>
                    {{-- Author --}}
                    <div style="display:flex; align-items:center; gap:12px; border-top:1px solid rgba(255,255,255,0.06); padding-top:16px;">
                        <div style="width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg, #6366f1, #8b5cf6); display:flex; align-items:center; justify-content:center; font-weight:700; color:#fff; font-size:0.9rem;">
                            {{ strtoupper(substr($t->nama_pemohon, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:600; font-size:0.9rem; color:rgba(255,255,255,0.85);">{{ $t->nama_pemohon }}</div>
                            <div style="font-size:0.78rem; color:rgba(255,255,255,0.4);">{{ $t->jenis_layanan }} &bull; {{ $t->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- Scroll indicators --}}
            @if($testimonials->count() > 2)
            <div style="display:flex; justify-content:center; gap:8px; margin-top:16px;">
                <button onclick="document.getElementById('testimonialTrack').scrollBy({left:-380,behavior:'smooth'})" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.1); color:rgba(255,255,255,0.5); width:36px; height:36px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.3s;" onmouseover="this.style.background='rgba(99,102,241,0.3)'; this.style.color='#fff';" onmouseout="this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.5)';">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button onclick="document.getElementById('testimonialTrack').scrollBy({left:380,behavior:'smooth'})" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.1); color:rgba(255,255,255,0.5); width:36px; height:36px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.3s;" onmouseover="this.style.background='rgba(99,102,241,0.3)'; this.style.color='#fff';" onmouseout="this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.5)';">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
        @else
        <div style="text-align:center; padding:30px; color:rgba(255,255,255,0.4);">
            <i class="bi bi-chat-dots" style="font-size:2.5rem; margin-bottom:12px; display:block; opacity:0.3;"></i>
            <p>Belum ada testimoni dari pengguna layanan.</p>
        </div>
        @endif

        {{-- CTA to submit --}}
        <div style="text-align:center; margin-top:30px;">
            <a href="{{ route('layanan.form') }}" class="btn btn-primary">
                Ajukan Layanan TIK <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- KEGIATAN TERBARU --}}
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Berita & Kegiatan</div>
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

        <div class="section-header">
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
