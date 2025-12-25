@extends('layouts.frontend')

@section('title', 'Hubungi Kami - Konsultasi Pengadaan Alkes Aqwil Medica')

@section('content')
    <style>
        .contact-card {
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            min-height: 350px;
            border: 0;
        }



        /* 🔹 Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .contact-card {
                padding: 1.25rem;
                text-align: center;
            }

            .contact-card h6 {
                font-size: 0.9rem;
                /* sedikit lebih kecil */
                margin-bottom: 0.3rem;
            }

            .contact-card p {
                font-size: 0.8rem;
                /* lebih kecil dari semula */
                line-height: 1.3;
                /* jarak antarbaris lebih rapat */
                margin-bottom: 0.6rem;
            }

            .text-gradient {
                font-size: 1.25rem;
                /* kecilkan judul di mobile */
            }

            .contact-section p.text-muted {
                font-size: 0.85rem;
                /* deskripsi di bawah judul */
                line-height: 1.4;
            }

            .map-container iframe {
                min-height: 230px;
                /* lebih ramping di HP */
            }

            .btn.btn-success {
                font-size: 0.9rem;
                padding: 0.65rem 0.8rem;
            }
        }

        .section-5 {
            background: linear-gradient(to bottom, #ffffff, #eaf3ff);
            color: #333;
        }

        /* Efek hover lembut pada setiap FAQ */
        .faq-item {
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .faq-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        /* Warna tombol saat aktif */
        .accordion-button:not(.collapsed) {
            background-color: #97b7e8;
            color: #fff;
            box-shadow: none;
        }

        /* Tombol FAQ */
        .accordion-button {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            box-shadow: none;
            font-size: 1rem;
            line-height: 1.4;
        }

        /* Body FAQ */
        .accordion-body {
            font-size: 0.95rem;
            color: #555;
            line-height: 1.6;
        }

        /* Judul dan deskripsi */
        .section-4 h4 {
            font-size: 1.5rem;
            line-height: 1.4;
        }

        .section-4 p {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* 🔹 Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .section-4 h4 {
                font-size: 1.1rem;
                line-height: 1.2;
            }

            .section-4 p {
                font-size: 0.8rem;
                line-height: 1.3;
            }

            .accordion-button {
                font-size: 0.85rem;
                line-height: 1.2;
                padding: 0.8rem 1rem;
            }

            .accordion-body {
                font-size: 0.8rem;
                line-height: 1.3;
                padding: 0.8rem 1rem;
            }
        }

        /* 🔹 Extra kecil (HP mini <480px) */
        @media (max-width: 480px) {
            .section-4 h4 {
                font-size: 1rem;
                line-height: 1.1;
            }

            .section-4 p {
                font-size: 0.75rem;
                line-height: 1.2;
            }

            .accordion-button {
                font-size: 0.8rem;
                line-height: 1.1;
                padding: 0.7rem 0.9rem;
            }

            .accordion-body {
                font-size: 0.75rem;
                line-height: 1.2;
                padding: 0.7rem 0.9rem;
            }
        }
    </style>
    {{-- ================= KONTAK KAMI ================= --}}
    <section class="py-5 position-relative contact-section section-5">
        <div class="container text-center">
            {{-- 🔹 Judul & Deskripsi --}}
            <h4 class="fw-bold mb-2 text-gradient">
                {{ $webpage->section_contact_title ?? 'Hubungi Kami' }}
            </h4>
            <div class="heading-underline mx-auto mb-4"></div>
            <p class="text-muted mb-5 fs-6" style="max-width: 600px; margin: 0 auto;">
                {{ $webpage->section_contact_content ??
                    'Kami siap membantu Anda. Silakan hubungi kami melalui informasi di bawah ini.' }}
            </p>

            {{-- 🔹 Info Kontak + Maps --}}
            <div class="row justify-content-center align-items-stretch g-4">

                {{-- 🔹 Kolom Info Kontak --}}
                <div class="col-md-4">
                    <div class="contact-card p-4 shadow-sm h-100 rounded-4 bg-white text-start">
                        <h6 class="fw-semibold mb-2">Alamat</h6>
                        <p class="text-muted small mb-4">
                            {{ $webpage->company_address ?? 'Alamat Perusahaan' }}
                        </p>

                        <h6 class="fw-semibold mb-2">Email</h6>
                        <p class="text-muted small mb-4">
                            {{ $webpage->footer_email ?? 'email@perusahaan.com' }}
                        </p>

                        <h6 class="fw-semibold mb-2">Telepon</h6>
                        <p class="text-muted small mb-0">
                            {{ $webpage->footer_phone ?? '+62 812 3456 7890' }}
                        </p>
                    </div>
                </div>

                {{-- 🔹 Kolom Maps --}}
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-3 p-md-4 d-flex flex-column">


                            {{-- 🔹 Google Maps --}}
                            <div class="map-container rounded-4 overflow-hidden flex-grow-1 shadow-sm ">
                                @if (!empty($webpage->maps_embed))
                                    {!! $webpage->maps_embed !!}
                                @else
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.230150498761!2d106.89952322062372!3d-6.49251652084064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c12ce704d3e5%3A0x23742da6744c2008!2sAqwil%20Medica%20Alkes!5e0!3m2!1sid!2sid!4v1762000804566!5m2!1sid!2sid"
                                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
    </section>



    {{-- ================= FAQ ================= --}}
    <section class=" section-4  py-5">
        <div class="container" style="max-width: 700px;">
            <div class="text-center mb-5">
                <h4 class="fw-bold text-primary">{{ $webpage->section_faq_title ?? 'Pertanyaan Umum (FAQ)' }}</h4>
                <p class="text-muted small">
                    {{ $webpage->section_faq_content ?? 'Temukan jawaban atas pertanyaan yang sering diajukan.' }}
                </p>
            </div>

            <div class="accordion shadow-sm rounded-4 overflow-hidden" id="faqAccordion">
                @forelse ($faqs as $index => $faq)
                    <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm faq-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed fw-semibold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white text-muted">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">Belum ada FAQ yang tersedia saat ini.</p>
                @endforelse
            </div>
        </div>
    </section>


@endsection
