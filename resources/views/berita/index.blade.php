@extends('layouts.public')
@section('title', 'Berita - SIMTIK POLDA DIY')

@section('content')
<section class="hero section-dark" style="min-height: 40vh; padding-top: 140px; background: linear-gradient(rgba(10,10,10,0.8), rgba(10,10,10,0.9)), url('{{ asset('assets/LOGO_BID_TIK.png') }}') center/cover;">
    <div class="container text-center">
        <h1 style="font-family:'Poppins', sans-serif; font-size:3rem; font-weight:800; color:var(--white); margin-bottom:15px;">Berita Terkini</h1>
        <p style="font-size:1.1rem; color:var(--gray-300); max-width:600px; margin:0 auto;">Informasi dan Berita terbaru dari Bidang TIK Polda DIY.</p>
    </div>
</section>

<section class="section section-gray">
    <div class="container">
        <div class="kegiatan-grid">
            @forelse($beritas as $b)
            <div class="kegiatan-card">
                @if($b->foto)
                    <img src="{{ asset($b->foto) }}" alt="{{ $b->judul }}">
                @else
                    <div style="width:100%; height:220px; background:var(--gray-200); display:flex; align-items:center; justify-content:center; color:var(--gray-500); border-bottom: 3px solid var(--accent);">
                        <i class="fas fa-newspaper fa-3x"></i>
                    </div>
                @endif
                <div class="card-body">
                    <div class="card-date"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }} | <i class="fas fa-clock"></i> {{ $b->created_at->format('H:i') }} WIB</div>
                    <h3 style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $b->judul }}</h3>
                    <p style="display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">{{ Str::limit(strip_tags($b->konten), 120) }}</p>
                    <a href="{{ route('berita.show', $b->id) }}" class="btn btn-outline" style="margin-top:20px; width:100%; justify-content:center; border-color:var(--gray-300); color:var(--primary);">Baca Selengkapnya</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align:center; padding: 60px 20px; background:var(--white); border-radius:var(--radius); box-shadow:var(--shadow);">
                <i class="fas fa-newspaper fa-4x" style="color:var(--gray-300); margin-bottom:20px;"></i>
                <h3 style="color:var(--gray-700); font-family:'Poppins', sans-serif;">Belum ada berita</h3>
                <p style="color:var(--gray-500);">Berita akan segera ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <div class="pagination-wrapper" style="margin-top: 50px;">
            {{ $beritas->links() }}
        </div>
    </div>
</section>
@endsection
