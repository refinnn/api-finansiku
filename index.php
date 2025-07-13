<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
  header("Location: login.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>Finansiku - Manajemen Keuangan Mahasiswa</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="img/logo.jpg" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Bootstrap & Custom Styles -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <style>
    .navbar-light .navbar-nav .nav-link {
      color: white !important;
    }
    .navbar-light .navbar-nav .nav-link.active {
      color: #0d6efd !important;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5">
      <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
        <h1 class="display-5 text-primary m-0">Finansiku</h1>
      </a>
      <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
          <a href="index.php" class="nav-item nav-link active">Beranda</a>
          <a href="catat.php" class="nav-item nav-link">Catat</a>
          <a href="rencana.php" class="nav-item nav-link">Perencanaan</a>
          <a href="laporan.php" class="nav-item nav-link">Laporan</a>
          <span class="nav-item nav-link">Hai, <?= $_SESSION['nama']; ?></span>
          <a href="logout.php" class="nav-item nav-link">Logout</a>
        </div>
      </div>
    </nav>
  </div>
  <!-- Navbar End -->

  <!-- Hero Section Start -->
  <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="d-flex align-items-center justify-content-center position-relative"
      style="background-image: url('img/bg-bg.jpeg'); background-size: cover; background-position: center; height: 100vh;">
      <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                  background-color: rgba(0,0,0,0.4); z-index: 1;"></div>

      <div class="carousel-caption text-start" style="z-index: 2;">
        <div class="container text-white">
          <div class="row justify-content-start">
            <div class="col-lg-8">
              <p class="d-inline-block border border-white rounded text-white fw-semi-bold py-1 px-3 animated slideInDown">
                Selamat Datang di Finansiku</p>
              <h1 class="display-1 mb-4 animated slideInDown text-white">Kelola Keuanganmu dengan Cerdas</h1>
              <p class="lead text-white animated slideInDown">
                Aplikasi manajemen keuangan pribadi untuk mahasiswa. Catat pemasukan dan pengeluaran, atur anggaran, dan pantau laporan keuanganmu setiap saat.
              </p>
              <a href="catat.php" class="btn btn-primary py-3 px-5 animated slideInDown">Catat Transaksi</a>
              <a href="rencana.php" class="btn btn-outline-light py-3 px-5 animated slideInDown">Rencana Budget</a>
              <a href="laporan.php" class="btn btn-light py-3 px-5 animated slideInDown">Lihat Laporan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5 text-center">
      <p class="mb-0 text-white">© 2025 Finansiku. All Rights Reserved.</p>
    </div>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
