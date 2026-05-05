<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SIMTIK POLDA DIY')</title>
    <link rel="icon" href="{{ asset('assets/LOGO_BID_TIK.png') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @yield('styles')
</head>
<body>
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/LOGO_BID_TIK.png') }}" alt="Logo">
            <span>SIMTIK</span>
        </div>
        <div class="sidebar-section">Menu Utama</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span class="icon"><i class="fas fa-th-large"></i></span> Dashboard</a></li>
        </ul>
        <div class="sidebar-section">Data</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin.anggota.index') }}" class="{{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}"><span class="icon"><i class="fas fa-users"></i></span> Anggota</a></li>
            <li><a href="{{ route('admin.persuratan.index') }}" class="{{ request()->routeIs('admin.persuratan.*') ? 'active' : '' }}"><span class="icon"><i class="fas fa-envelope"></i></span> Persuratan</a></li>
            <li><a href="{{ route('admin.keuangan.index') }}" class="{{ request()->routeIs('admin.keuangan.*') ? 'active' : '' }}"><span class="icon"><i class="fas fa-chart-line"></i></span> Keuangan</a></li>
            <li><a href="{{ route('admin.kegiatan.index') }}" class="{{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}"><span class="icon"><i class="fas fa-calendar-alt"></i></span> Kegiatan</a></li>
        </ul>
        <div class="sidebar-section">Lainnya</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('home') }}"><span class="icon"><i class="fas fa-globe"></i></span> Lihat Website</a></li>
        </ul>
        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none;border:none;cursor:pointer;color:inherit;font-size:inherit;font-family:inherit;display:flex;align-items:center;gap:8px;width:100%;padding:8px 0;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            <h2>@yield('page-title', 'Dashboard')</h2>
            <div class="user-info">
                <i class="fas fa-user-circle" style="font-size:1.5rem;"></i>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </header>
        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

    @yield('scripts')
</body>
</html>
