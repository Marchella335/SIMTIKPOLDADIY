@extends('layouts.admin')
@section('title', 'Dashboard - Admin SIMTIK')
@section('page-title', 'Dashboard')

@section('content')
<div class="welcome-card">
    <h2>👋 Selamat Datang di SIMTIK POLDA DIY</h2>
    <p>Kelola data anggota, persuratan, keuangan, dan kegiatan Bidang TIK Polda DIY.</p>
</div>

<div class="dash-grid">
    <div class="dash-card">
        <div class="dash-icon bg-primary"><i class="fas fa-users"></i></div>
        <div class="dash-info"><h3>{{ $jumlahAnggota }}</h3><p>Jumlah Anggota</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-success"><i class="fas fa-envelope"></i></div>
        <div class="dash-info"><h3>{{ $suratMasuk }}</h3><p>Surat Masuk</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-danger"><i class="fas fa-paper-plane"></i></div>
        <div class="dash-info"><h3>{{ $suratKeluar }}</h3><p>Surat Keluar</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-info"><i class="fas fa-calendar-check"></i></div>
        <div class="dash-info"><h3>{{ $jumlahKegiatan }}</h3><p>Kegiatan</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon" style="background:#dc2626;"><i class="fas fa-wallet"></i></div>
        <div class="dash-info"><h3 style="font-size:1.1rem;">Rp {{ number_format($paguTotal,0,',','.') }}</h3><p>Pagu {{ date('Y') }}</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon" style="background:var(--danger);"><i class="fas fa-money-bill-wave"></i></div>
        <div class="dash-info"><h3 style="font-size:1.1rem;">Rp {{ number_format($totalRealisasi,0,',','.') }}</h3><p>Realisasi</p></div>
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
