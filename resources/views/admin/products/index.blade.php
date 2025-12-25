@extends('admin.layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold mb-0">Daftar Produk</h3>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah Produk</span>
        </a>

    </div>



    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama Produk</option>
                <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
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

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-light text-center">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 30%;">Nama Produk</th>
                    <th style="width: 20%;">Gambar</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $p)
                    @php
                        $primaryImage = $p->images->where('is_primary', true)->first();
                        $firstImage = $p->images->first();
                        $displayImage = $primaryImage
                            ? asset('storage/' . $primaryImage->image_path)
                            : ($firstImage
                                ? asset('storage/' . $firstImage->image_path)
                                : asset('no-image.png'));
                    @endphp

                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $loop->index }}
                        </td>
                        <td>
                            <strong>{{ $p->name }}</strong>
                            {{-- 🔹 Badge Status --}}
                            @if ($p->status === 'published')
                                <span class="badge bg-success ms-2 text-white">Published</span>
                            @elseif ($p->status === 'draft')
                                <span class="badge bg-warning text-white ms-2">Draft</span>
                            @else
                                <span class="badge bg-secondary ms-2">{{ ucfirst($p->status) }}</span>
                            @endif
                            <br>
                            <small class="text-muted">{{ Str::limit($p->short_description, 60) }}</small>
                        </td>

                        <td class="text-center">
                            <img src="{{ $displayImage }}" alt="Gambar {{ $p->name }}" class="rounded shadow-sm"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.produk.edit', $p->id) }}" class="btn btn-warning btn-sm me-1"
                                title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>

    </div>
@endsection
