@extends('layouts.public')
@section('title', $berita->judul . ' - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top: 140px; background:var(--gray-50);">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; background:var(--white); border-radius:var(--radius); box-shadow:var(--shadow); overflow:hidden;">
            @if($berita->foto)
                <img src="{{ asset($berita->foto) }}" alt="{{ $berita->judul }}" style="width:100%; max-height:400px; object-fit:cover;">
            @endif
            
            <div style="padding: 40px;">
                <div style="display:flex; gap:15px; color:var(--gray-500); font-size:0.9rem; margin-bottom:20px; font-weight:500;">
                    <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
                    <span><i class="fas fa-clock"></i> {{ $berita->created_at->format('H:i') }} WIB</span>
                </div>
                
                <h1 style="font-family:'Poppins', sans-serif; font-size:2rem; font-weight:800; color:var(--primary); margin-bottom:30px; line-height:1.4;">{{ $berita->judul }}</h1>
                
                <div style="color:var(--gray-700); line-height:1.8; font-size:1.05rem;">
                    {!! nl2br(e($berita->konten)) !!}
                </div>
                
                <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--gray-200); display:flex; justify-content:space-between; align-items:center;">
                    <a href="{{ route('berita') }}" class="btn btn-outline" style="border-color:var(--gray-300); color:var(--gray-700);"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita</a>
                </div>
            </div>
        </div>

        @if($beritas_lain->count() > 0)
        <div style="max-width: 800px; margin: 60px auto 0;">
            <h3 style="font-family:'Poppins', sans-serif; font-size:1.5rem; font-weight:700; color:var(--primary); margin-bottom:20px;">Berita Lainnya</h3>
            <div class="news-list">
                @foreach($beritas_lain as $bl)
                <a href="{{ route('berita.show', $bl->id) }}" class="news-item">
                    <div style="display:flex; gap:20px; align-items:center; width:100%;">
                        @if($bl->foto)
                            <img src="{{ asset($bl->foto) }}" style="width:80px; height:60px; object-fit:cover; border-radius:8px;">
                        @endif
                        <div style="flex:1;">
                            <h4 style="font-size:1.05rem; color:var(--primary); margin-bottom:5px; font-weight:600;">{{ $bl->judul }}</h4>
                            <div class="news-date">{{ \Carbon\Carbon::parse($bl->tanggal)->format('d M Y') }}</div>
                        </div>
                        <div class="news-arrow"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
