<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'PT Aqwil Medica Group adalah produsen alat kesehatan di Bogor. Spesialis pengadaan Bed Pasien, Meja Periksa, Lemari Obat, dan perlengkapan rumah sakit.')">
    
    <title>@yield('title', 'Aqwil Medica - Produsen & Distributor Alat Kesehatan Bogor')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #0066cc;
            --secondary-color: #00a8e8;
            --accent-color: #00c9a7;
            --dark-color: #1a2332;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: "Montserrat", sans-serif;

            color: #333;
            overflow-x: hidden;
            padding-top: 73px;
            background: linear-gradient(to bottom, #ffffff, #eaf3ff);
        }



        /* 🌟 Navbar utama */
        .elegant-navbar {
            background: rgb(255, 255, 255);
            backdrop-filter: blur(12px);
            transition: all 0.4s ease-in-out;
        }

        .elegant-navbar.scrolled {
            background: rgb(255, 255, 255);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* 🌈 Link animasi */
        .navbar .nav-link {
            position: relative;
            color: #333;
            transition: color 0.3s ease-in-out;
        }

        .navbar .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0%;
            height: 2px;
            background-color: #0d6efd;
            transition: width 0.3s ease-in-out;
        }

        .navbar .nav-link:hover {
            color: #0d6efd;
        }

        .navbar .nav-link:hover::after {
            width: 100%;
        }

        /* Active state */
        .navbar .nav-link.active {
            color: #0d6efd;
            font-weight: 600;
            position: relative;
        }

        .navbar .nav-link.active::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background: #0d6efd;
            margin-top: 4px;
            border-radius: 2px;
        }

        /* 💫 Animasi logo */
        .animate-logo {
            transition: transform 0.3s ease;
        }



        /* 🔗 Sosial media icon */
        .social-icons a {
            color: #333;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: #0d6efd;
            transform: translateY(-3px);
        }

        /* 📱 Responsif mobile */
        @media (max-width: 991px) {
            .navbar-collapse {
                background-color: rgba(255, 255, 255, 0.95);
                padding: 1rem;
                border-radius: 12px;
                margin-top: 0.5rem;
            }

            .nav-link {
                text-align: center;
                padding: 0.7rem 0;
            }

            .social-icons {
                justify-content: center;
                margin-top: 0.5rem;
            }
        }

        /* 🦶 FOOTER */
        footer .bg-white {
            transition: all 0.3s ease;
        }

        footer .bg-white:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }



        /* 📱 RESPONSIVE */
        @media (max-width: 768px) {


            .section-title {
                font-size: 32px;
            }

            .navbar-brand img {
                height: 30px !important;
            }


        }

        .navbar-nav .nav-link {
            font-size: 0.9rem;
            /* ubah sesuai kebutuhan, misal 0.8rem untuk lebih kecil */
        }

        /* opsional: kecilkan juga ikon sosial biar proporsional */
        .social-icons a i {
            font-size: 1rem;
            /* default 1.25rem di Bootstrap Icons */
        }

        /* Default ukuran normal */
        footer {
            font-size: 0.95rem;
        }

        footer h6 {
            font-size: 1rem;
        }

        footer .text-muted,
        footer ul li,
        footer a {
            font-size: 12px;
        }

        /* 🔹 Ukuran kecil (mobile) */
        @media (max-width: 992px) {
            footer {
                font-size: 0.8rem;
            }

            footer h6 {
                font-size: 0.85rem;
                margin-bottom: 0.5rem;
            }

            footer .text-muted,
            footer ul li,
            footer a {
                font-size: 0.75rem;
            }

            footer .bi {
                font-size: 1rem !important;
            }

            footer .row {
                gap: 1rem 0;
                /* jarak antar kolom lebih rapat */
            }

            footer .pt-5 {
                padding-top: 2rem !important;
            }

            footer .pb-3 {
                padding-bottom: 1rem !important;
            }
        }


        /* 🔹 Ukuran kecil (mobile) */
        @media (max-width: 576px) {
            footer {
                font-size: 0.8rem;
            }

            footer h6 {
                font-size: 0.85rem;
                margin-bottom: 0.5rem;
            }

            footer .text-muted,
            footer ul li,
            footer a {
                font-size: 0.75rem;
            }

            footer .bi {
                font-size: 1rem !important;
            }

            footer .row {
                gap: 1rem 0;
                /* jarak antar kolom lebih rapat */
            }

            footer .pt-5 {
                padding-top: 2rem !important;
            }

            footer .pb-3 {
                padding-bottom: 1rem !important;
            }
        }
    </style>
</head>

<body>
    <!-- 🌐 NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm elegant-navbar">
        <div class="container py-2">
            <!-- Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="me-2 animate-logo"
                    style="height: 32px;">
                <img src="{{ asset('storage/logo2.png') }}" alt="Logo" class="animate-logo" style="height: 32px;">
            </a>

            <!-- Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1"></i>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold {{ request()->routeIs('produk') ? 'active' : '' }}"
                            href="{{ route('produk') }}">
                            Produk
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold {{ request()->routeIs('berita') ? 'active' : '' }}"
                            href="{{ route('berita') }}">
                            Berita
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold {{ request()->routeIs('tentang') ? 'active' : '' }}"
                            href="{{ route('tentang') }}">
                            Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold {{ request()->routeIs('kontak') ? 'active' : '' }}"
                            href="{{ route('kontak') }}">
                            Kontak Kami
                        </a>
                    </li>
                </ul>

                <!-- Sosial Media -->
                <div class="d-flex align-items-center social-icons">
                    @if (!empty($webpage->link_linkedin))
                        <a href="{{ $webpage->link_linkedin }}" class="ms-3"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if (!empty($webpage->link_facebook))
                        <a href="{{ $webpage->link_facebook }}" class="ms-3"><i class="bi bi-facebook"></i></a>
                    @endif

                </div>
            </div>
        </div>
    </nav>



    <!-- 🧱 KONTEN -->
    <main class="">
        @yield('content')
    </main>

    <!-- 🦶 FOOTER -->
    <footer class="bg-light pt-5 border-top">
        <div class="container  text-md-start">
            <div class="border-top pt-4 pb-3">
                <div class="row  ">
                    
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3">Aqwil Medica</h6>
                        <p class="text-muted small">{{ $webpage->footer_text ?? 'Footer text Default' }}</p>
                        <h6 class="fw-bold mt-4 mb-1 small">Alamat</h6>
                    <address class="text-muted small mb-0">
                        Perum Indogreen Blok D5 No 11, Gn. Sari, Kec. Citeureup, Kab. Bogor, Jawa Barat.
                    </address>
                    <h6 class="fw-bold mt-3 mb-1 small">Kontak Kami</h6>
                    <p class="text-muted small mb-1">
                        WhatsApp: 0813 9814 2989
                    </p>
                    <p class="text-muted small mb-3">
                        Email: aqwilmedica@gmail.com
                    </p>
                        <div class="mt-2">
                        @if (!empty($webpage->link_linkedin))
                            <a href="{{ $webpage->link_linkedin }}" class="text-dark text-decoration-none me-2">
                                <i class="bi bi-instagram fs-5"></i>
                            </a>
                        @endif

                        @if (!empty($webpage->link_facebook))
                            <a href="{{ $webpage->link_facebook }}" class="text-dark text-decoration-none">
                                <i class="bi bi-facebook fs-5"></i>
                            </a>
                        @endif
                    </div>

                    </div>

                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3">Perusahaan</h6>
                        <ul class="list-unstyled  ">
                            <li><a href="{{ url('/') }}" class="text-muted text-decoration-none">Beranda</a></li>
                            <li><a href="{{ url('/produk') }}" class="text-muted text-decoration-none">Produk</a></li>
                            <li><a href="{{ url('/berita') }}" class="text-muted text-decoration-none">Berita</a></li>
                            <li><a href="{{ url('/tentang-kami') }}" class="text-muted text-decoration-none">Tentang
                                    Kami</a></li>
                            <li><a href="{{ url('/kontak-kami') }}" class="text-muted text-decoration-none">Kontak
                                    Kami</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3">Dukungan</h6>
                        <ul class="list-unstyled  ">
                            <!-- <li><a href="{{ route('privasi') }}" class="text-muted text-decoration-none">Kebijakan
                                    Privasi</a></li> -->
                            <li><a href="#" class="text-muted text-decoration-none">Pusat Bantuan</a></li>
                            <li><a href="#" class="text-muted text-decoration-none">Garansi</a></li>
                            <li><a href="#" class="text-muted text-decoration-none">Pengembalian & Refund</a></li>
                        </ul>
                    </div>
                </div>

                <div class="text-center border-top mt-4 pt-3   text-muted">
                    &copy; {{ date('Y') }} Aqwil Medica. Seluruh hak cipta dilindungi.
                </div>
            </div>
        </div>
    </footer>




    <script>
        // 🌫️ Navbar berubah saat scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("scroll", function() {
            const navbar = document.querySelector(".elegant-navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>

    <script>
        document.addEventListener('contextmenu', function(e) {
            if (e.target.tagName === 'IMG') {
                e.preventDefault();
            }
        });
    </script>


</body>

</html>
