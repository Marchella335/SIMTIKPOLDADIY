@extends('layouts.public')
@section('title', 'Kegiatan - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px;">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Berita & Kegiatan</div>
            <h2 class="section-title">Kegiatan Bid TIK Polda DIY</h2>
            <p class="section-subtitle">Informasi kegiatan terbaru dari Bidang TIK Polda DIY</p>
        </div>
        <div class="kegiatan-grid">
            @forelse($kegiatans as $k)
            <a href="{{ route('kegiatan.show', $k->id) }}" class="kegiatan-card">
                @if($k->gambar)
                    <img src="{{ asset($k->gambar) }}" alt="{{ $k->nama_kegiatan }}">
                @else
                    <div style="height:200px;background:linear-gradient(135deg,var(--primary),var(--primary-light));display:flex;align-items:center;justify-content:center;color:var(--white);font-size:3rem;"><i class="fas fa-calendar-alt"></i></div>
                @endif
                <div class="card-body">
                    <div class="card-date"><i class="far fa-calendar"></i> {{ $k->tanggal->format('d M Y') }} | <i class="far fa-clock"></i> {{ $k->created_at->format('H:i') }} WIB</div>
                    <h3>{{ $k->nama_kegiatan }}</h3>
                    <p>{{ Str::limit($k->deskripsi, 100) }}</p>
                </div>
            </a>
            @empty
            <p style="text-align:center;color:var(--gray-500);grid-column:1/-1;">Belum ada kegiatan yang dipublikasikan.</p>
            @endforelse
        </div>
        <div class="pagination-wrapper">
            {{ $kegiatans->links() }}
        </div>
    </div>
</section>
@endsection
