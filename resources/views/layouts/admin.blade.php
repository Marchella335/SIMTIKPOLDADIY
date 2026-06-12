<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SIMTIK POLDA DIY')</title>
    <link rel="icon" href="{{ asset('assets/LOGO_BID_TIK.png') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('styles')
</head>
<body>
    <div id="scrollProgress" style="position:fixed; top:0; left:0; width:0; height:3px; background:var(--accent); z-index:9999; transition:width 0.1s ease;"></div>
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/LOGO_BID_TIK.png') }}" alt="Logo">
            <span>SIMTIK</span>
        </div>
        <div class="sidebar-section">Menu Utama</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span class="icon"><i class="bi bi-speedometer2"></i></span> Dashboard</a></li>
        </ul>
        <div class="sidebar-section">Data</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin.anggota.landing') }}" class="{{ (request()->routeIs('admin.anggota.*') || request()->routeIs('admin.jabatan.*') || request()->routeIs('admin.struktur.*')) ? 'active' : '' }}"><span class="icon"><i class="bi bi-people"></i></span> Anggota & Jabatan</a></li>
            <li><a href="{{ route('admin.persuratan.landing') }}" class="{{ request()->routeIs('admin.persuratan.*') ? 'active' : '' }}"><span class="icon"><i class="bi bi-mailbox"></i></span> Persuratan</a></li>
            <li><a href="{{ route('admin.keuangan.index') }}" class="{{ request()->routeIs('admin.keuangan.*') ? 'active' : '' }}"><span class="icon"><i class="bi bi-cash-stack"></i></span> Keuangan</a></li>
            <li><a href="{{ route('admin.kegiatan.index') }}" class="{{ request()->routeIs('admin.kegiatan.index') || request()->routeIs('admin.kegiatan.create') || request()->routeIs('admin.kegiatan.edit') ? 'active' : '' }}"><span class="icon"><i class="bi bi-calendar-event"></i></span> Kegiatan</a></li>
            <li><a href="{{ route('admin.rencana-kegiatan.index') }}" class="{{ request()->routeIs('admin.rencana-kegiatan.*') ? 'active' : '' }}"><span class="icon"><i class="bi bi-calendar-plus"></i></span> Rencana Kegiatan</a></li>
            <li><a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}"><span class="icon"><i class="bi bi-newspaper"></i></span> Berita</a></li>
            <li><a href="{{ route('admin.carousel.index') }}" class="{{ request()->routeIs('admin.carousel.*') ? 'active' : '' }}"><span class="icon"><i class="bi bi-images"></i></span> Carousel</a></li>
        </ul>
        <div class="sidebar-section">Monitoring &amp; Pelaporan</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin.rekap.index') }}" class="{{ request()->routeIs('admin.rekap.index') ? 'active' : '' }}"><span class="icon"><i class="bi bi-collection"></i></span> Rekapitulasi Universal</a></li>
        </ul>
        <div class="sidebar-section" style="margin-top: 20px;">Sistem &amp; Akses</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}"><span class="icon"><i class="bi bi-gear"></i></span> Pengaturan</a></li>
            <li><a href="{{ route('admin.activity-log') }}" class="{{ request()->routeIs('admin.activity-log') ? 'active' : '' }}"><span class="icon"><i class="bi bi-shield-lock"></i></span> Activity Log</a></li>
        </ul>
        <div class="sidebar-bottom" style="position: static; border-top: none; background: transparent; padding-top: 0;">
            <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:12px; padding:12px 18px; color:var(--gray-500); border-radius:var(--radius-sm); font-size:0.95rem; font-weight:500; transition:var(--transition); text-decoration:none;">
                <i class="bi bi-globe" style="font-size:1.2rem; width:24px; text-align:center;"></i> Lihat Website
            </a>
            <div style="height:1px; background:rgba(255,255,255,0.05); margin:10px 18px;"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none; border:none; color:var(--danger); cursor:pointer; font-size:0.95rem; font-weight:600; display:flex; align-items:center; gap:12px; width:100%; padding:12px 18px; border-radius:var(--radius-sm); transition:var(--transition);">
                    <i class="bi bi-box-arrow-right" style="font-size:1.2rem; width:24px; text-align:center;"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            <div class="header-left">
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                    <span class="sep">/</span>
                    <span class="current">@yield('page-title', 'Dashboard')</span>
                </div>
                <h2>@yield('page-title', 'Dashboard')</h2>
            </div>
            <div style="display:flex; align-items:center; gap:20px;">
                <button id="themeToggle" class="theme-toggle-btn" title="Ganti Tema">
                    <i class="bi bi-moon-fill" id="themeIcon"></i>
                </button>
                <div class="notification-dropdown">
                    <div class="notification-bell" id="notifBell">
                        <i class="bi bi-bell-fill"></i>
                        @if($expiringAnggotas->count() > 0 || $upcomingRencana->count() > 0)
                            <span class="notification-dot">{{ $expiringAnggotas->count() + $upcomingRencana->count() }}</span>
                        @endif
                    </div>
                    <div class="notification-menu" id="notifMenu">
                        {{-- Tabs --}}
                        <div style="display:flex; border-bottom:1px solid rgba(255,255,255,0.08);">
                            <button class="notif-tab active" data-tab="tab-jabatan" style="flex:1; padding:12px 10px; background:none; border:none; cursor:pointer; font-size:0.82rem; font-weight:700; color:var(--accent); border-bottom:2px solid var(--accent); transition:var(--transition);">
                                <i class="bi bi-person-exclamation"></i> Jabatan ({{ $expiringAnggotas->count() }})
                            </button>
                            <button class="notif-tab" data-tab="tab-rencana" style="flex:1; padding:12px 10px; background:none; border:none; cursor:pointer; font-size:0.82rem; font-weight:700; color:var(--gray-500); border-bottom:2px solid transparent; transition:var(--transition);">
                                <i class="bi bi-calendar-check"></i> Rencana ({{ $upcomingRencana->count() }})
                            </button>
                        </div>

                        {{-- Tab Jabatan --}}
                        <div class="notification-list notif-tab-content" id="tab-jabatan" style="display:block;">
                            @forelse($expiringAnggotas as $agt)
                                <div class="notification-item">
                                    <div class="notif-icon">
                                        <i class="bi bi-person-exclamation"></i>
                                    </div>
                                    <div class="notif-content">
                                        <div class="notif-title">{{ $agt->nama_lengkap }}</div>
                                        <div class="notif-text">Masa jabatan berakhir: {{ \Carbon\Carbon::parse($agt->akhir_jabatan)->format('d M Y') }}</div>
                                        <div class="notif-actions">
                                            <a href="{{ route('admin.anggota.edit', $agt) }}" class="notif-action-btn edit">
                                                <i class="bi bi-pencil-square"></i> Perbarui SK
                                            </a>
                                            <a href="{{ route('admin.anggota.show', $agt) }}" class="notif-action-btn view">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="notification-empty">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <p>Tidak ada pemberitahuan masa jabatan.</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- Tab Rencana --}}
                        <div class="notification-list notif-tab-content" id="tab-rencana" style="display:none;">
                            @forelse($upcomingRencana as $ur)
                                <div class="notification-item">
                                    <div class="notif-icon" style="background:rgba(2,132,199,0.15); color:#0284c7;">
                                        @if($ur->tipe == 'berita')
                                            <i class="bi bi-newspaper" style="color:#7c3aed;"></i>
                                        @else
                                            <i class="bi bi-calendar-check"></i>
                                        @endif
                                    </div>
                                    <div class="notif-content">
                                        <div class="notif-title">{{ $ur->nama_kegiatan }}</div>
                                        <div class="notif-text">
                                            Tgl: {{ $ur->tanggal_rencana->format('d M Y') }}
                                            @if($ur->tipe == 'berita')
                                                &middot; <span style="color:#7c3aed; font-weight:700;">Berita</span>
                                            @else
                                                &middot; <span style="color:#0284c7; font-weight:700;">Kegiatan</span>
                                            @endif
                                        </div>
                                        <div class="notif-actions">
                                            <a href="{{ route('admin.rencana-kegiatan.edit', $ur) }}" class="notif-action-btn edit">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{ route('admin.rencana-kegiatan.index') }}" class="notif-action-btn view">
                                                <i class="bi bi-list-ul"></i> Lihat Semua
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="notification-empty">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <p>Tidak ada rencana mendatang.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.profile') }}" class="user-info" style="text-decoration:none; color:inherit; transition: var(--transition);">
                    <i class="bi bi-person-circle" style="font-size:1.5rem;"></i>
                    <span>{{ Auth::user()->name }}</span>
                </a>
            </div>
        </header>
        <div class="admin-content">
            @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toast Configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
            @endif
            @if(session('error'))
                Toast.fire({ icon: 'error', title: '{{ session('error') }}' });
            @endif

            // Notification Bell
            const bell = document.getElementById('notifBell');
            const menu = document.getElementById('notifMenu');
            
            if (bell && menu) {
                bell.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menu.classList.toggle('show');
                });
                
                document.addEventListener('click', function(e) {
                    if (!menu.contains(e.target) && !bell.contains(e.target)) {
                        menu.classList.remove('show');
                    }
                });

                // Tab switching
                document.querySelectorAll('.notif-tab').forEach(tab => {
                    tab.addEventListener('click', function(e) {
                        e.stopPropagation();
                        // Reset all tabs
                        document.querySelectorAll('.notif-tab').forEach(t => {
                            t.classList.remove('active');
                            t.style.color = 'var(--gray-500)';
                            t.style.borderBottomColor = 'transparent';
                        });
                        // Activate clicked tab
                        this.classList.add('active');
                        this.style.color = 'var(--accent)';
                        this.style.borderBottomColor = 'var(--accent)';
                        // Show corresponding content
                        document.querySelectorAll('.notif-tab-content').forEach(c => c.style.display = 'none');
                        document.getElementById(this.dataset.tab).style.display = 'block';
                    });
                });
            }

            // Simple Search Filter
            const searchInputs = document.querySelectorAll('.table-search');
            searchInputs.forEach(input => {
                input.addEventListener('keyup', function() {
                    const value = this.value.toLowerCase();
                    const targetTable = document.querySelector(this.dataset.table);
                    const rows = targetTable.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
                    });
                });
            });

            // Scroll Progress
            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                document.getElementById("scrollProgress").style.width = scrolled + "%";
            });

            // Theme Logic
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const html = document.documentElement;

            function setTheme(theme, isAuto = false) {
                html.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
                themeIcon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
                if(!isAuto) localStorage.setItem('theme-manual', 'true');
            }

            // Check preference or auto
            const savedTheme = localStorage.getItem('theme');
            const manual = localStorage.getItem('theme-manual');
            const hour = new Date().getHours();
            const isNight = hour >= 18 || hour < 6;

            if (savedTheme) {
                setTheme(savedTheme, true);
            } else if (isNight) {
                setTheme('dark', true);
            }

            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-theme');
                setTheme(currentTheme === 'dark' ? 'light' : 'dark');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
