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
        
        <div style="margin-bottom: 30px;">
            <h4 style="font-size: 1rem; margin-bottom: 10px; color: var(--gray-700);">Trend Kegiatan / Bulan</h4>
            <div style="display:flex; gap:10px; align-items:flex-end; height:120px; padding:10px; background:var(--gray-50); border:1px solid var(--gray-200); border-radius:8px; overflow-x:auto;">
                @if(isset($trendData) && count($trendData) > 0)
                    @php $maxCount = max($trendData->toArray()); @endphp
                    @foreach($trendData as $month => $count)
                    <div style="display:flex; flex-direction:column; align-items:center; min-width:60px;">
                        <div style="font-size:0.75rem; font-weight:700; margin-bottom:4px;">{{ $count }}</div>
                        <div style="width:30px; background:var(--accent); border-radius:4px 4px 0 0; height:{{ $maxCount > 0 ? ($count / $maxCount * 70) : 0 }}px;"></div>
                        <div style="font-size:0.65rem; color:var(--gray-500); margin-top:4px;">{{ $month }}</div>
                    </div>
                    @endforeach
                @else
                    <div style="color:var(--gray-500); font-size:0.8rem; margin:auto;">Belum ada data kegiatan untuk menampilkan trend.</div>
                @endif
            </div>
        </div>

        <div class="table-container">
            <table>
<<<<<<< HEAD
                <thead><tr><th>No</th><th>Gambar</th><th>Nama Kegiatan</th><th>Tanggal</th><th>Deskripsi</th><th style="text-align:center;">Tampilkan</th><th>Aksi</th></tr></thead>
=======
                <thead><tr><th>No</th><th>Hari</th><th>Nama Kegiatan</th><th>Keterangan</th><th>Hasil Kegiatan</th><th>Foto</th><th>Aksi</th></tr></thead>
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
                <tbody>
                    @forelse($kegiatans as $i => $k)
                    <tr>
                        <td>{{ $kegiatans->firstItem() + $i }}</td>
                        <td>{{ \Carbon\Carbon::parse($k->tanggal)->locale('id')->translatedFormat('l, d/m/Y') }}</td>
                        <td style="font-weight:500;">{{ $k->nama_kegiatan }}</td>
                        <td>{{ Str::limit($k->deskripsi, 50) }}</td>
<<<<<<< HEAD
                        <td style="text-align:center;">
                            @if($k->tampilkan)
                                <span style="background:#10b981; color:white; padding:4px 8px; border-radius:4px; font-size:0.75rem; font-weight:600; display:inline-block;">Ya</span>
                            @else
                                <span style="background:#ef4444; color:white; padding:4px 8px; border-radius:4px; font-size:0.75rem; font-weight:600; display:inline-block;">Tidak</span>
                            @endif
=======
                        <td>{{ Str::limit($k->hasil_rapat, 50) ?? '-' }}</td>
                        <td>
                            @if($k->foto) <img src="{{ asset($k->foto) }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px; margin-bottom:4px;"> @endif
                            @if($k->gambar) <img src="{{ asset($k->gambar) }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;"> @endif
                            @if(!$k->foto && !$k->gambar) - @endif
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
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
