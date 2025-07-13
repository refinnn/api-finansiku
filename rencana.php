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
  <meta charset="UTF-8">
  <title>Perencanaan Keuangan - Finansiku</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    .card { box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    #btnSimpan { display: none; }
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
        <a href="rencana.php" class="nav-item nav-link active">Perencanaan</a>
        <a href="laporan.php" class="nav-item nav-link">Laporan</a>
        <span class="nav-item nav-link">Hai, <?= $_SESSION['nama']; ?></span>
        <a href="logout.php" class="nav-item nav-link">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container py-5">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card p-4">
          <h5>Form Rencana Keuangan</h5>
          <form action="simpan_rencana.php" method="POST" id="formRencana">
            <div class="mb-3">
              <label>Nama Rencana:</label>
              <input type="text" name="nama_rencana" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Total Anggaran (Rp):</label>
              <input type="number" name="total_anggaran" id="total" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Durasi Penggunaan (hari):</label>
              <input type="number" name="durasi_hari" id="hari" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Dana Darurat (Rp):</label>
              <input type="number" name="dana_darurat" id="darurat" class="form-control" value="0">
            </div>

            <input type="hidden" name="saran_harian" id="saran_harian_hidden">

            <button type="button" onclick="hitungSaran()" class="btn btn-primary w-100">Hitung Rencana</button>
            <button type="submit" id="btnSimpan" class="btn btn-success w-100 mt-2">Simpan Rencana</button>
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card p-4 bg-light">
          <h5 class="mb-3">Hasil Estimasi</h5>
          <p id="output" class="fw-bold text-primary"></p>
          <div id="detailKebutuhan"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    function hitungSaran() {
      const total = parseFloat(document.getElementById("total").value);
      const hari = parseFloat(document.getElementById("hari").value);
      const darurat = parseFloat(document.getElementById("darurat").value) || 0;

      if (!isNaN(total) && !isNaN(hari) && hari > 0) {
        const sisa = total - darurat;
        const saran = sisa / hari;

        document.getElementById("saran_harian_hidden").value = Math.round(saran);
        document.getElementById("btnSimpan").style.display = 'block';

        document.getElementById("output").innerHTML = `
          <p>Sisa setelah darurat: Rp ${sisa.toFixed(0)}</p>
          <p>Saran pengeluaran per hari: Rp ${saran.toFixed(0)}</p>`;

        const kebutuhan = {
          "Makanan": (saran * 0.5).toFixed(0),
          "Minuman": (saran * 0.2).toFixed(0),
          "Transportasi": (saran * 0.2).toFixed(0),
          "Lainnya": (saran * 0.1).toFixed(0),
        };

        let html = '<ul>';
        for (const key in kebutuhan) {
          html += `<li>${key}: Rp ${kebutuhan[key]}</li>`;
        }
        html += '</ul>';
        document.getElementById("detailKebutuhan").innerHTML = html;
      } else {
        alert("Masukkan data valid.");
        document.getElementById("btnSimpan").style.display = 'none';
        document.getElementById("output").innerText = "";
        document.getElementById("detailKebutuhan").innerHTML = "";
      }
    }
  </script>
</body>
</html>
