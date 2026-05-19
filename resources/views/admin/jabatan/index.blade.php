@extends('layouts.admin')
@section('title', 'Manajemen Jabatan - Admin SIMTIK')
@section('page-title', 'Kelola Jabatan - ' . strtoupper($bidang))

@section('content')
<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3>Daftar Jabatan ({{ strtoupper($bidang) }})</h3>
        <div>
            <a href="{{ route('admin.jabatan.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali Pilih Bidang</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.jabatan.store') }}" method="POST" class="form-inline" style="margin-bottom:20px; display:flex; gap:10px; width:100%;">
            @csrf
            <input type="hidden" name="bidang" value="{{ $bidang }}">
            <div class="form-group" style="margin-bottom:0; flex:1;">
                <input type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan Baru untuk {{ strtoupper($bidang) }}" required style="width:100%;">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Jabatan</button>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Jabatan</th>
                        <th>Bidang</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jabatans as $index => $j)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $j->nama_jabatan }}</td>
                        <td><span class="badge {{ $j->bidang ? 'badge-info' : 'badge-secondary' }}">{{ $j->bidang ?? 'Global' }}</span></td>
                        <td>
                            <div class="actions">
                                <form action="{{ route('admin.jabatan.destroy', $j) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:20px; color:var(--gray-500);">Belum ada data jabatan untuk bidang {{ $bidang }}.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
