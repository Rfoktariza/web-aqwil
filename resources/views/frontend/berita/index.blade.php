@extends('layouts.frontend')

@section('title', 'Berita & Artikel - Aqwil Medica Alkes Bogor')

@section('content')
    <style>
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4em;
            /* tinggi tiap baris */
            min-height: 2.8em;
            /* tinggi minimum = 2 baris (1.4 x 2) */
        }

        a.d-block:hover img {
            transform: scale(1.1);
        }

        a.d-block:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-6px);
        }

        .category-text {
            letter-spacing: 0.05em;

            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.55rem;

        }

        .card-h1 {
            line-height: 2.5rem;
            font-size: 1.8rem
        }

        .pagination {
            gap: 8px;
        }

        .card.bg-dark.text-white.border-0.rounded-4.overflow-hidden {
            min-height: 450px; /* Menambah tinggi minimal container hero */
            display: flex;
            align-items: center; /* Memastikan konten tetap di tengah secara vertikal */
        }

        .card-img-overlay {
            padding: 3rem !important; /* Memberikan ruang lebih luas antara teks dan tepi gambar */
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 100%); /* Overlay agar teks lebih mudah dibaca */
        }

        /* Penyesuaian tombol hero agar lebih menonjol */
        .btn-primary.rounded-3.px-4.py-2 {
            width: fit-content;
            padding: 12px 30px !important;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        }

        /* Tipografi Hero agar lebih tegas */
        .card-h1 {
            margin-bottom: 1.5rem;
            max-width: 80%; /* Mencegah judul terlalu panjang ke kanan */
        }

        .page-link {
            border-radius: 50% !important;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .page-item.active .page-link {
            background-color: #2563eb !important;
            /* biru */
            color: #fff !important;
            border-color: #2563eb !important;
        }

        .page-link:hover {
            background-color: #f1f5f9;
        }

        .h4,
        h4 {
            font-size: 20px !important;
            font-weight: 600;
        }

        .image-wrapper {
            height: 200px;
            object-fit: cover;
            object-position: center;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.75rem;
            margin-bottom: 0.5rem;

        }

        .badge {
            font-size: 0.8rem;
            font-weight: 200;
        }

        @media (max-width: 992px) {

            .h4,
            h4 {
                font-size: 18px !important;
                font-weight: 600;
            }

            .card-title {
                font-size: 0.8rem;
                font-weight: 600;
            }

            .card-text {
                font-size: 0.75rem;
                margin-bottom: 0.5rem;

            }

            .badge {
                font-size: 0.8rem;
                font-weight: 200;
            }
        }

        /* 🔹 Responsif untuk layar kecil */
        @media (max-width: 768px) {

            .h4,
            h4 {
                font-size: 16px !important;
                font-weight: 600;
            }

            .image-wrapper {
                height: 120px;
                object-fit: cover;
                object-position: center;
            }

            .card-title {
                font-size: 0.8rem;
                font-weight: 600;
            }

            .card-text {
                font-size: 0.60rem;
                margin-bottom: 0.5rem;

            }

            .badge {
                font-size: 0.8rem;
                font-weight: 200;
            }
        }

        @media (max-width: 768px) {
            .card.bg-dark.text-white.border-0.rounded-4.overflow-hidden {
                min-height: 350px;
            }
            .card-img-overlay {
                padding: 1.5rem !important;
            }
            .card-h1 {
                max-width: 100%;
            }
        }

        /* Responsif mobile */
        @media (max-width: 576px) {

            .h4,
            h4 {
                font-size: 14px !important;
                font-weight: 600;
            }

            .image-wrapper {
                height: 90px;
                object-fit: cover;
                object-position: center;
            }

            .card-title {
                font-size: 0.8rem;
                font-weight: 600;
            }

            .card-text {
                font-size: 0.8rem;
                margin-bottom: 0.5rem;

            }

            .badge {
                font-size: 0.45rem;
                font-weight: 200;
            }
        }
    </style>
    <div class="p-2">
    
    {{-- 💡 Tambahkan Pengecekan di sini --}}
    @if (isset($latestArticle) && $latestArticle)
        
        <section class="container position-relative my-3 rounded-4 bg-dark text-white">
            {{-- 🔹 Background Image --}}
            <img src="{{ asset('storage/' . $latestArticle->image) }}" alt="{{ $latestArticle->title }}"
                class="position-absolute rounded-4 top-0 start-0 w-100 h-100 object-fit-cover opacity-50">

            {{-- 🔹 Overlay Gradasi --}}
            <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4"
                style="background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.6), transparent);">
            </div>

            {{-- 🔹 Konten --}}
            <div class="container position-relative py-4 rounded-4">
                <div class="col-lg-6">
                    @if (!empty($latestArticle->categories) && $latestArticle->categories->count())
                        <span class="badge bg-primary text-uppercase fw-bold mb-3">
                            {{ $latestArticle->categories->first()->name }}
                        </span>
                    @endif


                    <h1 class="fw-bold mb-3 card-h1">{{ $latestArticle->title }}</h1>

                    <p class="text-light mb-4 card-text">
                        {{ $latestArticle->excerpt }}
                    </p>

                    {{-- 🔹 Info Penulis & Tanggal --}}
                    <div class="d-flex align-items-center text-white-50 mb-4 card-text">
                        <div class="d-flex align-items-center me-3 ">
                            <i class="bi bi-person-fill me-2"></i>
                            <span>{{ $latestArticle->author ?? 'Admin' }}</span>
                        </div>
                        <span class="me-3 d-none d-md-inline">|</span>
                        <div class="d-flex align-items-center  ">
                            <i class="bi bi-calendar-event me-2"></i>
                            <span>{{ \Carbon\Carbon::parse($latestArticle->published_at)->format('d M Y') }}</span>
                        </div>
                    </div>

                    {{-- 🔹 Tombol Aksi --}}
                    <a href="{{ route('detail.berita', $latestArticle->slug) }}"
                        class="btn btn-primary btn-lg fw-bold px-4 py-2 card-text">
                        Baca Sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </section>

    {{-- 💡 Tambahkan @else untuk menampilkan pesan jika tidak ada berita --}}
    @else
        <div class="container text-center py-5">
            <h2 class="text-muted">Saat ini belum ada artikel berita yang diterbitkan.</h2>
        </div>
    @endif
</div>
    {{-- 🔹 Konten Berita --}}
    <div class="container   my-5">
        <div class="mb-3">
            <div class="  mb-3">
                <h4 class=" "> Artikel Lainnya</h4>
                <hr>
            </div>
            {{-- 🔸 Daftar Berita --}}
            <div class="row">
                @forelse ($berita as $item)
                    <div class="col-md-4 mb-4 px-2">
                        <a href="{{ route('detail.berita', $item->slug) }}"
                            class="d-block bg-white rounded-4 shadow-sm border border-light overflow-hidden text-decoration-none text-dark position-relative transition-all"
                            style="transition: all 0.3s ease; display: flex; flex-direction: column; height: 100%;">

                            {{-- 🔹 Gambar --}}
                            @if ($item->image)
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                        class="img-fluid w-100"
                                        style="height: 220px; object-fit: cover; transition: transform 0.5s ease;">

                                </div>
                            @endif

                            {{-- 🔹 Konten --}}
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                {{-- Tag kategori --}}



                                {{-- Judul --}}
                                <h5 class="card-title text-truncate-2">{{ $item->title }}</h5>



                                {{-- Info Penulis & Tanggal --}}
                                <div class="d-flex align-items-center border-top pt-2 mt-auto text-muted card-text">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person me-1"></i>
                                        <span>{{ $item->author ?? 'Admin' }}</span>
                                    </div>
                                    <span class="mx-2">|</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">Tidak ada berita yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>





            <div class="d-flex justify-content-center mt-4 mb-5">
                {{ $berita->links('pagination::bootstrap-4') }}
            </div>








        </div> {{-- end .bg-white --}}
    </div> {{-- end .container --}}
@endsection
