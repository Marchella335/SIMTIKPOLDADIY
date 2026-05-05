@extends('layouts.public')
@section('title', 'Keuangan - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px;">
    <div class="container">
        <div class="section-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
            <h2 class="section-title" style="margin:0;">Data Keuangan</h2>
            
            <form action="{{ route('administrasi.keuangan') }}" method="GET" id="filterForm">
                <div style="display:flex; align-items:center; gap:10px;">
                    <label style="font-weight:600; color:var(--primary); font-size:0.9rem;">Pilih Sumber Dana:</label>
                    <select name="sumber_dana_id" onchange="document.getElementById('filterForm').submit()" style="padding:8px 15px; border-radius:10px; border:1px solid #ddd; outline:none; font-family:'Inter',sans-serif; cursor:pointer;">
                        <option value="">Semua Sumber Dana</option>
                        @foreach($sumberDanas as $sd)
                            <option value="{{ $sd->id }}" {{ $selectedSourceId == $sd->id ? 'selected' : '' }}>{{ $sd->nama }} ({{ $sd->tahun }})</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="stats-grid" style="margin-bottom:40px;">
            <div class="stat-card"><div class="stat-number" style="font-size:1.3rem;">Rp {{ number_format($paguTotal,0,',','.') }}</div><div class="stat-label">Total Pagu Anggaran {{ date('Y') }}</div></div>
            <div class="stat-card"><div class="stat-number" style="font-size:1.3rem;">Rp {{ number_format($totalRealisasi,0,',','.') }}</div><div class="stat-label">Total Dana Terrealisasi</div></div>
            <div class="stat-card"><div class="stat-number" style="font-size:1.3rem;">Rp {{ number_format($paguTotal - $totalRealisasi, 0, ',', '.') }}</div><div class="stat-label">Saldo Anggaran</div></div>
        </div>

        <div style="background:var(--white);border-radius:var(--radius);padding:30px;box-shadow:var(--shadow);margin-bottom:30px;">
            <h3 style="font-family:'Poppins',sans-serif;margin-bottom:20px;">
                Grafik Perbandingan Anggaran {{ $selectedSourceId ? '- ' . $sumberDanas->find($selectedSourceId)->nama : '(Semua Sumber Dana)' }}
            </h3>
            <canvas id="keuanganChart" height="100"></canvas>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const labels = [];
const dataPagu = [];
const dataRealisasi = [];

@foreach($sumberDanas as $sd)
    labels.push('{{ $sd->nama }}');
    dataPagu.push({{ $sd->pagu ?? 0 }});
    dataRealisasi.push({{ $sd->total_realisasi ?? 0 }});
@endforeach

new Chart(document.getElementById('keuanganChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Pagu Anggaran',
                data: dataPagu,
                backgroundColor: 'rgba(200, 169, 110, 0.8)', // Accent color
                borderRadius: 4
            },
            {
                label: 'Total Realisasi',
                data: dataRealisasi,
                backgroundColor: 'rgba(26, 60, 52, 0.8)', // Primary color
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
