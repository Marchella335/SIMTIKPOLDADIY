@extends('layouts.public')
@section('title', $kegiatan->nama_kegiatan . ' - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px;">
    <div class="container" style="max-width:800px;">
        <a href="{{ route('kegiatan') }}" style="display:inline-flex;align-items:center;gap:8px;color:var(--primary);font-weight:500;margin-bottom:20px;"><i class="fas fa-arrow-left"></i> Kembali</a>
        @if($kegiatan->gambar)
            <img src="{{ asset($kegiatan->gambar) }}" alt="{{ $kegiatan->nama_kegiatan }}" style="width:100%;border-radius:var(--radius);margin-bottom:25px;box-shadow:var(--shadow);">
        @endif
        <p style="color:var(--gray-500);font-size:0.9rem;margin-bottom:10px;"><i class="far fa-calendar"></i> {{ $kegiatan->tanggal->format('d F Y') }} | <i class="far fa-clock"></i> {{ $kegiatan->created_at->format('H:i') }} WIB</p>
        <h1 style="font-family:'Poppins',sans-serif;font-size:2rem;font-weight:700;margin-bottom:20px;">{{ $kegiatan->nama_kegiatan }}</h1>
        <div style="color:var(--gray-700);line-height:1.8;font-size:1rem;">{!! nl2br(e($kegiatan->deskripsi)) !!}</div>
    </div>
</section>
@endsection
