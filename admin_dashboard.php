<?php
session_start();
include '../koneksi.php';

// Cek apakah sudah login
if (!isset($_SESSION['id_pengguna'])) {
  header("Location: ../login.php");
  exit();
}

// Cek apakah level-nya adalah admin
if ($_SESSION['level'] != 'admin') {
  echo "<script>alert('Akses ditolak. Hanya admin yang boleh mengakses.'); window.location='../index.php';</script>";
  exit();
}

// Ambil semua pengguna biasa (exclude admin)
$pengguna = $koneksi->query("SELECT * FROM pengguna WHERE level = 'user' ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Data Pengguna</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h3 class="mb-4 text-center">👤 Admin Dashboard: Data Pengguna Biasa</h3>

    <?php while ($user = $pengguna->fetch_assoc()): ?>
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">👤 <?= htmlspecialchars($user['nama']) ?> (<?= $user['email'] ?>)</h5>
        </div>
        <div class="card-body">

          <!-- Transaksi -->
          <h6 class="text-muted">📒 Transaksi</h6>
          <table class="table table-bordered table-sm mb-4">
            <thead class="table-light">
              <tr>
                <th>Jenis</th><th>Jumlah</th><th>Kategori</th><th>Keterangan</th><th>Tanggal</th><th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $id = $user['id_pengguna'];
              $transaksi = $koneksi->query("SELECT * FROM transaksi WHERE id_pengguna = $id ORDER BY tanggal DESC");
              if ($transaksi->num_rows > 0):
                while ($t = $transaksi->fetch_assoc()):
              ?>
              <tr>
                <td><?= htmlspecialchars($t['jenis']) ?></td>
                <td>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($t['kategori']) ?></td>
                <td><?= htmlspecialchars($t['keterangan']) ?></td>
                <td><?= $t['tanggal'] ?></td>
                <td>
                  <a href="edit_transaksi.php?id=<?= $t['id_transaksi'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="hapus_transaksi.php?id=<?= $t['id_transaksi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr><td colspan="6" class="text-center text-muted">Tidak ada transaksi</td></tr>
              <?php endif; ?>
            </tbody>
          </table>

          <!-- Rencana -->
          <h6 class="text-muted">🗓️ Rencana Keuangan</h6>
          <table class="table table-bordered table-sm">
            <thead class="table-light">
              <tr>
                <th>Rencana</th><th>Total</th><th>Durasi</th><th>Darurat</th><th>Harian</th><th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $rencana = $koneksi->query("SELECT * FROM perencanaan WHERE id_pengguna = $id");
              if ($rencana->num_rows > 0):
                while ($r = $rencana->fetch_assoc()):
              ?>
              <tr>
                <td><?= htmlspecialchars($r['nama_rencana']) ?></td>
                <td>Rp <?= number_format($r['total_anggaran'], 0, ',', '.') ?></td>
                <td><?= $r['durasi_hari'] ?> hari</td>
                <td>Rp <?= number_format($r['dana_darurat'], 0, ',', '.') ?></td>
                <td>Rp <?= number_format($r['saran_harian'], 0, ',', '.') ?></td>
                <td>
                  <a href="edit_rencana.php?id=<?= $r['id_rencana'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="hapus_rencana.php?id=<?= $r['id_rencana'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr><td colspan="6" class="text-center text-muted">Tidak ada rencana</td></tr>
              <?php endif; ?>
            </tbody>
          </table>

        </div>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
