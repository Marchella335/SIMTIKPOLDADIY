@extends('layouts.admin')
@section('title', 'Dashboard - Admin SIMTIK')
@section('page-title', 'Dashboard')

@section('content')
<div class="welcome-card">
    <h2>👋 Selamat Datang di SIMTIK POLDA DIY</h2>
    <p>Kelola data anggota, persuratan, keuangan, dan kegiatan Bidang TIK Polda DIY.</p>
</div>

@if($expiringAnggotas->count() > 0)
<div class="card" style="margin-bottom:25px; border-left: 5px solid #dc2626; background: #fff5f5;">
    <div class="card-header" style="background:transparent; border:none; padding-bottom:0;">
        <h3 style="color:#991b1b;"><i class="bi bi-exclamation-triangle-fill"></i> Pemberitahuan Masa Jabatan</h3>
    </div>
    <div class="card-body">
        <p style="margin-bottom:15px; color:#b91c1c; font-weight:600;">Admin harus membuat surat perpanjangan pembaruan SK (Surat Keputusan) untuk anggota berikut:</p>
        <div class="table-container" style="box-shadow:none; border:1px solid #fee2e2;">
            <table style="background:transparent;">
                <thead style="background:#fee2e2; color:#991b1b;">
                    <tr>
                        <th>Nama Anggota</th>
                        <th>Jabatan</th>
                        <th>Akhir Masa Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expiringAnggotas as $agt)
                    <tr>
                        <td>{{ $agt->nama_lengkap }}</td>
                        <td>{{ $agt->jabatan }}</td>
                        <td>{{ \Carbon\Carbon::parse($agt->akhir_jabatan)->format('d/m/Y') }}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($agt->akhir_jabatan)->isPast())
                                <span style="color:#dc2626; font-weight:bold;">Selesai</span>
                            @else
                                <span style="color:#ea580c; font-weight:bold;">Akan Berakhir</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.anggota.show', $agt) }}" class="btn btn-outline btn-sm">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<div class="dash-grid">
    <div class="dash-card">
        <div class="dash-icon bg-primary"><i class="bi bi-people-fill"></i></div>
        <div class="dash-info"><h3>{{ $jumlahAnggota }}</h3><p>Jumlah Anggota</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-success"><i class="bi bi-inbox-fill"></i></div>
        <div class="dash-info"><h3>{{ $suratMasuk }}</h3><p>Surat Masuk</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-danger"><i class="bi bi-send-fill"></i></div>
        <div class="dash-info"><h3>{{ $suratKeluar }}</h3><p>Surat Keluar</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon bg-info"><i class="bi bi-calendar2-check"></i></div>
        <div class="dash-info"><h3>{{ $jumlahKegiatan }}</h3><p>Kegiatan</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon" style="background:#dc2626;"><i class="bi bi-wallet2"></i></div>
        <div class="dash-info"><h3 style="font-size:1.1rem;">Rp {{ number_format($paguTotal,0,',','.') }}</h3><p>Pagu {{ date('Y') }}</p></div>
    </div>
    <div class="dash-card">
        <div class="dash-icon" style="background:var(--danger);"><i class="bi bi-cash-coin"></i></div>
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
