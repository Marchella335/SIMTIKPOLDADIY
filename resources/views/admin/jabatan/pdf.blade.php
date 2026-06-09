<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Rekap Anggota Bid TIK Polda DIY</title>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: 'DejaVu Sans', Arial, sans-serif;
        font-size: 9px;
        color: #1e293b;
        background: #fff;
    }

    /* ── HEADER ── */
    .kop {
        display: table;
        width: 100%;
        border-bottom: 3px solid #1e3a5f;
        padding-bottom: 10px;
        margin-bottom: 14px;
    }
    .kop-logo { display: table-cell; width: 70px; vertical-align: middle; }
    .kop-logo img { width: 60px; height: 60px; }
    .kop-text { display: table-cell; vertical-align: middle; text-align: center; }
    .kop-text .instansi { font-size: 11px; font-weight: bold; color: #1e3a5f; letter-spacing: 0.5px; }
    .kop-text .sub-instansi { font-size: 9px; color: #475569; margin-top: 2px; }
    .kop-text .alamat { font-size: 7.5px; color: #64748b; margin-top: 2px; }
    .kop-right { display: table-cell; width: 80px; vertical-align: middle; text-align: right; }
    .kop-right .tanggal { font-size: 7.5px; color: #475569; }
    .kop-right .no-dok { font-size: 7px; color: #94a3b8; margin-top: 3px; }

    .doc-title {
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        color: #1e3a5f;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .doc-sub {
        text-align: center;
        font-size: 8px;
        color: #64748b;
        margin-bottom: 16px;
    }

    /* ── BIDANG SECTION ── */
    .bidang-header {
        background: #1e3a5f;
        color: #fff;
        padding: 6px 10px;
        font-size: 9.5px;
        font-weight: bold;
        border-radius: 3px 3px 0 0;
        margin-top: 14px;
        margin-bottom: 0;
        letter-spacing: 0.5px;
    }
    .bidang-header span { font-weight: normal; font-size: 8px; opacity: 0.8; margin-left: 6px; }

    table.anggota {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }
    table.anggota thead tr {
        background: #e8eef6;
        color: #1e3a5f;
    }
    table.anggota thead th {
        padding: 5px 6px;
        text-align: left;
        font-size: 8px;
        font-weight: bold;
        border: 1px solid #c8d6e5;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    table.anggota tbody tr { background: #fff; }
    table.anggota tbody tr:nth-child(even) { background: #f8fafc; }
    table.anggota tbody td {
        padding: 5px 6px;
        border: 1px solid #dde5ef;
        vertical-align: middle;
        font-size: 8.5px;
    }
    table.anggota .col-no   { width: 24px; text-align: center; }
    table.anggota .col-foto { width: 44px; text-align: center; }
    table.anggota .col-nama { width: 30%; }
    table.anggota .col-pangkat { width: 18%; }
    table.anggota .col-nrp  { width: 16%; }
    table.anggota .col-jab  { width: 22%; }

    .foto-cell img {
        width: 36px;
        height: 36px;
        border-radius: 3px;
        object-fit: cover;
        border: 1px solid #cbd5e1;
    }
    .foto-placeholder {
        width: 36px;
        height: 36px;
        background: #e2e8f0;
        border-radius: 3px;
        display: inline-block;
        text-align: center;
        line-height: 36px;
        color: #94a3b8;
        font-size: 7px;
    }

    .empty-row td {
        text-align: center;
        color: #94a3b8;
        font-style: italic;
        padding: 10px;
    }

    /* ── REKAP SECTION ── */
    .rekap-title {
        font-size: 11px;
        font-weight: bold;
        color: #1e3a5f;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 2px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .rekap-divider {
        border: none;
        border-top: 2px solid #1e3a5f;
        margin-bottom: 12px;
    }

    .rekap-bidang-title {
        font-size: 9px;
        font-weight: bold;
        color: #1e3a5f;
        margin-top: 10px;
        margin-bottom: 4px;
        padding: 4px 8px;
        background: #eef2f8;
        border-left: 4px solid #1e3a5f;
    }

    table.rekap {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 6px;
    }
    table.rekap thead tr { background: #1e3a5f; color: #fff; }
    table.rekap thead th {
        padding: 5px 8px;
        text-align: left;
        font-size: 8px;
        font-weight: bold;
        border: 1px solid #1e3a5f;
        text-transform: uppercase;
    }
    table.rekap tbody tr { background: #fff; }
    table.rekap tbody tr:nth-child(even) { background: #f8fafc; }
    table.rekap tbody td {
        padding: 5px 8px;
        border: 1px solid #dde5ef;
        font-size: 8.5px;
        vertical-align: middle;
    }
    table.rekap .col-no   { width: 28px; text-align: center; }
    table.rekap .col-jab  { width: 40%; }
    table.rekap .col-kuota, .col-jumlah, .col-selisih { width: 10%; text-align: center; }
    table.rekap .col-status { width: 18%; text-align: center; }

    .badge-ok      { background: #dcfce7; color: #166534; padding: 2px 7px; border-radius: 20px; font-size: 7.5px; font-weight: bold; }
    .badge-kurang  { background: #fef9c3; color: #854d0e; padding: 2px 7px; border-radius: 20px; font-size: 7.5px; font-weight: bold; }
    .badge-kosong  { background: #fee2e2; color: #991b1b; padding: 2px 7px; border-radius: 20px; font-size: 7.5px; font-weight: bold; }

    /* footer */
    .page-footer {
        position: fixed;
        bottom: 0;
        left: 0; right: 0;
        height: 24px;
        border-top: 1px solid #e2e8f0;
        font-size: 7px;
        color: #94a3b8;
        text-align: center;
        line-height: 24px;
    }
    .page-break { page-break-after: always; }
</style>
</head>
<body>

<!-- ══════════════════════════════════════════
     KOP / HEADER
════════════════════════════════════════════ -->
<div class="kop">
    <div class="kop-logo">
        @php $logoPath = public_path('assets/LOGO_BID_TIK.png'); @endphp
        @if(file_exists($logoPath))
            <img src="{{ $logoPath }}">
        @endif
    </div>
    <div class="kop-text">
        <div class="instansi">KEPOLISIAN DAERAH DAERAH ISTIMEWA YOGYAKARTA</div>
        <div class="sub-instansi">BIDANG TEKNOLOGI INFORMASI DAN KOMUNIKASI (BID TIK)</div>
        <div class="alamat">Jl. Reksobayan No.1, Ngupasan, Gondomanan, Kota Yogyakarta, D.I. Yogyakarta</div>
    </div>
    <div class="kop-right">
        <div class="tanggal">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        <div class="no-dok">SIMTIK POLDA DIY</div>
    </div>
</div>

<div class="doc-title">Rekap Data Anggota Bidang TIK</div>
<div class="doc-sub">Kepolisian Daerah Daerah Istimewa Yogyakarta &mdash; Dicetak otomatis dari SIMTIK</div>

<!-- ══════════════════════════════════════════
     KABID TIK
════════════════════════════════════════════ -->
@if($kabidList->count())
<div class="bidang-header">
    PIMPINAN BID TIK
    <span>{{ $kabidList->count() }} personel</span>
</div>
<table class="anggota">
    <thead>
        <tr>
            <th class="col-no">No</th>
            <th class="col-foto">Foto</th>
            <th class="col-nama">Nama Lengkap</th>
            <th class="col-pangkat">Pangkat</th>
            <th class="col-nrp">NRP</th>
            <th class="col-jab">Jabatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kabidList as $i => $a)
        <tr>
            <td class="col-no">{{ $i + 1 }}</td>
            <td class="col-foto foto-cell">
                @if($a->foto && file_exists(public_path($a->foto)))
                    <img src="{{ public_path($a->foto) }}">
                @else
                    <span class="foto-placeholder">—</span>
                @endif
            </td>
            <td class="col-nama">{{ $a->nama_lengkap }}</td>
            <td class="col-pangkat">{{ $a->pangkat ?? '-' }}</td>
            <td class="col-nrp">{{ $a->nrp ?? '-' }}</td>
            <td class="col-jab">{{ $a->jabatan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<!-- ══════════════════════════════════════════
     ANGGOTA PER BIDANG
════════════════════════════════════════════ -->
@foreach($bidangs as $bidang)
@php $list = $anggotaPerBidang[$bidang]; @endphp

<div class="bidang-header">
    SUBBID {{ strtoupper($bidang) }}
    <span>{{ $list->count() }} personel</span>
</div>
<table class="anggota">
    <thead>
        <tr>
            <th class="col-no">No</th>
            <th class="col-foto">Foto</th>
            <th class="col-nama">Nama Lengkap</th>
            <th class="col-pangkat">Pangkat</th>
            <th class="col-nrp">NRP</th>
            <th class="col-jab">Jabatan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($list as $i => $a)
        <tr>
            <td class="col-no">{{ $i + 1 }}</td>
            <td class="col-foto foto-cell">
                @if($a->foto && file_exists(public_path($a->foto)))
                    <img src="{{ public_path($a->foto) }}">
                @else
                    <span class="foto-placeholder">—</span>
                @endif
            </td>
            <td class="col-nama">{{ $a->nama_lengkap }}</td>
            <td class="col-pangkat">{{ $a->pangkat ?? '-' }}</td>
            <td class="col-nrp">{{ $a->nrp ?? '-' }}</td>
            <td class="col-jab">{{ $a->jabatan }}</td>
        </tr>
        @empty
        <tr class="empty-row">
            <td colspan="6">Belum ada anggota terdaftar di Subbid {{ $bidang }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endforeach

<!-- ══════════════════════════════════════════
     REKAP KUOTA (halaman baru)
════════════════════════════════════════════ -->
<div class="page-break"></div>

<!-- KOP ulang di halaman rekap -->
<div class="kop">
    <div class="kop-logo">
        @if(file_exists($logoPath))
            <img src="{{ $logoPath }}">
        @endif
    </div>
    <div class="kop-text">
        <div class="instansi">KEPOLISIAN DAERAH DAERAH ISTIMEWA YOGYAKARTA</div>
        <div class="sub-instansi">BIDANG TEKNOLOGI INFORMASI DAN KOMUNIKASI (BID TIK)</div>
        <div class="alamat">Jl. Reksobayan No.1, Ngupasan, Gondomanan, Kota Yogyakarta, D.I. Yogyakarta</div>
    </div>
    <div class="kop-right">
        <div class="tanggal">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        <div class="no-dok">SIMTIK POLDA DIY</div>
    </div>
</div>

<div class="rekap-title">Rekapitulasi Kuota &amp; Kekurangan Personel</div>
<hr class="rekap-divider">

@foreach($bidangs as $bidang)
@if(isset($rekapKuota[$bidang]) && count($rekapKuota[$bidang]))
<div class="rekap-bidang-title">Subbid {{ $bidang }}</div>
<table class="rekap">
    <thead>
        <tr>
            <th class="col-no">No</th>
            <th class="col-jab">Nama Jabatan</th>
            <th class="col-kuota">Kuota</th>
            <th class="col-jumlah">Terisi</th>
            <th class="col-selisih">Selisih</th>
            <th class="col-status">Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalKuota   = 0;
            $totalTerisi  = 0;
        @endphp
        @foreach($rekapKuota[$bidang] as $idx => $r)
        @php
            $totalKuota  += $r['kuota'];
            $totalTerisi += $r['jumlah'];
        @endphp
        <tr>
            <td class="col-no">{{ $idx + 1 }}</td>
            <td class="col-jab">{{ $r['nama_jabatan'] }}</td>
            <td class="col-kuota">{{ $r['kuota'] }}</td>
            <td class="col-jumlah">{{ $r['jumlah'] }}</td>
            <td class="col-selisih" style="{{ $r['selisih'] > 0 ? 'color:#dc2626; font-weight:bold;' : 'color:#16a34a;' }}">
                {{ $r['selisih'] > 0 ? '-'.$r['selisih'] : '0' }}
            </td>
            <td class="col-status">
                @if($r['status'] === 'Terpenuhi')
                    <span class="badge-ok">&#10003; Terpenuhi</span>
                @elseif($r['status'] === 'Kosong')
                    <span class="badge-kosong">&#9888; Kosong</span>
                @else
                    <span class="badge-kurang">&#9651; {{ $r['status'] }}</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="background:#e8eef6; font-weight:bold; border-top:2px solid #1e3a5f;">
            <td colspan="2" style="padding:5px 8px; font-size:8.5px; color:#1e3a5f;">TOTAL SUBBID {{ strtoupper($bidang) }}</td>
            <td class="col-kuota" style="text-align:center; font-size:8.5px;">{{ $totalKuota }}</td>
            <td class="col-jumlah" style="text-align:center; color:{{ $totalTerisi >= $totalKuota ? '#166534' : '#991b1b' }}; font-size:8.5px;">{{ $totalTerisi }}</td>
            <td class="col-selisih" style="text-align:center; color:{{ ($totalKuota - $totalTerisi) > 0 ? '#dc2626' : '#16a34a' }}; font-size:8.5px; font-weight:bold;">
                {{ ($totalKuota - $totalTerisi) > 0 ? '-'.($totalKuota - $totalTerisi) : '0' }}
            </td>
            <td class="col-status" style="text-align:center;">
                @if($totalTerisi >= $totalKuota)
                    <span class="badge-ok">Terpenuhi</span>
                @elseif($totalTerisi === 0)
                    <span class="badge-kosong">Kosong</span>
                @else
                    <span class="badge-kurang">Kurang {{ $totalKuota - $totalTerisi }}</span>
                @endif
            </td>
        </tr>
    </tfoot>
</table>
@endif
@endforeach

<!-- Keterangan -->
<div style="margin-top:18px; padding:10px 12px; background:#fff7ed; border:1px solid #fdba74; border-radius:4px;">
    <div style="font-size:8.5px; font-weight:bold; color:#92400e; margin-bottom:6px;">&#9888; Keterangan Status:</div>
    <table style="width:100%; border:none;">
        <tr>
            <td style="border:none; padding:2px 8px; width:33%;">
                <span class="badge-ok">&#10003; Terpenuhi</span>
                <span style="font-size:7.5px; color:#475569; margin-left:4px;">Jumlah anggota sudah sesuai atau melebihi kuota</span>
            </td>
            <td style="border:none; padding:2px 8px; width:33%;">
                <span class="badge-kurang">&#9651; Kurang</span>
                <span style="font-size:7.5px; color:#475569; margin-left:4px;">Jumlah anggota di bawah kuota yang ditetapkan</span>
            </td>
            <td style="border:none; padding:2px 8px; width:33%;">
                <span class="badge-kosong">&#9888; Kosong</span>
                <span style="font-size:7.5px; color:#475569; margin-left:4px;">Belum ada anggota yang mengisi jabatan ini</span>
            </td>
        </tr>
    </table>
</div>

<!-- Tanda tangan -->
<div style="margin-top:30px; display:table; width:100%;">
    <div style="display:table-cell; width:60%;"></div>
    <div style="display:table-cell; width:40%; text-align:center;">
        <div style="font-size:8px; color:#475569;">Yogyakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        <div style="font-size:8px; font-weight:bold; color:#1e3a5f; margin-top:2px;">Kabid TIK Polda DIY</div>
        <div style="height:55px;"></div>
        <div style="font-size:8px; color:#475569; border-top:1px solid #94a3b8; display:inline-block; min-width:140px; padding-top:4px;">
            ............................................
        </div>
    </div>
</div>

<!-- Footer tetap -->
<div class="page-footer">
    Dokumen ini dicetak secara otomatis oleh Sistem Informasi Manajemen Teknologi Informasi dan Komunikasi (SIMTIK) Polda DIY &bull; {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
</div>

</body>
</html>
