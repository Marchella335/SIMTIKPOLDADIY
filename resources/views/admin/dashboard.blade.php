@extends('layouts.admin')
@section('title', 'Dashboard - Admin SIMTIK')
@section('page-title', 'Dashboard')

@section('content')
@php
    $hour = date('H');
    if ($hour >= 5 && $hour < 11) {
        $greeting = 'Selamat Pagi';
        $icon = '🌅';
    } elseif ($hour >= 11 && $hour < 15) {
        $greeting = 'Selamat Siang';
        $icon = '☀️';
    } elseif ($hour >= 15 && $hour < 18) {
        $greeting = 'Selamat Sore';
        $icon = '🌇';
    } else {
        $greeting = 'Selamat Malam';
        $icon = '🌙';
    }
@endphp

<div class="welcome-card" style="position:relative; overflow:hidden;">
    <div style="position:absolute;top:0;right:0;bottom:0;width:35%;background:linear-gradient(135deg,transparent,rgba(56,189,248,0.05));pointer-events:none;"></div>
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
        <div>
            <h2>{{ $icon }} {{ $greeting }}, {{ Auth::user()->name }}!</h2>
            <p>Senang melihat Anda kembali. Berikut adalah ringkasan data Bidang TIK Polda DIY hari ini.</p>
        </div>
        <div style="display:flex; align-items:center; gap:14px; background:rgba(0,0,0,0.15); padding:12px 20px; border-radius:12px; border:1px solid rgba(255,255,255,0.08);">
            <span id="weather-icon-admin" style="font-size: 2.2rem; line-height:1;">⛅</span>
            <div>
                <div style="display:flex; align-items:baseline; gap:8px;">
                    <span id="weather-temp-admin" style="font-size: 1.5rem; font-weight: 800; font-family: 'Poppins', sans-serif; color:#fff;">--°C</span>
                    <span id="weather-desc-admin" style="font-size: 0.85rem; color: rgba(255,255,255,0.7); font-weight: 500;">Memuat...</span>
                </div>
                <div style="display:flex; gap:12px; margin-top:4px; font-size:0.78rem; color:rgba(255,255,255,0.45);">
                    <span><i class="fas fa-map-marker-alt"></i> Yogyakarta</span>
                    <span id="weather-wind-admin"><i class="fas fa-wind"></i> --</span>
                    <span id="weather-humidity-admin"><i class="fas fa-tint"></i> --</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dash-grid">
    <div class="dash-card">
        <div class="dash-icon bg-primary"><i class="bi bi-people-fill"></i></div>
        <div class="dash-info">
            <h3>{{ $jumlahAnggota }}</h3>
            <p>Jumlah Anggota <span class="trend-badge trend-up"><i class="bi bi-arrow-up"></i> 2</span></p>
        </div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-success"><i class="bi bi-inbox-fill"></i></div>
        <div class="dash-info">
            <h3>{{ $suratMasuk }}</h3>
            <p>Surat Masuk <span class="trend-badge trend-up"><i class="bi bi-arrow-up"></i> 5</span></p>
        </div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-danger"><i class="bi bi-send-fill"></i></div>
        <div class="dash-info">
            <h3>{{ $suratKeluar }}</h3>
            <p>Surat Keluar <span class="trend-badge trend-down"><i class="bi bi-arrow-down"></i> 3</span></p>
        </div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-info"><i class="bi bi-calendar2-check"></i></div>
        <div class="dash-info">
            <h3>{{ $jumlahKegiatan }}</h3>
            <p>Kegiatan <span class="trend-badge trend-up"><i class="bi bi-arrow-up"></i> 1</span></p>
        </div>
    </div>
    <div class="dash-card">
        <div class="dash-icon" style="background:#dc2626;"><i class="bi bi-wallet2"></i></div>
        <div class="dash-info">
            <h3 style="font-size:1.1rem;">Rp {{ number_format($paguTotal,0,',','.') }}</h3>
            <p>Pagu {{ date('Y') }}</p>
        </div>
    </div>
    <div class="dash-card">
        <div class="dash-icon" style="background:var(--danger);"><i class="bi bi-cash-coin"></i></div>
        <div class="dash-info">
            <h3 style="font-size:1.1rem;">Rp {{ number_format($totalRealisasi,0,',','.') }}</h3>
            <p>Realisasi <span class="trend-badge trend-up" style="background:rgba(220,38,38,0.1); color:var(--danger);">{{ number_format(($totalRealisasi / max($paguTotal,1)) * 100, 1) }}%</span></p>
        </div>
    </div>
</div>

<div class="chart-container">
    <h3>Grafik Keuangan {{ date('Y') }}</h3>
    <canvas id="dashChart" height="80"></canvas>
</div>
@endsection

@section('scripts')
<script>
const labels = [];
const dataPagu = [];
const dataRealisasi = [];

@php
    $sumberDanas = \App\Models\SumberDana::where('tahun', date('Y'))->get();
    foreach($sumberDanas as $sd) {
        $sd->total_realisasi = \App\Models\KeuanganAcaraItem::where('tipe', 'Pengeluaran')
            ->whereHas('acara', function($q) use ($sd) {
                $q->where('sumber_dana_id', $sd->id);
            })->sum('nilai');
    }
@endphp

@foreach($sumberDanas as $sd)
    labels.push('{{ $sd->nama }}');
    dataPagu.push({{ $sd->pagu ?? 0 }});
    dataRealisasi.push({{ $sd->total_realisasi ?? 0 }});
@endforeach

new Chart(document.getElementById('dashChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Pagu Anggaran',
                data: dataPagu,
                backgroundColor: 'rgba(239, 68, 68, 0.85)',
                borderRadius: 4
            },
            {
                label: 'Total Realisasi',
                data: dataRealisasi,
                backgroundColor: 'rgba(59, 130, 246, 0.85)',
                borderRadius: 4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { 
                position: 'top',
                labels: {
                    color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#374151',
                    font: { family: "'Inter', sans-serif" }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#cbd5e1' : '#374151'
                },
                grid: {
                    color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#334155' : '#e5e7eb'
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#cbd5e1' : '#374151',
                    callback: v => 'Rp ' + v.toLocaleString('id-ID')
                },
                grid: {
                    color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#334155' : '#e5e7eb'
                }
            }
        }
    }
});
</script>

<script>
// Real-time Weather — Open-Meteo API (free, no key needed)
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

            // Admin widget
            setEl('weather-temp-admin', Math.round(c.temperature_2m) + '°C');
            setEl('weather-desc-admin', desc);
            setEl('weather-icon-admin', icon);
            setHtml('weather-wind-admin', '<i class="fas fa-wind"></i> ' + Math.round(c.wind_speed_10m) + ' km/h');
            setHtml('weather-humidity-admin', '<i class="fas fa-tint"></i> ' + c.relative_humidity_2m + '%');
        })
        .catch(() => {
            const el = document.getElementById('weather-desc-admin');
            if (el) el.textContent = 'Gagal memuat cuaca';
        });
})();
</script>
@endsection
