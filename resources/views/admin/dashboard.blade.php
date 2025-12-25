@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="row g-3">
        {{-- 🔹 Produk --}}
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <div class="text-primary mb-2">
                        <i class="bi bi-box display-5"></i>
                    </div>
                    <h5 class="card-title">Produk</h5>
                    <p class="card-text fs-4 fw-bold">{{ $totalProduk ?? 0 }}</p>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                </div>
            </div>
        </div>

        {{-- 🔹 Kategori --}}
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <div class="text-success mb-2">
                        <i class="bi bi-tags display-5"></i>
                    </div>
                    <h5 class="card-title">Kategori</h5>
                    <p class="card-text fs-4 fw-bold">{{ $totalKategori ?? 0 }}</p>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-outline-success">Lihat</a>
                </div>
            </div>
        </div>

        {{-- 🔹 Webpage Setting --}}
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <div class="text-warning mb-2">
                        <i class="bi bi-gear display-5"></i>
                    </div>
                    <h5 class="card-title">Webpage Setting</h5>
                    <p class="card-text fs-4 fw-bold">⚙️</p>
                    <a href="{{ route('admin.webpage.setting') }}" class="btn btn-sm btn-outline-warning">Atur</a>
                </div>
            </div>
        </div>

        {{-- 🔹 Statistik Singkat --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="bi bi-bar-chart-line display-5"></i>
                    </div>
                    <h5 class="card-title mb-2">Statistik</h5>
                    <p class="text-muted small">
                        Selamat datang di halaman admin.<br>
                        Gunakan menu di sebelah kiri untuk mengelola konten website.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
