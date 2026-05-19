@extends('layouts.admin')
@section('title', 'Manajemen Pangkat - Admin SIMTIK')
@section('page-title', 'Manajemen Pangkat')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Pangkat</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pangkat.store') }}" method="POST" class="form-inline" style="margin-bottom:20px;">
            @csrf
            <div class="form-group" style="margin-bottom:0; flex:1;">
                <input type="text" name="nama_pangkat" class="form-control" placeholder="Nama Pangkat Baru" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pangkat</button>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Pangkat</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pangkats as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->nama_pangkat }}</td>
                        <td>
                            <div class="actions">
                                <form action="{{ route('admin.pangkat.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pangkat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding:20px; color:var(--gray-500);">Belum ada data pangkat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
