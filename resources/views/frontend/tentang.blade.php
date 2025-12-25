@extends('layouts.frontend')

@section('title', 'Tentang Kami PT Aqwil Medica Group - Produsen Alkes Bogor')

@section('content')

    {{-- 🔹 Hero Section --}}
    <section class="position-relative overflow-hidden">
        <div class="container pt-3 position-relative">
            <div class="row align-items-center gy-4 position-relative">
                {{-- 🔹 Konten --}}
                <div class="position-relative z-2">
                    <div class=" ">
                        <div class="">
                            <h3 class="fw-bold title-hero">{{ $about->title ?? 'Tentang Aqwil Medica' }}</h3>
                            <p class="caption-hero">{!! nl2br(e($about->content_1)) !!}</p>
                            <p class="small mb-0">{!! nl2br(e($about->content_2)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 🔹 Visi & Misi --}}
    <section class="pb-5 mt-2  ">
        <div class="container  ">


            <div class="row justify-content-center g-4">
                {{-- 🔹 Visi --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 px-4 py-3 h-100 visi-card">
                        <div class="icon-wrapper">
                            <i class="bi bi-eye-fill text-primary fs-1"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $about->vision_title ?? 'Visi' }}</h5>
                        <div class="caption-hero">{!! $about->vision_content ?? 'Menjadi perusahaan terbaik di bidangnya.' !!}</div>
                    </div>
                </div>

                {{-- 🔹 Misi --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 px-4 py-3 h-100 visi-card">
                        <div class="icon-wrapper">
                            <i class="bi bi-bullseye text-success fs-1"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $about->mission_title ?? 'Misi' }}</h5>
                        <div class="caption-hero">{!! $about->mission_content ?? 'Memberikan layanan berkualitas dan inovatif.' !!}</div>
                    </div>
                </div>

                {{-- 🔹 Inovasi --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 px-4 py-3 h-100 visi-card">
                        <div class="icon-wrapper">
                            <i class="bi bi-lightbulb-fill text-warning fs-1"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $about->innovation_title ?? 'Inovasi' }}</h5>
                        <div class="caption-hero">{!! $about->innovation_content ?? 'Terus berinovasi dalam setiap aspek layanan.' !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* 1. Penyesuaian Global (Agar tidak mepet Navbar) */
    body {
        /* Jarak aman dari navbar fixed */
        padding-top: 100px !important; 
        background-color: #ffffff;
    }

    /* 2. Styling Judul Utama */
    h2.fw-bold {
        margin-top: 20px;
        margin-bottom: 25px;
        color: #1a2332;
        font-size: 2rem;
    }

    /* 3. Kartu Visi, Misi, Inovasi */
    .card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: none !important;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        height: 100%; /* Memastikan tinggi kartu sejajar */
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1) !important;
    }

    /* 4. Tipografi di Dalam Kartu */
    .card h4 {
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 15px;
    }

    .card p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #555;
    }

    /* 🔹 Responsif Mobile */
    @media (max-width: 768px) {
        body {
            padding-top: 85px !important;
        }

        h2.fw-bold {
            font-size: 1.6rem;
        }

        .card {
            padding: 1.5rem;
            margin-bottom: 15px;
        }

        .icon-wrapper i {
            font-size: 2rem !important;
        }
    }
</style>

    <section class="py-5 nilai-section text-white text-center">
        <div class="container">
            <!-- Judul -->
            <div class="mb-5">
                <h3 class="fw-bold mb-2 title-hero">Nilai-Nilai Kami</h3>
                <p class="mb-0 caption-hero">Prinsip yang memandu setiap keputusan dan tindakan kami</p>
            </div>

            <!-- Nilai -->
            <div class="row justify-content-center gy-4">
                <!-- 🔹 Kepedulian -->
                <div class="col-md-3 col-6">
                    <div class="caption-hero">
                        <div class="nilai-icon mb-3">
                            <i class="bi bi-heart fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Kepedulian</h5>
                        <p class="mb-0 caption">Mengutamakan keselamatan pengguna dalam desain dan material furniture, memastikan kenyamanan dan fungsionalitas bagi tenaga medis.</p>
                    </div>
                </div>

                <!-- 🔹 Kualitas -->
                <div class="col-md-3 col-6">
                    <div class="caption-hero">
                        <div class="nilai-icon mb-3">
                            <i class="bi bi-shield-check fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Kualitas</h5>
                        <p class="mb-0 caption">Menerapkan Standar Mutu dan memastikan produk Alkes memiliki Izin Edar.</p>
                    </div>
                </div>

                <!-- 🔹 Inovasi -->
                <div class="col-md-3 col-6">
                    <div class="caption-hero">
                        <div class="nilai-icon mb-3">
                            <i class="bi bi-lightning-charge fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Inovasi</h5>
                        <p class="mb-0 caption">Pengembangan desain ergonomis pada Bed Pasien dan peralatan, untuk efisiensi operasional</p>
                    </div>
                </div>

                <!-- 🔹 Kolaborasi -->
                <div class="col-md-3 col-6">
                    <div class="caption-hero">
                        <div class="nilai-icon mb-3">
                            <i class="bi bi-people fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Kolaborasi</h5>
                        <p class="mb-0 caption">Bekerja sama dengan tenaga medis dan pengadaan untuk layanan konsultasi, instalasi, dan garansi pasca-penjualan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="clients-section py-5  ">
        <div class="container">
            <div class="row mb-5">
    <div class="col-12 text-center">
        <h3 class="fw-bold title-hero mb-2">Pelanggan Kami</h3>
        <p class="text-muted">Telah dipercaya oleh berbagai institusi kesehatan</p>
        <div class="mx-auto" style="width: 50px; height: 3px; background: #007bff; border-radius: 2px;"></div>
    </div>
    </div>

            <div class="row g-4 justify-content-center caption-hero">

                <!-- 🔹 Klinik -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="client-card text-center shadow-sm p-4 rounded-4 h-100 bg-white">
                        <div class="nilai-icon mb-3 text-primary">
                            <i class="bi bi-hospital fs-1"></i>
                        </div>
                        <h5 class="fw-semibold mb-1">Klinik</h5>
                        <p class="mb-0 fs-5 fw-bold text-secondary counter" data-target="{{ $about->clinic_count ?? 0 }}">0
                        </p>
                    </div>
                </div>

                <!-- 🔹 Rumah Sakit -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="client-card text-center shadow-sm p-4 rounded-4 h-100 bg-white">
                        <div class="nilai-icon mb-3 text-success">
                            <i class="bi bi-building-check fs-1"></i>
                        </div>
                        <h5 class="fw-semibold mb-1">Rumah Sakit</h5>
                        <p class="mb-0 fs-5 fw-bold text-secondary counter" data-target="{{ $about->hospital_count ?? 0 }}">
                            0</p>
                    </div>
                </div>

                <!-- 🔹 Partner -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="client-card text-center shadow-sm p-4 rounded-4 h-100 bg-white">
                        <div class="nilai-icon mb-3 text-info">
                            <i class="bi bi-people fs-1"></i>
                        </div>
                        <h5 class="fw-semibold mb-1">Partner</h5>
                        <p class="mb-0 fs-5 fw-bold text-secondary counter" data-target="{{ $about->partner_count ?? 0 }}">0
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".counter");

            const speed = 150; // Semakin kecil, semakin cepat

            const animateCounter = (counter) => {
                const target = +counter.getAttribute("data-target");
                const start = 0;
                const increment = Math.ceil(target / speed);
                let current = start;

                const updateCount = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = current;
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCount();
            };

            // Aktifkan animasi saat elemen terlihat di layar
            const observer = new IntersectionObserver(
                (entries, obs) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            obs.unobserve(entry.target); // hanya animasi sekali
                        }
                    });
                }, {
                    threshold: 0.5
                }
            );

            counters.forEach((counter) => observer.observe(counter));
        });
    </script>

    <style>

    .nilai-section {
        background: linear-gradient(90deg, #007bff, #00b3b3);
        padding: 60px 0;
    }

    .nilai-item {
        transition: transform 0.5s ease, background 0.3s ease;
        padding: 20px;
    }

    .nilai-icon {
        background: rgba(255, 255, 255, 0.15);
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(4px);
    }

    .nilai-item h4 {
        font-weight: 700;
        margin-bottom: 0.8rem;
    }

    .nilai-item p {
        font-size: 0.95rem;
        line-height: 1.6;
        opacity: 0.9;
    }

    .nilai-item:hover {
        transform: translateY(-5px);
    }

    .clients-section {
        background: #f7f7f8;
        padding: 60px 0;
    }

    .client-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        height: 180px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0,0,0,0.02);
    }

    .client-card h4 {
        font-weight: 700;
        font-size: 1.1rem;
        margin: 10px 0 5px 0;
        color: #333;
    }

    .client-card .counter-value {
        font-weight: 800;
        font-size: 1.5rem;
        color: #007bff;
    }

    .client-card:hover {
        background-color: #f0f7ff;
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 123, 255, 0.15);
    }
    
    /* Tablet & Mobile Umum */
    @media (max-width: 768px) {
        .client-card {
            height: 150px;
        }
    }

    /* Mobile Kecil (Smartphone) */
    @media (max-width: 576px) {
        /* Nilai-Nilai: Paksa 1 kolom agar teks deskripsi tidak sempit */
        .nilai-section .row > div {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 1.5rem;
        }

        .nilai-icon {
            width: 55px;
            height: 55px;
        }

        /* Pelanggan Kami: Tetap 2 kolom agar tidak terlalu banyak scrolling */
        .clients-section .row {
            display: flex;
            flex-wrap: wrap;
            gap: 0; /* Menggunakan gap dari grid bootstrap */
        }
        
        /* Pastikan elemen col di HTML menggunakan class 'col-6' */
        .client-card {
            height: 140px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .client-card h4 { font-size: 0.95rem; }
        .client-card .counter-value { font-size: 1.25rem; }
    }
</style>

@endsection
