@extends('layouts.admin')
@section('title', 'Rekap Universal - Admin SIMTIK')
@section('page-title', 'Rekap Universal Data SIMTIK')

@section('content')
<!-- Filter Card -->
<div class="card" style="margin-bottom: 25px;">
    <div class="card-body">
        <form method="GET" style="display:flex; flex-wrap:wrap; gap:15px; align-items:flex-end;">
            <div class="form-group" style="margin:0; flex:1; min-width:200px;">
                <label style="font-weight:600; margin-bottom:5px; display:block;">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" style="width:100%;">
            </div>
            <div class="form-group" style="margin:0; flex:1; min-width:200px;">
                <label style="font-weight:600; margin-bottom:5px; display:block;">Tanggal Selesai</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" style="width:100%;">
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                <a href="{{ route('admin.rekap.export-pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="btn btn-outline"><i class="fas fa-file-pdf"></i> Export PDF</a>
            </div>
        </form>
    </div>
</div>

<!-- Grid Summaries -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 25px;">
    <!-- Anggota -->
    <div class="card" style="border-left: 4px solid #3b82f6;">
        <div class="card-body" style="padding:20px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h4 style="margin:0 0 5px; color:var(--gray-500); font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Total Anggota</h4>
                <div style="font-size:1.8rem; font-weight:700; color:var(--gray-800);">{{ $totalAnggota }}</div>
            </div>
            <div style="font-size:2rem; color:#3b82f6;"><i class="bi bi-people"></i></div>
        </div>
    </div>
    <!-- Persuratan -->
    <div class="card" style="border-left: 4px solid #10b981;">
        <div class="card-body" style="padding:20px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h4 style="margin:0 0 5px; color:var(--gray-500); font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Surat Masuk / Keluar</h4>
                <div style="font-size:1.8rem; font-weight:700; color:var(--gray-800);">{{ $suratMasuk }} / {{ $suratKeluar }}</div>
            </div>
            <div style="font-size:2rem; color:#10b981;"><i class="bi bi-envelope"></i></div>
        </div>
    </div>
    <!-- Keuangan -->
    <div class="card" style="border-left: 4px solid #f59e0b;">
        <div class="card-body" style="padding:20px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h4 style="margin:0 0 5px; color:var(--gray-500); font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Realisasi Keuangan</h4>
                <div style="font-size:1.15rem; font-weight:700; color:var(--gray-800);">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                <div style="font-size:0.75rem; color:#10b981;">Pemasukan: Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </div>
            <div style="font-size:2rem; color:#f59e0b;"><i class="bi bi-cash-stack"></i></div>
        </div>
    </div>
    <!-- Kegiatan -->
    <div class="card" style="border-left: 4px solid #8b5cf6;">
        <div class="card-body" style="padding:20px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h4 style="margin:0 0 5px; color:var(--gray-500); font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Kegiatan Terlaksana</h4>
                <div style="font-size:1.8rem; font-weight:700; color:var(--gray-800);">{{ $totalKegiatanTampilkan }}</div>
                <div style="font-size:0.75rem; color:var(--gray-500);">Total terdaftar: {{ $totalKegiatan }}</div>
            </div>
            <div style="font-size:2rem; color:#8b5cf6;"><i class="bi bi-calendar-event"></i></div>
        </div>
    </div>
</div>

<!-- Details Grid -->
<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap:25px;">
    <!-- Left Column: Anggota & Persuratan Bidang -->
    <div style="display:flex; flex-direction:column; gap:25px;">
        <!-- Anggota Card -->
        <div class="card">
            <div class="card-header">
                <h3>Distribusi Anggota Per Bidang</h3>
            </div>
            <div class="card-body">
                <div class="table-container" style="border:none;">
                    <table style="border:none;">
                        <thead>
                            <tr>
                                <th>Bidang</th>
                                <th style="text-align:right;">Jumlah Anggota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($anggotaPerBidang as $ab)
                            <tr>
                                <td><strong>{{ strtoupper($ab->bidang) }}</strong></td>
                                <td style="text-align:right;">{{ $ab->count }} orang</td>
                            </tr>
                            @empty
                            <tr><td colspan="2" style="text-align:center; color:var(--gray-500);">Tidak ada data anggota</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Persuratan Card -->
        <div class="card">
            <div class="card-header">
                <h3>Persuratan Per Bidang</h3>
            </div>
            <div class="card-body">
                <div class="table-container" style="border:none;">
                    <table style="border:none;">
                        <thead>
                            <tr>
                                <th>Bidang</th>
                                <th style="text-align:right;">Jumlah Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suratPerBidang as $sb)
                            <tr>
                                <td><strong>{{ strtoupper($sb->bidang) }}</strong></td>
                                <td style="text-align:right;">{{ $sb->count }} surat</td>
                            </tr>
                            @empty
                            <tr><td colspan="2" style="text-align:center; color:var(--gray-500);">Tidak ada data surat</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Kegiatan & Berita -->
    <div style="display:flex; flex-direction:column; gap:25px;">
        <!-- Kegiatan & Berita Summary Card -->
        <div class="card" style="height:100%;">
            <div class="card-header">
                <h3>Ringkasan Publikasi (Berita & Kegiatan)</h3>
            </div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:20px;">
                <div style="background:rgba(139,92,246,0.06); border:1px solid rgba(139,92,246,0.1); padding:20px; border-radius:10px;">
                    <h4 style="margin:0 0 10px; color:#8b5cf6;"><i class="bi bi-calendar-event"></i> Kegiatan</h4>
                    <p style="margin:0 0 5px; color:var(--gray-600);">Total Kegiatan Terlaksana (Ditampilkan di Web): <strong>{{ $totalKegiatanTampilkan }}</strong></p>
                    <p style="margin:0; color:var(--gray-500); font-size:0.85rem;">Total arsip kegiatan: {{ $totalKegiatan }}</p>
                </div>

                <div style="background:rgba(244,63,94,0.06); border:1px solid rgba(244,63,94,0.1); padding:20px; border-radius:10px;">
                    <h4 style="margin:0 0 10px; color:#f43f5e;"><i class="bi bi-newspaper"></i> Berita</h4>
                    <p style="margin:0 0 5px; color:var(--gray-600);">Total Berita Dipublikasikan (Ditampilkan di Web): <strong>{{ $totalBeritaTampilkan }}</strong></p>
                    <p style="margin:0; color:var(--gray-500); font-size:0.85rem;">Total draf/berita terdaftar: {{ $totalBerita }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
