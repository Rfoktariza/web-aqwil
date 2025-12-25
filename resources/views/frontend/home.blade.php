@extends('layouts.frontend')

@section('content')

    <style>
        /* 🔹 Default */
        .section-3 h5 {
            font-size: 1.5rem;
            line-height: 1.4;
        }

        .section-3 p {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .section-3 h6 {
            font-size: 1rem;
            line-height: 1.4;
        }

        /* 🔹 Responsif di layar kecil */
        @media (max-width: 768px) {
            .section-3 h5 {
                font-size: 1.1rem;
                line-height: 1.2;
            }

            .section-3 h6 {
                font-size: 0.85rem;
                line-height: 1.2;
            }

            .section-3 p {
                font-size: 0.7rem;
                line-height: 1.1;
            }

            .section-3 i {
                font-size: 1.4rem !important;
                margin-bottom: 0.4rem !important;
            }

            .section-3 .p-4 {
                padding: 0.9rem !important;
            }

            .section-3 .col-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* 🔹 Extra kecil (HP mini <480px) */
        @media (max-width: 480px) {
            .section-3 h5 {
                font-size: 1rem;
            }

            .section-3 h6 {
                font-size: 0.8rem;
            }

            .section-3 p {
                font-size: 0.8rem;
                line-height: 1.05;
            }

            .section-3 i {
                font-size: 1.3rem !important;
            }
        }

        /* --- Deskripsi produk --- */
        .product-desc {
            font-size: 0.9rem;
            margin-top: 5px;
            line-height: 1.4em;
            font-weight: 600;
            /* 🔹 Membuat teks lebih tebal */

        }

        /* --- Wrapper gambar 1:1 tanpa terpotong --- */
        .image-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .image-wrapper:hover img {
            transform: scale(1.05);
            filter: brightness(95%);
        }

        /* --- Overlay “Lihat Detail” --- */
        .image-wrapper .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-wrapper:hover .overlay {
            opacity: 1;
        }

        .image-wrapper .overlay span {
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover .overlay span {
            transform: scale(1);
        }

        /* --- Card produk --- */
        .product-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
            border: none;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
        }

        /* --- Bagian isi card --- */
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* --- Nama produk: maksimal 2 baris --- */
        .product-name {
            font-weight: 600;
            line-height: 1.3em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: color 0.3s ease;
            cursor: pointer;
            margin-bottom: 0;
        }

        .product-name:hover {
            color: #007bff;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 70%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            top: 50%;
            transform: translateY(-50%);
        }

        .carrousel-card:hover {
            cursor: pointer;
        }

        /* 🔹 Responsif untuk layar kecil */
        @media (max-width: 768px) {

            .lihat-link {
                font-size: 0.9rem !important;
                padding: 4px 10px !important;
            }

            .product-column {
                padding: 0.2rem !important;
            }



            .image-wrapper .overlay span {
                font-size: 0.75rem !important;
            }

            .product-desc {
                font-size: 0.6rem !important;
                line-height: 1.05em !important;
                margin-top: 3px !important;
            }

            .product-name {
                font-size: 0.8rem !important;
                line-height: 1.1em !important;
            }

            .btn-gradient {
                font-size: 0.75rem !important;
                padding: 6px 12px !important;
            }


            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                width: 2rem;
                height: 2rem;
            }

            .carousel-control-prev span,
            .carousel-control-next span {
                padding: 0.8rem !important;
            }
        }

        /* 🔹 Layar sangat kecil (HP mini <480px) */
        @media (max-width: 480px) {

            .lihat-link {
                font-size: 0.8rem !important;
                padding: 3px 8px !important;
            }

            .product-column {
                padding: 0.1rem !important;
            }

            .ribbon-tag {
                font-size: 0.6rem !important;
                padding: 3px 8px !important;
                max-width: 90px !important;
            }

            .product-desc {
                font-size: 0.50rem !important;
                line-height: 1em !important;
            }

            .product-name {
                font-size: 0.75rem !important;
                line-height: 1.05em !important;
            }

            .btn-gradient {
                font-size: 0.7rem !important;
                padding: 5px 10px !important;
            }


            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                width: 1.2rem;
                height: 1.2rem;
                background-size: 50%;
            }

            .carousel-control-prev span,
            .carousel-control-next span {
                padding: 0.5rem !important;
            }
        }


        /* --- Default desktop / tablet --- */
        .product-scroll-container .row {
            flex-wrap: wrap;
            /* tetap grid normal di layar besar */
        }

        /* --- Layar kecil (HP <768px) --- */
        @media (max-width: 768px) {
            .product-scroll-container .row {
                flex-wrap: nowrap !important;
                /* jadikan horizontal scroll */
                overflow-x: auto;
                /* aktifkan scroll horizontal */
                -webkit-overflow-scrolling: touch;
                /* scroll smooth di HP */
                padding-bottom: 0.5rem;
            }

            .product-scroll-container .product-column {
                flex: 0 0 auto !important;
                width: 70%;
                /* 3 produk muat sebagian, bisa digeser */
                max-width: 70%;
            }

            /* Optional: scrollbar lebih tipis */
            .product-scroll-container::-webkit-scrollbar {
                height: 6px;
            }

            .product-scroll-container::-webkit-scrollbar-thumb {
                background: rgba(0, 0, 0, 0.2);
                border-radius: 10px;
            }
        }

        .product-desc p {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3em;
            min-height: calc(1.3em * 2);
            /* minimal tinggi untuk 2 baris */
        }

        .caption-hero {
            font-size: 1rem;
            padding: 0rem !important;
        }

        .caption {
            font-size: 0.8rem;

        }

        element.style {
            background-color: transparent;
        }

        .title-hero {
            font-size: 1.50rem;
        }

        section h5 {
            font-size: 1rem;

        }

        .visi-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 35px 25px;
            transition: all 0.3s ease;
            height: 180px;
        }

        .visi-card:hover {
            background-color: #d8e7ff;
            transform: translateY(-6px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }


        @media (max-width: 992px) {
            .caption {
                font-size: 0.75rem;

            }

            .caption-hero,
            section h5 {
                font-size: 0.8rem;
            }

            .title-hero {
                font-size: 1rem;
            }


        }

        @media (max-width: 768px) {
            .caption {
                font-size: 0.8rem;

            }

            .caption-hero,
            section h5 {
                font-size: 0.7rem;
            }

            .title-hero {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .caption {
                font-size: 0.8rem;

            }

            .caption-hero,
            section h5 {
                font-size: 0.8rem;
            }

            .title-hero {
                font-size: 0.7rem;
            }
        }

        /* 🌈 Warna berbeda & kontras antar section */
        .section-1 {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .section-2 {
            background: #e9f2fb;
            /* biru muda lembut */
        }

        .section-3 {
            background: linear-gradient(to bottom, #ffffff, #eaf3ff);
        }

        .section-4 {
            background: linear-gradient(to bottom, #ffffff, #eaf3ff);
            color: #333;
        }



        .section-6 {
            background: linear-gradient(to bottom, #ffffff, #eaf3ff);
            color: #333;
        }

        .section-7 {
            background: linear-gradient(to bottom, #ffffff, #eaf3ff);
            color: #333;
        }

        /* 🧱 Style umum */
        section {
            padding: 100px 0;
            transition: background 0.4s ease;
        }

        .testimoni-card {
            transition: all 0.3s ease;
            background: #fff;
        }

        .testimoni-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .text-gradient {
            background: linear-gradient(90deg, #0d6efd, #6f42c1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
        }

        .heading-underline {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0d6efd, #6f42c1);
            border-radius: 10px;
            opacity: 0.9;
        }

        .section-heading:hover .heading-underline {
            width: 120px;
            transition: all 0.4s ease;
        }

        /* Responsif tablet */
        @media (max-width: 992px) {
            #testimoniCarousel .col-lg-4 {
                flex: 0 0 80%;
                max-width: 80%;
            }

            .testimoni-card p {
                font-size: 0.9rem;
            }

            .testimoni-card h6 {
                font-size: 0.95rem;
            }

            .text-gradient {
                font-size: 1.25rem;
            }

            .section-heading p {
                font-size: 0.9rem;
            }
        }

        /* Responsif mobile */
        @media (max-width: 576px) {
            #testimoniCarousel .col-lg-4 {
                flex: 0 0 90%;
                max-width: 90%;
            }

            .testimoni-card {
                padding: 1.2rem;
            }

            .testimoni-card p {
                font-size: 0.85rem;
            }

            .testimoni-card h6 {
                font-size: 0.9rem;
            }

            .testimoni-card small {
                font-size: 0.75rem;
                /* perkecil jabatan */
                line-height: 1;
                /* rapatkan */
                display: block;
                /* biar rapi di bawah nama */
            }

            .text-gradient {
                font-size: 1.1rem;
            }

            .section-heading p {
                font-size: 0.85rem;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                padding: 0.6rem !important;
            }

            .section-7 p {
                font-size: 0.8rem !important;
                line-height: 1.3;
            }
        }

        .testimoni-card p {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* maksimal 4 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5em;
            /* tinggi baris */
            min-height: calc(1.5em * 4);
            /* tinggi minimal agar semua card rata */
        }

        /* ✨ Gaya heading utama */
        .section-heading {
            font-size: 1.5rem;
            line-height: 1.4;
            /* ukuran default (desktop) */
        }

        /* 🔹 Responsif: di layar tablet */
        @media (max-width: 768px) {
            .section-heading {
                font-size: 1.1rem;
                line-height: 1.2;
            }

            .section-header a {
                font-size: 0.85rem !important;
                padding: 6px 12px !important;
            }
        }

        /* 🔹 Responsif: di layar HP kecil */
        @media (max-width: 480px) {
            .section-heading {
                font-size: 1rem;
            }

            .section-header a {
                font-size: 0.8rem !important;
                padding: 5px 10px !important;
            }

            .section-header {

                gap: 0.5rem;

            }
        }

        /* 🌊 HERO SECTION - Tone Biru Modern */
        .hero-modern-blue {

            position: relative;
            padding: 120px 0;
            background: linear-gradient(135deg, #14BDF6 0%, #0A74C4 100%);
            color: #fff;
            overflow: hidden;
        }

        .hero-modern-blue::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.2), transparent 70%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1), transparent 70%);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* 🎈 Ilustrasi melayang */
        .floating-illustration {
            width: 75%;
            animation: float 6s ease-in-out infinite;
            filter: drop-shadow(0 8px 20px rgba(20, 189, 246, 0.3));
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* 💫 Tombol */
        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: white;
            backdrop-filter: blur(6px);
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-light {
            background: white;
            color: #0A74C4;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: #eaf7ff;
            transform: translateY(-2px);
        }

        /* 🔵 Dekoratif elemen */
        .decor {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            z-index: 1;
            animation: pulse 10s ease-in-out infinite;
        }

        /* 🟢 Biru utama */
        .decor-blue {
            width: 350px;
            height: 350px;
            background: rgba(20, 189, 246, 0.6);
            top: -50px;
            left: -80px;
        }

        /* ⚪ Biru muda lembut */
        .decor-light {
            width: 300px;
            height: 300px;
            background: rgba(170, 233, 255, 0.5);
            bottom: -120px;
            right: -80px;
        }

        /* 💎 Efek glow tambahan */
        .decor-glow {
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.35);
            top: 40%;
            left: 45%;
            filter: blur(90px);
            opacity: 0.5;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.5;
                transform: scale(1);
            }

            50% {
                opacity: 0.9;
                transform: scale(1.1);
            }
        }

        /* 📱 Responsif */
        @media (max-width: 992px) {
            .hero-modern-blue {
                text-align: center;
                padding: 90px 0;
            }

            .floating-illustration {
                width: 90%;
                margin-top: 30px;
            }
        }
    </style>

    <section id="home" class="hero-modern-blue text-white  ">
        <div class="container hero-content position-relative">
            <div class="row align-items-start  text-lg-start">
                <div class="col-12 col-md-8 position-relative  ">
                    <h1 class="display-4 fw-bold mb-4" style="line-height: 1;">
                        {{ $webpage->hero_title ?? 'Solusi Kesehatan Modern' }}
                    </h1>
                    <p class="lead mb-4 ">
                        {{ $webpage->hero_subtitle ?? 'Kami hadir dengan inovasi dan pelayanan terbaik untuk Anda.' }}
                    </p>

                    <div class="d-flex flex-column flex-sm-row gap-3    ">
                        @if (!empty($webpage->catalog_pdf))
                            {{-- <a href="{{ asset('storage/' . $webpage->catalog_pdf) }}"
                                class="btn btn-outline-light btn-lg px-4 shadow-sm" download>
                                <i class="bi bi-download me-2"></i>Lihat Katalog
                            </a> --}}
                            <a href="{{ route('produk') }}" class="btn btn-outline-light btn-lg px-4 shadow-sm">
                                Lihat Katalog
                            </a>
                        @endif

                        @php
                            $nomor_wa = $webpage->whatsapp_number ?? '628123456789';
                            $pesan = urlencode('Halo Admin, saya ingin konsultasi gratis');
                            $wa_link = "https://wa.me/{$nomor_wa}?text={$pesan}";
                        @endphp

                        <a href="{{ route('kontak') }}" class="btn btn-light btn-lg px-4 shadow-sm">
                            Hubungi Kami
                        </a>
                    </div>
                </div>


            </div>
        </div>

        <!-- 🔵 Elemen dekoratif -->
        <div class="decor decor-circle decor-blue"></div>
        <div class="decor decor-circle decor-light"></div>
        <div class="decor decor-circle decor-glow"></div>
    </section>



    <section class="section-3 py-5">

        <div class="container text-center">
            <h5 class="fw-bold">Mengapa Memilih Kami</h5>
            <p class="text-muted mb-4">Kualitas, kepatuhan, dan layanan terpercaya.</p>
            <div class="row justify-content-center g-4">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100 feature-card">
                        <i class="bi bi-shield-check text-primary fs-2 mb-3"></i>
                        <h6 class="fw-semibold">Berpengalaman & Terpercaya</h6>
                        <p class="text-muted small mb-0">Telah dipercaya oleh ratusan rumah sakit dan klinik selama lebih
                            dari 10 tahun.</p>
                    </div>
                </div>



                <div class="col-12 col-sm-6 col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100 feature-card">
                        <i class="bi bi-truck text-primary fs-2 mb-3"></i>
                        <h6 class="fw-semibold">Logistik Cepat & Andal</h6>
                        <p class="text-muted small mb-0">Pengiriman ke seluruh Indonesia dengan pelacakan aman dan
                            terpercaya.</p>
                    </div>
                </div>



                <div class="col-12 col-sm-6 col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm h-100 feature-card">
                        <i class="bi bi-cash-stack text-primary fs-2 mb-3"></i>
                        <h6 class="fw-semibold">Harga Kompetitif</h6>
                        <p class="text-muted small mb-0">Produk berkualitas tinggi dengan harga kompetitif dan nilai
                            terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="section-2  py-4">

        <div class="container text-center">
            <div class="section-header align-items-center mb-4">
                <h5 class="fw-bold section-heading">
                    Produk Unggulan
                </h5>


            </div>


            <!-- 🔹 Carousel -->
            <div id="produkCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-inner">
                    @foreach ($products->chunk(6) as $chunkIndex => $chunk)
                        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                            <div class="row g-3 justify-content-center">
                                @foreach ($chunk as $product)
                                    @php
                                        $primaryImage = $product->images->where('is_primary', true)->first();

                                    @endphp

                                    <div class="col-6 col-md-4 carrousel-card ">
                                        <div class="card bg-light product-card border-0 shadow-sm position-relative m-0"
                                            onclick="window.location.href='{{ route('detail.produk', $product->slug) }}'">
                                            <div class="image-wrapper position-relative bg-white">
                                                <img src="{{ $primaryImage ? asset('storage/' . $primaryImage->image_path) : asset('no-image.png') }}"
                                                    alt="{{ $product->name }}" class="card-img-top">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <span class="text-white fw-bold fs-6">Lihat Detail</span>
                                                </div>
                                            </div>
                                            <div class="product-desc py-2 bg-white">
                                                <div class=" btn-gradient text-center   justify-content-center px-2">
                                                    <p class=" m-0 fw-bold ">
                                                        {{ $product->name }}
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- 🔹 Tombol Navigasi -->
                @if ($products->count() > 6)
                    <button class="carousel-control-prev" type="button" data-bs-target="#produkCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#produkCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Berikutnya</span>
                    </button>
                @endif

            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('produk') }}" class="btn btn-primary lihat-link text-decoration-none px-4 py-2">
                    Lihat semua produk <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>




    </section>








    {{-- ================= TESTIMONI ================= --}}
    <section class="py-5 section-7">
        <div class="container text-center">

            {{-- Judul & Deskripsi --}}
            <div class="section-heading mb-5 position-relative text-center">
                <h4 class="fw-bold mb-3 text-gradient">
                    {{ $webpage->section_testimoni_title ?? 'Testimoni' }}
                </h4>
                <div class="heading-underline mx-auto mb-3"></div>
                <p class="text-muted fs-6 mx-auto" style="max-width: 600px;">
                    {{ $webpage->section_testimoni_content ?? 'Pendapat pelanggan dan pengguna produk kami yang puas.' }}
                </p>
            </div>

            @if ($testimonis && $testimonis->count() > 0)
                @php
                    $chunks = $testimonis->chunk(1);
                    $slideCount = $chunks->count();
                @endphp

                <div id="testimoniCarousel" class="carousel slide  " data-bs-ride="carousel" data-bs-interval="2000">

                    @if ($slideCount > 1)
                        <div class="carousel-indicators mb-4">
                            @for ($i = 0; $i < $slideCount; $i++)
                                <button type="button" data-bs-target="#testimoniCarousel"
                                    data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"
                                    aria-current="{{ $i === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $i + 1 }}"></button>
                            @endfor
                        </div>
                    @endif

                    <div class="carousel-inner">
                        @foreach ($chunks as $chunkIndex => $chunk)
                            <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                <div class="row justify-content-center g-4">
                                    @foreach ($chunk as $item)
                                        <div class="col-10">
                                            <div
                                                class="card border-0 shadow-sm rounded-4 p-4 text-start testimoni-card h-100">
                                                {{-- Foto pelanggan --}}
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $item->photo ? asset('storage/' . $item->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($item->name) }}"
                                                        alt="{{ $item->name }}" class="rounded-circle me-3 shadow-sm"
                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">{{ $item->name }}</h6>
                                                        <small
                                                            class="text-muted">{{ $item->job_title ?? 'Pelanggan' }}</small>
                                                    </div>
                                                </div>

                                                {{-- Isi testimoni --}}
                                                <p class="text-muted fst-italic">“{{ $item->message }}”
                                                </p>

                                                {{-- Rating --}}
                                                @if (!empty($item->rating))
                                                    <div class="mt-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="bi bi-star{{ $i <= $item->rating ? '-fill text-warning' : ' text-secondary' }}"></i>
                                                        @endfor
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Controls (tampil kalau slide > 1) --}}
                    @if ($slideCount > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Sebelumnya</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Berikutnya</span>
                        </button>
                    @endif
                </div>
            @else
                <p class="text-muted">Belum ada testimoni yang tersedia saat ini.</p>
            @endif

        </div>
    </section>




    {{-- 🔹 WhatsApp Customer Care --}}
    <section class="position-relative py-5 text-center text-dark"
        style="background: linear-gradient(135deg, #f9f9f9 0%, #e9f7ef 100%); overflow: hidden;">

        {{-- Ornamen kiri atas --}}
        <div class="position-absolute top-0 start-0 w-50 h-50 rounded-circle"
            style="background: radial-gradient(circle at center, rgba(72,239,128,0.25) 0%, transparent 70%);
                   transform: translate(-30%, -30%);">
        </div>

        {{-- Ornamen kanan bawah --}}
        <div class="position-absolute bottom-0 end-0 w-50 h-50 rounded-circle"
            style="background: radial-gradient(circle at center, rgba(46,204,113,0.15) 0%, transparent 70%);
                   transform: translate(30%, 30%);">
        </div>

        <div class="container position-relative">
            <h4 class="fw-bold mb-3 display-6 text-success-emphasis title-hero">
                Kini WhatsApp Customer Care hadir untuk menjawab kebutuhan informasi Sahabat Aqwil Medica
            </h4>
            <p class="text-muted   mb-4 caption-hero">
                Hubungi kami untuk konsultasi atau informasi produk terbaru.
            </p>

            @php
                $nomor_wa = $webpage->whatsapp_number;
                $pesan = urlencode('Halo Admin, saya ingin konsultasi dengan Aqwil Medica.');
                $wa_link = "https://wa.me/{$nomor_wa}?text={$pesan}";
            @endphp

            <a href="{{ $wa_link }}" target="_blank"
                class="btn btn-success px-4 py-2 rounded-pill fw-semibold shadow-lg d-inline-flex align-items-center gap-2 caption"
                style="transition: all 0.3s ease;">
                <i class="bi bi-whatsapp fs-4"></i> Chat via WhatsApp
            </a>
        </div>
    </section>







@endsection
