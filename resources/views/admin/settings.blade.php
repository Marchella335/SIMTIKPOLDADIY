@extends('layouts.admin')
@section('title', 'Pengaturan Sistem - Admin SIMTIK')
@section('page-title', 'Pengaturan Sistem')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header">
        <h3><i class="bi bi-gear-fill"></i> Pengaturan Tampilan Homepage</h3>
    </div>
    <div class="card-body">
        <p style="color: var(--gray-500); margin-bottom: 25px; font-size: 0.9rem;">
            Atur bagian mana saja yang ditampilkan di halaman utama (homepage) website publik.
        </p>
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Berita Toggle --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px; background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 10px; margin-bottom: 15px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 44px; height: 44px; background: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 0.95rem; color: var(--gray-900);">Tampilkan Bagian Berita</div>
                        <div style="font-size: 0.82rem; color: var(--gray-500); margin-top: 2px;">Menampilkan 3 berita terbaru di homepage</div>
                    </div>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="show_berita" id="show_berita" {{ $showBerita ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            {{-- Kegiatan Toggle --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px; background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 10px; margin-bottom: 30px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 44px; height: 44px; background: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 0.95rem; color: var(--gray-900);">Tampilkan Bagian Kegiatan</div>
                        <div style="font-size: 0.82rem; color: var(--gray-500); margin-top: 2px;">Menampilkan 3 kegiatan terbaru di homepage</div>
                    </div>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="show_kegiatan" id="show_kegiatan" {{ $showKegiatan ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
.toggle-switch {
    position: relative;
    display: inline-block;
    width: 52px;
    height: 28px;
    flex-shrink: 0;
}
.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: var(--gray-300);
    border-radius: 28px;
    transition: 0.3s;
}
.toggle-slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    border-radius: 50%;
    transition: 0.3s;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}
.toggle-switch input:checked + .toggle-slider {
    background-color: var(--accent);
}
.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(24px);
}
</style>
@endsection
