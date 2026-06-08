@extends('layouts.admin')
@section('title', 'Anggota - Admin SIMTIK')
@section('page-title', 'Data Anggota ' . ($bidang ? '- ' . strtoupper($bidang) : ''))

@section('content')
<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <div style="display:flex; align-items:center; gap:20px;">
            <h3 style="margin:0;">Daftar Anggota {{ $bidang ? 'Subbid ' . strtoupper($bidang) : 'Bid TIK' }}</h3>
            <div class="search-box" style="position:relative;">
                <i class="bi bi-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--gray-500); font-size:0.9rem;"></i>
                <input type="text" class="table-search" data-table="table" placeholder="Cari nama, pangkat, atau NRP..." style="padding:8px 12px 8px 35px; border-radius:var(--radius-sm); border:1px solid var(--gray-200); font-size:0.9rem; width:280px; outline:none; transition:var(--transition);">
            </div>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('admin.anggota.landing') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
            <a href="{{ route('admin.jabatan.index', ['bidang' => $bidang]) }}" class="btn btn-info btn-sm"><i class="fas fa-briefcase"></i> Kelola Jabatan</a>
            <a href="{{ route('admin.anggota.create', ['bidang' => $bidang]) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead><tr><th>No</th><th>Foto</th><th>Nama Lengkap</th><th>Pangkat</th><th>Bidang</th><th>Jabatan</th><th>Jobdesk</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($anggotas as $i => $a)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>@if($a->foto)<img src="{{ asset($a->foto) }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">@else <div style="width:40px;height:40px;border-radius:50%;background:#e2e4e8;display:flex;align-items:center;justify-content:center;color:#999;"><i class="fas fa-user"></i></div> @endif</td>
                        <td>{{ $a->nama_lengkap }}<br><small style="color:#666;">NRP: {{ $a->nrp ?? '-' }}</small></td>
                        <td>{{ $a->pangkat }}</td>
                        <td><span class="badge badge-info">{{ $a->bidang }}</span></td>
                        <td>{{ $a->jabatan }}</td>
                        <td>{{ Str::limit($a->jobdesk ?? '-', 30) }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.anggota.show', $a) }}" class="btn btn-sm btn-info"><i class="fas fa-id-card"></i></a>
                            <a href="{{ route('admin.anggota.edit', $a) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.anggota.destroy', $a) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="text-align:center;color:#6b7280;">Belum ada data anggota.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
