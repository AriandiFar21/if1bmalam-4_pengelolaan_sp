<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f8f9fa;
      padding-top: 70px;
    }

    .btn {
      min-width: 100px;
      height: 35px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .hero-section {
      position: relative;
      min-height: 85vh;
      display: flex;
      align-items: center;
      overflow: hidden;
      padding: 2rem 0;
    }

    .hero-section::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #192a56;
      z-index: -1;
      /* Bentuk miring */
      clip-path: polygon(100% 0, 100% 0, 100% 100%, 0 100%);
    }

    .hero-content h1 {
      font-size: clamp(2rem, 5vw, 3rem);
      font-weight: 700;
      color: #212529;
    }

    .hero-content p {
      font-size: 1rem;
      color: #6c757d;
    }

    .illustration-container img {
      max-width: 100%;
      height: auto;
      object-fit: cover;
    }

    .hero {
      background-color: #192a56;
      width: 100%;
      top: -49px;
      position: relative;
      padding: 4rem 0;
      margin-top: 3rem;
    }

    .card {
      border: none;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      height: 100%;
    }

    .card img {
      height: 250px;
      object-fit: cover;
      object-position: top;
    }

    footer {
      background-color: #192a56;
      color: #fff;
      padding: 3rem 0;
    }

    .social-icons a {
      font-size: 1.25rem;
      margin-right: 10px;
    }

    @media (max-width: 991.98px) {

      .hero-section {
        text-align: center;
        min-height: auto;
        padding-top: 2rem;
        padding-bottom: 2rem;
      }

      .hero-section::before {
        display: none;
      }

      .hero-section .row {
        flex-direction: column-reverse;
      }

      .illustration-container img {
        margin-bottom: 2rem;
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
      <div class="container"> <a class="navbar-brand" href="#">
          <img src="./FOTO/logo.png" height="40" alt="Logo" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
            <li class="nav-item">
              <a class="nav-link text-black fw-bold" href="#beranda">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black fw-bold" href="#tentang-kami">Tentang</a>
            </li>
            <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
              <a href="auth/login.php" class="btn btn-primary fw-bold text-white px-4">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="hero-section" id="beranda">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
          <h1>Website Pengelolaan Surat Peringatan Mahasiswa</h1>
          <p class="mt-3">
            Mudah, cepat, dan transparan dalam pengelolaan surat peringatan.
          </p>
        </div>

        <div class="col-lg-6">
          <div class="illustration-container text-center">
            <img class="rounded-2 shadow" src="./FOTO/Rectangle.png" alt="Ilustrasi Login" />
          </div>
        </div>
      </div>
    </div>
  </main>

  <div class="hero" id="tentang-kami">
    <div class="container">
      <div class="text-center">
        <button type="button" class="btn btn-sm btn-light mb-3">
          Meet Our Team
        </button>
      </div>
      <h2 class="text-center fw-bold text-white">Tentang Kami</h2>
      <p class="text-center text-white col-md-8 mx-auto">
        Kami adalah developer yang mengerjakan aplikasi pengelolaan surat
        peringatan berbasis website ini.
      </p>
      <div class="text-center mt-4">
        <span class="badge bg-light text-dark p-2">IF1Bmalam</span>
        <span class="badge bg-primary p-2">Kelompok 4</span>
      </div>
    </div>
  </div>

  <div class="container my-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

      <div class="col">
        <div class="card h-100">
          <img src="./FOTO/fariel1.jpg" class="card-img-top" alt="Fariel" />
          <div class="card-body d-flex flex-column text-center">
            <h5 class="card-title fw-bold">Fariel Ariandi</h5>
            <p class="card-text fw-medium text-primary">Ketua Kelompok | Full Stack</p>
            <p class="card-text small mt-auto">"Hidup Kadang Kadang Kiding Kiding"</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="./FOTO/devicha reta.jpg" class="card-img-top" alt="Devicha" />
          <div class="card-body d-flex flex-column text-center">
            <h5 class="card-title fw-bold">Devicha Reta S</h5>
            <p class="card-text fw-medium text-primary">Anggota Kelompok | UI / UX</p>
            <p class="card-text small mt-auto">"Hidup Kadang Kadang Kiding Kiding"</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="./FOTO/lanna laura.png" class="card-img-top" alt="Lanna" />
          <div class="card-body d-flex flex-column text-center">
            <h5 class="card-title fw-bold">Lanna Laura</h5>
            <p class="card-text fw-medium text-primary">Anggota Kelompok | Front End</p>
            <p class="card-text small mt-auto">"Hidup Kadang Kadang Kiding Kiding"</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="./FOTO/syarifah aqilah.png" class="card-img-top" alt="Syarifah" />
          <div class="card-body d-flex flex-column text-center">
            <h5 class="card-title fw-bold">Syarifah Aqilah</h5>
            <p class="card-text fw-medium text-primary">Anggota Kelompok | Front End</p>
            <p class="card-text small mt-auto">"Hidup Kadang Kadang Kiding Kiding"</p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5 class="fw-bold mb-3">Tentang Kami</h5>
          <p>
            Kami adalah developer yang mengerjakan aplikasi pengelolaan surat
            peringatan berbasis website ini.
          </p>
        </div>

        <div class="col-md-4 mb-4">
          <h5 class="fw-bold mb-3">Link Cepat</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-decoration-none text-white">Beranda</a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none text-white">Tentang</a></li>
            <li class="mb-2"><a href="auth/login.php" class="text-decoration-none text-white">Login</a></li>
          </ul>
        </div>

        <div class="col-md-4 mb-4">
          <h5 class="fw-bold mb-3">Follow Us</h5>
          <div class="social-icons">
            <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
          </div>
        </div>
      </div>
      <hr class="mb-4" />
      <div class="row">
        <div class="col-12 text-center">
          <p class="mb-0">&copy; 2025 Project PBL. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>