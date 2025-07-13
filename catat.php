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
  <title>Catat Transaksi - Finansiku</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    .btn-choice {
      width: 120px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 16px;
      font-weight: bold;
      transition: all 0.2s ease;
    }
    .btn-choice.active, .btn-choice:hover {
      background-color: #0d6efd;
      color: white;
      transform: scale(1.05);
    }
    .btn-kategori {
      width: 100px;
      height: 80px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 500;
      border: 2px solid #0d6efd;
      background-color: white;
      color: #0d6efd;
      transition: all 0.2s ease;
    }
    .btn-kategori:hover {
      transform: scale(1.08);
      background-color: #0d6efd;
      color: white;
    }
    .btn-kategori.active {
      background-color: #0d6efd;
      color: white;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5">
    <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
      <h1 class="display-5 text-primary m-0">Finansiku</h1>
    </a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
        <a href="catat.php" class="nav-item nav-link active">Catat</a>
        <a href="rencana.php" class="nav-item nav-link">Perencanaan</a>
        <a href="laporan.php" class="nav-item nav-link">Laporan</a>
        <span class="nav-item nav-link">Hai, <?= $_SESSION['nama']; ?></span>
        <a href="logout.php" class="nav-item nav-link">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <h2 class="text-center mb-4">Catat Transaksi</h2>
    <form action="simpan_transaksi.php" method="POST" class="card mx-auto p-4 shadow" style="max-width: 500px;">
      <div class="mb-3">
        <label>Jenis Transaksi:</label><br>
        <input type="hidden" name="jenis" id="jenis" value="pemasukan">
        <div class="d-flex gap-3 justify-content-center">
          <button type="button" class="btn btn-outline-primary btn-choice" id="btnPemasukan" onclick="setJenis('pemasukan')">⬇️ Pemasukan</button>
          <button type="button" class="btn btn-outline-primary btn-choice" id="btnPengeluaran" onclick="setJenis('pengeluaran')">⬆️ Pengeluaran</button>
        </div>
      </div>

      <div class="mb-3">
        <label>Kategori:</label><br>
        <input type="hidden" name="kategori" id="kategori" required>
        <div id="kategori-container" class="d-flex flex-wrap gap-3 mt-2 justify-content-center"></div>
      </div>

      <div class="mb-3">
        <label>Jumlah (Rp):</label>
        <input type="number" name="jumlah" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Keterangan:</label>
        <input type="text" name="keterangan" class="form-control">
      </div>

      <div class="mb-3">
        <label>Tanggal:</label>
        <input type="date" name="tanggal" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">💾 Simpan Transaksi</button>
    </form>
  </div>

  <script>
    const kategoriInput = document.getElementById('kategori');
    const kategoriContainer = document.getElementById('kategori-container');
    const btnPemasukan = document.getElementById('btnPemasukan');
    const btnPengeluaran = document.getElementById('btnPengeluaran');

    const kategoriPemasukan = ['Gaji', 'Hadiah', 'Hibah', 'Penjualan', 'Lainnya'];
    const kategoriPengeluaran = ['Makanan', 'Transportasi', 'Hiburan', 'Belanja', 'Lainnya'];

    function setJenis(jenis) {
      document.getElementById('jenis').value = jenis;
      btnPemasukan.classList.remove('active');
      btnPengeluaran.classList.remove('active');
      if (jenis === 'pemasukan') btnPemasukan.classList.add('active');
      else btnPengeluaran.classList.add('active');

      const daftar = (jenis === 'pemasukan') ? kategoriPemasukan : kategoriPengeluaran;
      kategoriContainer.innerHTML = '';

      daftar.forEach(kat => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-kategori';
        btn.innerText = kat;
        btn.onclick = (e) => pilihKategori(e, kat);
        kategoriContainer.appendChild(btn);
      });
    }

    function pilihKategori(e, nama) {
      kategoriInput.value = nama;
      [...kategoriContainer.children].forEach(btn => btn.classList.remove('active'));
      e.target.classList.add('active');
    }

    window.onload = () => setJenis('pemasukan');
  </script>
</body>
</html>
