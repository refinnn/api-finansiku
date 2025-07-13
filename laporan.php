<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
  header("Location: login.html");
  exit();
}
include 'koneksi.php';
$id_pengguna = $_SESSION['id_pengguna'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Keuangan - Finansiku</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    canvas {
      max-width: 400px;
      margin: 20px auto;
    }
    body {
      background-color: #f7faff;
    }
    .icon-title {
      font-size: 28px;
      color: #0d6efd;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5">
    <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
      <h1 class="display-5 text-primary m-0">Finansiku</h1>
    </a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
        <a href="catat.php" class="nav-item nav-link">Catat</a>
        <a href="rencana.php" class="nav-item nav-link">Perencanaan</a>
        <a href="laporan.php" class="nav-item nav-link active">Laporan</a>
        <span class="nav-item nav-link">Hai, <?= $_SESSION['nama']; ?></span>
        <a href="logout.php" class="nav-item nav-link">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center mb-5">
        <i class="fas fa-chart-pie icon-title mb-3"></i>
        <h2 class="fw-bold">Laporan Keuangan</h2>
        <p class="text-muted">Pantau riwayat transaksi dan perencanaan keuanganmu secara lengkap.</p>
      </div>

      <!-- Data Transaksi -->
      <div class="card mb-5 p-4 shadow-sm">
        <h5><i class="fas fa-list me-2"></i>Data Transaksi</h5>
        <table class="table table-striped">
          <thead class="table-primary">
            <tr>
              <th>Jenis</th><th>Jumlah</th><th>Kategori</th><th>Keterangan</th><th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $q = "SELECT * FROM transaksi WHERE id_pengguna = ?";
            $stmt = $koneksi->prepare($q);
            $stmt->bind_param("i", $id_pengguna);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_assoc()) {
              echo "<tr>
                      <td>" . htmlspecialchars($row['jenis']) . "</td>
                      <td>Rp " . number_format($row['jumlah'], 0, ',', '.') . "</td>
                      <td>" . htmlspecialchars($row['kategori']) . "</td>
                      <td>" . htmlspecialchars($row['keterangan']) . "</td>
                      <td>" . htmlspecialchars($row['tanggal']) . "</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Grafik Pie -->
      <div class="card p-4 shadow-sm mb-5">
        <h5 class="text-center"><i class="fas fa-chart-pie me-2"></i>Grafik Pengeluaran per Kategori</h5>
        <canvas id="grafikPie"></canvas>
      </div>

      <!-- Data Perencanaan -->
      <div class="card p-4 shadow-sm">
        <h5 class="text-center"><i class="fas fa-calendar-check me-2"></i>Rencana Keuangan Tersimpan</h5>
        <table class="table table-bordered">
          <thead class="table-info">
            <tr>
              <th>Nama Rencana</th>
              <th>Total Budget</th>
              <th>Durasi (hari)</th>
              <th>Dana Darurat</th>
              <th>Saran Harian</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $queryRencana = "SELECT * FROM perencanaan WHERE id_pengguna = ?";
            $stmtR = $koneksi->prepare($queryRencana);
            $stmtR->bind_param("i", $id_pengguna);
            $stmtR->execute();
            $resR = $stmtR->get_result();

            if ($resR->num_rows > 0) {
              while ($r = $resR->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($r['nama_rencana']) . "</td>
                        <td>Rp " . number_format($r['total_anggaran'], 0, ',', '.') . "</td>
                        <td>" . $r['durasi_hari'] . "</td>
                        <td>Rp " . number_format($r['dana_darurat'], 0, ',', '.') . "</td>
                        <td>Rp " . number_format($r['saran_harian'], 0, ',', '.') . "</td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada rencana disimpan.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Grafik Pie dari Transaksi -->
  <script>
    fetch('get_pie_data.php')
      .then(res => res.json())
      .then(data => {
        const ctx = document.getElementById('grafikPie');
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: data.labels,
            datasets: [{
              label: 'Pengeluaran',
              data: data.values,
              backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'bottom' }
            }
          }
        });
      });
  </script>
</body>
</html>
