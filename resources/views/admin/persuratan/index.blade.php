@extends('layouts.admin')
@section('title', 'Persuratan - Admin SIMTIK')
@section('page-title', 'Persuratan Bidang ' . ($bidang ?? 'Renmin'))

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.persuratan.landing') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali ke Pilihan Bidang</a>
</div>

<div class="surat-summary">
    <div class="surat-card masuk" onclick="location.href='{{ route('admin.persuratan.index', ['tipe'=>'masuk', 'bidang' => $bidang]) }}'" style="cursor:pointer;">
        <div class="surat-count">{{ \App\Models\Surat::where('tipe', 'masuk')->where('bidang', $bidang)->count() }}</div>
        <div class="surat-label">Surat Masuk {{ $bidang }}</div>
    </div>
    <div class="surat-card keluar" onclick="location.href='{{ route('admin.persuratan.index', ['tipe'=>'keluar', 'bidang' => $bidang]) }}'" style="cursor:pointer;">
        <div class="surat-count">{{ \App\Models\Surat::where('tipe', 'keluar')->where('bidang', $bidang)->count() }}</div>
        <div class="surat-label">Surat Keluar {{ $bidang }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Daftar Surat {{ $bidang }}</h3>
        <div>
            <a href="{{ route('admin.persuratan.export', ['bidang' => $bidang, 'tipe' => request('tipe')]) }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Rekap</a>
            <a href="{{ route('admin.persuratan.create', ['bidang' => $bidang]) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="search-bar">
            <input type="hidden" name="bidang" value="{{ $bidang }}">
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
                        <td><span style="padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;color:#ffffff;background:{{ $s->tipe=='masuk'?'#3b82f6':'#ef4444' }};text-transform:uppercase;letter-spacing:0.5px;">{{ ucfirst($s->tipe) }}</span></td>
                        <td>{{ $s->jenis_surat }}</td>
                        <td>{{ Str::limit($s->perihal, 30) }}</td>
                        <td>
                            @if($s->tipe == 'masuk')
                                <small>Dari:</small><br>{!! nl2br(e($s->dari)) !!}
                            @else
                                <small>Kepada:</small><br>{!! nl2br(e($s->kepada)) !!}
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
