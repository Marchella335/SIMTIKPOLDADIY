@extends('layouts.admin')
@section('title', 'Anggota - Admin SIMTIK')
@section('page-title', 'Data Anggota')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Anggota Bid TIK</h3>
        <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead><tr><th>No</th><th>Foto</th><th>Nama Lengkap</th><th>Pangkat</th><th>Bidang</th><th>Jabatan</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($anggotas as $i => $a)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>@if($a->foto)<img src="{{ asset($a->foto) }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">@else <div style="width:40px;height:40px;border-radius:50%;background:#e2e4e8;display:flex;align-items:center;justify-content:center;color:#999;"><i class="fas fa-user"></i></div> @endif</td>
                        <td>{{ $a->nama_lengkap }}<br><small style="color:#666;">NRP: {{ $a->nrp ?? '-' }}</small></td>
                        <td>{{ $a->pangkat }}</td>
                        <td><span class="badge badge-info">{{ $a->bidang }}</span></td>
                        <td>{{ $a->jabatan }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.anggota.show', $a) }}" class="btn btn-sm btn-info"><i class="fas fa-id-card"></i></a>
                            <a href="{{ route('admin.anggota.edit', $a) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.anggota.destroy', $a) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center;color:#6b7280;">Belum ada data anggota.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
