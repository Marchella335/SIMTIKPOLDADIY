@extends('layouts.public')
@section('title', 'Profil - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px;">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Profil</div>
            <h2 class="section-title">Bidang TIK Polda DIY</h2>
            <p class="section-subtitle">Bidang Teknologi Informasi dan Komunikasi Kepolisian Daerah Daerah Istimewa Yogyakarta</p>
        </div>
        <div style="max-width:800px;margin:0 auto 60px;text-align:center;">
            <p style="color:var(--gray-500);line-height:1.8;margin-bottom:15px;">Bidang TIK Polda DIY merupakan unsur pelaksana pada tingkat Polda yang bertugas menyelenggarakan kegiatan di bidang teknologi informasi dan komunikasi, meliputi perencanaan, pengembangan, pemeliharaan, dan pengamanan sistem informasi serta infrastruktur jaringan komunikasi.</p>
            <p style="color:var(--gray-500);line-height:1.8;">Bidang TIK dipimpin oleh Kepala Bidang TIK (Kabid TIK) yang bertanggung jawab kepada Kapolda, dan dalam pelaksanaan tugas sehari-hari di bawah kendali Wakapolda. Bidang TIK terdiri dari Sub Bidang Perencanaan dan Administrasi (Subbid Renmin), Sub Bidang Teknologi Komunikasi (Subbid Tekkom), dan Sub Bidang Teknologi Informasi (Subbid Tekinfo).</p>
        </div>
    </div>
</section>

<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">&#9679; Struktur Organisasi</div>
            <h2 class="section-title">Struktur Organisasi Bid TIK Polda DIY</h2>
        </div>

        <div class="org-chart">
            {{-- KABID TIK --}}
            @if($kabid->count())
            <div class="org-level">
                @foreach($kabid as $a)
                <div class="org-card" style="border-color:var(--accent);min-width:220px;">
                    @if($a->foto)
                        <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                    @else
                        <div class="no-photo"><i class="fas fa-user"></i></div>
                    @endif
                    <div class="jabatan">{{ $a->jabatan }}</div>
                    <h4>{{ $a->pangkat }} {{ $a->nama_lengkap }}</h4>
                    <div class="pangkat">NRP: {{ $a->nrp ?? '-' }}</div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- KASUBBID --}}
            @if($kasubbid->count())
            <div class="org-level">
                @php
                    $order = ['Kasubbid Renmin', 'Kasubbid Tekkom', 'Kasubbid Tekinfo'];
                    $sorted = $kasubbid->sortBy(function($a) use ($order) { return array_search($a->jabatan, $order); });
                @endphp
                @foreach($sorted as $a)
                <div class="org-card" style="border-color:var(--primary);">
                    @if($a->foto)
                        <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                    @else
                        <div class="no-photo"><i class="fas fa-user"></i></div>
                    @endif
                    <div class="jabatan">{{ $a->jabatan }}</div>
                    <h4>{{ $a->pangkat }} {{ $a->nama_lengkap }}</h4>
                    <div class="pangkat">NRP: {{ $a->nrp ?? '-' }}</div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- MEMBERS PER SUBBID --}}
            <div class="subbid-container">
                <div class="subbid-group">
                    <div class="org-section-title">Subbid Renmin</div>
                    <div class="org-members">
                        @forelse($renmin as $a)
                        <div class="org-card">
                            @if($a->foto)
                                <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                            @else
                                <div class="no-photo"><i class="fas fa-user"></i></div>
                            @endif
                            <div class="jabatan">{{ $a->jabatan }}</div>
                            <h4>{{ $a->pangkat }} {{ $a->nama_lengkap }}</h4>
                        </div>
                        @empty
                        <p style="color:var(--gray-500);text-align:center;grid-column:1/-1;">Belum ada anggota</p>
                        @endforelse
                    </div>
                </div>
                <div class="subbid-group">
                    <div class="org-section-title">Subbid Tekkom</div>
                    <div class="org-members">
                        @forelse($tekkom as $a)
                        <div class="org-card">
                            @if($a->foto)
                                <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                            @else
                                <div class="no-photo"><i class="fas fa-user"></i></div>
                            @endif
                            <div class="jabatan">{{ $a->jabatan }}</div>
                            <h4>{{ $a->pangkat }} {{ $a->nama_lengkap }}</h4>
                        </div>
                        @empty
                        <p style="color:var(--gray-500);text-align:center;grid-column:1/-1;">Belum ada anggota</p>
                        @endforelse
                    </div>
                </div>
                <div class="subbid-group">
                    <div class="org-section-title">Subbid Tekinfo</div>
                    <div class="org-members">
                        @forelse($tekinfo as $a)
                        <div class="org-card">
                            @if($a->foto)
                                <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                            @else
                                <div class="no-photo"><i class="fas fa-user"></i></div>
                            @endif
                            <div class="jabatan">{{ $a->jabatan }}</div>
                            <h4>{{ $a->pangkat }} {{ $a->nama_lengkap }}</h4>
                        </div>
                        @empty
                        <p style="color:var(--gray-500);text-align:center;grid-column:1/-1;">Belum ada anggota</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
