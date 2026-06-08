@extends('layouts.admin')
@section('title', 'Trend Kegiatan - Admin SIMTIK')
@section('page-title', 'Trend & Counter Kegiatan')

@section('content')
<!-- Stats Counter Card -->
<div style="display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 25px;">
    <div class="card" style="display: flex; align-items: center; padding: 25px; border-left: 5px solid var(--primary);">
        <div style="background: rgba(30, 58, 138, 0.1); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.8rem; margin-right: 20px;">
            <i class="bi bi-calendar-check-fill"></i>
        </div>
        <div>
            <h4 style="color: var(--gray-500); margin: 0; font-size: 0.9rem; text-transform: uppercase;">Total Kegiatan Terlaksana</h4>
            <h2 style="font-size: 2.2rem; margin: 5px 0 0; font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--primary);">{{ $totalKegiatan }} <span style="font-size: 1rem; font-weight: 500; color: var(--gray-500);">kegiatan</span></h2>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap: wrap; gap: 15px;">
        <h3>Grafik Frekuensi Kegiatan berdasarkan Waktu</h3>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('admin.kegiatan.trend', ['by' => 'date']) }}" class="btn {{ $by == 'date' ? 'btn-primary' : 'btn-outline' }} btn-sm">Per Tanggal</a>
            <a href="{{ route('admin.kegiatan.trend', ['by' => 'week']) }}" class="btn {{ $by == 'week' ? 'btn-primary' : 'btn-outline' }} btn-sm">Per Minggu</a>
            <a href="{{ route('admin.kegiatan.trend', ['by' => 'month']) }}" class="btn {{ $by == 'month' ? 'btn-primary' : 'btn-outline' }} btn-sm">Per Bulan</a>
            <a href="{{ route('admin.kegiatan.trend', ['by' => 'year']) }}" class="btn {{ $by == 'year' ? 'btn-primary' : 'btn-outline' }} btn-sm">Per Tahun</a>
            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Chart.js Graph -->
        <div style="position: relative; height: 350px; width: 100%; margin-bottom: 30px;">
            <canvas id="trendChart"></canvas>
        </div>

        <!-- Data Table -->
        <h3 style="margin-bottom: 15px;">Tabel Data Frekuensi</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px; text-align: center;">No</th>
                        <th>Periode (Waktu)</th>
                        <th style="width: 250px; text-align: center;">Frekuensi Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse($trendData as $key => $data)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td><strong>{{ $data['label'] }}</strong></td>
                        <td style="text-align: center;"><span style="background: rgba(30, 58, 138, 0.1); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 0.85rem;">{{ $data['count'] }} kali</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: var(--gray-500); padding: 20px;">Belum ada data untuk trend.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trendChart').getContext('2d');
        const labels = @json($labels);
        const counts = @json($counts);

        // Get theme to adapt text color
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const textColor = isDark ? '#94a3b8' : '#64748b';
        const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Frekuensi Kegiatan',
                    data: counts,
                    backgroundColor: 'rgba(30, 58, 138, 0.75)',
                    borderColor: 'rgba(30, 58, 138, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(30, 58, 138, 0.95)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        padding: 12,
                        backgroundColor: isDark ? '#1e293b' : '#0f172a',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 8,
                        boxPadding: 6
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                family: 'Poppins',
                                size: 11
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            precision: 0,
                            font: {
                                family: 'Poppins',
                                size: 11
                            }
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
