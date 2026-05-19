@extends('layouts.admin')
@section('title', 'Carousel - Admin SIMTIK')
@section('page-title', 'Manajemen Carousel Beranda')

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Daftar Slide Carousel</h3>
        <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Banner Slide</a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th style="width: 200px;">Gambar Latar</th>
                        <th>Judul Banner</th>
                        <th>Deskripsi Ringkas</th>
                        <th style="width: 250px;">Link / URL Tujuan</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carousels as $index => $c)
                    <tr>
                        <td>{{ $carousels->firstItem() + $index }}</td>
                        <td>
                            <div style="width: 160px; height: 90px; border-radius: 8px; overflow: hidden; border: 1px solid var(--gray-200); background: #000;">
                                <img src="{{ asset($c->gambar) }}" alt="Banner" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </td>
                        <td><strong>{{ $c->judul }}</strong></td>
                        <td><span style="font-size:0.9rem; color:var(--gray-600);">{{ Str::limit($c->deskripsi, 100) }}</span></td>
                        <td>
                            @if($c->link)
                                <a href="{{ $c->link }}" target="_blank" style="color: var(--accent); font-weight: 500; font-size: 0.85rem; word-break: break-all;">
                                    {{ Str::limit($c->link, 35) }} <i class="fas fa-external-link-alt" style="font-size:0.75rem;"></i>
                                </a>
                            @else
                                <span style="color:var(--gray-400); font-style: italic; font-size: 0.85rem;">Tidak ada link</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.carousel.edit', $c) }}" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.carousel.destroy', $c) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus slide banner ini?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px; color:var(--gray-500);">
                            <i class="fas fa-images fa-3x" style="opacity:0.3; margin-bottom:15px; display:block;"></i>
                            Belum ada slide banner yang ditambahkan. Carousel akan menampilkan fallback berita secara default.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper" style="margin-top: 20px;">
            {{ $carousels->links() }}
        </div>
    </div>
</div>
@endsection
