@extends('layouts.admin')
@section('title', 'Persuratan - Admin SIMTIK')
@section('page-title', 'Persuratan Bidang ' . ($bidang ?? 'Renmin'))

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.persuratan.landing') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali ke Pilihan Bidang</a>
</div>

<div class="surat-summary">
    <div class="surat-card masuk" onclick="location.href='{{ route('admin.persuratan.index', ['tipe'=>'masuk', 'bidang' => $bidang]) }}'" style="cursor:pointer;">
        <div class="surat-count">
            {{ \App\Models\Surat::where('tipe', 'masuk')->where(function($q) use ($bidang) {
                $q->where('bidang', $bidang)->orWhere('status_terusan', $bidang);
            })->count() }}
        </div>
        <div class="surat-label">Surat Masuk {{ $bidang }}</div>
    </div>
    <div class="surat-card keluar" onclick="location.href='{{ route('admin.persuratan.index', ['tipe'=>'keluar', 'bidang' => $bidang]) }}'" style="cursor:pointer;">
        <div class="surat-count">
            {{ \App\Models\Surat::where('tipe', 'keluar')->where(function($q) use ($bidang) {
                $q->where('bidang', $bidang)->orWhere('status_terusan', $bidang);
            })->count() }}
        </div>
        <div class="surat-label">Surat Keluar {{ $bidang }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3>Daftar Surat {{ $bidang }}</h3>
<<<<<<< HEAD
        <div style="display:flex; gap:10px;">
            <a href="{{ route('admin.persuratan.export-pdf', ['bidang' => $bidang, 'start_date' => request('start_date'), 'end_date' => request('end_date'), 'search' => request('search'), 'tipe' => request('tipe')]) }}" target="_blank" class="btn btn-outline btn-sm"><i class="fas fa-file-pdf"></i> Export PDF</a>
            <a href="{{ route('admin.persuratan.create', ['bidang' => $bidang]) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Surat</a>
=======
        <div>
            <a href="{{ route('admin.persuratan.export', ['bidang' => $bidang, 'tipe' => request('tipe')]) }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Rekap</a>
            <a href="{{ route('admin.persuratan.create', ['bidang' => $bidang]) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="search-bar" style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px; align-items:center;">
            <input type="hidden" name="bidang" value="{{ $bidang }}">
            <input type="text" name="search" class="form-control" placeholder="Cari nomor, jenis, atau perihal surat..." value="{{ request('search') }}" style="flex:1; min-width:200px;">
            <select name="tipe" class="form-control" style="max-width:120px;" onchange="this.form.submit()">
                <option value="">Semua Tipe</option>
                <option value="masuk" {{ request('tipe')=='masuk'?'selected':'' }}>Masuk</option>
                <option value="keluar" {{ request('tipe')=='keluar'?'selected':'' }}>Keluar</option>
            </select>
            <div style="display:flex; align-items:center; gap:5px;">
                <span style="font-size:0.85rem; color:var(--gray-500);">Periode:</span>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" style="width:135px; padding:6px 10px;">
                <span style="font-size:0.85rem; color:var(--gray-500);">-</span>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" style="width:135px; padding:6px 10px;">
            </div>
            <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            @if(request('search') || request('tipe') || request('start_date') || request('end_date'))
                <a href="{{ route('admin.persuratan.index', ['bidang' => $bidang]) }}" class="btn btn-outline" title="Reset Filter"><i class="fas fa-times"></i></a>
            @endif
        </form>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nomor Surat / Agenda</th>
                        <th>Tipe</th>
                        <th>Jenis</th>
                        <th>Tentang / Perihal</th>
                        <th>Dari / Kepada</th>
                        <th>Tanggal</th>
                        <th>Disposisi</th>
                        <th>PDF</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $i => $s)
                    <tr>
                        <td>{{ $surats->firstItem() + $i }}</td>
                        <td>
                            No. Surat: <strong>{{ $s->nomor_surat }}</strong><br>
                            No. Agenda: <span style="color:var(--primary); font-weight:600;">{{ $s->nomor_agenda ?? '-' }}</span><br>
                            Tgl. Agenda: <span style="color:var(--gray-600); font-size:0.8rem;">{{ $s->tanggal_agenda ? $s->tanggal_agenda->format('d/m/Y') : '-' }}</span>
                            @if($s->status_terusan)
                                <br><span class="badge" style="font-size:0.7rem; background:#10b981; color:#fff; padding:2px 6px; border-radius:4px; margin-top:4px; display:inline-block;">Diteruskan ke {{ $s->status_terusan }}</span>
                            @endif
                        </td>
                        <td><span style="padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;color:#ffffff;background:{{ $s->tipe=='masuk'?'#3b82f6':'#ef4444' }};text-transform:uppercase;letter-spacing:0.5px;">{{ ucfirst($s->tipe) }}</span></td>
                        <td>{{ $s->jenis_surat }}</td>
                        <td>{{ Str::limit($s->perihal, 30) }}</td>
                        <td>
                            @if($s->tipe == 'masuk')
                                <small style="color:var(--gray-500);">Dari:</small><br><strong>{!! nl2br(e($s->dari)) !!}</strong>
                            @else
                                <small style="color:var(--gray-500);">Kepada:</small><br><strong>{!! nl2br(e($s->kepada)) !!}</strong>
                            @endif
                        </td>
                        <td>{{ $s->tanggal->format('d/m/Y') }}</td>
                        <td>
                            <span style="font-size:0.85rem; font-style:italic;" title="{{ $s->disposisi }}">{{ Str::limit($s->disposisi ?? '-', 25) }}</span>
                        </td>
                        <td>@if($s->file_pdf)<a href="{{ asset($s->file_pdf) }}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-file-pdf"></i></a>@else - @endif</td>
                        <td class="actions">
                            @if($bidang == 'Renmin' && !$s->status_terusan)
                            <form action="{{ route('admin.persuratan.teruskan', $s) }}" method="POST" style="display:inline-block; margin-right:4px;">
                                @csrf
                                <select name="status_terusan" onchange="if(confirm('Teruskan surat ke ' + this.value + '?')) this.form.submit()" class="form-control" style="font-size:0.75rem; padding:3px 6px; width:auto; display:inline-block; height:auto; margin:0; line-height:1.2;">
                                    <option value="">Teruskan...</option>
                                    <option value="Tekkom">Tekkom</option>
                                    <option value="Tekinfo">Tekinfo</option>
                                </select>
                            </form>
                            @endif
                            <a href="{{ route('admin.persuratan.edit', $s) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.persuratan.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus surat?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" style="text-align:center;color:#6b7280;padding:20px;">Belum ada data surat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $surats->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
