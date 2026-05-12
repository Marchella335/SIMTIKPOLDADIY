@extends('layouts.public')
@section('title', 'Layanan TIK - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px; min-height:100vh;">
    <div class="container" style="max-width:800px;">
        <div class="section-header">
            <span class="section-badge">LAYANAN TIK</span>
            <h2 style="font-family:'Poppins',sans-serif; font-weight:800;">Permintaan Layanan Teknologi</h2>
            <p style="color:var(--gray-500);">Sampaikan kebutuhan layanan TIK Anda. Tim Bid TIK Polda DIY akan segera merespons.</p>
        </div>

        @if(session('success'))
            <div style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); padding:15px 20px; border-radius:12px; margin-bottom:25px; color:var(--success); font-weight:600; display:flex; align-items:center; gap:10px;">
                <i class="bi bi-check-circle-fill" style="font-size:1.3rem;"></i> {{ session('success') }}
            </div>
        @endif

        <div style="background:var(--white); border-radius:16px; padding:35px; box-shadow:var(--shadow); border:1px solid var(--gray-200);">
            <form action="{{ route('layanan.store') }}" method="POST">
                @csrf
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                    <div>
                        <label style="font-weight:600; margin-bottom:8px; display:block; font-size:0.9rem;">Nama Lengkap <span style="color:var(--accent);">*</span></label>
                        <input type="text" name="nama_pemohon" required value="{{ old('nama_pemohon') }}" placeholder="Masukkan nama lengkap" style="width:100%; padding:12px 16px; border:1px solid var(--gray-200); border-radius:10px; font-size:0.95rem; transition:var(--transition); outline:none;">
                    </div>
                    <div>
                        <label style="font-weight:600; margin-bottom:8px; display:block; font-size:0.9rem;">Email <span style="color:var(--accent);">*</span></label>
                        <input type="email" name="email_pemohon" required value="{{ old('email_pemohon') }}" placeholder="email@contoh.com" style="width:100%; padding:12px 16px; border:1px solid var(--gray-200); border-radius:10px; font-size:0.95rem; transition:var(--transition); outline:none;">
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                    <div>
                        <label style="font-weight:600; margin-bottom:8px; display:block; font-size:0.9rem;">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" style="width:100%; padding:12px 16px; border:1px solid var(--gray-200); border-radius:10px; font-size:0.95rem; transition:var(--transition); outline:none;">
                    </div>
                    <div>
                        <label style="font-weight:600; margin-bottom:8px; display:block; font-size:0.9rem;">Jenis Layanan <span style="color:var(--accent);">*</span></label>
                        <select name="jenis_layanan" required style="width:100%; padding:12px 16px; border:1px solid var(--gray-200); border-radius:10px; font-size:0.95rem; transition:var(--transition); outline:none; background:var(--white);">
                            <option value="">-- Pilih Jenis Layanan --</option>
                            <option value="Pengembangan Aplikasi">Pengembangan Aplikasi</option>
                            <option value="Jaringan & Infrastruktur">Jaringan & Infrastruktur</option>
                            <option value="Perbaikan Hardware">Perbaikan Hardware</option>
                            <option value="Instalasi Software">Instalasi Software</option>
                            <option value="Keamanan Siber">Keamanan Siber</option>
                            <option value="Dukungan Teknis Lainnya">Dukungan Teknis Lainnya</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom:25px;">
                    <label style="font-weight:600; margin-bottom:8px; display:block; font-size:0.9rem;">Deskripsi Permasalahan <span style="color:var(--accent);">*</span></label>
                    <textarea name="deskripsi" rows="5" required placeholder="Jelaskan detail permasalahan atau kebutuhan layanan Anda..." style="width:100%; padding:12px 16px; border:1px solid var(--gray-200); border-radius:10px; font-size:0.95rem; resize:vertical; transition:var(--transition); outline:none;">{{ old('deskripsi') }}</textarea>
                </div>

                <button type="submit" style="background:var(--accent); color:#fff; border:none; padding:14px 40px; border-radius:10px; font-size:1rem; font-weight:700; cursor:pointer; transition:var(--transition); display:flex; align-items:center; gap:8px;">
                    <i class="bi bi-send-fill"></i> Kirim Permintaan
                </button>
            </form>
        </div>

        <div style="text-align:center; margin-top:30px; color:var(--gray-500); font-size:0.85rem;">
            <i class="bi bi-shield-check"></i> Data Anda dilindungi dan hanya digunakan untuk keperluan layanan TIK.
        </div>
    </div>
</section>
@endsection
