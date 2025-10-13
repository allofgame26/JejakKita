<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sekolah Dasar Islam Terpadu AL Asror</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />
    <style>
        /* Mengambil gaya terbaik dari welcomes1.blade.php */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background-color: #f8f9fa;
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
            /* */
            background: url("{{ asset('images/kunjungansekolah.jpeg') }} ") no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 8rem 1rem;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
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
        
        /* */
        .completed-project-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .completed-project-card img {
            height: 220px;
            object-fit: cover;
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
        .splide.is-centered .splide__list {
            justify-content: center;
        }
    </style>
</head>

<body class="bg-light">

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
                    <li class="nav-item"><a href="#donasi" class="nav-link text-white fw-semibold">Donasi</a></li>
                    <li class="nav-item"><a href="#galeri" class="nav-link text-white fw-semibold">Galeri</a></li>
                    <li class="nav-item"><a href="#kontak" class="nav-link text-white fw-semibold">Kontak</a></li>
                    <li class="nav-item">
                        <a href="{{ route('filament.admin.auth.login') }}" class="btn ms-lg-3 px-4 py-2 rounded-pill" style="background-color: var(--btn-yellow-bg);">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero" id="beranda">
        <div class="hero-content">
            <h1 class="mb-3">Membangun Harapan di Puncak Gunung</h1>
            <p class="mb-4 lead">SDIT AL Asror hadir untuk memberikan pendidikan berkualitas bagi anak-anak di pedalaman. Mari wujudkan mimpi mereka bersama.</p>
            <div>
                 <a href="#donasi" class="btn btn-lg rounded-pill px-4 me-2" style="background-color: var(--btn-yellow-bg);">Dukung Pembangunan</a>
                 <a href="#kisah-kami" class="btn btn-lg btn-outline-light rounded-pill px-4">Lihat Kisah Kami</a>
            </div>
        </div>
    </section>

    <section class="container my-5 py-5">
        <h2 class="text-center fw-bold mb-5">Sambutan Kepala Sekolah</h2>
        <div
            class="d-flex flex-column flex-md-row align-items-center bg-white rounded-3 shadow-sm border p-4 p-md-5">
            <div class="flex-shrink-0 me-md-5 mb-4 mb-md-0">
                 <img src="{{ asset('images/habibie.jpeg') }}" alt="Foto Kepala Sekolah"
                    class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="text-md-start text-center">
                <p class="fs-6 text-muted mb-3">Assalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                <p class="fs-6 text-muted">Selamat datang di SDIT Al Asror, sebuah sekolah yang lahir dari mimpi untuk memberikan akses pendidikan Islam berkualitas bagi anak-anak di kawasan pegunungan yang kami cintai. Di sini, kami tidak hanya mengajar, tetapi juga mendidik dan membangun karakter generasi penerus yang tangguh dan berakhlak mulia.</p>
                <div class="text-end mt-4">
                    <span class="d-block fw-bold text-gray-800">Nama Kepala Sekolah</span>
                    <span class="d-block fs-6 text-muted">Kepala SDIT Al Asror</span>
                </div>
            </div>
        </div>
    </section>
    
    <section id="kisah-kami" class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="section-title mb-4">Perjuangan Meraih Ilmu di Ketinggian</h2>
                <p class="text-muted">Terletak di daerah pegunungan yang jauh dari pusat kota, anak-anak di sekitar kami menghadapi tantangan besar untuk mendapatkan pendidikan yang layak. Jarak yang jauh dan fasilitas yang terbatas menjadi penghalang utama mereka dalam meraih cita-cita.</p>
                <p class="text-muted">SDIT AL Asror didirikan sebagai jawaban atas tantangan tersebut. Kami bercita-cita membangun sebuah pusat pendidikan yang tidak hanya unggul secara akademis, tetapi juga menjadi benteng moral dan spiritual. Namun, untuk mewujudkan mimpi besar ini, kami tidak bisa berjalan sendiri. Kami membutuhkan uluran tangan Anda.</p>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <img src="{{ asset('images/kemenkeumengajar.jpeg') }}" class="img-fluid rounded-3 shadow" alt="Anak-anak sekolah di desa">
                    </div>
                    <div class="col-6">
                        <img src="{{ asset('images/SDMuhammadiyahGantong.jpeg') }}" class="img-fluid rounded-3 shadow" alt="Pemandangan pegunungan">
                    </div>
                     <div class="col-12">
                        <img src="{{ asset('images/GunungGede.jpeg') }}" class="img-fluid rounded-3 shadow" alt="Proses pembangunan sekolah">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="py-5" style="background-color: #fffbe6;" id="donasi">
        <div class="container my-5">
            <h2 class="text-center mb-3 section-title">Wujudkan Mimpi Mereka, Bata demi Bata</h2>
            <p class="text-center text-muted mb-5 mx-auto" style="max-width: 700px;">Setiap donasi Anda akan menjadi bagian dari pembangunan ruang kelas, perpustakaan, dan fasilitas belajar lainnya yang akan membentuk masa depan mereka.</p>
            <div class="row g-4 justify-content-center">
                @forelse($programDonasi as $program)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-custom h-100">
                            <img src="{{ $program->getFirstMediaUrl('pembangunan') }}" class="card-img-top" alt="{{ $program->nama_pembangunan }}">
                            
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-warning text-dark align-self-start mb-2">Infrastruktur</span>
                                
                                <h5 class="card-title">{{ $program->nama_pembangunan }}</h5>
                                <p class="card-text text-muted small mb-3">{{ $program->deskripsi }}</p>
                                
                                <div class="progress mt-auto mb-2" style="height: 20px;">
                                    <div class="progress-bar bg-warning text-dark fw-bold" role="progressbar" 
                                        style="width: {{ $program->persentase_terkumpul }}%;" 
                                        aria-valuenow="{{ $program->persentase_terkumpul }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                        {{ $program->persentase_terkumpul }}%
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between small">
                                    <span class="fw-bold">Terkumpul: <br> Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</span>
                                    <span class="text-end">Target: <br> Rp {{ number_format($program->estimasi_biaya, 0, ',', '.') }}</span>
                                </div>

                                @auth
                                    <a href="{{ route('filament.admin.resources.transaksi-donasi-programs.create', ['program_id' => $program->id]) }}" 
                                    class="btn btn-warning w-100 mt-4 fw-bold">
                                    Donasi Sekarang
                                    </a>
                                @else
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
        </div>
    </section>

    <section class="container my-5 py-5" id="transparansi">
        <h2 class="text-center mb-5 section-title">Transparansi & Dampak Donasi Anda</h2>
        <div class="row g-4">
            <div class="col-lg-8">
                <h4 class="mb-4">Program yang Telah Selesai</h4>
                <div class="card completed-project-card p-3">
                    <div class="row g-0">
                        <div class="col-md-5">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-start" alt="Bangunan selesai">
                             <div class="text-center bg-dark text-white p-1 mt-1 rounded-bottom small">Tampilan Setelah Selesai</div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">Pembangunan Fondasi & 2 Ruang Kelas Awal</h5>
                                <p class="card-text text-muted small">Alhamdulillah, berkat bantuan para donatur, tahap pertama pembangunan telah selesai pada [Bulan, Tahun]. Ini menjadi langkah awal yang sangat penting bagi kami.</p>
                                <p class="card-text"><small class="text-muted">Total Dana Terkumpul: Rp [Jumlah Dana]</small></p>
                                <a href="#" class="btn btn-outline-secondary btn-sm">Lihat Laporan Akhir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h4 class="mb-4">Laporan Keuangan</h4>
                <div class="card card-custom h-100 p-4">
                    <div class="text-center">
                        <i class="bi bi-file-earmark-text display-3 text-warning"></i>
                        <h5 class="mt-3">Laporan Donasi Bulanan</h5>
                        <p class="text-muted small mb-4">Kami berkomitmen untuk transparan. Unduh laporan penggunaan dana kami untuk melihat bagaimana setiap rupiah Anda memberikan dampak.</p>
                    </div>

                    {{-- Daftar Laporan Dinamis --}}
                    <ul class="list-group list-group-flush">
                        @forelse($reports as $report)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $report['name'] }}
                                <a href="{{ $report['url'] }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-download"></i> Unduh
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">
                                Belum ada laporan yang diterbitkan.
                            </li>
                        @endforelse
                    </ul>

                    {{-- Tombol untuk laporan terbaru --}}
                    @if($reports->isNotEmpty())
                        <a href="{{ $reports->first()['url'] }}" target="_blank" class="btn btn-warning mt-auto fw-bold">
                            Unduh Laporan Terbaru
                        </a>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </section>

    @foreach($daftarKategori as $kategori)
    <section class="container my-5 py-5" id="galeri">
        <h2 class="text-center mb-4 section-title">{{ $kategori->title }}</h2>

        <div class="splide" role="group" aria-label="Carousel {{ $kategori->title }}" data-post-count="{{ $kategori->posts->count() }}">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($kategori->posts as $post)
                        <li class="splide__slide p-2">
                            <div class="card card-custom">
                                <img src="{{ $post->getFirstMediaUrl('fitur_image') }}" alt="{{ $post->title }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
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


    <section class="container my-5 py-5" id="tentang">
        <h2 class="text-center mb-5 section-title">Tentang Sekolah</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Visi</h3>
                    <p class="card-text">Menjadi sekolah dasar Islam unggul yang melahirkan generasi cerdas, berkarakter Qur'ani, dan berwawasan lingkungan di kawasan [Nama Daerah].</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Misi</h3>
                    <p class="card-text">Menyelenggarakan pendidikan berkualitas, menanamkan nilai-nilai Islam dalam setiap aspek pembelajaran, dan mengembangkan potensi siswa secara optimal.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100">
                    <h3 class="card-title">Sejarah</h3>
                    <p class="card-text">Didirikan pada tahun 2024 atas kepedulian masyarakat untuk menyediakan pendidikan yang layak dan terjangkau di daerah pegunungan.</p>
                </div>
            </div>
        </div>
    </section>

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

    <section class="container my-5 py-5 text-center">
        <h2 class="fw-bold mb-4">Bekerja sama dengan :</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-5 partner-logos">
            <img src="{{ asset('images/logo_polinema.png') }}" alt="Logo of Polinema" class="img-fluid" style="max-width: 140px;">
            <img src="{{ asset('images/jti_polinema.png') }}" alt="Logo of JTI" class="img-fluid" style="max-width: 140px;">
        </div>
    </section>

    <footer class="text-center p-4 bg-dark text-white">
        <p class="mb-0">© {{ date('Y') }} Sekolah Dasar Islam Terpadu AL Asror. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua elemen splide di halaman
    var splideElements = document.querySelectorAll('.splide');

    if (splideElements.length > 0) {
        splideElements.forEach(function(splideElement) {
            
            // Ambil jumlah post dari atribut data yang kita buat tadi
            const postCount = parseInt(splideElement.dataset.postCount) || 0;
            const perPage = 3; // Jumlah slide per halaman (sesuaikan jika perlu)

            let options = {}; // Siapkan objek opsi kosong

            // Jika jumlah post lebih sedikit atau sama dengan slide per halaman
            if (postCount <= perPage) {
                // Nonaktifkan fitur carousel dan tengahkan item
                options = {
                    type: 'slide', // 'slide' tidak akan membuat duplikat
                    arrows: false, // Sembunyikan panah
                    pagination: false, // Sembunyikan titik navigasi
                    drag: false, // Matikan fungsi geser
                    perPage: perPage, // Tetap tampilkan sesuai jumlah per halaman
                    gap: '1.5rem',
                     breakpoints: {
                        992: { perPage: 2 },
                        576: { perPage: 1 }
                    }
                };
                // Tambahkan class untuk menengahkan
                splideElement.classList.add('is-centered');
            } else {
                // Jika post banyak, jalankan mode carousel seperti biasa
                options = {
                    type: 'loop', // 'loop' akan membuat duplikat untuk efek putaran
                    perPage: perPage,
                    gap: '1.5rem',
                    pagination: false,
                    arrows: true,
                    breakpoints: {
                        992: { perPage: 2 },
                        576: { perPage: 1 }
                    }
                };
            }

                // Jalankan Splide dengan opsi yang sudah ditentukan
                new Splide(splideElement, options).mount();
            });
        }
    });
    </script>
</body>

</html>