@extends('layouts.admin')
@section('title', 'Activity Log - Admin SIMTIK')
@section('page-title', 'Security & Activity Log')

@section('content')

{{-- PRINT KOP SURAT --}}
<div class="print-header" style="display:none;">
    <div style="text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
        <h1 style="margin: 0; font-size: 22px; text-transform: uppercase;">KEPOLISIAN DAERAH</h1>
        <h2 style="margin: 5px 0; font-size: 18px; color: #333;">DAERAH ISTIMEWA YOGYAKARTA</h2>
        <p style="margin: 0; font-size: 14px;">BIDANG TEKNOLOGI INFORMASI DAN KOMUNIKASI</p>
    </div>
    <h3 style="text-align: center; text-decoration: underline; margin-bottom: 20px; font-size: 16px;">LOG AKTIVITAS (AUDIT TRAIL)</h3>
</div>

{{-- Privacy & Ethics Banner --}}
<div class="welcome-card" style="background:linear-gradient(135deg, #0a0a0a, #1a1a2e); color:#fff; border:1px solid rgba(220,38,38,0.2);">
    <div style="display:flex; align-items:center; gap:15px;">
        <i class="bi bi-shield-lock-fill" style="font-size:2.5rem; color:var(--accent);"></i>
        <div>
            <h2 style="color:#fff; margin-bottom:4px;">Audit Log & Monitoring Sistem</h2>
            <p style="color:rgba(255,255,255,0.6);">Pencatatan riwayat aktivitas operasional untuk menjamin keamanan informasi, integritas data, dan akuntabilitas penggunaan sistem di lingkungan Bid TIK POLDA DIY.</p>
        </div>
    </div>
</div>

{{-- Security Stats --}}
<div class="dash-grid" style="margin:25px 0;">
    <div class="dash-card" style="border-left:3px solid var(--accent);">
        <div class="dash-icon" style="background:var(--accent);"><i class="bi bi-activity"></i></div>
        <div class="dash-info"><h3>{{ $stats['total'] }}</h3><p>Total Aktivitas</p></div>
    </div>
    <div class="dash-card" style="border-left:3px solid var(--success);">
        <div class="dash-icon bg-success"><i class="bi bi-calendar-check"></i></div>
        <div class="dash-info"><h3>{{ $stats['today'] }}</h3><p>Aktivitas Hari Ini</p></div>
    </div>
    <div class="dash-card" style="border-left:3px solid var(--info);">
        <div class="dash-icon bg-info"><i class="bi bi-plus-circle"></i></div>
        <div class="dash-info"><h3>{{ $stats['creates'] }}</h3><p>Data Dibuat</p></div>
    </div>
    <div class="dash-card" style="border-left:3px solid var(--warning);">
        <div class="dash-icon bg-warning"><i class="bi bi-pencil-square"></i></div>
        <div class="dash-info"><h3>{{ $stats['updates'] }}</h3><p>Data Diubah</p></div>
    </div>
</div>

{{-- System Health Widget --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px;">
        <div style="display:flex; align-items:center; gap:10px; padding:12px; background:var(--gray-50); border-radius:8px;">
            <i class="bi bi-check-circle-fill" style="color:var(--success); font-size:1.3rem;"></i>
            <div><small style="color:var(--gray-500);">Status</small><p style="font-weight:700; color:var(--success);">System Secure</p></div>
        </div>
        <div style="display:flex; align-items:center; gap:10px; padding:12px; background:var(--gray-50); border-radius:8px;">
            <i class="bi bi-database-check" style="color:var(--info); font-size:1.3rem;"></i>
            <div><small style="color:var(--gray-500);">Database</small><p style="font-weight:700; color:var(--info);">Optimized</p></div>
        </div>
        <div style="display:flex; align-items:center; gap:10px; padding:12px; background:var(--gray-50); border-radius:8px;">
            <i class="bi bi-lock-fill" style="color:var(--accent); font-size:1.3rem;"></i>
            <div><small style="color:var(--gray-500);">Enkripsi</small><p style="font-weight:700;">AES-256</p></div>
        </div>
        <div style="display:flex; align-items:center; gap:10px; padding:12px; background:var(--gray-50); border-radius:8px;">
            <i class="bi bi-clock-history" style="color:var(--warning); font-size:1.3rem;"></i>
            <div><small style="color:var(--gray-500);">Uptime</small><p style="font-weight:700; color:var(--success);">99.9%</p></div>
        </div>
    </div>
</div>

{{-- Log Table --}}
<div class="card" id="logTableCard">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3 style="margin:0;"><i class="bi bi-journal-text" style="color:var(--accent); margin-right:8px;"></i> Audit Trail — Riwayat Aktivitas</h3>
        <button onclick="window.print()" style="background:rgba(16,185,129,0.1); border:1px solid var(--success); color:var(--success); padding:6px 16px; border-radius:30px; font-weight:600; cursor:pointer; font-size:14px; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-printer-fill"></i> Cetak PDF
        </button>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead><tr>
                    <th>Waktu</th><th>User</th><th>Aksi</th><th>Modul</th><th>Detail</th><th>IP Address</th>
                </tr></thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td style="white-space:nowrap; font-size:0.8rem;">
                            {{ $log->created_at->format('d/m/Y') }}<br>
                            <small style="color:var(--gray-500);">{{ $log->created_at->format('H:i:s') }}</small>
                        </td>
                        <td><strong>{{ $log->user->name ?? 'System' }}</strong></td>
                        <td>
                            @if($log->action == 'Create')
                                <span class="badge" style="background:var(--success); color:#fff;">{{ $log->action }}</span>
                            @elseif($log->action == 'Update')
                                <span class="badge" style="background:var(--warning); color:#000;">{{ $log->action }}</span>
                            @elseif($log->action == 'Delete')
                                <span class="badge" style="background:var(--danger); color:#fff;">{{ $log->action }}</span>
                            @else
                                <span class="badge badge-info">{{ $log->action }}</span>
                            @endif
                        </td>
                        <td>{{ $log->model ?? '-' }} {{ $log->model_id ? '#'.$log->model_id : '' }}</td>
                        <td style="max-width:200px; font-size:0.8rem;">
                            @if($log->details)
                                @foreach($log->details as $key => $val)
                                    <span style="color:var(--gray-500);">{{ $key }}:</span> {{ $val }}<br>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td><code style="font-size:0.75rem; background:var(--gray-100); padding:2px 6px; border-radius:4px;">{{ $log->ip_address ?? '-' }}</code></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center; color:var(--gray-500);">Belum ada aktivitas tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:15px;">
            {{ $logs->links() }}
        </div>
    </div>
</div>

<div style="text-align:center; padding:20px; color:var(--gray-500); font-size:0.8rem;">
    <i class="bi bi-shield-check"></i> Sistem ini mematuhi standar Etika Penggunaan Komputer, Keamanan Data Pribadi, dan Hak Kekayaan Intelektual.
</div>

@endsection

@section('scripts')
<style>
    @media print {
        @page { size: A4 landscape; margin: 15mm; }
        body { background: #fff !important; color: #000 !important; font-family: 'Arial', sans-serif !important; }
        
        .admin-sidebar, .admin-header, .welcome-card, .dash-grid, .card:not(#logTableCard), button, .pagination, .footer, nav[aria-label="Pagination Navigation"], .bi-shield-check { display: none !important; }
        .admin-content { margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; }
        
        .print-header { display: block !important; }
        
        .card { border: none !important; box-shadow: none !important; }
        .card-header { display: none !important; }
        .card-body { padding: 0 !important; }
        
        table { width: 100% !important; border-collapse: collapse !important; font-size: 11px !important; }
        th, td { border: 1px solid #000 !important; padding: 8px !important; color: #000 !important; }
        th { background: #f2f2f2 !important; font-weight: bold !important; text-transform: uppercase !important; }
        
        /* Badges & specific elements */
        .badge { border: 1px solid #000 !important; color: #000 !important; background: transparent !important; box-shadow: none !important; }
        code { border: none !important; background: transparent !important; padding: 0 !important; color: #000 !important; }
        small, span { color: #000 !important; }
        
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
</style>
@endsection
