<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="index.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
</head>

<style>
  body {
    font-family: "Poppins", sans-serif;
    background-color: #f8f9fa;
  }

  .btn {
    width: 100px;
    height: 35px;
  }

  .hero-section {
    position: relative;
    min-height: 85vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    margin-top: 100px;
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
    clip-path: polygon(100% 0, 100% 0, 100% 100%, 0% 100%);
  }

  .hero {
    background-color: #192a56;
    width: 100%;
    height: 300px;
  }

  .btns {
    width: 100px;
    height: 35px;
  }

  .hero-content h1 {
    font-size: 3rem;
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
  }

  footer {
    background-color: #192a56;
    color: #fff;
    padding: 3rem 0;
  }

  .social-icons a {
    font-size: 1.25rem;
  }

  @media (max-width: 991.98px) {
    body {
      overflow: scroll;
    }

    .hero-section {
      text-align: center;
      min-height: auto;
      padding-top: 5rem;
      padding-bottom: 3rem;
      margin-top: 0;
    }

    .hero-section::before {
      display: none;
    }

    .hero-content {
      padding-bottom: 3rem;
    }

    .hero-content h1 {
      font-size: 2.2rem;
    }
  }
</style>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand ms-xl-5 ms-3" href="#">
          <img src="./FOTO/logo.png" width="100px" alt="Logo" />
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link text-black fw-bold"
                aria-current="page"
                href="#beranda">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black fw-bold" href="#tentang-kami">Tentang</a>
            </li>
            <li class="nav-item me-3">
              <a href="auth/login.php" class="btns btn btn-primary fw-bold">Login</a>
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
            Mudah, cepat, dan transparan dalam pengelolaan
            surat peringatan.
          </p>
        </div>

        <div class="col-lg-6 mt-4 mt-lg-0">
          <div class="illustration-container">
            <img
              class="rounded-2 ms-xl-5 ms-0"
              src="./FOTO/Rectangle.png"
              alt="Ilustrasi Login dan Keamanan"
              width="80%" />
          </div>
        </div>
      </div>
    </div>
  </main>

  <div class="hero" id="tentang-kami">
    <div class="text-center">
      <button
        type="button"
        style="font-size: 11px"
        class="btn btn-sm btn-light mt-5">
        Meet Our Team
      </button>
    </div>
    <h2 class="text-center fw-bold mt-3 text-white">Tentang Kami</h2>
    <p class="text-center text-white">
      Kami adalah developer yang mengerjakan aplikasi pengelolaan surat
      peringatan berbasis website ini.
    </p>
    <div class="text-center">
      <button type="button" style="font-size: 11px" class="btn btn-light">
        Apply Now ->
      </button>
      <button type="button" style="font-size: 11px" class="btn btn-primary">
        Contact US ->
      </button>
    </div>
  </div>

  <div class="foto mt-4">
    <div class="mt-4 container d-flex justify-content-center">
      <div class="row">
        <div
          class="col-sm col-md-3 d-flex mt-4 mt-xl-0 justify-content-center">
          <div class="card" style="width: 18rem">
            <img src="./FOTO/fariel1.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title fw-bold">Fariel Ariandi</h5>
              <p class="card-text fw-medium" style="color: #6236f5">
                Ketua Kelompok | Full Stack
              </p>
              <p class="text-center">Hidup Kadang Kadang Kiding Kiding</p>
            </div>
          </div>
        </div>
        <div
          class="col-sm col-md-3 d-flex mt-4 mt-xl-0 justify-content-center">
          <div class="card" style="width: 18rem">
            <img
              src="./FOTO/devicha reta.jpg"
              class="card-img-top"
              alt="..." />
            <div class="card-body">
              <h5 class="card-title fw-bold">Devicha Reta S</h5>
              <p class="card-text fw-medium" style="color: #6236f5">
                Anggota Kelompok | UI / UX
              </p>
              <p class="text-center">Hidup Kadang Kadang Kiding Kiding</p>
            </div>
          </div>
        </div>
        <div
          class="col-sm col-md-3 d-flex mt-4 mt-xl-0 justify-content-center">
          <div class="card" style="width: 18rem">
            <img
              src="./FOTO/lanna laura.png"
              class="card-img-top"
              alt="..." />
            <div class="card-body">
              <h5 class="card-title fw-bold">Lanna Laura</h5>
              <p class="card-text fw-medium" style="color: #6236f5">
                Anggota Kelompok | Front End
              </p>
              <p class="text-center">Hidup Kadang Kadang Kiding Kiding</p>
            </div>
          </div>
        </div>
        <div
          class="col-sm col-md-3 d-flex mt-4 mt-xl-0 justify-content-center">
          <div class="card" style="width: 18rem">
            <img
              src="./FOTO/syarifah aqilah.png"
              class="card-img-top"
              alt="..." />
            <div class="card-body">
              <h5 class="card-title fw-bold">Syarifah Aqilah</h5>
              <p class="card-text fw-medium" style="color: #6236f5">
                Anggota Kelompok | Front End
              </p>
              <p class="text-center">Hidup Kadang Kadang Kiding Kiding</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="mt-3">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5>Tentang Kami</h5>
          <p>
            Kami adalah developer yang mengerjakan aplikasi pengelolaan surat
            peringatan berbasis website ini
          </p>
        </div>

        <div class="col-md-4 mb-3">
          <h5>Link cepat</h5>
          <ul class="list-unstyled">
            <li>
              <a href="#" class="text-decoration-none text-white">Beranda</a>
            </li>
            <li>
              <a href="#" class="text-decoration-none text-white">Tentang</a>
            </li>
            <li>
              <a href="auth/login.php" class="text-decoration-none text-white">Login</a>
            </li>
          </ul>
        </div>
        <div class="col-md-4 mb-3">
          <h5>Follow Us</h5>
          <ul class="list-inline social-icons">
            <li class="list-inline-item">
              <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <hr class="mb-4" />
      <div class="row">
        <div class="col-md-12 text-center">
          <p>&copy; 2025 Project PBL. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>