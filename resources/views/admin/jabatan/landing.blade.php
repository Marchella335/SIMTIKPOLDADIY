@extends('layouts.admin')
@section('title', 'Pilih Bidang Jabatan - SIMTIK')
@section('page-title', 'Pilih Bidang Jabatan')

@section('content')
<div class="landing-grid" style="margin-top: 20px;">
    <!-- RENMIN -->
    @php $r = $summary['Renmin']; @endphp
    <div class="card landing-card" onclick="location.href='{{ route('admin.jabatan.index', ['bidang' => 'Renmin']) }}'">
        <div class="icon-wrapper renmin">
            <i class="bi bi-briefcase"></i>
        </div>
        <h3>RENMIN</h3>
        <p>Subbag Perencanaan dan Administrasi</p>

        <div class="stat-row">
            <div class="stat-item">
                <span class="stat-value">{{ $r['total_jabatan'] }}</span>
                <span class="stat-label">Jabatan</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-value renmin-color">{{ $r['total_anggota'] }}</span>
                <span class="stat-label">Anggota</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-value">{{ $r['total_kuota'] }}</span>
                <span class="stat-label">Kuota</span>
            </div>
        </div>

        @php $renminPct = $r['total_kuota'] > 0 ? min(100, round($r['total_anggota'] / $r['total_kuota'] * 100)) : 0; @endphp
        <div class="progress-wrap">
            <div class="progress-bar-bg">
                <div class="progress-bar-fill renmin-bg" style="width: {{ $renminPct }}%"></div>
            </div>
            <span class="progress-label">{{ $renminPct }}% terisi</span>
        </div>

        <div class="btn-select renmin">Kelola Jabatan</div>
    </div>

    <!-- TEKKOM -->
    @php $t = $summary['Tekkom']; @endphp
    <div class="card landing-card" onclick="location.href='{{ route('admin.jabatan.index', ['bidang' => 'Tekkom']) }}'">
        <div class="icon-wrapper tekkom">
            <i class="bi bi-broadcast"></i>
        </div>
        <h3>TEKKOM</h3>
        <p>Subbid Teknologi Komunikasi</p>

        <div class="stat-row">
            <div class="stat-item">
                <span class="stat-value">{{ $t['total_jabatan'] }}</span>
                <span class="stat-label">Jabatan</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-value tekkom-color">{{ $t['total_anggota'] }}</span>
                <span class="stat-label">Anggota</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-value">{{ $t['total_kuota'] }}</span>
                <span class="stat-label">Kuota</span>
            </div>
        </div>

        @php $tekkomPct = $t['total_kuota'] > 0 ? min(100, round($t['total_anggota'] / $t['total_kuota'] * 100)) : 0; @endphp
        <div class="progress-wrap">
            <div class="progress-bar-bg">
                <div class="progress-bar-fill tekkom-bg" style="width: {{ $tekkomPct }}%"></div>
            </div>
            <span class="progress-label">{{ $tekkomPct }}% terisi</span>
        </div>

        <div class="btn-select tekkom">Kelola Jabatan</div>
    </div>

    <!-- TEKINFO -->
    @php $f = $summary['Tekinfo']; @endphp
    <div class="card landing-card" onclick="location.href='{{ route('admin.jabatan.index', ['bidang' => 'Tekinfo']) }}'">
        <div class="icon-wrapper tekinfo">
            <i class="bi bi-laptop"></i>
        </div>
        <h3>TEKINFO</h3>
        <p>Subbid Teknologi Informasi</p>

        <div class="stat-row">
            <div class="stat-item">
                <span class="stat-value">{{ $f['total_jabatan'] }}</span>
                <span class="stat-label">Jabatan</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-value tekinfo-color">{{ $f['total_anggota'] }}</span>
                <span class="stat-label">Anggota</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-value">{{ $f['total_kuota'] }}</span>
                <span class="stat-label">Kuota</span>
            </div>
        </div>

        @php $tekinfoPct = $f['total_kuota'] > 0 ? min(100, round($f['total_anggota'] / $f['total_kuota'] * 100)) : 0; @endphp
        <div class="progress-wrap">
            <div class="progress-bar-bg">
                <div class="progress-bar-fill tekinfo-bg" style="width: {{ $tekinfoPct }}%"></div>
            </div>
            <span class="progress-label">{{ $tekinfoPct }}% terisi</span>
        </div>

        <div class="btn-select tekinfo">Kelola Jabatan</div>
    </div>
</div>

<style>
    .landing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }
    @media (max-width: 992px) {
        .landing-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .landing-grid { grid-template-columns: 1fr; }
    }
    .landing-card {
        text-align: center;
        padding: 32px 28px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0;
        transition: all 0.3s ease;
        border: 1px solid var(--gray-200);
    }
    .landing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        border-color: var(--accent);
    }
    .icon-wrapper {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 1.8rem;
    }
    .icon-wrapper.renmin  { background: rgba(220, 38, 38, 0.1);  color: var(--accent); }
    .icon-wrapper.tekkom  { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .icon-wrapper.tekinfo { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .icon-wrapper.global  { background: rgba(107, 114, 128, 0.1); color: #6b7280; }

    .landing-card h3 { margin: 0 0 6px; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.2rem; }
    .landing-card > p { color: var(--gray-500); font-size: 0.85rem; margin: 0 0 20px; }

    /* Stat row */
    .stat-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        width: 100%;
        background: var(--gray-50);
        border-radius: 12px;
        padding: 14px 8px;
        margin-bottom: 16px;
        border: 1px solid var(--gray-200);
    }
    .stat-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
    }
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-800);
        line-height: 1;
    }
    .stat-label {
        font-size: 0.72rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .stat-divider {
        width: 1px;
        height: 36px;
        background: var(--gray-200);
    }
    .renmin-color  { color: var(--accent) !important; }
    .tekkom-color  { color: #3b82f6 !important; }
    .tekinfo-color { color: #10b981 !important; }

    /* Progress bar */
    .progress-wrap {
        width: 100%;
        margin-bottom: 20px;
    }
    .progress-bar-bg {
        height: 8px;
        background: var(--gray-200);
        border-radius: 99px;
        overflow: hidden;
        margin-bottom: 5px;
    }
    .progress-bar-fill {
        height: 100%;
        border-radius: 99px;
        transition: width 0.6s ease;
    }
    .renmin-bg  { background: var(--accent); }
    .tekkom-bg  { background: #3b82f6; }
    .tekinfo-bg { background: #10b981; }
    .progress-label {
        font-size: 0.75rem;
        color: var(--gray-500);
        font-weight: 500;
    }

    /* Button */
    .btn-select {
        padding: 8px 28px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
        color: #fff;
        font-size: 0.875rem;
        transition: opacity 0.2s;
        margin-top: 4px;
    }
    .btn-select:hover { opacity: 0.85; }
    .btn-select.renmin  { background: var(--accent); }
    .btn-select.tekkom  { background: #3b82f6; }
    .btn-select.tekinfo { background: #10b981; }
    .btn-select.global  { background: #6b7280; }

    /* Dark mode */
    [data-theme="dark"] .stat-row { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.08); }
    [data-theme="dark"] .stat-value { color: #f1f5f9; }
    [data-theme="dark"] .stat-divider { background: rgba(255,255,255,0.1); }
    [data-theme="dark"] .progress-bar-bg { background: rgba(255,255,255,0.1); }
    [data-theme="dark"] .icon-wrapper.global { color: #94a3b8; }
    [data-theme="dark"] .btn-select.global { background: #4b5563; }
</style>
@endsection
