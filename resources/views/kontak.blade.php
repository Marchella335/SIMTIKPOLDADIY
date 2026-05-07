@extends('layouts.public')
@section('title', 'Kontak - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px;">
    <div class="container">
        <div class="kontak-grid">
            <div class="kontak-info">
                <h1>HUBUNGI KAMI</h1>
                <p style="color:var(--gray-500);margin-bottom:30px;">Bidang TIK Polda DIY siap melayani Anda. Hubungi kami melalui alamat, telepon, email, atau formulir kontak.</p>
                <div class="kontak-detail">
                    <h3>Jl. Ring Road Utara, Sleman, DIY <i class="fas fa-arrow-right" style="color:var(--accent);"></i></h3>
                </div>
                <div class="kontak-detail">
                    <h3>0274 884444 <i class="fas fa-arrow-right" style="color:var(--accent);"></i></h3>
                </div>
                <div class="kontak-detail">
                    <h3>bidtik@polda-diy.go.id <i class="fas fa-arrow-right" style="color:var(--accent);"></i></h3>
                </div>
                <div style="display:flex;gap:15px;margin-top:20px;">
                    <a href="https://www.facebook.com/profile.php?id=100087924513256&sk=about" target="_blank" style="width:40px;height:40px;border-radius:8px;background:var(--gray-900);color:var(--white);display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/bidtik.diy?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" style="width:40px;height:40px;border-radius:8px;background:var(--gray-900);color:var(--white);display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="kontak-form">
                <h3>Kirim pesan atau isi formulir:</h3>
                
                @if(session('success'))
                    <div style="background:#dcfce7;color:#166534;padding:15px;border-radius:10px;margin-bottom:20px;font-size:0.9rem;font-weight:600;">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background:#fee2e2;color:#991b1b;padding:15px;border-radius:10px;margin-bottom:20px;font-size:0.9rem;font-weight:600;">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('kontak.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subjek" class="form-control" placeholder="Subjek Pesan" value="{{ old('subjek') }}" required>
                    </div>
                    <div class="form-group">
                        <textarea name="pesan" class="form-control" placeholder="Tuliskan pesan Anda di sini..." style="min-height:120px;" required>{{ old('pesan') }}</textarea>
                    </div>
                    <p style="font-size:0.8rem;color:var(--gray-500);margin-bottom:15px;">
                        Dengan mengirim formulir ini, pesan Anda akan langsung diteruskan ke tim IT Bidang TIK Polda DIY.
                    </p>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">Kirim Pesan Sekarang</button>
                </form>
            </div>
        </div>

        <div class="map-section">
            <h2>LOKASI KAMI</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0676784498397!2d110.3881234!3d-7.7476652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59a8b8e0a3e3%3A0x5027a76e355bc80!2sPolda%20DIY!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection
