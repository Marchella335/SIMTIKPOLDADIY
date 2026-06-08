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
        <div style="max-width:800px;margin:0 auto 60px;text-align:left;">
            <p style="color:var(--gray-500);line-height:1.8;margin-bottom:15px;text-align:center;">Bidang TIK Polda DIY merupakan unsur pelaksana pada tingkat Polda yang bertugas menyelenggarakan kegiatan di bidang teknologi informasi dan komunikasi, meliputi perencanaan, pengembangan, pemeliharaan, dan pengamanan sistem informasi serta infrastruktur jaringan komunikasi.</p>
            <p style="color:var(--gray-500);line-height:1.8;margin-bottom:30px;text-align:center;">Bidang TIK dipimpin oleh Kepala Bidang TIK (Kabid TIK) yang bertanggung jawab kepada Kapolda, dan dalam pelaksanaan tugas sehari-hari di bawah kendali Wakapolda. Bidang TIK terdiri dari Sub Bidang Perencanaan dan Administrasi (Subbid Renmin), Sub Bidang Teknologi Komunikasi (Subbid Tekkom), dan Sub Bidang Teknologi Informasi (Subbid Tekinfo).</p>
            
            <div style="background:var(--gray-50); padding:30px; border-radius:12px; border:1px solid var(--gray-200);">
                <h3 style="color:var(--primary); margin-bottom:15px; font-size:1.4rem; text-align:center;">VISI</h3>
                <p style="color:var(--gray-700); line-height:1.8; text-align:center; font-weight:500; font-style:italic;">
                    "Terwujudnya Pelayanan di Bidang Teknologi Informasi dan Komunikasi dalam Mendukung Operasional kegiatan Kepolisian di wilayah Polda D.I. Yogyakarta yang Tertib, Aman, dan Terkendali."
                </p>

                <h3 style="color:var(--primary); margin-top:30px; margin-bottom:15px; font-size:1.4rem; text-align:center;">MISI</h3>
                <ol style="color:var(--gray-700); line-height:1.8; padding-left:20px; text-align:left;" type="A">
                    <li style="margin-bottom:10px;">Meningkatkan kemampuan sumber daya manusia Bidang Teknologi Informasi dan Komunikasi;</li>
                    <li style="margin-bottom:10px;">Melaksanakan dukungan teknis bidang Teknologi, Informasi, dan Komunikasi kepada seluruh jajaran dan memelihara sarana dan prasarana Teknologi Komunikasi;</li>
                    <li style="margin-bottom:10px;">Menyelenggarakan pembinaan dan pengembangan Inovasi System Informasi dan Komunikasi guna terwujudnya keterpaduan antar fungsi dalam pelaksanaan tugas pokok Polri dalam bidang penyajian Tekologi, Informasi, dan Komunikasi;</li>
                    <li style="margin-bottom:10px;">Optimalisasi kerjasama dalam bidang Teknologi, Informasi, dan Komunikasi dengan Instansi terkait;</li>
                    <li style="margin-bottom:10px;">Kerjasama dalam pencegahan gangguan terhadap keamanan informasi dan komunikasi dalam lingkungan Kepolisian.</li>
                </ol>
            </div>
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
                    <div class="pangkat">{{ $a->pangkat }}</div>
                    <h4>{{ $a->nama_lengkap }}</h4>
                    <div style="font-size:0.8rem; color:var(--gray-500); margin-top:4px;">NRP: {{ $a->nrp ?? '-' }}</div>
                    @if($a->jobdesk)
                        <div style="font-size:0.78rem; color:var(--gray-500); margin-top:4px; font-style:italic;">{{ $a->jobdesk }}</div>
                    @endif
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
                    <div class="pangkat">{{ $a->pangkat }}</div>
                    <h4>{{ $a->nama_lengkap }}</h4>
                    <div style="font-size:0.8rem; color:var(--gray-500); margin-top:4px;">NRP: {{ $a->nrp ?? '-' }}</div>
                    @if($a->jobdesk)
                        <div style="font-size:0.78rem; color:var(--gray-500); margin-top:4px; font-style:italic;">{{ $a->jobdesk }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            {{-- MEMBERS PER SUBBID --}}
            <div class="subbid-container">
                <div class="subbid-group">
                    <div class="org-section-title" @if(isset($struktur['Renmin'])) onclick="showStruktur('{{ asset($struktur['Renmin']) }}')" style="cursor:pointer;" title="Klik untuk melihat struktur" @endif>Subbid Renmin</div>
                    <div class="org-members">
                        @forelse($renmin as $a)
                        <div class="org-card">
                            @if($a->foto)
                                <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                            @else
                                <div class="no-photo"><i class="fas fa-user"></i></div>
                            @endif
                            <div class="jabatan">{{ $a->jabatan }}</div>
                            <div class="pangkat">{{ $a->pangkat }}</div>
                            <h4>{{ $a->nama_lengkap }}</h4>
                            @if($a->jobdesk)
                                <div style="font-size:0.78rem; color:var(--gray-500); margin-top:4px; font-style:italic;">{{ $a->jobdesk }}</div>
                            @endif
                        </div>
                        @empty
                        <p style="color:var(--gray-500);text-align:center;grid-column:1/-1;">Belum ada anggota</p>
                        @endforelse
                    </div>
                </div>
                <div class="subbid-group">
                    <div class="org-section-title" @if(isset($struktur['Tekkom'])) onclick="showStruktur('{{ asset($struktur['Tekkom']) }}')" style="cursor:pointer;" title="Klik untuk melihat struktur" @endif>Subbid Tekkom</div>
                    <div class="org-members">
                        @forelse($tekkom as $a)
                        <div class="org-card">
                            @if($a->foto)
                                <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                            @else
                                <div class="no-photo"><i class="fas fa-user"></i></div>
                            @endif
                            <div class="jabatan">{{ $a->jabatan }}</div>
                            <div class="pangkat">{{ $a->pangkat }}</div>
                            <h4>{{ $a->nama_lengkap }}</h4>
                            @if($a->jobdesk)
                                <div style="font-size:0.78rem; color:var(--gray-500); margin-top:4px; font-style:italic;">{{ $a->jobdesk }}</div>
                            @endif
                        </div>
                        @empty
                        <p style="color:var(--gray-500);text-align:center;grid-column:1/-1;">Belum ada anggota</p>
                        @endforelse
                    </div>
                </div>
                <div class="subbid-group">
                    <div class="org-section-title" @if(isset($struktur['Tekinfo'])) onclick="showStruktur('{{ asset($struktur['Tekinfo']) }}')" style="cursor:pointer;" title="Klik untuk melihat struktur" @endif>Subbid Tekinfo</div>
                    <div class="org-members">
                        @forelse($tekinfo as $a)
                        <div class="org-card">
                            @if($a->foto)
                                <img src="{{ asset($a->foto) }}" alt="{{ $a->nama_lengkap }}">
                            @else
                                <div class="no-photo"><i class="fas fa-user"></i></div>
                            @endif
                            <div class="jabatan">{{ $a->jabatan }}</div>
                            <div class="pangkat">{{ $a->pangkat }}</div>
                            <h4>{{ $a->nama_lengkap }}</h4>
                            @if($a->jobdesk)
                                <div style="font-size:0.78rem; color:var(--gray-500); margin-top:4px; font-style:italic;">{{ $a->jobdesk }}</div>
                            @endif
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

<!-- Modal Struktur -->
<div id="strukturModal" class="modal-bg" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.8); z-index:9999; align-items:center; justify-content:center;">
    <div style="position:relative; max-width:90%; max-height:90%;">
        <span onclick="closeStruktur()" style="position:absolute; top:-40px; right:0; color:#fff; font-size:30px; cursor:pointer; font-weight:bold;">&times;</span>
        <img id="strukturImg" src="" style="max-width:100%; max-height:85vh; border-radius:8px; border:3px solid var(--accent);">
    </div>
</div>

<script>
function showStruktur(url) {
    document.getElementById('strukturImg').src = url;
    document.getElementById('strukturModal').style.display = 'flex';
}
function closeStruktur() {
    document.getElementById('strukturModal').style.display = 'none';
}
</script>
@endsection
