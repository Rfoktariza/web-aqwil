@extends('admin.layouts.admin')

@section('title', 'Produk di Beranda')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold mb-0">Produk di Beranda</h3>
            <form action="{{ route('admin.featured-products.store') }}" method="POST" class="d-flex gap-2">
                @csrf
                <select name="product_id" class="form-select" style="width: 250px;">
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Tambah</button>
            </form>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Urutan</th>
                            <th>Nama Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($featured as $item)
                            <tr data-id="{{ $item->id }}">
                                <td class="text-center">{{ $item->order }}</td>
                                <td>@if ($item->product)
                {{ $item->product->name }}
            @else
                <span class="text-danger">Produk Dihapus atau Tidak Ditemukan</span>
            @endif</td>
                                <td>
                                    <form action="{{ route('admin.featured-products.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
