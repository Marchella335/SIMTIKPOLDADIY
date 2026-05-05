@extends('layouts.public')
@section('title', 'Persuratan - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Data Persuratan</h2>
        </div>
        <div class="surat-summary">
            <div class="surat-card masuk">
                <div class="surat-count">{{ $suratMasuk }}</div>
                <div class="surat-label">Surat Masuk</div>
            </div>
            <div class="surat-card keluar">
                <div class="surat-count">{{ $suratKeluar }}</div>
                <div class="surat-label">Surat Keluar</div>
            </div>
        </div>
        <form method="GET" style="display:flex;gap:10px;margin-bottom:25px;flex-wrap:wrap;">
            <input type="text" name="search" class="form-control" placeholder="Cari nomor, jenis, atau perihal surat..." value="{{ request('search') }}" style="max-width:300px;">
            <select name="tipe" class="form-control" style="max-width:160px;" onchange="this.form.submit()">
                <option value="">Semua Tipe</option>
                <option value="masuk" {{ request('tipe')=='masuk'?'selected':'' }}>Surat Masuk</option>
                <option value="keluar" {{ request('tipe')=='keluar'?'selected':'' }}>Surat Keluar</option>
            </select>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $i => $s)
                    <tr>
                        <td>{{ $surats->firstItem() + $i }}</td>
                        <td>{{ $s->nomor_surat }}</td>
                        <td><span style="padding:3px 10px;border-radius:12px;font-size:0.8rem;font-weight:600;color:#fff;background:{{ $s->tipe=='masuk'?'#22c55e':'#ef4444' }};">{{ ucfirst($s->tipe) }}</span></td>
                        <td>{{ $s->jenis_surat }}</td>
                        <td>{{ $s->perihal }}</td>
                        <td>
                            @if($s->tipe == 'masuk')
                                <small>Dari:</small> {{ $s->dari }}
                            @else
                                <small>Kepada:</small> {{ $s->kepada }}
                            @endif
                        </td>
                        <td>{{ $s->tanggal->format('d/m/Y') }}</td>
                        <td>@if($s->file_pdf)<a href="{{ asset($s->file_pdf) }}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-download"></i></a>@else - @endif</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center;color:var(--gray-500);">Tidak ada data surat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $surats->withQueryString()->links() }}</div>
    </div>
</section>
@endsection
