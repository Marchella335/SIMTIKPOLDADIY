@extends('layouts.admin')
@section('title', 'Update Status Layanan - SIMTIK')
@section('page-title', 'Update Status Layanan')

@section('content')
<div class="card">
    <div class="card-header"><h3>Tiket #{{ $layanan->id }} — Update Status</h3></div>
    <div class="card-body">
        {{-- Ticket Detail --}}
        <div style="background:var(--gray-50); padding:25px; border-radius:12px; margin-bottom:25px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div>
                    <small style="color:var(--gray-500);">Pemohon</small>
                    <p style="font-weight:700;">{{ $layanan->nama_pemohon }}</p>
                </div>
                <div>
                    <small style="color:var(--gray-500);">Email</small>
                    <p>{{ $layanan->email_pemohon }}</p>
                </div>
                <div>
                    <small style="color:var(--gray-500);">No. HP</small>
                    <p>{{ $layanan->no_hp ?? '-' }}</p>
                </div>
                <div>
                    <small style="color:var(--gray-500);">Jenis Layanan</small>
                    <p><span class="badge badge-info">{{ $layanan->jenis_layanan }}</span></p>
                </div>
                <div style="grid-column:span 2;">
                    <small style="color:var(--gray-500);">Deskripsi</small>
                    <p>{{ $layanan->deskripsi }}</p>
                </div>
                @if($layanan->rating)
                <div style="grid-column:span 2;">
                    <small style="color:var(--gray-500);">Rating dari User</small>
                    <p>
                        @for($s = 1; $s <= 5; $s++)
                            <i class="bi bi-star-fill" style="font-size:1.2rem; color:{{ $s <= $layanan->rating ? 'var(--warning)' : 'var(--gray-200)' }};"></i>
                        @endfor
                        <span style="margin-left:8px; font-weight:700;">{{ $layanan->rating }}/5</span>
                    </p>
                    @if($layanan->feedback)
                        <p style="margin-top:5px; color:var(--gray-500); font-style:italic;">"{{ $layanan->feedback }}"</p>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Link Rating untuk dikirim ke User --}}
        <div style="background:rgba(220,38,38,0.05); border:1px solid rgba(220,38,38,0.2); padding:15px 20px; border-radius:10px; margin-bottom:25px;">
            <small style="color:var(--accent); font-weight:600;"><i class="bi bi-link-45deg"></i> Link Rating untuk User:</small>
            <div style="display:flex; align-items:center; gap:10px; margin-top:8px;">
                <input type="text" value="{{ route('layanan.rate', $layanan->token) }}" id="ratingLink" readonly style="flex:1; padding:10px 14px; border:1px solid var(--gray-200); border-radius:8px; font-size:0.85rem; background:var(--white);">
                <button onclick="navigator.clipboard.writeText(document.getElementById('ratingLink').value); this.innerHTML='<i class=\'bi bi-check\'></i> Copied!'; setTimeout(()=>this.innerHTML='<i class=\'bi bi-clipboard\'></i> Copy', 2000);" style="padding:10px 16px; background:var(--accent); color:#fff; border:none; border-radius:8px; cursor:pointer; font-weight:600; white-space:nowrap;">
                    <i class="bi bi-clipboard"></i> Copy
                </button>
            </div>
        </div>

        {{-- Status Update Form --}}
        <form action="{{ route('admin.layanan.update', $layanan) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group" style="margin-bottom:20px;">
                <label style="font-weight:600; margin-bottom:8px; display:block;">Update Status</label>
                <select name="status" required style="width:100%; padding:12px 16px; border:1px solid var(--gray-200); border-radius:10px; font-size:0.95rem;">
                    @foreach(['Pending', 'In Progress', 'Completed'] as $s)
                        <option value="{{ $s }}" {{ $layanan->status == $s ? 'selected' : '' }}>
                            {{ $s == 'Pending' ? '⏳' : ($s == 'In Progress' ? '🔄' : '✅') }} {{ $s }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Simpan Status</button>
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
