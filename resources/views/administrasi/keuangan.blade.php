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
@endsection
