@extends('layouts.frontend')

@section('title', 'Katalog Alat Kesehatan & Furniture RS - Aqwil Medica')
@section('meta_description', 'Jelajahi katalog lengkap alat kesehatan Aqwil Medica. Tersedia Bed Pasien, Brankar, Lemari Obat, Kursi Donor hingga Meja Periksa standar medis terbaik.')

@section('content')

    <style>
        /* Sidebar Filter Sticky */
        .sticky-sidebar {
            position: sticky;
            top: 90px;
            /* disesuaikan agar sejajar dengan navbar */
            z-index: 99;
        }

        /* Sidebar Styling */
        .sidebar-filter {
            background-color: #fff;
            border-radius: 0.75rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .sidebar-filter:hover {

            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-filter h5 {
            color: #0066cc;
        }

        .sidebar-filter .form-control,
        .sidebar-filter .form-select {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            padding: 10px;
        }

        .sidebar-filter .form-control:focus,
        .sidebar-filter .form-select:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .sidebar-filter .btn-primary {
            border-radius: 0.5rem;
            background: #14BDF6;
            border: none;
            font-weight: 500;
        }

        .sidebar-filter .btn-primary:hover {
            background: #0da7dc;
        }

        /* Produk Card */
        .product-card {
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #fff;
            border-radius: 10px;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .product-image {
            aspect-ratio: 1 / 1;
            width: 100%;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.03);
        }

        .product-title {
            font-weight: 600;
            margin: 8px 8px;
            margin-bottom: 0px;
            color: #333;
            font-size: 0.8rem;

            /* 🔹 Line Clamp */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;

            line-height: 1.3;
            min-height: calc(1.3em * 2);
            /* minimal 2 baris */
            max-height: calc(1.3em * 2);
            /* maksimal 2 baris */
        }



        .text-detail {
            display: inline-block;
            padding: 6px 14px;
            text-align: center;
            font-weight: 500;
            font-size: 0.75rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .text-detail:hover {
            transform: scale(1.05);
            background-color: #0d6efd;
            color: #fff !important;
            border-color: #0d6efd;
            box-shadow: 0 3px 6px rgba(13, 110, 253, 0.25);
            text-decoration: none;
        }

        .sidebar-filter h5 {
            font-size: 0.80rem;
            line-height: 0.4;
        }

        .sidebar-filter select,
        .sidebar-filter input,
        .sidebar-filter button {
            font-size: 0.80rem;
            line-height: 0.8;
        }


        /* Responsif */
        @media (max-width: 992px) {
            .sticky-sidebar {
                position: relative;
                top: 0;
                margin-bottom: 20px;
            }

            .product-title {
                font-size: 0.8rem;
            }

            .text-detail {
                font-size: 0.8rem;
            }

            h5.fw-bold {
                font-size: 1rem;
            }

            .sidebar-filter {
                padding: 1rem !important;
            }

            .sidebar-filter h5 {
                font-size: 0.8rem;
            }

            .sidebar-filter select,
            .sidebar-filter input,
            .sidebar-filter button {
                font-size: 0.8rem;
                line-height: 0.8;
            }

            .sidebar-filter form {
                gap: 0.25rem;
            }
        }

        @media (max-width: 768px) {
            .product-title {
                font-size: 0.75rem;
            }

            .text-detail {
                font-size: 0.8rem;
            }

            h5.fw-bold {
                font-size: 1rem;
            }

            .sidebar-filter {
                padding: 1rem !important;
            }

            .sidebar-filter h5 {
                font-size: 0.8rem;
                line-height: 0.8;
            }

            .sidebar-filter select,
            .sidebar-filter input,
            .sidebar-filter button {
                font-size: 0.8rem;
                line-height: 0.8;
            }

            .sidebar-filter form {
                gap: 0.25rem;
            }
        }

        /* 🔹 Responsif mobile (lebar < 576px) */
        @media (max-width: 480px) {
            .product-title {
                font-size: 0.75rem;
            }

            .text-detail {
                font-size: 0.8rem;
            }

            h5.fw-bold {
                font-size: 0.9rem;
            }

            .sidebar-filter {
                padding: 1rem !important;
            }

            .form-control,
            .form-select {
                font-size: 0.8rem;
            }

            .sidebar-filter {
                padding: 1rem !important;
            }

            .sidebar-filter h5 {
                font-size: 0.8rem;
                line-height: 0.8;
            }

            .sidebar-filter select,
            .sidebar-filter input,
            .sidebar-filter button {
                font-size: 0.8rem;
                line-height: 0.8;
            }

            .sidebar-filter form {
                gap: 0.25rem;
            }
        }
    </style>

    <div class="section-product">

        <div class="container mt-4">
            <div class="row">
                <!-- 🔹 Sidebar Filter -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm p-4 sidebar-filter sticky-sidebar">
                        <form action="{{ route('produk') }}" method="GET" id="filterForm">
                            <h5 class="fw-bold mb-3">Filter Kategori</h5>
                            <select class="form-select mb-3 " name="category_id" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <h5 class="fw-bold mb-3">Cari Produk</h5>
                            <input type="text" name="search" class="form-control mb-3"
                                placeholder="Cari berdasarkan nama..." value="{{ request('search') }}">
                        </form>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const form = document.getElementById('filterForm');
                                const searchInput = form.querySelector('input[name="search"]');
                                let typingTimer;

                                // Jalankan hanya jika input ada
                                if (searchInput) {
                                    searchInput.addEventListener('input', function() {
                                        clearTimeout(typingTimer);
                                        typingTimer = setTimeout(() => {
                                            form.submit();
                                        }, 1000); // ⏱️ 1 detik setelah berhenti mengetik
                                    });
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- 🔹 Grid Produk -->
                <div class="col-md-9">
                    <div class="row g-4">
                        @forelse ($products as $product)
                            <div class="col-6 col-md-3 p-1">
                                <div class="card product-card h-100  ">
                                    <img src="{{ $product->primaryImage ? asset('storage/' . $product->primaryImage->image_path) : asset('no-image.png') }}"
                                        alt="{{ $product->name }}" class="product-image">

                                    <div class="card-body p-0 d-flex flex-column text-center">
                                        <span class="product-title">{{ $product->name }}</span>
                                        <a href="{{ route('detail.produk', $product->slug) }}" class="text-detail m-1  ">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-box-seam fs-2"></i>
                                <p class="mt-3">Belum ada produk tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>




    </div>



    {{-- 🔹 Select2 (untuk filter kategori) --}}
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Deteksi jika layar lebar <= 768px (mobile)
                if (window.innerWidth <= 768) {
                    const url = new URL(window.location.href);

                    // Jika belum ada parameter mobile=true, tambahkan
                    if (!url.searchParams.has('mobile')) {
                        url.searchParams.set('mobile', 'true');
                        window.location.href = url.toString(); // Redirect ke URL baru
                    }
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2
                $('.select2').select2({
                    placeholder: "Pilih Kategori",
                    allowClear: true
                });


            });
        </script>
    @endpush
@endsection
