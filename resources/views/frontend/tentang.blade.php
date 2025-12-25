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
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* 🔹 Responsif */
        @media (max-width: 576px) {
            .card {
                padding: 1.5rem;
            }

            .card .text-muted {
                font-size: 0.85rem;
                line-height: 1.4;
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

    <style>
        .nilai-section {
            background: linear-gradient(90deg, #007bff, #00b3b3);
        }

        .nilai-item {
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .nilai-icon {
            background: rgba(255, 255, 255, 0.15);
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .nilai-item:hover {
            transform: translateY(-5px);
        }

        /* Responsif */
        @media (max-width: 576px) {


            .nilai-icon {
                width: 50px;
                height: 50px;
            }

            .nilai-item p {
                font-size: 0.9rem;
            }
        }
    </style>
    <section class="clients-section py-5  ">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-4 text-lg-start text-center">
                    <h3 class="fw-bold mb-0 title-hero">Pelanggan Kami</h3>
                </div>
                <div class="col-lg-8"></div>
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
        .counter {
            transition: all 0.3s ease;
        }

        .clients-section {
            background: #f7f7f8
        }

        .letter-spacing {
            letter-spacing: 4px;
        }

        .client-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 35px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            height: 180px;
        }

        .client-card:hover {
            background-color: #d8e7ff;
            transform: translateY(-6px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .nilai-icon i {
            transition: transform 0.3s ease;
        }

        .client-card:hover .nilai-icon i {
            transform: scale(1.1);
        }

        /* Responsif */
        @media (max-width: 768px) {
            .client-card {
                height: 140px;
                padding: 25px 20px;
            }


        }

        @media (max-width: 576px) {
            .client-card {
                height: 120px;
                padding: 20px 15px;
            }


        }
    </style>





@endsection
