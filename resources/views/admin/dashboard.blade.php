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

<div class="welcome-card">
    <h2>{{ $icon }} {{ $greeting }}, {{ Auth::user()->name }}!</h2>
    <p>Senang melihat Anda kembali. Berikut adalah ringkasan data Bidang TIK Polda DIY hari ini.</p>
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
                backgroundColor: 'rgba(220, 38, 38, 0.8)',
                borderRadius: 4
            },
            {
                label: 'Total Realisasi',
                data: dataRealisasi,
                backgroundColor: 'rgba(26, 26, 26, 0.8)',
                borderRadius: 4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: v => 'Rp ' + v.toLocaleString('id-ID')
                }
            }
        }
    }
});
</script>
@endsection
