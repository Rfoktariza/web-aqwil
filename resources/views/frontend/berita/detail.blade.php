@extends('layouts.frontend')

@section('title', $news->title . ' - Aqwil Medica')
@section('meta_description', 'Dapatkan informasi terbaru seputar inovasi alat kesehatan, tips perawatan furniture medis, dan update pengadaan alkes dari PT Aqwil Medica Group.')


@section('content')

    {{-- 🔹 Style Responsif --}}
    <style>
    /* 0. Penyesuaian Global & Jarak Navbar */
    body {
        background: #ffffff !important; /* Memaksa background menjadi putih bersih */
        /* Ditambah menjadi 100px agar tidak mepet Navbar Fixed */
        padding-top: 100px !important; 
    }

    /* Menambah ruang agar teks "Kembali ke Semua Berita" lebih turun */
    .container.py-3 {
        padding-top: 1.5rem !important;
    }

    /* 1. Container Utama & General Text */
    .news-article {
        overflow-wrap: break-word;
        line-height: 1.7;
        color: #333;
    }

    /* 2. Category & Back Link (Warna Biru Royal) */
    .category-text, 
    .category-text a,
    .news-article .category-text {
        font-size: 0.85rem !important;
        font-weight: 700;
        margin-bottom: 12px !important;
        color: #0d6efd !important;
        text-decoration: none !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* 3. Title Utama */
    .news-article h2 {
        font-size: 1.85rem; 
        font-weight: 700;
        line-height: 1.3;
        color: #1a2332;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    /* 4. Meta Info (Author & Tanggal) */
    .news-article p.text-muted {
        font-size: 0.85rem !important;
        margin-bottom: 25px;
    }

    /* 5. Konten Utama (Paragraphs) */
    .news-article .content, 
    .news-article .content p {
        font-size: 1rem !important; 
        line-height: 1.8; /* Lebih renggang agar lebih nyaman dibaca */
        color: #444;
    }

    /* 6. Gambar Fitur Utama (Header Berita) */
    .news-article img.rounded {
        max-height: 480px; 
        object-fit: cover;
        border-radius: 12px !important;
        margin-bottom: 10px;
        width: 100%;
    }

    /* 7. Gambar di Dalam Konten (Gambar Produk Berulang) */
    .content img {
        max-width: 500px; 
        width: 100%;      
        height: auto;
        display: block;   
        margin: 40px auto; /* Jarak atas-bawah ditambah agar lebih lega */
        border-radius: 8px;
        /* box-shadow: 0 4px 12px rgba(0,0,0,0.08);  */
    }

    /* 8. Sub-Judul & Link di Dalam Konten (Warna Biru Royal Brand) */
    .content h3, .content h4, 
    .content strong, 
    .content p strong,
    .content a {
        color: #0d6efd !important; 
        text-decoration: none !important;
        font-weight: 700;
    }

    .content h3, .content h4 {
        margin-top: 20px; /* Jarak dari paragraf sebelumnya diperlebar */
        display: block;
        font-size: 1.25rem; 
    }

    /* 9. Artikel Lainnya (Related News) */
    .related-news {
        margin-top: 60px;
        padding-top: 30px;
        border-top: 1px solid #eee;
    }

    .related-news h4 {
        font-size: 1.25rem;
        margin-bottom: 25px;
        font-weight: 700;
        color: #1a2332;
    }
    
    .related-news h6 {
        font-size: 0.9rem;
        line-height: 1.4;
        font-weight: 600;
    }

    /* --- Responsivitas (Layar HP) --- */
    @media (max-width: 768px) {
        body {
            padding-top: 85px !important;
        }
        .news-article h2 {
            font-size: 1.55rem;
        }
        .news-article .content, .news-article .content p {
            font-size: 0.95rem !important;
        }
    }
</style>

    <div class="container py-3">
        <div class="row   justify-content-center">

            {{-- 🔹 Konten Utama --}}
            <div class="col-lg-8">
                <article class="news-article">

                    <div class="mb-2 fw-semibold category-text ">

                        <a href="{{ route('berita') }}" class="text-decoration-none "> <i class="bi bi-arrow-left"></i>
                            Kembali ke Semua Berita
                        </a>
                    </div>
                    @if ($news->categories->count())

                        <div class="mb-2">
                            @foreach ($news->categories as $cat)
                                <span class="text-primary category-text"
                                    style="    text-transform: uppercase;    letter-spacing: 0.05em;">
                                    {{ $cat->name }}@if (!$loop->last)
                                        {{ ',' }}
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    @endif
                    <h2 class="fw-bold mb-3">{{ $news->title }}</h2>

                    <p class="text-muted mb-4">
                        <i class="bi bi-person-fill me-2"></i>
                        <span class="me-2">{{ $news->author ?? 'Admin' }}</span>
                        <i class="bi bi-calendar-event me-2"></i> {{ $news->created_at->format('d M Y') }}

                    </p>

                    @if ($news->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $news->image) }}" class="  rounded shadow-sm w-100"
                                alt="{{ $news->title }}" style="object-fit: cover; max-height: 400px;">
                        </div>
                    @endif

                    <div class="content mb-3">
                        {!! $news->content !!}
                    </div>
                </article>

                {{-- 🔹 Berita Lainnya --}}
                @if ($related->count())
                    <hr>
                    <div class="related-news mt-5 text-center">
                        <h4 class="fw-bold mb-4">Artikel Lainnya</h4>

                        <div class="row justify-content-center g-4">
                            @foreach ($related as $item)
                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="{{ route('detail.berita', $item->slug) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex align-items-start gap-3">
                                            {{-- Thumbnail --}}
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                                    class="rounded shadow-sm"
                                                    style="width: 90px; height: 90px; object-fit: cover;">
                                            </div>

                                            {{-- Konten --}}
                                            <div class="text-start">
                                                @if ($item->categories->count())
                                                    <p class="text-primary text-uppercase small fw-bold mb-1">
                                                        {{ $item->categories->first()->name }}
                                                    </p>
                                                @endif

                                                <h6 class="fw-semibold mb-1 text-dark">
                                                    {{ Str::limit($item->title, 60) }}
                                                </h6>

                                                <small class="text-muted d-block">
                                                    <i class="bi bi-person-fill me-1"></i>
                                                    {{ $item->author ?? 'Admin' }}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


            </div>

        </div>
    </div>


@endsection
