<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sekolah Dasar Islam Terpadu AL Asror</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Splide Carousel CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        :root {
            --primary-color: #becf21;
            --primary-dark: #adb321;
            --primary-light: #e2e962;
            --nav-bg: #a4c932;
            --nav-link-color: white;
            --btn-yellow-bg: #e1e844;
            --btn-yellow-bg-hover: #c6d118;
            --card-border-yellow: #dadd59;
            --card-border-blue: #5866ef;
            --card-border-green: #97ab36;
            --card-border-purple: #7363a2;
            --btn-chat-bg: #4cbb17;
            --btn-chat-bg-hover: #3aa311;
        }

        .navbar-brand .logo-icon {
            width: 32px;
            height: 32px;
            margin-right: 0.5rem;
            border-radius: 50%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-brand .logo-icon>i {
            color: #FFA726;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .hero {
            position: relative;
            background: url('https://placehold.co/1200x800/222222/FFFFFF?text=Hero+Image') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 6rem 1rem 5rem;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.43);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 940px;
            margin-left: auto;
            margin-right: auto;
        }

        .text-shadow-light {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
        }

        .btn-hero {
            background-color: var(--btn-yellow-bg);
            border: none;
            color: #333;
            font-weight: 600;
            padding: 0.625rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 1px 3px 6px #aaa;
            transition: background-color 0.3s ease;
            text-transform: none;
        }

        .btn-hero:hover {
            background-color: var(--btn-yellow-bg-hover);
            color: black;
        }

        .btn-chat-admin {
            position: fixed;
            bottom: 1.25rem;
            right: 1.5rem;
            background-color: var(--btn-chat-bg);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.5rem 0.8rem;
            border-radius: 1.5rem;
            font-size: 0.9rem;
            box-shadow: 0 3px 6px #3c9b0eaa;
            cursor: pointer;
            z-index: 1050;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            user-select: none;
        }

        .btn-chat-admin:hover {
            background-color: var(--btn-chat-bg-hover);
        }

        .card-tentang {
            position: relative;
            border-radius: 1rem;
            border: 1.8px solid var(--card-border-blue);
            padding: 1.2rem 1.6rem;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(31, 43, 75, 0.1);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 140px;
            overflow-wrap: break-word;
            transition: transform 0.3s ease;
        }

        .card-tentang:hover {
            transform: translateY(-8px);
        }

        .card-tentang.visi {
            border-color: var(--card-border-purple);
        }

        .card-tentang.misi {
            border-color: var(--card-border-yellow);
        }

        .card-tentang.sejarah {
            border-color: var(--card-border-green);
        }

        .card-tentang .title {
            font-weight: 700;
            margin-bottom: 0.6rem;
            font-size: 1.25rem;
            color: #373a7b;
        }

        .card-news {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.5rem;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card-news:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 12px rgba(31, 43, 75, 0.15);
        }

        .card-pembangunan {
            border: 1px solid var(--btn-yellow-bg);
            border-radius: 12px;
            box-shadow: 0 1px 8px rgba(31, 43, 75, 0.1);
            transition: transform 0.3s ease;
            padding-bottom: 1rem;
            overflow: hidden;
            background-color: #fff;
            cursor: default;
        }

        .card-pembangunan:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 12px rgba(31, 43, 75, 0.15);
        }

        .card-pembangunan .card-img-top {
            object-fit: cover;
            max-height: 180px;
            border-radius: 12px 12px 0 0;
            width: 100%;
        }

        .card-pembangunan .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #5866ef;
            margin-bottom: 0.25rem;
            cursor: pointer;
        }

        .card-pembangunan .card-text {
            font-size: 0.85rem;
            color: #444;
            font-weight: 500;
        }

        .gallery-row img {
            width: 180px;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .gallery-row img:hover {
            transform: scale(1.07);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.25);
        }

        .partner-logos img {
            max-width: 140px;
            height: auto;
            object-fit: contain;
            cursor: default;
        }

        .map-responsive {
            width: 100%;
            max-width: 800px;
            aspect-ratio: 16 / 9;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .map-responsive iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .lokasi-section {
            background: linear-gradient(45deg, var(--primary-light) 0%, #e1e86f 60%, #dbdd68 80%, var(--primary-color) 100%);
        }

        .kontak-section {
            background: url('https://placehold.co/1000x800/222222/FFFFFF?text=Contact+Background') no-repeat center center/cover;
        }

        .contact-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
        }

        /* Custom Splide style for mobile */
        @media (max-width: 576px) {
            .splide__arrow {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background-color: #FFA726;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" style="color: var(--nav-link-color);"
                href="#">
                <div class="logo-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <span>Sekolah Dasar Islam Terpadu AL Asror</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: var(--nav-link-color);"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item"><a href="#beranda" class="nav-link text-white fw-semibold">Beranda</a></li>
                    <li class="nav-item"><a href="#tentang" class="nav-link text-white fw-semibold">Tentang</a></li>
                    <li class="nav-item"><a href="#pembangunan" class="nav-link text-white fw-semibold">Pembangunan</a>
                    </li>
                    <li class="nav-item"><a href="#galeri" class="nav-link text-white fw-semibold">Galeri</a></li>
                    <li class="nav-item"><a href="#lokasi" class="nav-link text-white fw-semibold">Lokasi</a></li>
                    <li class="nav-item"><a href="#kontak" class="nav-link text-white fw-semibold">Kontak</a></li>
                    <li class="nav-item">
                        <a href="http://127.0.0.1:8000/admin/login"
                            class="btn btn-hero ms-lg-3 px-4 py-1 rounded-3">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-content">
            <h1 class="fw-bold text-4xl md:text-5xl lh-sm mb-2 text-shadow-light">
                Sekolah Dasar Islam Terpadu AL Asror<br />Gedangsari, Kab Gunungkidul<br />D.I.Yogyakarta
            </h1>
            <p class="fs-5 fw-medium mb-4 text-shadow-light">
                Membangun generasi cerdas, berkarakter, dan berahlak mulia
            </p>
            <a href="#" class="btn btn-hero">Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- Chat Admin Button -->
    <button class="btn-chat-admin">
        <i class="bi bi-chat-dots-fill"></i> Chat Admin
    </button>

    <!-- Sambutan Kepala Sekolah -->
    <section class="container my-5 py-5">
        <h2 class="text-center fw-bold mb-5">Sambutan Kepala Sekolah</h2>
        <div
            class="d-flex flex-column flex-md-row align-items-center bg-white rounded-3 shadow-sm border border-secondary p-4 p-md-5">
            <div class="flex-shrink-0 me-md-5 mb-4 mb-md-0">
                <img src="https://placehold.co/200x200/cccccc/222222?text=Kepala+Sekolah" alt="Foto Kepala Sekolah"
                    class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="text-md-start text-center">
                <p class="fs-6 text-muted mb-3">Assalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                <p class="fs-6 text-muted">Puji syukur kehadirat Allah SWT, shalawat serta salam semoga tercurah kepada
                    junjungan kita, Nabi Muhammad SAW. Kami mengucapkan selamat datang di website resmi Sekolah Dasar
                    Islam Terpadu Al Asror. Website ini merupakan media informasi dan komunikasi bagi seluruh civitas
                    akademika dan masyarakat.</p>
                <p class="fs-6 text-muted">Semoga website ini dapat memberikan manfaat yang sebesar-besarnya bagi kita
                    semua. Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                <div class="text-end mt-4">
                    <span class="d-block fw-bold text-gray-800">Nama Kepala Sekolah</span>
                    <span class="d-block fs-6 text-muted">Kepala SDIT Al Asror</span>
                </div>
                <a href="#" class="btn btn-hero mt-3">Baca Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Tentang Sekolah -->
    <section class="container my-5 py-5" id="tentang">
        <h2 class="text-center fw-bold mb-5">Tentang Sekolah</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <article class="card-tentang visi shadow-sm">
                    <div class="title">Visi</div>
                    <p class="fs-6 text-muted">Menjadi sekolah dasar yang unggul dalam prestasi, berkarakter, dan
                        berwawasan lingkungan.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="card-tentang misi shadow-sm">
                    <div class="title">Misi</div>
                    <p class="fs-6 text-muted">Menyelenggarakan pendidikan yang berkualitas dan mengembangkan potensi
                        siswa secara optimal.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="card-tentang sejarah shadow-sm">
                    <div class="title">Sejarah</div>
                    <p class="fs-6 text-muted">Didirikan pada tahun 2024, telah melahirkan banyak alumni yang sukses di
                        berbagai bidang.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru (Latest News) -->
    <section class="container my-5 py-5" id="berita">
        <h2 class="text-center fw-bold mb-4">Berita Terbaru</h2>
        <div class="splide" role="group" aria-label="Berita Terbaru Carousel">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide p-2">
                        <div class="card card-news shadow-sm">
                            <img src="https://placehold.co/400x300/4c4c4c/FFFFFF?text=Berita+1" alt="Berita 1"
                                class="card-img-top" style="height: 12rem; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold text-dark">Judul Berita Pertama</h5>
                                <p class="card-text text-muted">Deskripsi singkat tentang berita ini. Berisi informasi
                                    penting yang menarik perhatian pembaca.</p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide p-2">
                        <div class="card card-news shadow-sm">
                            <img src="https://placehold.co/400x300/4c4c4c/FFFFFF?text=Berita+2" alt="Berita 2"
                                class="card-img-top" style="height: 12rem; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold text-dark">Judul Berita Kedua</h5>
                                <p class="card-text text-muted">Teks yang lebih panjang untuk berita ini, menjelaskan
                                    detail lebih lanjut tentang acara atau kegiatan sekolah.</p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide p-2">
                        <div class="card card-news shadow-sm">
                            <img src="https://placehold.co/400x300/4c4c4c/FFFFFF?text=Berita+3" alt="Berita 3"
                                class="card-img-top" style="height: 12rem; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold text-dark">Judul Berita Ketiga</h5>
                                <p class="card-text text-muted">Ini adalah berita tentang pencapaian siswa di
                                    kompetisi. Informasi yang inspiratif dan membanggakan.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Pembangunan Dinamis -->
    <section class="container my-5 py-5" id="pembangunan">
        <h2 class="text-center fw-bold mb-4">Pembangunan</h2>
        <div class="splide" role="group" aria-label="Pembangunan Carousel">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- Pembangunan Item 1 -->
                    <li class="splide__slide p-2">
                        <div class="card card-pembangunan shadow-sm">
                            <img src="https://placehold.co/400x250/dadd59/444444?text=Pembangunan+1"
                                alt="Pembangunan gedung baru" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Pembangunan Gedung Baru</h5>
                                <p class="card-text">Deskripsi singkat pembangunan gedung baru. Proyek ini bertujuan
                                    untuk meningkatkan fasilitas belajar mengajar.</p>
                            </div>
                        </div>
                    </li>
                    <!-- Pembangunan Item 2 -->
                    <li class="splide__slide p-2">
                        <div class="card card-pembangunan shadow-sm">
                            <img src="https://placehold.co/400x250/dadd59/444444?text=Pembangunan+2"
                                alt="Pembangunan lapangan" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Renovasi Lapangan Olahraga</h5>
                                <p class="card-text">Lapangan olahraga yang baru direnovasi untuk menunjang kegiatan
                                    ekstrakurikuler siswa.</p>
                            </div>
                        </div>
                    </li>
                    <!-- Pembangunan Item 3 -->
                    <li class="splide__slide p-2">
                        <div class="card card-pembangunan shadow-sm">
                            <img src="https://placehold.co/400x250/dadd59/444444?text=Pembangunan+3"
                                alt="Pembangunan kantin" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Pembangunan Kantin Sehat</h5>
                                <p class="card-text">Kantin baru yang menyediakan makanan sehat dan bergizi bagi
                                    seluruh warga sekolah.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Galeri Sekolah -->
    <section class="container my-5 py-5" id="galeri">
        <h2 class="text-center fw-bold mb-4">Galeri Sekolah</h2>

        <!-- Group 1: Kegiatan Pembelajaran -->
        <div class="text-center mb-5">
            <h3 class="fw-semibold text-primary mb-1">Kegiatan Pembelajaran</h3>
            <p class="fs-6 text-muted mb-4">Momen berharga di kelas dan di luar kelas.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 gallery-row">
                <img src="https://placehold.co/200x150/97ab36/ffffff?text=Pembelajaran+1"
                    alt="Kegiatan Pembelajaran 1" class="shadow-sm">
                <img src="https://placehold.co/200x150/97ab36/ffffff?text=Pembelajaran+2"
                    alt="Kegiatan Pembelajaran 2" class="shadow-sm">
                <img src="https://placehold.co/200x150/97ab36/ffffff?text=Pembelajaran+3"
                    alt="Kegiatan Pembelajaran 3" class="shadow-sm">
            </div>
        </div>

        <!-- Group 2: Fasilitas Sekolah -->
        <div class="text-center mb-5">
            <h3 class="fw-semibold text-primary mb-1">Fasilitas Sekolah</h3>
            <p class="fs-6 text-muted mb-4">Lihat fasilitas terbaik yang kami sediakan.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 gallery-row">
                <img src="https://placehold.co/200x150/dadd59/444444?text=Fasilitas+1" alt="Fasilitas Sekolah 1"
                    class="shadow-sm">
                <img src="https://placehold.co/200x150/dadd59/444444?text=Fasilitas+2" alt="Fasilitas Sekolah 2"
                    class="shadow-sm">
                <img src="https://placehold.co/200x150/dadd59/444444?text=Fasilitas+3" alt="Fasilitas Sekolah 3"
                    class="shadow-sm">
            </div>
        </div>

        <!-- Group 3: Ekstrakurikuler -->
        <div class="text-center mb-5">
            <h3 class="fw-semibold text-primary mb-1">Ekstrakurikuler</h3>
            <p class="fs-6 text-muted mb-4">Kegiatan di luar jam pelajaran yang seru dan bermanfaat.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 gallery-row">
                <img src="https://placehold.co/200x150/7363a2/ffffff?text=Ekskul+1" alt="Ekstrakurikuler 1"
                    class="shadow-sm">
                <img src="https://placehold.co/200x150/7363a2/ffffff?text=Ekskul+2" alt="Ekstrakurikuler 2"
                    class="shadow-sm">
                <img src="https://placehold.co/200x150/7363a2/ffffff?text=Ekskul+3" alt="Ekstrakurikuler 3"
                    class="shadow-sm">
            </div>
        </div>
    </section>

    <!-- Kontak Kami -->
    <section class="kontak-section container my-5 py-5 rounded-4 shadow-lg text-white" id="kontak">
        <h2 class="text-center fw-bold mb-5 text-shadow-light">Kontak Kami</h2>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <address class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2">Alamat</strong>
                <p class="fs-6 fw-semibold text-muted">Jl. Suru Lor, Suruh, Hargomulyo, Kec. Gedangsari, Kabupaten
                    Gunungkidul, Daerah Istimewa Yogyakarta 55863.</p>
            </address>
            <div class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2">Kontak</strong>
                <p class="fs-6 fw-semibold text-muted">Telepon: 081*********</p>
                <p class="fs-6 fw-semibold text-muted">Email: sdit@gmail.com</p>
            </div>
            <div class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2">Jam Operasional</strong>
                <p class="fs-6 fw-semibold text-muted">Senin - Jumat: 06.00 - 15.00 WIB</p>
                <p class="fs-6 fw-semibold text-muted">Sabtu: 07.00 - 12.00 WIB</p>
                <p class="fs-6 fw-semibold text-muted">Minggu: Tutup</p>
            </div>
            <div class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2">Sosial Media</strong>
                <div class="mt-4 fs-6 fw-semibold text-muted">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-muted mb-1"><i
                            class="bi bi-instagram"></i> 081*********</a>
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-muted mb-1"><i
                            class="bi bi-instagram"></i> sdit.id</a>
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-muted mb-1"><i
                            class="bi bi-tiktok"></i> sdit.tiktok</a>
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-muted"><i
                            class="bi bi-youtube"></i> sdit.youtube</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi Kami -->
    <section class="lokasi-section py-5 d-flex flex-column align-items-center" id="lokasi">
        <h2 class="fw-bold text-center mb-4 text-dark">Lokasi Kami</h2>
        <div class="map-responsive shadow-lg">
            <iframe
                src="https://maps.google.com/maps?q=Sekolah%20Dasar%20Islam%20Terpadu%20AL%20Asror%20Gedangsari,%20Kab.%20Gunungkidul,%20Yogyakarta&t=&z=14&ie=UTF8&iwloc=&output=embed"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                title="Google Maps Location">
            </iframe>
        </div>
    </section>
    <!-- Program Donasi Section -->
    <section class="container my-5 py-5 bg-white rounded-4 shadow-sm" id="donasi">
        <h2 class="text-center mb-5 section-title">Program Donasi Mendesak</h2>
        <div class="row g-4 justify-content-center">
            @forelse($programDonasi as $program)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100">
                        {{-- Gambar program jika ada --}}
                        <img src="{{ $program->getFirstMediaUrl('pembangunan') }}" class="card-img-top"
                            alt="{{ $program->nama_pembangunan }}">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $program->nama_pembangunan }}</h5>
                            <p class="card-text text-muted small mb-3">{{ $program->deskripsi }}</p>

                            {{-- Progress Bar --}}
                            <div class="progress mt-auto mb-2" style="height: 20px;">
                                <div class="progress-bar bg-warning text-dark fw-bold" role="progressbar"
                                    style="width: {{ $program->persentase_terkumpul }}%;"
                                    aria-valuenow="{{ $program->persentase_terkumpul }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ $program->persentase_terkumpul }}%
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center">
                        <p class="text-muted">Belum ada program donasi yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    {{-- <!-- Tentang Sekolah Section -->
    <section class="container my-5 py-5" id="tentang">
        <h2 class="text-center mb-5 section-title">Tentang Sekolah</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Visi</h3>
                    <p class="card-text">Menjadi sekolah dasar Islam unggul yang melahirkan
                        generasi cerdas, berkarakter Qur'ani, dan berwawasan lingkungan di
                        kawasan [Nama Daerah].</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Misi</h3>
                    <p class="card-text">Menyelenggarakan pendidikan berkualitas, menanamkan
                        nilai-nilai Islam dalam setiap aspek pembelajaran, dan mengembangkan
                        potensi siswa secara optimal.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Sejarah</h3>
                    <p class="card-text">Didirikan pada tahun 2024 atas kepedulian masyarakat
                        untuk menyediakan pendidikan yang layak dan terjangkau di daerah
                        pegunungan.</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Footer -->
    <footer class="text-center p-4 bg-light text-muted">
        <p class="mb-0">&copy; 2024 Sekolah Dasar Islam Terpadu AL Asror Gedangsari. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var splideElements = document.querySelectorAll('.splide');
            if (splideElements.length > 0) {
                splideElements.forEach(function(splideElement) {
                    new Splide(splideElement, {
                        type: 'loop',
                        perPage: 3,
                        gap: '1.5rem',
                        pagination: false,
                        arrows: true,
                        breakpoints: {
                            992: {
                                perPage: 2,
                            },
                            576: {
                                perPage: 1,
                                gap: '0.5rem',
                            }
                        }
                    }).mount();
                });
            }
        });
    </script>
</body>

</html>
