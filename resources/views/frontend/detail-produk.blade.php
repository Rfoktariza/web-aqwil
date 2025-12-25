@extends('layouts.frontend')

@section('title', $product->name . ' - Aqwil Medica')
@section('meta_description', 'Jual ' . $product->name . ' di Bogor. ' . Str::limit(strip_tags($product->description), 120))

@section('content')

    <style>
        /* 🔹 Mobile (lebar < 480px) */
        @media (max-width: 480px) {
            .container {
                font-size: 0.8rem;
            }

            #mainImage {
                max-width: 250px;
            }
        }

        .active-thumb {
            border: 2px solid #007bff !important;
        }


        #mainImage {
            width: 100%;
            max-width: 400px;
            /* batas maksimal di layar besar */
            aspect-ratio: 1 / 1;
            /* menjaga proporsi kotak */
            object-fit: cover;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        #mainImage {
            transition: opacity 0.3s ease-in-out;
        }

        .fade-out {
            opacity: 0;
        }

        .fade-in {
            opacity: 1;
        }

        .h3,
        h3 {
            font-size: 1.4rem;

        }



        /* 🔹 Laptop kecil / tablet landscape */
        @media (max-width: 992px) {
            .container {
                font-size: 0.8rem;

            }

            .h3,
            h3 {
                font-size: 1rem;

            }

            #mainImage {
                max-width: 400px;
            }


        }

        /* 🔹 Tablet potrait */
        @media (max-width: 768px) {
            .container {
                font-size: 0.75rem;
            }

            #mainImage {
                max-width: 300px;
            }
        }



        .container {
            font-size: 0.8rem;

        }

        .arrow-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.4);
            border: none;
            color: white;
            font-size: 1.5rem;
            padding: 0.6rem 1rem;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
            z-index: 2;
        }

        .arrow-btn:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .arrow-btn.left {
            left: 10px;
        }

        .arrow-btn.right {
            right: 10px;
        }

        /* 🔹 Thumbnail aktif */
        .small-image.active-thumb {
            border: 2px solid #0d6efd !important;
        }

        .arrow-btn {
            font-size: 1rem;
            padding: 0.35rem 0.7rem;
        }



        /* 🔹 Tablet (max-width: 992px) */
        @media (max-width: 992px) {
            .arrow-btn {
                font-size: 1rem;
                padding: 0.35rem 0.7rem;
            }
        }

        /* 🔹 HP sedang (max-width: 768px) */
        @media (max-width: 768px) {
            .arrow-btn {
                font-size: 1rem;
                padding: 0.35rem 0.7rem;
            }
        }

        /* 🔹 HP kecil (max-width: 480px) */
        @media (max-width: 480px) {
            .arrow-btn {
                font-size: 1rem;
                padding: 0.35rem 0.7rem;
            }

            .arrow-btn.left {
                left: 5px;
            }

            .arrow-btn.right {
                right: 5px;
            }
        }

        /* Tombol sticky di layar kecil */
        @media (max-width: 768px) {
            .sticky-wa-btn {
                position: fixed;
                bottom: 15px;
                left: 50%;
                transform: translateX(-50%);
                width: 90%;
                z-index: 999;
                border-radius: 50px;
                font-size: 0.9rem;
                text-align: center;
                /* Warna hijau WhatsApp */
                overflow: hidden;
                transition: all 0.3s ease;
                box-shadow: none;
            }

            /* Efek highlight menyapu */
            .sticky-wa-btn::after {
                content: "";
                position: absolute;
                top: 0;
                left: -75%;
                width: 50%;
                height: 100%;
                background: linear-gradient(120deg,
                        rgba(255, 255, 255, 0) 0%,
                        rgba(255, 255, 255, 0.5) 50%,
                        rgba(255, 255, 255, 0) 100%);
                animation: shine 2.5s infinite;
            }

            /* Animasi kilauan */
            @keyframes shine {
                0% {
                    left: -75%;
                }

                100% {
                    left: 125%;
                }
            }
        }

        /* Untuk layar besar (non-sticky, tanpa efek) */
        @media (min-width: 769px) {
            .sticky-wa-btn {

                width: auto;
                transform: none;
                border-radius: 15px;
                font-size: 0.95rem;
                text-align: center;
                /* Warna hijau WhatsApp */
                overflow: hidden;
                transition: all 0.3s ease;
                box-shadow: none;
                font-weight: 600;

            }

            .sticky-wa-btn::after {
                display: none;
            }
        }



        .hover-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .hover-card:hover .product-name {
            color: #0d6efd !important;
            /* biru Bootstrap */
            transition: color 0.3s ease;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        /* ✨ Nama produk selalu 2 baris */
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3rem;
            /* sesuaikan dengan ukuran font */
            min-height: calc(1.3rem * 1);
            /* tinggi minimal = 2 baris */
        }

        .card {
            height: 100%;
        }

        /* 🔹 Ukuran dan tampilan ikon */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 70%;
            filter: invert(1);

        }

        /* 🔹 Tombol bentuk lingkaran rapi */
        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            background-color: #ffffff;
            border-color: #000000;
            opacity: 1;
        }

        /* 🔹 Efek hover */
        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: #ffffff;
            border-color: #c3c6cc;
        }

        .carousel-control-prev:hover .carousel-control-prev-icon,
        .carousel-control-next:hover .carousel-control-next-icon {
            filter: invert(1);
        }

        /* 🔹 Responsif kecil: tombol lebih kecil */
        @media (max-width: 576px) {

            .carousel-control-prev,
            .carousel-control-next {
                width: 34px;
                height: 34px;
                padding: 0.4rem;
            }
        }

        .table {
            --bs-table-bg: transparent;
        }



        .detail-desc {
            font-size: 0.8rem;
        }

        /* 🔹 Efek hover kartu */
        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        }

        /* 🔹 Gambar produk — rasio 1:1 dan responsif */
        .hover-card img {
            width: 100%;
            aspect-ratio: 1 / 1;
            /* menjaga gambar tetap kotak */
            object-fit: cover;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            transition: transform 0.3s;
        }





        .card-title {
            font-size: 0.75rem;
        }

        h4 {
            font-size: 1.25rem;
        }

        /* ================= RESPONSIVE ================= */

        /* 🔹 Tablet landscape (≤ 992px) */
        @media (max-width: 992px) {
            h4 {
                font-size: 1.25rem;
            }

            .card-title {
                font-size: 0.75rem;
            }

            .card-body p {
                font-size: 0.55rem;
                line-height: 0.55rem;
            }
        }

        /* 🔹 Tablet potrait (≤ 768px) */
        @media (max-width: 768px) {
            .hover-card img {
                aspect-ratio: 1 / 1;
            }

            h4 {
                font-size: 1.10rem;
            }

            .card-title {
                font-size: 0.7rem;
            }

            .card-body p {
                font-size: 0.55rem;
                line-height: 0.55rem;
            }

            .custom-nav {
                width: 20px;
                height: 20px;
            }

            .custom-nav span {
                width: 20px;
                height: 20px;
            }
        }

        /* 🔹 Mobile (≤ 480px) */
        @media (max-width: 480px) {
            h4 {
                font-size: 1rem;
            }

            .card-title {
                font-size: 0.75rem;
            }

            .card-body p {
                font-size: 0.50rem;
                line-height: 0.50rem;
            }

            .hover-card img {
                aspect-ratio: 1 / 1;
            }

            .custom-nav {
                width: 15px;
                height: 15px;
            }

            .custom-nav span {
                width: 15px;
                height: 15px;
            }

        }

        .card-title {
            white-space: nowrap;
            /* 🔹 Tidak pindah baris */
            overflow: hidden;
            /* 🔹 Sembunyikan teks berlebih */
            text-overflow: ellipsis;
            /* 🔹 Tambah "..." di akhir */
            display: block;
            /* 🔹 Wajib agar text-overflow berfungsi */
            max-width: 100%;
            /* 🔹 Batasi sesuai lebar parent */
        }
    </style>
    <div class="container py-4">

        <div class="mb-2 fw-semibold category-text ">

            <a href="{{ route('produk') }}" class="text-decoration-none "> <i class="bi bi-arrow-left"></i>
                Kembali ke Semua Produk
            </a>
        </div>

        <div class="row">
            <div class="col-md-6">
                {{-- 🔹 Gambar utama --}}
                @php
                    $primaryImage = $product->images->where('is_primary', true)->first();
                    $mainImage = $primaryImage ? asset('storage/' . $primaryImage->image_path) : asset('no-image.png');
                @endphp

                <div class="position-relative text-center mb-3">
                    <img id="mainImage" src="{{ $mainImage }}" class="img-fluid rounded"
                        style="max-height: 400px; object-fit: contain;">


                </div>


                {{-- 🔹 Thumbnail gambar --}}
                <div class="d-flex justify-content-center flex-wrap gap-2">
                    @forelse ($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}"
                            class="img-thumbnail small-image {{ $img->is_primary ? 'active-thumb' : '' }}"
                            style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                            onclick="changeImage(this)">
                    @empty
                        <img src="{{ asset('no-image.png') }}" class="img-thumbnail small-image active-thumb"
                            style="width: 80px; height: 80px; object-fit: cover;">
                    @endforelse
                </div>
            </div>

            {{-- 🔹 Script ganti gambar utama + navigasi arrow --}}
            <script>
                const images = Array.from(document.querySelectorAll('.small-image'));
                let currentIndex = images.findIndex(img => img.classList.contains('active-thumb'));

                function changeImage(el) {
                    const mainImage = document.getElementById('mainImage');

                    // --- Fade out ---
                    mainImage.classList.add('fade-out');

                    setTimeout(() => {
                        // Ubah gambar setelah fade-out selesai
                        mainImage.src = el.src;

                        // Highlight thumbnail
                        images.forEach(img => img.classList.remove('active-thumb'));
                        el.classList.add('active-thumb');

                        // --- Fade in ---
                        mainImage.classList.remove('fade-out');
                        mainImage.classList.add('fade-in');

                    }, 200); // sedikit lebih kecil dari transition CSS
                }

                document.getElementById('mainImage').addEventListener('transitionend', () => {
                    mainImage.classList.remove('fade-in');
                });

                document.getElementById('prevImage').addEventListener('click', () => {
                    if (images.length === 0) return;
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    changeImage(images[currentIndex]);
                });

                document.getElementById('nextImage').addEventListener('click', () => {
                    if (images.length === 0) return;
                    currentIndex = (currentIndex + 1) % images.length;
                    changeImage(images[currentIndex]);
                });
            </script>
            <script>
                const imagesSwipe = Array.from(document.querySelectorAll('.small-image'));
                let currentIndexSwipe = imagesSwipe.findIndex(img => img.classList.contains('active-thumb'));

                let startX = 0;
                let endX = 0;

                const mainImg = document.getElementById('mainImage');

                // 🟦 Mulai sentuhan
                mainImg.addEventListener('touchstart', function(e) {
                    startX = e.touches[0].clientX;
                });

                // 🔵 Akhir sentuhan
                mainImg.addEventListener('touchend', function(e) {
                    endX = e.changedTouches[0].clientX;
                    handleSwipe();
                });

                function handleSwipe() {
                    const diff = endX - startX;

                    // Usap kanan (➜) → gambar sebelumnya
                    if (diff > 50) {
                        currentIndexSwipe = (currentIndexSwipe - 1 + imagesSwipe.length) % imagesSwipe.length;
                        changeImage(imagesSwipe[currentIndexSwipe]);
                    }

                    // Usap kiri (⬅) → gambar berikutnya
                    if (diff < -50) {
                        currentIndexSwipe = (currentIndexSwipe + 1) % imagesSwipe.length;
                        changeImage(imagesSwipe[currentIndexSwipe]);
                    }
                }
            </script>








            {{-- 🔹 Informasi produk --}}
            <div class="col-md-6 py-3">


                <h3 class="fw-bold">{{ $product->name }}</h3>

                {{-- Deskripsi (sudah dalam HTML) --}}
                <div class="mb-3 detail-desc">

                    {!! $product->description !!}

                </div>

                {{-- 🔹 Spesifikasi Produk --}}
                @if (!empty($product->specs))
                    @php
                        $specs = is_array($product->specs) ? $product->specs : json_decode($product->specs, true);
                    @endphp

                    @if (!empty($specs))
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">Spesifikasi</h6>
                            <hr>

                            <div class="table-responsive ">
                                <table class="table table-sm mb-0" style="border: none;">
                                    <tbody>
                                        @foreach ($specs as $key => $value)
                                            <tr style="border: none;">
                                                <td class="fw-semibold text-dark p-0" style="width: 40%; border: none;">
                                                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                </td>
                                                <td class="text-secondary p-0" style="border: none;  ">
                                                    @if (is_array($value))
                                                        {{ implode(', ', $value) }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif


                {{-- 🔹 Tombol Pesan via WhatsApp --}}
                @php
                    // Nomor admin toko (tanpa tanda +)
                    $nomor_wa = $webpage->whatsapp_number;
                    $pesan = urlencode("Halo, saya ingin memesan produk *{$product->name}* dari website Anda.");
                    $wa_link = "https://wa.me/{$nomor_wa}?text={$pesan}";
                @endphp

                <div class="text-start mt-3">
                    <a href="{{ $wa_link }}" target="_blank"
                        class="btn btn-success btn-lg   sticky-wa-btn d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-whatsapp fs-5"></i>
                        <span>Pesan Sekarang via WhatsApp</span>
                    </a>
                </div>


            </div>

        </div>




        <!-- 🔹 Produk Lainnya -->
        <div class="container mt-3 d-none d-md-block">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Produk Lainnya</h4>

                <div class="d-flex gap-2">
                    <!-- 🔹 Tombol Navigasi -->
                    <button
                        class="carousel-control-prev position-static border rounded-circle p-2 d-flex align-items-center justify-content-center  "
                        type="button" data-bs-target="#relatedCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button
                        class="carousel-control-next position-static border rounded-circle p-2 d-flex align-items-center justify-content-center  "
                        type="button" data-bs-target="#relatedCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
            <div id="relatedCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse ($relatedProducts->chunk(4) as $chunkIndex => $chunk)
                        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                            <div class="row g-3 justify-content-start">
                                @foreach ($chunk as $related)
                                    @php
                                        $img = $related->images->where('is_primary', true)->first();
                                        $imgUrl = $img ? asset('storage/' . $img->image_path) : asset('no-image.png');
                                    @endphp

                                    <div class="col-md-3 col-6 d-flex">
                                        <div
                                            class="card bg-white border-0 shadow-sm hover-card p-2 w-100 d-flex flex-column">
                                            <a href="{{ route('detail.produk', $related->slug) }}"
                                                class="text-decoration-none flex-grow-1 d-flex flex-column">
                                                <div class="ratio ratio-1x1 bg-light overflow-hidden rounded">
                                                    <img src="{{ $imgUrl }}" class="object-fit-cover w-100 h-100"
                                                        alt="{{ $related->name }}">
                                                </div>

                                                <div class="p-2 mt-auto">
                                                    <p class="fw-semibold text-start text-black text-truncate-2 mb-1 product-name"
                                                        title="{{ $related->name }}">
                                                        {{ $related->name }}
                                                    </p>

                                                    <span class="text-secondary small d-block text-truncate">
                                                        {{ $related->categories->first()->name ?? '-' }}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-2"></i>
                            <p class="mt-3">Belum ada produk tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="container mt-3 d-md-none">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Produk Lainnya</h4>

                <div class="d-flex gap-2">
                    <!-- 🔹 Tombol Navigasi -->
                    <button
                        class="carousel-control-prev position-static border rounded-circle p-2 d-flex align-items-center justify-content-center  "
                        type="button" data-bs-target="#relatedCarousel-sm" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button
                        class="carousel-control-next position-static border rounded-circle p-2 d-flex align-items-center justify-content-center  "
                        type="button" data-bs-target="#relatedCarousel-sm" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>




            {{-- layar kecil --}}
            <div id="relatedCarousel-sm" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse ($relatedProducts->chunk(2) as $chunkIndex => $chunk)
                        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                            <div class="row g-3 justify-content-start">
                                @foreach ($chunk as $related)
                                    @php
                                        $img = $related->images->where('is_primary', true)->first();
                                        $imgUrl = $img ? asset('storage/' . $img->image_path) : asset('no-image.png');
                                    @endphp

                                    <div class="col-md-3 col-6 d-flex">
                                        <div
                                            class="card bg-white border-0 shadow-sm hover-card p-2 w-100 d-flex flex-column">
                                            <a href="{{ route('detail.produk', $related->slug) }}"
                                                class="text-decoration-none flex-grow-1 d-flex flex-column">
                                                <div class="ratio ratio-1x1 bg-light overflow-hidden rounded">
                                                    <img src="{{ $imgUrl }}" class="object-fit-cover w-100 h-100"
                                                        alt="{{ $related->name }}">
                                                </div>

                                                <div class="p-2 mt-auto">
                                                    <p class="fw-semibold text-start text-black text-truncate-2 mb-1 product-name"
                                                        title="{{ $related->name }}">
                                                        {{ $related->name }}
                                                    </p>

                                                    <span class="text-secondary small d-block text-truncate">
                                                        {{ $related->categories->first()->name ?? '-' }}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-2"></i>
                            <p class="mt-3">Belum ada produk tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>






        </div>




    </div>


@endsection
