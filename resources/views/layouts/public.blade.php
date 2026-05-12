<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIMTIK POLDA DIY - Sistem Informasi Manajemen Teknologi Informasi dan Komunikasi Polda DIY">
    <title>@yield('title', 'SIMTIK POLDA DIY')</title>
    <link rel="icon" href="{{ asset('assets/LOGO_BID_TIK.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @yield('styles')
</head>
<body>
    {{-- NAVBAR --}}
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('assets/LOGO_BID_TIK.png') }}" alt="Logo Bid TIK">
                <span>SIMTIK POLDA DIY</span>
            </a>
            <div class="nav-links" id="navLinks">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a>
                <a href="{{ route('kegiatan') }}" class="{{ request()->routeIs('kegiatan*') ? 'active' : '' }}">Kegiatan</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                <a href="{{ route('administrasi') }}" class="{{ request()->routeIs('administrasi*') ? 'active' : '' }}">Administrasi</a>
                <a href="{{ route('layanan.form') }}" class="{{ request()->routeIs('layanan*') ? 'active' : '' }}">Layanan TIK</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn-login">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                @endauth
                <button id="themeToggle" class="public-theme-toggle" title="Ganti Tema">
                    <i class="bi bi-moon-fill" id="themeIcon"></i>
                </button>
            </div>
            <button class="mobile-toggle" onclick="document.getElementById('navLinks').classList.toggle('active')">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    @yield('content')

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="{{ asset('assets/LOGO_BID_TIK.png') }}" alt="Logo">
                    <p>Bidang Teknologi Informasi dan Komunikasi Kepolisian Daerah Daerah Istimewa Yogyakarta</p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/profile.php?id=100087924513256&sk=about" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/bidtik.diy?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('profil') }}">Profil</a></li>
                        <li><a href="{{ route('kegiatan') }}">Kegiatan</a></li>
                        <li><a href="{{ route('kontak') }}">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="{{ route('administrasi') }}">Administrasi</a></li>
                        <li><a href="{{ route('administrasi.persuratan.landing') }}">Persuratan</a></li>
                        <li><a href="{{ route('administrasi.keuangan') }}">Keuangan</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Kontak</h4>
                    <ul>
                        <li><a href="{{ route('kontak') }}">Jl. Ring Road Utara, Sleman, DIY</a></li>
                        <li><a href="{{ route('kontak') }}">bidtik@polda-diy.go.id</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} SIMTIK POLDA DIY. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
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

        const savedTheme = localStorage.getItem('theme');
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
    </script>
    @yield('scripts')
</body>
</html>
