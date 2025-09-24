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
        /* Mengambil gaya terbaik dari welcomes1.blade.php */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background-color: #f8f9fa; /* Latar belakang sedikit abu-abu agar tidak terlalu silau */
        }

        :root {
            --primary-color: #becf21;
            --nav-bg: #a4c932;
            --nav-link-color: white;
            --btn-yellow-bg: #e1e844;
            --btn-yellow-bg-hover: #c6d118;
            --btn-chat-bg: #4cbb17;
            --btn-chat-bg-hover: #3aa311;
        }

        /* --- Navbar --- */
        .navbar-brand .logo-icon {
            width: 40px;
            height: 40px;
            margin-right: 0.75rem;
            border-radius: 50%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-brand .logo-icon>i {
            color: #FFA726;
            font-size: 1.5rem;
        }

        /* --- Hero Section --- */
        .hero {
            position: relative;
            background: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 8rem 1rem;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            line-height: 1.2;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        .hero-content p {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            font-weight: 400;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        /* --- Section Styling --- */
        .section-title {
            font-weight: 700;
            font-size: 2.25rem;
            color: #2c3e50;
        }

        /* --- Card Styling (Pembangunan & Berita) --- */
        .card-custom {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }

        .card-custom .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        .card-custom .card-title {
            font-weight: 600;
            color: #34495e;
        }

        .card-custom .card-text {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        /* --- Galeri --- */
        .gallery-item img {
            border-radius: 12px;
            object-fit: cover;
            width: 100%;
            height: 200px;
            transition: transform 0.3s ease;
        }
        .gallery-item img:hover {
            transform: scale(1.05);
        }
        .kontak-section {
            background-color: #e48e1d;

        }
        .contact-card {
            background-color: #ffffff;
    }


    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background-color: #FFA726;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="#">
                <div class="logo-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <span>SDIT AL Asror</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item"><a href="#beranda" class="nav-link text-white fw-semibold">Beranda</a></li>
                    <li class="nav-item"><a href="#tentang" class="nav-link text-white fw-semibold">Tentang</a></li>
                    <li class="nav-item"><a href="#pembangunan" class="nav-link text-white fw-semibold">Pembangunan</a></li>
                    <li class="nav-item"><a href="#galeri" class="nav-link text-white fw-semibold">Galeri</a></li>
                    <li class="nav-item"><a href="#kontak" class="nav-link text-white fw-semibold">Kontak</a></li>
                    <li class="nav-item">
                        <a href="{{ route('filament.admin.auth.login') }}" class="btn ms-lg-3 px-4 py-2 rounded-pill" style="background-color: var(--btn-yellow-bg);">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-content">
            <h1 class="mb-3">Sekolah Dasar Islam Terpadu AL Asror</h1>
            <p class="mb-4">Membangun generasi cerdas, berkarakter, dan berakhlak mulia.</p>
            <a href="#tentang" class="btn btn-lg rounded-pill px-4" style="background-color: var(--btn-yellow-bg);">Pelajari Lebih Lanjut</a>
        </div>
    </section>

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
                <a href="#kontak" class="btn btn-hero mt-3">Baca Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Tentang Sekolah -->
    <section class="container my-5 py-5" id="tentang">
        <h2 class="text-center mb-5 section-title">Tentang Sekolah</h2>
        <div class="row g-4 justify-content-center">
            {{-- Bagian ini masih statis, bisa Anda buat dinamis jika perlu --}}
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Visi</h3>
                    <p class="card-text">Menjadi sekolah dasar yang unggul dalam prestasi, berkarakter, dan berwawasan lingkungan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Misi</h3>
                    <p class="card-text">Menyelenggarakan pendidikan yang berkualitas dan mengembangkan potensi siswa secara optimal.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Sejarah</h3>
                    <p class="card-text">Didirikan pada tahun 2024, telah melahirkan banyak alumni yang sukses di berbagai bidang.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================== -->
    <!-- === BAGIAN BERITA DINAMIS DARI CMS                  === -->
    <!-- ========================================================== -->
    @foreach($daftarKategori as $kategori)
    
    <section class="container my-5 py-5" id="{{ $kategori->slug }}">
        {{-- Judul section diambil dari nama kategori --}}
        <h2 class="text-center mb-4 section-title">{{ $kategori->title }}</h2>

        <div class="splide" role="group" aria-label="Carousel {{ $kategori->title }}">
            <div class="splide__track">
                <ul class="splide__list">
                    {{-- Lakukan perulangan untuk setiap POST di dalam kategori ini --}}
                    @foreach($kategori->posts as $post)

                        {{-- Tampilkan post ini sebagai kartu dengan gambar utama dan deskripsi --}}
                        <li class="splide__slide p-2">
                            <div class="card card-custom">
                                {{-- Gunakan gambar dari koleksi 'featured_image' --}}
                                <img src="{{ $post->getFirstMediaUrl('fitur_image') }}" alt="{{ $post->title }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    {{-- Tampilkan konten/deskripsi dari post --}}
                                    <div class="card-text">{!! Str::limit(strip_tags($post->content), 100) !!}</div>
                                </div>
                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    @endforeach

    <section class="container my-5 py-5 bg-white rounded-4 shadow-sm" id="donasi">
    <h2 class="text-center mb-5 section-title">Program Donasi Mendesak</h2>
    <div class="row g-4 justify-content-center">
        @forelse($programDonasi as $program)
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom h-100">
                    {{-- Anda bisa menambahkan gambar untuk program jika ada --}}
                    <img src="{{ $program->getFirstMediaUrl('pembangunan') }}" class="card-img-top" alt="{{ $program->nama_pembangunan }}">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $program->nama_pembangunan }}</h5>
                        <p class="card-text text-muted small mb-3">{{ $program->deskripsi }}</p>
                        
                        {{-- Progress Bar --}}
                        <div class="progress mt-auto mb-2" style="height: 20px;">
                            <div class="progress-bar bg-warning text-dark fw-bold" role="progressbar" 
                                 style="width: {{ $program->persentase_terkumpul }}%;" 
                                 aria-valuenow="{{ $program->persentase_terkumpul }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ $program->persentase_terkumpul }}%
                            </div>
                        </div>

                        {{-- Info Dana --}}
                        <div class="d-flex justify-content-between small">
                            <span class="fw-bold">Terkumpul: <br> Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</span>
                            <span class="text-end">Target: <br> Rp {{ number_format($program->estimasi_biaya, 0, ',', '.') }}</span>
                        </div>

                        {{-- Tombol Aksi --}}
                        @auth
                            {{-- JIKA PENGGUNA SUDAH LOGIN --}}
                            {{-- Tombol ini akan mengarah ke halaman create DENGAN membawa ID program --}}
                            <a href="{{ route('filament.admin.resources.transaksi-donasi-programs.create', ['program_id' => $program->id]) }}" 
                            class="btn btn-warning w-100 mt-4 fw-bold">
                            Donasi Sekarang
                            </a>
                        @else
                            {{-- JIKA PENGGUNA BELUM LOGIN (GUEST) --}}
                            {{-- Tombol ini akan mengarah ke halaman login standar Filament --}}
                            <a href="{{ route('filament.admin.auth.login') }}" 
                            class="btn btn-warning w-100 mt-4 fw-bold">
                            Login untuk Berdonasi
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Saat ini tidak ada program donasi yang sedang dibuka.</p>
            </div>
        @endforelse
    </div>
</section>


    <!-- Kontak Kami -->
    <section class="kontak-section container my-5 py-5 rounded-4 shadow-lg text-white" id="kontak">
        <h2 class="text-center fw-bold mb-5 text-shadow-light">Kontak Kami</h2>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <address class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2 text-black">Alamat</strong>
                <p class="fs-6 fw-semibold text-muted">Jl. Suru Lor, Suruh, Hargomulyo, Kec. Gedangsari, Kabupaten
                    Gunungkidul, Daerah Istimewa Yogyakarta 55863.</p>
            </address>
            <div class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2 text-black">Kontak</strong>
                <p class="fs-6 fw-semibold text-muted">Telepon: 081*********</p>
                <p class="fs-6 fw-semibold text-muted">Email: sdit@gmail.com</p>
            </div>
            <div class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2 text-black">Jam Operasional</strong>
                <p class="fs-6 fw-semibold text-muted">Senin - Jumat: 06.00 - 15.00 WIB</p>
                <p class="fs-6 fw-semibold text-muted">Sabtu: 07.00 - 12.00 WIB</p>
                <p class="fs-6 fw-semibold text-muted">Minggu: Tutup</p>
            </div>
            <div class="contact-card p-4 rounded-3 shadow-sm w-100" style="max-width: 280px;">
                <strong class="d-block fs-5 fw-bold mb-2 text-black">Sosial Media</strong>
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

    <!-- Bekerja sama dengan -->
    <section class="container my-5 py-5 text-center">
        <h2 class="fw-bold mb-4">Bekerja sama dengan :</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-5 partner-logos">
            <img src="logo_polinema.png" alt="Logo of Polinema" class="img-fluid" style="max-width: 140px;">
            <img src="Jti_polinema.png" alt="Logo of JTI" class="img-fluid" style="max-width: 140px;">
        </div>
    </section>


    <!-- Footer -->
    <footer class="text-center p-4 bg-dark text-white">
        <p class="mb-0">&copy; {{ date('Y') }} Sekolah Dasar Islam Terpadu AL Asror. All rights reserved.</p>
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
                                gap: '1rem',
                            }
                        }
                    }).mount();
                });
            }
        });
    </script>
</body>

</html>
