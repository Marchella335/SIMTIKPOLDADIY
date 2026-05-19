@extends('layouts.admin')
@section('title', 'Berita - Admin SIMTIK')
@section('page-title', 'Manajemen Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Berita</h3>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Berita</a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 150px;">Tanggal</th>
                        <th>Judul Berita</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $index => $b)
                    <tr>
                        <td>{{ $beritas->firstItem() + $index }}</td>
                        <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}<br><small style="color:var(--gray-500);">{{ $b->created_at->format('H:i') }} WIB</small></td>
                        <td>
                            <strong>{{ $b->judul }}</strong>
                            @if($b->foto)
                            <div style="margin-top:5px;">
                                <img src="{{ asset($b->foto) }}" alt="Foto" style="height:40px; border-radius:4px; object-fit:cover;">
                            </div>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.berita.edit', $b) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.berita.destroy', $b) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:20px; color:var(--gray-500);">Belum ada data berita.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $beritas->links() }}
        </div>
    </div>
</div>
@endsection
