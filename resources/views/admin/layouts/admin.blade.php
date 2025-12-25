<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Admin')</title>

    <!-- Tabler + Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Google Fonts: Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f5f7fb;
        }

        /* Tambahan opsional biar tampak lebih halus */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        p,
        a,
        button,
        label,
        input,
        textarea {
            font-weight: 400;
        }

        /* Efek halus untuk hover link */
        a {
            transition: color 0.2s ease;
        }

        a:hover {
            color: #1b8ec4;
        }


        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #206bc4;
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            padding-top: 10px;
            transition: all 0.3s ease;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #1b5cab;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 1030;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: left 0.3s ease;
        }

        .navbar-brand {
            font-weight: bold;
            color: #206bc4;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
                z-index: 1050;
            }

            .navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .avatar {
                border-radius: 50%;
                object-fit: cover;
            }

        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<!-- Select2 -->

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="px-3 mb-4">
            <h3 class="text-white fw-bold">Admin Panel</h3>
        </div>

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        {{-- Produk --}}
        <a href="{{ route('admin.produk.index') }}" class="{{ request()->is('admin/produk*') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2"></i> Produk
        </a>
        {{-- Produk di Beranda --}}
        <a href="{{ route('admin.featured-products.index') }}"
            class="{{ request()->is('admin/featured-products*') ? 'active' : '' }}">
            <i class="bi bi-pin-angle me-2"></i> Produk di Beranda
        </a>

        {{-- Kategori --}}
        <a href="{{ route('admin.kategori.index') }}" class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
            <i class="bi bi-tags me-2"></i> Kategori
        </a>

        {{-- 🔹 Berita --}}
        <a href="{{ route('admin.news.index') }}" class="{{ request()->is('admin/news*') ? 'active' : '' }}">
            <i class="bi bi-newspaper me-2"></i> Berita
        </a>

        {{-- Kategori Berita --}}
        <a href="{{ route('admin.kategori-berita.index') }}"
            class="{{ request()->is('admin/kategori-berita*') ? 'active' : '' }}">
            <i class="bi bi-tags me-2"></i> Kategori Berita
        </a>

        {{-- Pengaturan Webpage --}}
        <a href="{{ route('admin.webpage.setting') }}"
            class="{{ request()->is('admin/webpage/setting*') ? 'active' : '' }}">
            <i class="bi bi-gear me-2"></i> Webpage Setting
        </a>

        {{-- 🔹 Tentang Kami --}}
        <a href="{{ route('admin.about') }}" class="{{ request()->is('admin/about*') ? 'active' : '' }}">
            <i class="bi bi-info-circle me-2"></i> Tentang Kami
        </a>

        {{-- 🔹 Testimoni --}}
        <a href="{{ route('admin.testimoni.index') }}"
            class="{{ request()->is('admin/testimoni*') ? 'active' : '' }}">
            <i class="bi bi-chat-quote me-2"></i> Testimoni
        </a>
    </div>


    <!-- Overlay for mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Topbar -->
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Sidebar Toggle -->
            <button class="btn btn-outline-primary d-lg-none me-3" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>

            <!-- Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="me-2" style="height: 40px;">
                <img src="{{ asset('storage/logo2.png') }}" alt="Logo" style="height: 40px;">
            </a>

            <!-- User Info -->
            <div class="dropdown ms-auto">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2 fw-semibold text-dark">Halo, Admin</span>
                    <img src="https://ui-avatars.com/api/?name=Admin" alt="Admin" class="rounded-circle"
                        width="40" height="40">
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.settings') }}">
                            <i class="bi bi-gear me-2"></i> Pengaturan Akun
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>


    <!-- Main Content -->
    <main class="main-content pt-5 mt-5">
        <div class="container-fluid my-4">
            <!-- Breadcrumb Otomatis -->
            @php
                $segments = request()->segments(); // ambil semua segment URL
            @endphp

            <nav aria-label="breadcrumb" class="my-3">
                <ol class="breadcrumb bg-light p-2 rounded">


                    @foreach ($segments as $index => $segment)
                        @php
                            // Bangun URL sampai segment saat ini
                            $url = url(implode('/', array_slice($segments, 0, $index + 1)));
                            // Ubah dash menjadi spasi dan capitalize
                            $name = ucwords(str_replace('-', ' ', $segment));
                        @endphp

                        @if ($index + 1 == count($segments))
                            <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $url }}">{{ $name }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </nav>


            @yield('content')
        </div>
    </main>
    {{-- jQuery wajib duluan --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    @stack('scripts')

</body>

</html>
