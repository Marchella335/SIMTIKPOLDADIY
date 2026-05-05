@extends('layouts.admin')
@section('title', 'Persuratan - Admin SIMTIK')
@section('page-title', 'Persuratan')

@section('content')
<div class="surat-summary">
    <div class="surat-card masuk" onclick="location.href='{{ route('admin.persuratan.index', ['tipe'=>'masuk']) }}'" style="cursor:pointer;">
        <div class="surat-count">{{ $suratMasuk }}</div>
        <div class="surat-label">Surat Masuk</div>
    </div>
    <div class="surat-card keluar" onclick="location.href='{{ route('admin.persuratan.index', ['tipe'=>'keluar']) }}'" style="cursor:pointer;">
        <div class="surat-count">{{ $suratKeluar }}</div>
        <div class="surat-label">Surat Keluar</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Daftar Surat</h3>
        <a href="{{ route('admin.persuratan.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
    </div>
    <div class="card-body">
        <form method="GET" class="search-bar">
            <input type="text" name="search" class="form-control" placeholder="Cari nomor, jenis, atau perihal surat..." value="{{ request('search') }}">
            <select name="tipe" class="form-control" style="max-width:150px;" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="masuk" {{ request('tipe')=='masuk'?'selected':'' }}>Masuk</option>
                <option value="keluar" {{ request('tipe')=='keluar'?'selected':'' }}>Keluar</option>
            </select>
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Tipe</th>
                        <th>Jenis</th>
                        <th>Tentang / Perihal</th>
                        <th>Dari / Kepada</th>
                        <th>Tanggal</th>
                        <th>PDF</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $i => $s)
                    <tr>
                        <td>{{ $surats->firstItem() + $i }}</td>
                        <td>{{ $s->nomor_surat }}</td>
                        <td><span style="padding:3px 10px;border-radius:12px;font-size:0.75rem;font-weight:600;color:#fff;background:{{ $s->tipe=='masuk'?'#22c55e':'#ef4444' }}">{{ ucfirst($s->tipe) }}</span></td>
                        <td>{{ $s->jenis_surat }}</td>
                        <td>{{ Str::limit($s->perihal, 30) }}</td>
                        <td>
                            @if($s->tipe == 'masuk')
                                <small>Dari:</small> {{ $s->dari }}
                            @else
                                <small>Kepada:</small> {{ $s->kepada }}
                            @endif
                        </td>
                        <td>{{ $s->tanggal->format('d/m/Y') }}</td>
                        <td>@if($s->file_pdf)<a href="{{ asset($s->file_pdf) }}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-download"></i></a>@else - @endif</td>
                        <td class="actions">
                            <a href="{{ route('admin.persuratan.edit', $s) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.persuratan.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus surat?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="text-align:center;color:#6b7280;">Belum ada data surat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $surats->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
