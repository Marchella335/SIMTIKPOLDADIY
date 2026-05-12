@extends('layouts.admin')
@section('title', 'Layanan TIK - Admin SIMTIK')
@section('page-title', 'Layanan TIK (CRM)')

@section('content')
{{-- CRM Stats --}}
<div class="dash-grid" style="margin-bottom:30px;">
    <div class="dash-card" style="border-left:3px solid var(--accent);">
        <div class="dash-icon" style="background:var(--accent);"><i class="bi bi-ticket-perforated"></i></div>
        <div class="dash-info"><h3>{{ $stats['total'] }}</h3><p>Total Tiket</p></div>
    </div>
    <div class="dash-card" style="border-left:3px solid var(--warning);">
        <div class="dash-icon bg-warning"><i class="bi bi-hourglass-split"></i></div>
        <div class="dash-info"><h3>{{ $stats['pending'] }}</h3><p>Pending</p></div>
    </div>
    <div class="dash-card" style="border-left:3px solid var(--info);">
        <div class="dash-icon bg-info"><i class="bi bi-arrow-repeat"></i></div>
        <div class="dash-info"><h3>{{ $stats['in_progress'] }}</h3><p>In Progress</p></div>
    </div>
    <div class="dash-card" style="border-left:3px solid var(--success);">
        <div class="dash-icon bg-success"><i class="bi bi-check-circle"></i></div>
        <div class="dash-info"><h3>{{ $stats['completed'] }}</h3><p>Completed</p></div>
    </div>
</div>

{{-- Satisfaction Indicator --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h4 style="font-weight:700; margin-bottom:4px;">Customer Satisfaction Index</h4>
            <p style="color:var(--gray-500); font-size:0.85rem;">Berdasarkan {{ $stats['completed'] }} layanan yang telah selesai</p>
        </div>
        <div style="display:flex; align-items:center; gap:10px;">
            @for($s = 1; $s <= 5; $s++)
                <i class="bi bi-star-fill" style="font-size:1.5rem; color:{{ $s <= round($stats['avg_rating']) ? 'var(--warning)' : 'var(--gray-200)' }};"></i>
            @endfor
            <span style="font-size:1.5rem; font-weight:800; margin-left:10px;">{{ number_format($stats['avg_rating'], 1) }}</span>
        </div>
    </div>
</div>

{{-- Tiket List --}}
<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3 style="margin:0;">Daftar Permintaan Layanan (dari User)</h3>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead><tr>
                    <th>No</th><th>Pemohon</th><th>Jenis Layanan</th><th>Deskripsi</th><th>Status</th><th>Rating</th><th>Aksi</th>
                </tr></thead>
                <tbody>
                    @forelse($layanans as $i => $l)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <strong>{{ $l->nama_pemohon }}</strong><br>
                            <small style="color:var(--gray-500);">{{ $l->email_pemohon }}</small>
                            @if($l->no_hp)<br><small style="color:var(--gray-500);"><i class="bi bi-phone"></i> {{ $l->no_hp }}</small>@endif
                        </td>
                        <td><span class="badge badge-info">{{ $l->jenis_layanan }}</span></td>
                        <td style="max-width:200px;">{{ Str::limit($l->deskripsi, 60) }}</td>
                        <td>
                            @if($l->status == 'Pending')
                                <span class="badge" style="background:var(--warning); color:#000;">⏳ {{ $l->status }}</span>
                            @elseif($l->status == 'In Progress')
                                <span class="badge" style="background:var(--info); color:#fff;">🔄 {{ $l->status }}</span>
                            @else
                                <span class="badge" style="background:var(--success); color:#fff;">✅ {{ $l->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($l->rating)
                                @for($s = 1; $s <= 5; $s++)
                                    <i class="bi bi-star-fill" style="font-size:0.7rem; color:{{ $s <= $l->rating ? 'var(--warning)' : 'var(--gray-200)' }};"></i>
                                @endfor
                                @if($l->feedback)<br><small style="color:var(--gray-500);">"{{ Str::limit($l->feedback, 30) }}"</small>@endif
                            @else
                                <span style="color:var(--gray-500); font-size:0.8rem;">Belum dinilai</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.layanan.edit', $l) }}" class="btn btn-sm btn-warning" title="Update Status"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.layanan.destroy', $l) }}" method="POST" onsubmit="return confirm('Hapus tiket ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center; color:var(--gray-500);">Belum ada permintaan layanan dari user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
