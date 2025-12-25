@extends('admin.layouts.admin')
@section('title', 'Daftar Berita')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3 class="fw-semibold mb-1">Daftar Kategori</h3>


            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Berita
            </a>
        </div>
        <div class="">

            <form action="" method="GET" class="d-flex justify-content-between align-items-center mb-3 gap-4">
                <input type="text" name="search" class="form-control" placeholder="Cari judul..."
                    value="{{ request('search') }}">

                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>

                <button class="btn btn-primary">Cari</button>
            </form>

        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th> {{-- 🔹 Tambah kolom kategori --}}
                            <th>Gambar</th>
                            <th>Dibuat</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr>
                                <td>{{ $news->firstItem() + $loop->index }}</td>

                                <td>{{ $item->title }}</td>

                                {{-- 🔹 Kategori --}}
                                <td>
                                    @if ($item->categories->isNotEmpty())
                                        @foreach ($item->categories as $cat)
                                            <span
                                                class="badge bg-primary-subtle text-primary border border-primary-subtle me-1">
                                                {{ $cat->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small">Tanpa Kategori</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" width="60" class="rounded">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ $item->created_at->format('d M Y') }}</td>

                                <td class="text-end">
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada berita.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $news->links() }}
                </div>
            </div>
        </div>

        {{-- 🔹 Tambah sedikit styling agar badge kategori lebih lembut --}}
        <style>
            .badge.bg-primary-subtle {
                background-color: rgba(13, 110, 253, 0.1);
                color: #0d6efd;
                font-weight: 500;
                border-radius: 8px;
            }
        </style>

    </div>
@endsection
