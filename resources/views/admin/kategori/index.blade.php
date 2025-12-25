@extends('admin.layouts.admin')
@section('title', 'Kategori')

@section('content')
    <div class="container-fluid mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- 🔹 Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-semibold mb-1">Daftar Kategori</h3>
                <p class="text-muted mb-0">Kelola semua kategori produk di sistem kamu</p>
            </div>
            <a href="{{ route('admin.kategori.create') }}"
                class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah Kategori</span>
            </a>
        </div>
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari kategori..."
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Urutkan Nama</option>
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Tanggal Dibuat
                    </option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="order" class="form-select">
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>A → Z</option>
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z → A</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        {{-- 🔹 Card Container --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;" class="text-center">#</th>
                            <th>Nama & Deskripsi</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $kategori)
                            <tr>
                                <td class="text-center">{{ $categories->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <div class="fw-medium">{{ $kategori->name }}</div>
                                    @if (!empty($kategori->description))
                                        <div class="text-muted small">{{ $kategori->description }}</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox me-2"></i>Belum ada kategori
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>
        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
