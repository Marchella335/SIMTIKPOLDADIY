@extends('layouts.admin')
@section('title', 'Rencana Kegiatan & Berita - Admin SIMTIK')
@section('page-title', 'Rencana Ke Depan')

@section('content')
<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px;">
        <div style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
            <h3 style="margin:0;">Daftar Rencana Ke Depan</h3>
            <form method="GET" action="{{ route('admin.rencana-kegiatan.index') }}" style="display:flex; gap:10px; align-items:center;">
                <label style="font-size:0.85rem; font-weight:600; color:var(--gray-500);">Filter Tipe:</label>
                <select name="tipe" onchange="this.form.submit()" class="form-control" style="width:160px; height:32px; padding:0 10px; font-size:0.82rem; border-radius:8px;">
                    <option value="">Semua Rencana</option>
                    <option value="kegiatan" {{ request('tipe') == 'kegiatan' ? 'selected' : '' }}>Rencana Kegiatan</option>
                    <option value="berita" {{ request('tipe') == 'berita' ? 'selected' : '' }}>Rencana Berita</option>
                </select>
            </form>
        </div>
        <a href="{{ route('admin.rencana-kegiatan.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Rencana Baru</a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Rencana / Judul</th>
                        <th>Tipe</th>
                        <th>Tanggal Rencana</th>
                        <th>Tempat / Kategori</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rencanaKegiatans as $i => $rk)
                    <tr>
                        <td>{{ $rencanaKegiatans->firstItem() + $i }}</td>
                        <td style="font-weight: 600; color:var(--text-primary);">{{ $rk->nama_kegiatan }}</td>
                        <td>
                            @if($rk->tipe == 'berita')
                                <span style="background:rgba(124,58,237,0.15); color:#7c3aed; padding:4px 10px; border-radius:20px; font-size:0.75rem; font-weight:700;">Berita</span>
                            @else
                                <span style="background:rgba(2,132,199,0.15); color:#0284c7; padding:4px 10px; border-radius:20px; font-size:0.75rem; font-weight:700;">Kegiatan</span>
                            @endif
                        </td>
                        <td>{{ $rk->tanggal_rencana->format('d/m/Y') }}</td>
                        <td>
                            @if($rk->tipe == 'berita')
                                <span style="color:#7c3aed; font-weight:600;"><i class="bi bi-tag" style="margin-right:4px;"></i>{{ $rk->kategori ?? '-' }}</span>
                            @else
                                <span><i class="bi bi-geo-alt" style="margin-right:4px;"></i>{{ $rk->tempat ?? '-' }}</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($rk->keterangan ?? '-', 50) }}</td>
                        <td>
                            @if($rk->status == 'dijadwalkan')
                                <span style="background:#3b82f6; color:white; padding:4px 8px; border-radius:4px; font-size:0.75rem; font-weight:600;">Dijadwalkan</span>
                            @elseif($rk->status == 'selesai')
                                <span style="background:#10b981; color:white; padding:4px 8px; border-radius:4px; font-size:0.75rem; font-weight:600;">Selesai</span>
                            @else
                                <span style="background:#ef4444; color:white; padding:4px 8px; border-radius:4px; font-size:0.75rem; font-weight:600;">Batal</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.rencana-kegiatan.edit', $rk->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.rencana-kegiatan.destroy', $rk->id) }}" method="POST" onsubmit="return confirm('Hapus rencana ini?')">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; color:#6b7280; padding:30px;">Belum ada rencana yang terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $rencanaKegiatans->links() }}</div>
    </div>
</div>
@endsection
