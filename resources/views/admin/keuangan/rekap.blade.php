@extends('layouts.admin')
@section('title', 'Rekap Keuangan - Admin SIMTIK')
@section('page-title', 'Rekap Laporan Keuangan')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.keuangan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard Keuangan</a>
</div>

<div class="card" style="margin-bottom: 25px;">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3>Filter Laporan</h3>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('admin.keuangan.export-pdf') }}" target="_blank" class="btn btn-outline btn-sm"><i class="fas fa-file-pdf"></i> Export PDF Semua</a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" style="display:flex; flex-wrap:wrap; gap:15px; align-items:flex-end;">
            <div class="form-group" style="margin:0; flex:1; min-width:150px;">
                <label style="font-weight:600; margin-bottom:5px; display:block;">Periode</label>
                <select name="periode" class="form-control" onchange="this.form.submit()">
                    <option value="mingguan" {{ $periode == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    <option value="bulanan" {{ $periode == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $periode == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>
            @if($periode !== 'tahunan')
            <div class="form-group" style="margin:0; flex:1; min-width:150px;">
                <label style="font-weight:600; margin-bottom:5px; display:block;">Tahun</label>
                <select name="tahun" class="form-control" onchange="this.form.submit()">
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            @endif
        </form>
    </div>
</div>

<!-- Chart & Table Summary -->
<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap:25px; margin-bottom: 25px;">
    <!-- Chart -->
    <div class="card">
        <div class="card-header">
            <h3>Visualisasi Pemasukan vs Pengeluaran</h3>
        </div>
        <div class="card-body">
            <div style="height: 350px; position: relative;">
                <canvas id="rekapChart" style="max-height: 350px; width:100%;"></canvas>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <h3>Tabel Rincian Periode</h3>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th style="text-align:right;">Pemasukan</th>
                            <th style="text-align:right;">Pengeluaran</th>
                            <th style="text-align:right;">Selisih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $idx => $row)
                        @php $selisih = $row->pemasukan - $row->pengeluaran; @endphp
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td><strong>{{ $row->periode }}</strong></td>
                            <td style="text-align:right; color:#10b981; font-weight:600;">Rp{{ number_format($row->pemasukan, 0, ',', '.') }}</td>
                            <td style="text-align:right; color:#ef4444; font-weight:600;">Rp{{ number_format($row->pengeluaran, 0, ',', '.') }}</td>
                            <td style="text-align:right; font-weight:700; color:{{ $selisih >= 0 ? '#10b981' : '#ef4444' }};">
                                Rp{{ number_format($selisih, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" style="text-align:center; color:var(--gray-500);">Tidak ada data pada periode ini</td></tr>
                        @endforelse
                    </tbody>
                    @if($data->count() > 0)
                    <tfoot>
                        <tr style="font-weight:bold; background-color:var(--gray-100);">
                            <td colspan="2">TOTAL</td>
                            <td style="text-align:right; color:#10b981; font-weight:700;">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                            <td style="text-align:right; color:#ef4444; font-weight:700;">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                            <td style="text-align:right; color:{{ ($totalPemasukan - $totalPengeluaran) >= 0 ? '#10b981' : '#ef4444' }; font-weight:700;">
                                Rp{{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ChartJS Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('rekapChart').getContext('2d');
        const labels = {!! json_encode($data->pluck('periode')) !!};
        const pemasukanData = {!! json_encode($data->pluck('pemasukan')) !!};
        const pengeluaranData = {!! json_encode($data->pluck('pengeluaran')) !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: pemasukanData,
                        backgroundColor: '#10b981',
                        borderRadius: 4
                    },
                    {
                        label: 'Pengeluaran',
                        data: pengeluaranData,
                        backgroundColor: '#ef4444',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
