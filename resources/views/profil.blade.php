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

        {{-- KABID TIK: hanya nama dan jabatan --}}
        @if($kabidTik)
        <div style="display:flex; justify-content:center; margin-bottom:50px;">
            <div style="
                background:#fff;
                border:2px solid var(--accent);
                border-radius:16px;
                padding:28px 48px;
                text-align:center;
                box-shadow:0 4px 20px rgba(0,0,0,0.08);
                min-width:260px;
            ">
                <div style="
                    display:inline-flex;
                    align-items:center;
                    justify-content:center;
                    width:64px; height:64px;
                    border-radius:50%;
                    background:var(--accent);
                    margin-bottom:16px;
                ">
                    <i class="fas fa-user-tie" style="font-size:1.8rem; color:#fff;"></i>
                </div>
                <div style="font-size:0.85rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">
                    {{ $kabidTik->jabatan }}
                </div>
                <h3 style="font-size:1.25rem; font-weight:700; color:var(--gray-800); margin:0;">
                    {{ $kabidTik->nama_lengkap }}
                </h3>
            </div>
        </div>
        @endif

        {{-- STRUKTUR PER SUBBIDANG --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:32px; margin-top:20px;">

            {{-- Subbid Renmin --}}
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.08); border:1px solid var(--gray-200);">
                <div style="background:var(--primary); padding:16px 24px;">
                    <h4 style="color:#fff; margin:0; font-size:1rem; font-weight:700; text-align:center;">Subbid Renmin</h4>
                </div>
                <div style="padding:24px; text-align:center;">
                    @if(isset($struktur['renmin']) && $struktur['renmin'])
                        <img 
                            src="{{ asset($struktur['renmin']) }}" 
                            alt="Struktur Subbid Renmin"
                            style="width:100%; border-radius:8px; cursor:pointer;"
                            onclick="showStruktur('{{ asset($struktur['renmin']) }}', 'Struktur Subbid Renmin')"
                            title="Klik untuk memperbesar"
                        >
                        <p style="font-size:0.8rem; color:var(--gray-400); margin-top:10px; margin-bottom:0;">
                            <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                        </p>
                    @else
                        <div style="padding:40px 20px; color:var(--gray-400);">
                            <i class="fas fa-image" style="font-size:3rem; display:block; margin-bottom:12px;"></i>
                            <p style="margin:0; font-size:0.9rem;">Gambar struktur belum diunggah</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Subbid Tekkom --}}
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.08); border:1px solid var(--gray-200);">
                <div style="background:var(--primary); padding:16px 24px;">
                    <h4 style="color:#fff; margin:0; font-size:1rem; font-weight:700; text-align:center;">Subbid Tekkom</h4>
                </div>
                <div style="padding:24px; text-align:center;">
                    @if(isset($struktur['tekkom']) && $struktur['tekkom'])
                        <img 
                            src="{{ asset($struktur['tekkom']) }}" 
                            alt="Struktur Subbid Tekkom"
                            style="width:100%; border-radius:8px; cursor:pointer;"
                            onclick="showStruktur('{{ asset($struktur['tekkom']) }}', 'Struktur Subbid Tekkom')"
                            title="Klik untuk memperbesar"
                        >
                        <p style="font-size:0.8rem; color:var(--gray-400); margin-top:10px; margin-bottom:0;">
                            <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                        </p>
                    @else
                        <div style="padding:40px 20px; color:var(--gray-400);">
                            <i class="fas fa-image" style="font-size:3rem; display:block; margin-bottom:12px;"></i>
                            <p style="margin:0; font-size:0.9rem;">Gambar struktur belum diunggah</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Subbid Tekinfo --}}
            <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.08); border:1px solid var(--gray-200);">
                <div style="background:var(--primary); padding:16px 24px;">
                    <h4 style="color:#fff; margin:0; font-size:1rem; font-weight:700; text-align:center;">Subbid Tekinfo</h4>
                </div>
                <div style="padding:24px; text-align:center;">
                    @if(isset($struktur['tekinfo']) && $struktur['tekinfo'])
                        <img 
                            src="{{ asset($struktur['tekinfo']) }}" 
                            alt="Struktur Subbid Tekinfo"
                            style="width:100%; border-radius:8px; cursor:pointer;"
                            onclick="showStruktur('{{ asset($struktur['tekinfo']) }}', 'Struktur Subbid Tekinfo')"
                            title="Klik untuk memperbesar"
                        >
                        <p style="font-size:0.8rem; color:var(--gray-400); margin-top:10px; margin-bottom:0;">
                            <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                        </p>
                    @else
                        <div style="padding:40px 20px; color:var(--gray-400);">
                            <i class="fas fa-image" style="font-size:3rem; display:block; margin-bottom:12px;"></i>
                            <p style="margin:0; font-size:0.9rem;">Gambar struktur belum diunggah</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal Gambar Struktur -->
<div id="strukturModal" class="modal-bg" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.85); z-index:9999; align-items:center; justify-content:center; flex-direction:column;">
    <div style="position:relative; max-width:92%; max-height:90%;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
            <span id="strukturModalTitle" style="color:#fff; font-size:1.1rem; font-weight:600;"></span>
            <span onclick="closeStruktur()" style="color:#fff; font-size:32px; cursor:pointer; font-weight:bold; line-height:1; margin-left:20px;">&times;</span>
        </div>
        <img id="strukturImg" src="" style="max-width:100%; max-height:80vh; border-radius:10px; border:3px solid var(--accent); display:block;">
    </div>
</div>

<script>
function showStruktur(url, title) {
    document.getElementById('strukturImg').src = url;
    document.getElementById('strukturModalTitle').textContent = title || '';
    document.getElementById('strukturModal').style.display = 'flex';
}
function closeStruktur() {
    document.getElementById('strukturModal').style.display = 'none';
}
// Tutup modal jika klik di luar gambar
document.getElementById('strukturModal').addEventListener('click', function(e) {
    if (e.target === this) closeStruktur();
});
</script>
@endsection
