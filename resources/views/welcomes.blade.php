<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sekolah Dasar Islam Terpadu AL Asror</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    /* Custom colors */
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

    /* Navbar */
    navbar {
      background-color: var(--nav-bg);
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 1.25rem;
      color: var(--nav-link-color);
      display: flex;
      align-items: center;
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
    .navbar-brand .logo-icon > i {
      color: var(--nav-bg);
      font-weight: bold;
      font-size: 1.3rem;
    }
    .nav-link, .navbar-toggler-icon {
      color: var(--nav-link-color);
      font-weight: 600;
    }
    .nav-link:hover {
      color: #dfdfdf;
    }
    .btn-login {
      background-color: var(--btn-yellow-bg);
      color: #333;
      font-weight: 600;
    }
    .btn-login:hover {
      background-color: var(--btn-yellow-bg-hover);
      color: black;
    }
    /* Hero */
    .hero {
      position: relative;
      background: url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5031d136-040e-4b54-9c02-b31b59db3fe8.png') no-repeat center center/cover;
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
    .hero h1 {
      font-weight: 700;
      font-size: 2.5rem;
      line-height: 1.2;
      margin-bottom: 0.5rem;
    }
    .hero p {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
      font-weight: 500;
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
    /* Section shapes and shadows */
    .shape-purple {
      width: 0;
      height: 0;
      border-top: 60px solid transparent;
      border-left: 80px solid #7363a2;
      border-bottom: 60px solid transparent;
      position: absolute;
      top: 40px;
      left: 0;
      z-index: 0;
      opacity: 0.55;
      transform: translateX(-50px);
      border-radius: 0 0 20px 0;
    }
    section.tentang-sekolah {
      position: relative;
      padding-top: 60px;
      padding-bottom: 4rem;
      max-width: 1024px;
      margin: 0 auto 3rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    section.tentang-sekolah h2 {
      font-weight: 700;
      margin-bottom: 2.5rem;
      text-align: center;
      font-size: 1.8rem;
    }
    .card-tentang {
      position: relative;
      border-radius: 1rem;
      border: 1.8px solid var(--card-border-blue);
      padding: 1.2rem 1.6rem;
      background-color: #fff;
      box-shadow: 0 2px 10px rgb(31 43 75 / 0.1);
      font-size: 0.95rem;
      font-weight: 600;
      min-height: 140px;
      overflow-wrap: break-word;
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
    /* Pembangunan */
    section.pembangunan {
      padding-bottom: 3rem;
      max-width: 1024px;
      margin: 0 auto 3rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    section.pembangunan h2 {
      text-align: center;
      margin-bottom: 2.5rem;
      font-weight: 700;
      font-size: 1.8rem;
    }
    .card-pembangunan {
      border: 1px solid var(--btn-yellow-bg);
      border-radius: 12px;
      box-shadow: 0 1px 8px rgb(31 43 75 / 0.1);
      transition: transform 0.3s ease;
      padding-bottom: 1rem;
      overflow: hidden;
      background-color: #fff;
      cursor: default;
    }
    .card-pembangunan:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 12px rgb(31 43 75 / 0.15);
    }
    .card-pembangunan .card-img-top {
      object-fit: cover;
      max-height: 180px;
      border-radius: 12px 12px 0 0;
      width: 100%;
    }
    .card-pembangunan .card-body {
      padding-left: 1rem;
      padding-right: 1rem;
      padding-top: 0.6rem;
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
    /* Galeri */
    section.galeri {
      max-width: 1024px;
      margin: 0 auto 3rem;
      padding-left: 1rem;
      padding-right: 1rem;
      padding-bottom: 2rem;
    }
    section.galeri h2 {
      font-weight: 700;
      text-align: center;
      margin-bottom: 1.8rem;
      font-size: 1.7rem;
    }
    .gallery-group {
      margin-bottom: 2.6rem;
      text-align: center;
    }
    .gallery-group .title {
      font-weight: 600;
      font-size: 1.05rem;
      color: #446ee2;
      margin-bottom: 0.3rem;
      cursor: default;
    }
    .gallery-group .desc {
      font-size: 0.85rem;
      margin-bottom: 1rem;
      font-weight: 500;
    }
    .gallery-row {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
    }
    .gallery-row img {
      width: 180px;
      height: 140px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 1.5px 4px rgba(0,0,0,0.15);
      transition: transform 0.3s ease;
      cursor: default;
    }
    .gallery-row img:hover {
      transform: scale(1.07);
      box-shadow: 0 8px 15px rgba(0,0,0,0.25);
    }
    /* Bekerja sama dengan */
    section.partner {
      padding-top: 2rem;
      padding-bottom: 3rem;
      text-align: center;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    section.partner h2 {
      font-weight: 700;
      margin-bottom: 1.5rem;
      font-size: 1.6rem;
    }
    .partner-logos {
      display: flex;
      justify-content: center;
      gap: 4rem;
      flex-wrap: wrap;
    }
    .partner-logos img {
      max-width: 140px;
      height: auto;
      object-fit: contain;
      cursor: default;
    }
    /* Lokasi Kami */
    section.lokasi {
      padding: 2rem 1rem 4rem;
      background: linear-gradient(45deg, var(--primary-light) 0%, #e1e86f 60%, #dbdd68 80%, var(--primary-color) 100%);
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .map-responsive {
      width: 100%;
      max-width: 800px;
      aspect-ratio: 16 / 9;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgb(0 0 0 / 0.15);
    }
    iframe {
      border: 0;
      width: 100%;
      height: 100%;
      display: block;
    }
    section.lokasi h2 {
      font-weight: 700;
      margin-bottom: 1rem;
      text-align: center;
      width: 100%;
      color: #3b430a;
    }
    /* Kontak Kami */
    section.kontak {
      background: url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/169cb1b5-01c3-4a65-97c9-563ffaac53ac.png') no-repeat center center/cover;
      color: #444;
      padding: 3rem 1rem 5rem;
      max-width: 1024px;
      margin: 0 auto 2rem;
      border-radius: 18px;
      box-shadow: 0 2px 18px rgb(0 0 0 / 0.17);
      position: relative;
      overflow: hidden;
    }
    section.kontak h2 {
      font-weight: 700;
      color: white;
      text-align: center;
      font-size: 2rem;
      margin-bottom: 3rem;
      text-shadow: 0 2px 6px rgba(0,0,0,0.7);
    }
    .contact-cards {
      display: flex;
      justify-content: center;
      gap: 2rem;
      flex-wrap: wrap;
    }
    .contact-card {
      background-color: rgba(255 255 255 / 0.90);
      border-radius: 10px;
      box-shadow: 0 3px 12px rgb(0 0 0 / 0.12);
      max-width: 280px;
      padding: 1rem 1.4rem;
      min-height: 150px;
      font-weight: 600;
      font-size: 0.95rem;
      color: #444;
      user-select: none;
    }
    .contact-card strong {
      display: block;
      font-size: 1.1rem;
      margin-bottom: 0.6rem;
      font-weight: 700;
      color: #222;
    }
    .contact-card .social-list {
      margin-top: 0.8rem;
      font-weight: 500;
      font-size: 0.9rem;
    }
    .social-list a {
      display: flex;
      align-items: center;
      gap: 0.4rem;
      color: #333;
      text-decoration: none;
      margin-top: 0.2rem;
      user-select:none;
    }
    .social-list a:hover {
      color: var(--primary-dark);
      text-decoration: underline;
    }
    .social-list i {
      font-size: 1.25rem;
      min-width: 20px;
      text-align: center;
    }
    /* Footer */
    footer {
      text-align: center;
      padding: 1rem 1rem 2rem;
      font-size: 0.85rem;
      color: #666;
    }
    @media (max-width: 576px) {
      .card-pembangunan .card-img-top {
        max-height: 140px;
      }
      .gallery-row img {
        width: 140px;
        height: 110px;
      }
      section.tentang-sekolah,
      section.pembangunan,
      section.galeri,
      section.partner,
      section.kontak {
        padding-left: 1rem;
        padding-right: 1rem;
      }
      .contact-cards {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top" style="background-color: var(--nav-bg);">
    <div class="container">
      <a class="navbar-brand" href="#">
        <div class="logo-icon" aria-label="School badge icon" role="img"><i class="bi bi-mortarboard-fill"></i></div>
        Sekolah Dasar Islam Terpadu AL Asror
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color: white;"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-lg-center">
          <li class="nav-item"><a href="#beranda" class="nav-link">Beranda</a></li>
          <li class="nav-item"><a href="#tentang" class="nav-link">Tentang</a></li>
          <li class="nav-item"><a href="#pembangunan" class="nav-link">Pembangunan</a></li>
          <li class="nav-item"><a href="#galeri" class="nav-link">Galeri</a></li>
          <li class="nav-item"><a href="#lokasi" class="nav-link">Lokasi</a></li>
          <li class="nav-item"><a href="#kontak" class="nav-link">Kontak</a></li>
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/admin/login" class="btn btn-login ms-lg-3 px-4 py-1 rounded">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero" id="beranda" role="banner" aria-label="Hero section with school image and main heading">
    <div class="hero-content">
      <h1>Sekolah Dasar Islam Terpadu AL Asror<br />Gedangsari, Kab Gunungkidul<br />D.I.Yogyakarta</h1>
      <p>Membangun generasi cerdas, berkarakter, dan berahlak mulia</p>
      <button class="btn btn-hero" type="button" aria-label="Pelajari Lebih Lanjut">Pelajari Lebih Lanjut</button>
    </div>
  </section>

  <button class="btn-chat-admin" aria-label="Chat Admin"><i class="bi bi-chat-dots-fill"></i> Chat Admin</button>

  <!-- Tentang Sekolah -->
  <section class="tentang-sekolah" id="tentang" aria-labelledby="tentang-heading">
    <h2 id="tentang-heading">Tentang Sekolah</h2>
    <div class="shape-purple" aria-hidden="true"></div>
    <div class="row g-4">
      <div class="col-md-4">
        <article tabindex="0" class="card-tentang visi" aria-describedby="visi-desc" role="region" aria-label="Visi Sekolah">
          <div class="title">Visi</div>
          <p id="visi-desc">Menjadi sekolah dasar yang unggul dalam prestasi, berkarakter, dan berwawasan lingkungan.</p>
        </article>
      </div>
      <div class="col-md-4">
        <article tabindex="0" class="card-tentang misi" aria-describedby="misi-desc" role="region" aria-label="Misi Sekolah">
          <div class="title">Misi</div>
          <p id="misi-desc">Menyelenggarakan pendidikan yang berkualitas dan mengembangkan potensi siswa secara optimal.</p>
        </article>
      </div>
      <div class="col-md-4">
        <article tabindex="0" class="card-tentang sejarah" aria-describedby="sejarah-desc" role="region" aria-label="Sejarah Sekolah">
          <div class="title">Sejarah</div>
          <p id="sejarah-desc">Didirikan pada tahun 2024, telah melahirkan banyak alumni yang sukses di berbagai bidang.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- Pembangunan -->
  <section class="pembangunan" id="pembangunan" aria-labelledby="pembangunan-heading">
    <h2 id="pembangunan-heading">Pembangunan</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-sm-6 col-md-4">
        <div class="card-pembangunan" tabindex="0" role="region" aria-label="Pembangunan Kelas">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/bfeb54c0-8457-4202-af69-996e4d81eb1c.png" alt="Photo of classroom construction site with two-story building framework and blue scaffolding" class="card-img-top" onerror="this.style.display='none'"/>
          <div class="card-body">
            <h3 class="card-title">Kelas</h3>
            <p class="card-text">Deskripsi pembangunan kelas</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="card-pembangunan" tabindex="0" role="region" aria-label="Pembangunan Sumur">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/a8d9c2c2-f513-48f1-a1d3-401be20eb3bf.png" alt="Two men building a well near a tree using cement in a school yard" class="card-img-top" onerror="this.style.display='none'" />
          <div class="card-body">
            <h3 class="card-title">Sumur</h3>
            <p class="card-text">Deskripsi pembangunan sumur</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="card-pembangunan" tabindex="0" role="region" aria-label="Pembangunan Pos Satpam">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/a15a5057-d9a3-45a6-806d-eaf6b1b1656b.png" alt="Concrete small security post building under construction with window opening" class="card-img-top" onerror="this.style.display='none'" />
          <div class="card-body">
            <h3 class="card-title">Pos satpam</h3>
            <p class="card-text">Deskripsi pembangunan Pcs satpam</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Galeri Sekolah -->
  <section class="galeri" id="galeri" aria-labelledby="galeri-heading">
    <h2 id="galeri-heading">Galeri Sekolah</h2>

    <div class="gallery-group" role="region" aria-label="Galeri Perpustakaan">
      <div class="gallery-row justify-content-center">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8e0e494f-7c69-4ff1-a4ef-46f98984689c.png" alt="Three photos of a large library building under construction with concrete extended structures" tabindex="0" onerror="this.style.display='none'"/>
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f5195edd-42f7-4b39-9200-d8e65941edff.png" alt="Three photos of a large library building under construction with concrete extended structures" tabindex="0" onerror="this.style.display='none'"/>
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/540e0e44-b379-4a0f-943e-9b0f58c9dd2f.png" alt="Three photos of a large library building under construction with concrete extended structures" tabindex="0" onerror="this.style.display='none'"/>
      </div>
      <div class="title mt-2">Perpustakaan</div>
      <div class="desc">Fasilitas perpustakaan yang lengkap.</div>
    </div>

    <div class="gallery-group" role="region" aria-label="Galeri Masjid">
      <div class="gallery-row justify-content-center">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/502711e8-9668-4c45-b616-be31e17a4602.png" alt="Three photos of completed brick mosque buildings with blue roof and window openings" tabindex="0" onerror="this.style.display='none'"/>
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0b90d4d2-bea0-4c53-a034-3cd47d364877.png" alt="Three photos of completed brick mosque buildings with blue roof and window openings" tabindex="0" onerror="this.style.display='none'"/>
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/4f77e0fc-88e3-433b-a235-d77c3fd97e70.png" alt="Three photos of completed brick mosque buildings with blue roof and window openings" tabindex="0" onerror="this.style.display='none'"/>
      </div>
      <div class="title mt-2">Masjid</div>
      <div class="desc">Fasilitas masjid yang lengkap.</div>
    </div>

    <div class="gallery-group" role="region" aria-label="Galeri Aula">
      <div class="gallery-row justify-content-center">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/54fa6fec-a8f5-479e-9ca5-0302934d0192.png" alt="Three photos of a large hall building with steel framework and construction materials" tabindex="0" onerror="this.style.display='none'"/>
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f7623d6d-f660-4b57-a23a-b2af784695c5.png" alt="Three photos of a large hall building with steel framework and construction materials" tabindex="0" onerror="this.style.display='none'"/>
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5cc4a217-6c3e-43e2-ab2c-852586dbe681.png" alt="Three photos of a large hall building with steel framework and construction materials" tabindex="0" onerror="this.style.display='none'"/>
      </div>
      <div class="title mt-2">Aula</div>
      <div class="desc">Fasilitas aula yang lengkap.</div>
    </div>
  </section>

  <!-- Bekerja sama dengan -->
  <section class="partner" aria-label="Partners section">
    <h2>Bekerja sama dengan :</h2>
    <div class="partner-logos" role="list">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1ab4fa0d-f630-48c8-be1b-6ac7fac3d014.png" alt="Logo of Indonesian Education Department featuring yellow torch and purple shield" role="listitem" onerror="this.style.display='none'"/>
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f58dbd66-38d0-4de2-a1f2-76956f569a70.png" alt="Logo of JTI with stylized letters J T I in orange and black" role="listitem" onerror="this.style.display='none'"/>
    </div>
  </section>

  <!-- Lokasi Kami -->
  <section class="lokasi" id="lokasi" aria-labelledby="lokasi-heading">
    <h2 id="lokasi-heading">Lokasi Kami</h2>
    <div class="map-responsive" role="region" aria-label="Map showing Sekolah Dasar Islam Terpadu AL Asror location">
      <iframe
        src="https://maps.google.com/maps?q=Sekolah%20Dasar%20Islam%20Terpadu%20AL%20Asror%20Gedangsari,%20Kab.%20Gunungkidul,%20Yogyakarta&t=&z=14&ie=UTF8&iwloc=&output=embed"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Maps Location">
      </iframe>
    </div>
  </section>

  <!-- Kontak Kami -->
  <section class="kontak" id="kontak" aria-labelledby="kontak-heading">
    <h2 id="kontak-heading">Kontak Kami</h2>
    <div class="contact-cards">
      <address class="contact-card" tabindex="0" aria-label="Alamat Sekolah">
        <strong>Alamat</strong>
        Jl. Suru Lor, Suruh, Hargomulyo, Kec. Gedangsari, Kabupaten Gunungkidul, Daerah Istimewa Yogyakarta 55863.
      </address>
      <div class="contact-card" tabindex="0" aria-label="Kontak Telepon dan Email">
        <strong>Kontak</strong>
        <p>Telepon: 081*********</p>
        <p>Email: sdit@gmail.com</p>
      </div>
      <div class="contact-card" tabindex="0" aria-label="Jam Operasional Sekolah">
        <strong>Jam Operasional</strong>
        <p>Senin - Jumat: 06.00 - 15.00 WIB</p>
        <p>Sabtu: 07.00 - 12.00 WIB</p>
        <p>Minggu: Tutup</p>
      </div>
      <div class="contact-card" tabindex="0" aria-label="Sosial Media Sekolah">
        <strong>Sosial Media</strong>
        <div class="social-list">
          <a href="#" tabindex="0" aria-label="Instagram @081*******"><i class="bi bi-instagram"></i> 081*********</a>
          <a href="#" tabindex="0" aria-label="Instagram @sdit.id"><i class="bi bi-instagram"></i> sdit.id</a>
          <a href="#" tabindex="0" aria-label="TikTok @sdit.tiktok"><i class="bi bi-tiktok"></i> sdit.tiktok</a>
          <a href="#" tabindex="0" aria-label="YouTube channel sdit.youtube"><i class="bi bi-youtube"></i> sdit.youtube</a>
        </div>
      </div>
    </div>
  </section>

  <footer>
    © 2024 Sekolah Dasar Islam Terpadu AL Asror Gedangsari. All rights reserved.
  </footer>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

