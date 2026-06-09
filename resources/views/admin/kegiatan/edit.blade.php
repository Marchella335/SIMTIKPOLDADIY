@extends('layouts.admin')
@section('title', 'Edit Kegiatan - Admin SIMTIK')
@section('page-title', 'Edit Kegiatan')

@section('content')
<div class="card">
    <div class="card-header"><h3>Form Edit Kegiatan</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kegiatan.update', $kegiatan) }}" enctype="multipart/form-data" style="max-width:640px;">
            @csrf @method('PUT')

            {{-- ── PILIH RENCANA KEGIATAN ── --}}
            <div class="form-group" style="margin-bottom:24px;">
                <label style="font-weight:700; display:block; margin-bottom:6px;">
                    <i class="fas fa-calendar-check" style="color:var(--primary); margin-right:6px;"></i>
                    Pilih dari Rencana Kegiatan *
                </label>
                <select name="rencana_kegiatan_id" id="rencana_select" class="form-control" required
                        style="border:2px solid var(--primary); border-radius:10px; font-weight:600;">
                    <option value="">-- Pilih Rencana Kegiatan --</option>
                    @foreach($rencanaList as $rk)
                    <option value="{{ $rk->id }}"
                        data-nama="{{ $rk->nama_kegiatan }}"
                        data-tanggal="{{ $rk->tanggal_rencana->format('Y-m-d') }}"
                        data-tempat="{{ $rk->tempat ?? '' }}"
                        data-keterangan="{{ $rk->keterangan ?? '' }}"
                        {{ old('rencana_kegiatan_id', $kegiatan->rencana_kegiatan_id) == $rk->id ? 'selected' : '' }}>
                        📅 {{ $rk->tanggal_rencana->format('d/m/Y') }} — {{ $rk->nama_kegiatan }}
                        @if($rk->tempat) ({{ $rk->tempat }}) @endif
                    </option>
                    @endforeach
                </select>
                @error('rencana_kegiatan_id')<div class="form-error">{{ $message }}</div>@enderror

                {{-- Preview info rencana yang dipilih --}}
                <div id="rencana_preview" style="display:none; margin-top:12px; background:rgba(59,130,246,0.06); border:1px solid rgba(59,130,246,0.25); border-radius:10px; padding:14px 18px;">
                    <div style="font-size:0.8rem; font-weight:700; color:var(--primary); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">
                        <i class="fas fa-info-circle"></i> Detail Rencana
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px; font-size:0.875rem;">
                        <div><span style="color:var(--gray-500); font-weight:600;">Nama:</span> <span id="prev_nama" style="color:var(--text-primary); font-weight:700;"></span></div>
                        <div><span style="color:var(--gray-500); font-weight:600;">Tanggal:</span> <span id="prev_tanggal" style="color:var(--text-primary);"></span></div>
                        <div><span style="color:var(--gray-500); font-weight:600;">Tempat:</span> <span id="prev_tempat" style="color:var(--text-primary);"></span></div>
                    </div>
                </div>
            </div>

            {{-- ── TANGGAL PELAKSANAAN ── --}}
            <div class="form-group">
                <label>Tanggal Pelaksanaan *</label>
                <input type="date" name="tanggal" id="tanggal_input" class="form-control"
                       value="{{ old('tanggal', $kegiatan->tanggal->format('Y-m-d')) }}" required>
            </div>

            {{-- ── DESKRIPSI ── --}}
            <div class="form-group">
                <label>Deskripsi / Keterangan Kegiatan *</label>
                <textarea name="deskripsi" id="deskripsi_input" class="form-control" rows="5" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                @error('deskripsi')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group"><label>Hasil Rapat (Internal)</label><textarea name="hasil_rapat" class="form-control" rows="3">{{ old('hasil_rapat', $kegiatan->hasil_rapat) }}</textarea>@error('hasil_rapat')<div class="form-error">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>Ringkasan Hasil Kegiatan (Publik)</label><textarea name="hasil" class="form-control" rows="3" placeholder="Hasil atau output dari pelaksanaan kegiatan untuk publik">{{ old('hasil', $kegiatan->hasil) }}</textarea>@error('hasil')<div class="form-error">{{ $message }}</div>@enderror</div>
            
            <div class="form-row" style="display: flex; gap: 15px;">
                <div class="form-group" style="flex: 1;">
                    <label>Gambar / Brosur</label>
                    @if($kegiatan->gambar)
                        <div style="margin-bottom:10px;"><img src="{{ asset($kegiatan->gambar) }}" style="width:120px;height:80px;object-fit:cover;border-radius:8px;"></div>
                    @endif
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    @error('gambar')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Foto Dokumentasi</label>
                    @if($kegiatan->foto)
                        <div style="margin-bottom:10px;"><img src="{{ asset($kegiatan->foto) }}" style="width:120px;height:80px;object-fit:cover;border-radius:8px;"></div>
                    @endif
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    @error('foto')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <div class="form-group">
                <label>Tampilkan di Website *</label>
                <select name="tampilkan" class="form-control" required>
                    <option value="1" {{ old('tampilkan', $kegiatan->tampilkan ? '1' : '0') == '1' ? 'selected' : '' }}>Ya (Tampilkan di Homepage & Kegiatan)</option>
                    <option value="0" {{ old('tampilkan', $kegiatan->tampilkan ? '1' : '0') == '0' ? 'selected' : '' }}>Tidak (Hanya Simpan di Admin)</option>
                </select>
                @error('tampilkan')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex;gap:10px;margin-top:25px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button><a href="{{ route('admin.kegiatan.index') }}" class="btn btn-outline">Batal</a></div>
        </form>
    </div>
</div>

<script>
(function () {
    const select   = document.getElementById('rencana_select');
    const preview  = document.getElementById('rencana_preview');
    const tanggal  = document.getElementById('tanggal_input');
    const deskripsi = document.getElementById('deskripsi_input');

    function applyRencana() {
        const opt = select.options[select.selectedIndex];
        if (!opt || !opt.value) {
            preview.style.display = 'none';
            return;
        }

        const nama       = opt.getAttribute('data-nama');
        const tgl        = opt.getAttribute('data-tanggal');
        const tempat     = opt.getAttribute('data-tempat');
        const keterangan = opt.getAttribute('data-keterangan');

        // Auto-fill tanggal dari rencana (bisa diubah admin)
        if (tgl && !tanggal.dataset.modified) {
            tanggal.value = tgl;
        }

        // Auto-fill deskripsi dari keterangan rencana (jika masih kosong)
        if (keterangan && !deskripsi.value.trim()) {
            deskripsi.value = keterangan;
        }

        // Tampilkan preview
        document.getElementById('prev_nama').textContent    = nama;
        document.getElementById('prev_tanggal').textContent = tgl ? new Date(tgl).toLocaleDateString('id-ID', {day:'2-digit', month:'long', year:'numeric'}) : '-';
        document.getElementById('prev_tempat').textContent  = tempat || '-';
        preview.style.display = 'block';
    }

    select.addEventListener('change', function () {
        tanggal.dataset.modified = '';
        applyRencana();
    });

    tanggal.addEventListener('change', function () {
        tanggal.dataset.modified = '1';
    });

    // Apply saat page load (untuk old() value atau existing value)
    if (select.value) applyRencana();
})();
</script>
@endsection
