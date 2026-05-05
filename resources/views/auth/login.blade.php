<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMTIK POLDA DIY</title>
    <link rel="icon" href="{{ asset('assets/LOGO_BID_TIK.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f2620 0%, #1a3c34 50%, #2d5a4e 100%); }
        .login-container { width: 100%; max-width: 420px; padding: 20px; }
        .login-card { background: rgba(255,255,255,0.97); border-radius: 20px; padding: 45px 35px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); text-align: center; backdrop-filter: blur(20px); }
        .login-logo { margin-bottom: 25px; }
        .login-logo img { height: 80px; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15)); }
        .login-card h2 { font-family: 'Poppins', sans-serif; font-size: 1.5rem; color: #1a3c34; margin-bottom: 5px; }
        .login-card p { color: #6b7280; font-size: 0.9rem; margin-bottom: 30px; }
        .login-card .form-group { text-align: left; margin-bottom: 18px; }
        .login-card .form-group label { font-weight: 600; color: #374151; }
        .login-card .form-control { padding: 13px 16px; border-radius: 10px; }
        .login-btn { width: 100%; padding: 14px; background: linear-gradient(135deg, #1a3c34, #2d5a4e); color: #fff; border: none; border-radius: 10px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Inter', sans-serif; }
        .login-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(26,60,52,0.4); }
        .login-error { background: #fee2e2; color: #991b1b; padding: 10px 15px; border-radius: 8px; font-size: 0.85rem; margin-bottom: 15px; }
        .back-link { display: inline-block; margin-top: 20px; color: rgba(255,255,255,0.7); font-size: 0.9rem; }
        .back-link:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="{{ asset('assets/LOGO_BID_TIK.png') }}" alt="Logo">
            </div>
            <h2>SIMTIK POLDA DIY</h2>
            <p>Masuk ke panel administrasi</p>

            @if($errors->any())
                <div class="login-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                </div>
                <button type="submit" class="login-btn">Masuk</button>
            </form>
        </div>
        <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
    </div>
</body>
</html>
