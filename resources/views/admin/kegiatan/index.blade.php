@extends('layouts.admin')
@section('title', 'Kegiatan - Admin SIMTIK')
@section('page-title', 'Kegiatan')

@section('content')
<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3>Daftar Kegiatan ({{ $kegiatans->total() }} kegiatan)</h3>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('admin.kegiatan.trend') }}" class="btn btn-info btn-sm"><i class="fas fa-chart-bar"></i> Trend & Counter</a>
            <a href="{{ route('admin.kegiatan.export-pdf') }}" target="_blank" class="btn btn-outline btn-sm"><i class="fas fa-file-pdf"></i> Export PDF</a>
            <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead><tr><th>No</th><th>Gambar</th><th>Nama Kegiatan</th><th>Tanggal</th><th>Deskripsi</th><th style="text-align:center;">Tampilkan</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($kegiatans as $i => $k)
                    <tr>
                        <td>{{ $kegiatans->firstItem() + $i }}</td>
                        <td>@if($k->gambar)<img src="{{ asset($k->gambar) }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;">@else - @endif</td>
                        <td style="font-weight:500;">{{ $k->nama_kegiatan }}</td>
                        <td>{{ $k->tanggal->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($k->deskripsi, 50) }}</td>
                        <td style="text-align:center;">
                            @if($k->tampilkan)
                                <span style="background:#10b981; color:white; padding:4px 8px; border-radius:4px; font-size:0.75rem; font-weight:600; display:inline-block;">Ya</span>
                            @else
                                <span style="background:#ef4444; color:white; padding:4px 8px; border-radius:4px; font-size:0.75rem; font-weight:600; display:inline-block;">Tidak</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.kegiatan.edit', $k) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.kegiatan.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus kegiatan?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center;color:#6b7280;">Belum ada kegiatan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $kegiatans->links() }}</div>
    </div>
</div>
@endsection
