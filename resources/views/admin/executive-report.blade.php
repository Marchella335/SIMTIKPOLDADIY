@extends('layouts.admin')
@section('title', 'Rekapitulasi - SIMTIK')
@section('page-title', 'Rekapitulasi')

@section('content')
<div class="welcome-card" style="background:linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%); color:#fff; border:1px solid rgba(220,38,38,0.3);">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="color:#fff; margin-bottom:5px;"><i class="bi bi-bar-chart-line"></i> Rekapitulasi Data</h2>
            <p style="color:rgba(255,255,255,0.7);">Rangkuman seluruh data SDM, Persuratan, Keuangan, Kegiatan, dan Layanan TIK dalam satu halaman untuk memudahkan pengambilan keputusan.</p>
        </div>
        <div style="text-align:right; display:flex; align-items:center; gap:15px;">
            <button onclick="window.print()" style="background:rgba(16,185,129,0.1); border:1px solid var(--success); color:var(--success); padding:8px 16px; border-radius:30px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:8px; transition:var(--transition);">
                <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
            </button>
            <button id="toggleMonitoring" style="background:rgba(220,38,38,0.1); border:1px solid var(--accent); color:var(--accent); padding:8px 16px; border-radius:30px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:8px; transition:var(--transition);">
                <span class="pulse-red" style="width:8px; height:8px; background:var(--accent); border-radius:50%; display:inline-block;"></span>
                TV Monitoring Mode
            </button>
            <div style="border-left:1px solid rgba(255,255,255,0.1); padding-left:20px;">
                <span style="font-size:0.75rem; color:rgba(255,255,255,0.5); text-transform:uppercase; letter-spacing:1px;">Periode Analisis</span>
                <h3 style="color:var(--accent); font-size:1.5rem; margin:0;">{{ $currentYear }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- PRINT KOP SURAT --}}
<div class="print-header" style="display:none;">
    <div style="text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
        <h1 style="margin: 0; font-size: 22px; text-transform: uppercase;">KEPOLISIAN DAERAH</h1>
        <h2 style="margin: 5px 0; font-size: 18px; color: #333;">DAERAH ISTIMEWA YOGYAKARTA</h2>
        <p style="margin: 0; font-size: 14px;">BIDANG TEKNOLOGI INFORMASI DAN KOMUNIKASI</p>
    </div>
    <h3 style="text-align: center; text-decoration: underline; margin-bottom: 20px; font-size: 16px;">LAPORAN REKAPITULASI EKSEKUTIF - {{ $currentYear }}</h3>
</div>

{{-- RINGKASAN STATISTIK UTAMA --}}
<div style="margin-bottom:30px;">
    <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:15px; display:flex; align-items:center; gap:8px;">
        <span style="width:4px; height:20px; background:var(--accent); border-radius:2px;"></span>
        Statistik Utama & Ringkasan Kinerja Bidang TIK
    </h3>
    <div class="dash-grid">
        <div class="dash-card" style="border-left:3px solid var(--accent);">
            <div class="dash-icon" style="background:var(--accent);"><i class="bi bi-person-badge"></i></div>
            <div class="dash-info">
                <h3>{{ $totalAnggota }}</h3>
                <p>Total Personel TIK</p>
            </div>
        </div>
        <div class="dash-card" style="border-left:3px solid var(--success);">
            <div class="dash-icon bg-success"><i class="bi bi-calendar2-event"></i></div>
            <div class="dash-info">
                <h3>{{ $kegiatanThisYear }}</h3>
                <p>Total Kegiatan</p>
            </div>
        </div>
        <div class="dash-card" style="border-left:3px solid var(--info);">
            <div class="dash-icon bg-info"><i class="bi bi-envelope-paper"></i></div>
            <div class="dash-info">
                <h3>{{ $kpiData['efisiensi_surat'] }}</h3>
                <p>Total Persuratan</p>
            </div>
        </div>
        <div class="dash-card" style="border-left:3px solid var(--warning);">
            <div class="dash-icon bg-warning"><i class="bi bi-cash-coin"></i></div>
            <div class="dash-info">
                <h3>{{ $efisiensiAnggaran }}%</h3>
                <p>Realisasi Anggaran</p>
            </div>
        </div>
    </div>
</div>

{{-- ROW 1: SDM & Keuangan --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:30px;">
    {{-- SDM Module --}}
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-people" style="color:var(--accent); margin-right:8px;"></i> Modul SDM — Distribusi Anggota</h3>
        </div>
        <div class="card-body">
            <canvas id="sdmChart" height="200"></canvas>
            <div style="margin-top:15px; display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                @foreach($anggotaByBidang as $bidang => $total)
                <div style="display:flex; justify-content:space-between; padding:8px 12px; background:var(--gray-50); border-radius:8px; font-size:0.85rem;">
                    <span style="font-weight:600;">{{ $bidang }}</span>
                    <span style="color:var(--accent); font-weight:700;">{{ $total }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Keuangan Module --}}
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-cash-stack" style="color:var(--accent); margin-right:8px;"></i> Modul Keuangan — Pagu vs Realisasi</h3>
        </div>
        <div class="card-body">
            <canvas id="keuanganChart" height="200"></canvas>
            <div style="margin-top:15px; display:flex; justify-content:space-between; padding:12px; background:var(--gray-50); border-radius:8px;">
                <div style="text-align:center;">
                    <small style="color:var(--gray-500);">Total Pagu</small>
                    <p style="font-weight:700; color:var(--accent);">Rp {{ number_format($totalPagu, 0, ',', '.') }}</p>
                </div>
                <div style="text-align:center;">
                    <small style="color:var(--gray-500);">Total Realisasi</small>
                    <p style="font-weight:700;">Rp {{ number_format($totalRealisasi, 0, ',', '.') }}</p>
                </div>
                <div style="text-align:center;">
                    <small style="color:var(--gray-500);">Sisa Anggaran</small>
                    <p style="font-weight:700; color:var(--success);">Rp {{ number_format($totalPagu - $totalRealisasi, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ROW 2: Persuratan Trend & Year-over-Year Comparison --}}
<div style="display:grid; grid-template-columns:2fr 1fr; gap:20px; margin-bottom:30px;">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-graph-up" style="color:var(--accent); margin-right:8px;"></i> Tren Persuratan {{ $currentYear }} — Historical Data</h3>
        </div>
        <div class="card-body">
            <canvas id="suratTrendChart" height="120"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-arrow-left-right" style="color:var(--accent); margin-right:8px;"></i> Analisa Pertumbuhan Tahunan (YoY)</h3>
        </div>
        <div class="card-body">
            <div style="space-y:15px;">
                <div style="padding:12px; background:var(--gray-50); border-radius:8px; margin-bottom:10px;">
                    <small style="color:var(--gray-500);">Surat Masuk</small>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:5px;">
                        <span>{{ $lastYear }}: <strong>{{ $suratMasukLastYear }}</strong></span>
                        <span>{{ $currentYear }}: <strong style="color:var(--accent);">{{ $suratMasukThisYear }}</strong></span>
                    </div>
                    @php $changeMasuk = $suratMasukLastYear > 0 ? round((($suratMasukThisYear - $suratMasukLastYear) / $suratMasukLastYear) * 100, 1) : 0; @endphp
                    <span class="trend-badge {{ $changeMasuk >= 0 ? 'trend-up' : 'trend-down' }}" style="margin-top:8px;">
                        <i class="bi bi-arrow-{{ $changeMasuk >= 0 ? 'up' : 'down' }}"></i> {{ abs($changeMasuk) }}%
                    </span>
                </div>
                <div style="padding:12px; background:var(--gray-50); border-radius:8px; margin-bottom:10px;">
                    <small style="color:var(--gray-500);">Surat Keluar</small>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:5px;">
                        <span>{{ $lastYear }}: <strong>{{ $suratKeluarLastYear }}</strong></span>
                        <span>{{ $currentYear }}: <strong style="color:var(--accent);">{{ $suratKeluarThisYear }}</strong></span>
                    </div>
                    @php $changeKeluar = $suratKeluarLastYear > 0 ? round((($suratKeluarThisYear - $suratKeluarLastYear) / $suratKeluarLastYear) * 100, 1) : 0; @endphp
                    <span class="trend-badge {{ $changeKeluar >= 0 ? 'trend-up' : 'trend-down' }}" style="margin-top:8px;">
                        <i class="bi bi-arrow-{{ $changeKeluar >= 0 ? 'up' : 'down' }}"></i> {{ abs($changeKeluar) }}%
                    </span>
                </div>
                <div style="padding:12px; background:var(--gray-50); border-radius:8px;">
                    <small style="color:var(--gray-500);">Kegiatan</small>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:5px;">
                        <span>{{ $lastYear }}: <strong>{{ $kegiatanLastYear }}</strong></span>
                        <span>{{ $currentYear }}: <strong style="color:var(--accent);">{{ $kegiatanThisYear }}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div style="text-align:center; padding:20px; color:var(--gray-500); font-size:0.8rem;">
    <i class="bi bi-shield-check"></i> Data diproses melalui Data Warehouse SIMTIK — Terakhir diperbarui: {{ now()->format('d M Y H:i') }} WIB
</div>
@endsection

@section('scripts')
<style>
    .pulse-red { animation: pulse-red 2s infinite; }
    @keyframes pulse-red { 0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); } 70% { box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); } 100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); } }
    
    body.monitoring-mode { background: #000 !important; color: #fff !important; }
    body.monitoring-mode .admin-sidebar, body.monitoring-mode .admin-header { display: none !important; }
    body.monitoring-mode .admin-content { margin-left: 0 !important; padding: 20px !important; }
    body.monitoring-mode .card { background: #0a0a0a !important; border: 1px solid rgba(255,255,255,0.05) !important; }
    body.monitoring-mode .card-header { background: #111 !important; border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
    body.monitoring-mode .card-body { color: #ccc !important; }
    body.monitoring-mode .dash-card { background: #0a0a0a !important; border: 1px solid rgba(255,255,255,0.1) !important; }

    @media print {
        @page { size: A4 portrait; margin: 15mm; }
        body { background: #fff !important; color: #000 !important; font-family: 'Arial', sans-serif !important; }
        .admin-sidebar, .admin-header, button, .pulse-red, .welcome-card, .footer { display: none !important; }
        .admin-content { margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; }
        
        .print-header { display: block !important; }
        
        /* Grid resets */
        .dash-grid { display: grid !important; grid-template-columns: repeat(4, 1fr) !important; gap: 10px !important; margin-bottom: 20px !important; }
        .dash-card { border: 1px solid #ccc !important; box-shadow: none !important; padding: 10px !important; break-inside: avoid; background: #fff !important; }
        .dash-icon { display: none !important; }
        .dash-info h3 { font-size: 18px !important; color: #000 !important; margin: 0 !important; }
        .dash-info p { font-size: 12px !important; color: #333 !important; }
        
        /* Rows structure */
        div[style*="display:grid; grid-template-columns:1fr 1fr"] { display: grid !important; grid-template-columns: 1fr 1fr !important; gap: 15px !important; }
        div[style*="display:grid; grid-template-columns:2fr 1fr"] { display: grid !important; grid-template-columns: 2fr 1fr !important; gap: 15px !important; }
        div[style*="display:grid; grid-template-columns:repeat(4, 1fr)"] { display: grid !important; grid-template-columns: repeat(4, 1fr) !important; gap: 10px !important; }
        
        /* Cards */
        .card { border: 1px solid #ddd !important; box-shadow: none !important; margin-bottom: 20px !important; break-inside: avoid; background: #fff !important; }
        .card-header { background: #f8f8f8 !important; border-bottom: 1px solid #ddd !important; padding: 10px 15px !important; }
        .card-header h3 { font-size: 14px !important; font-weight: bold !important; color: #000 !important; margin: 0 !important; }
        .card-header i { display: none !important; }
        .card-body { padding: 15px !important; }
        
        /* Typography */
        h3, p, span, small { color: #000 !important; }
        
        /* Backgrounds & borders */
        .trend-badge { border: 1px solid #ccc !important; background: transparent !important; color: #000 !important; }
        div[style*="background:var(--gray-50)"] { background: transparent !important; border: 1px solid #eee !important; color: #000 !important; }
        
        /* Fix Charts */
        canvas { max-width: 100% !important; }
        
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
</style>

<script>
// Monitoring Mode Logic
document.getElementById('toggleMonitoring').addEventListener('click', function() {
    document.body.classList.toggle('monitoring-mode');
    
    if (document.body.classList.contains('monitoring-mode')) {
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        }
        this.innerHTML = '<i class="bi bi-x-lg"></i> Exit Monitoring';
        // Auto refresh every 5 minutes
        window.monitoringTimer = setInterval(() => { location.reload(); }, 300000);
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
        this.innerHTML = '<span class="pulse-red" style="width:8px; height:8px; background:var(--accent); border-radius:50%; display:inline-block;"></span> TV Monitoring Mode';
        clearInterval(window.monitoringTimer);
    }
});

// SDM Distribution Chart (Doughnut)
new Chart(document.getElementById('sdmChart'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode(array_keys($anggotaByBidang)) !!},
        datasets: [{
            data: {!! json_encode(array_values($anggotaByBidang)) !!},
            backgroundColor: ['#ef4444', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'],
            borderWidth: 0,
        }]
    },
    options: { 
        responsive: true, 
        plugins: { 
            legend: { 
                position: 'bottom', 
                labels: { 
                    padding: 15, 
                    color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#374151' 
                } 
            } 
        } 
    }
});

// Keuangan Chart (Bar)
new Chart(document.getElementById('keuanganChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($sumberDanas->pluck('nama')) !!},
        datasets: [
            { label: 'Pagu', data: {!! json_encode($sumberDanas->pluck('pagu')) !!}, backgroundColor: 'rgba(239, 68, 68, 0.85)', borderRadius: 4 },
            { label: 'Realisasi', data: {!! json_encode($sumberDanas->pluck('total_realisasi')) !!}, backgroundColor: 'rgba(59, 130, 246, 0.85)', borderRadius: 4 }
        ]
    },
    options: {
        responsive: true,
        plugins: { 
            legend: { 
                position: 'top', 
                labels: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#374151' } 
            } 
        },
        scales: { 
            y: { 
                grid: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#334155' : '#e5e7eb' }, 
                beginAtZero: true, 
                ticks: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#cbd5e1' : '#374151', callback: v => 'Rp ' + v.toLocaleString('id-ID') } 
            },
            x: { 
                grid: { display: false }, 
                ticks: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#cbd5e1' : '#374151' } 
            }
        }
    }
});

// Surat Trend Chart (Line)
new Chart(document.getElementById('suratTrendChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode(collect($suratTrend)->pluck('bulan')) !!},
        datasets: [
            {
                label: 'Surat Masuk',
                data: {!! json_encode(collect($suratTrend)->pluck('masuk')) !!},
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                fill: true, tension: 0.4, pointRadius: 4
            },
            {
                label: 'Surat Keluar',
                data: {!! json_encode(collect($suratTrend)->pluck('keluar')) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true, tension: 0.4, pointRadius: 4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { 
            legend: { 
                position: 'top', 
                labels: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#374151' } 
            } 
        },
        scales: { 
            y: { 
                grid: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#334155' : '#e5e7eb' }, 
                beginAtZero: true, 
                ticks: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#cbd5e1' : '#374151' } 
            },
            x: { 
                grid: { display: false }, 
                ticks: { color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#cbd5e1' : '#374151' } 
            }
        }
    }
});
</script>
@endsection
