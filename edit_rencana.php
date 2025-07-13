<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM perencanaan WHERE id_rencana=$id")->fetch_assoc();
?>

<h3>Edit Rencana</h3>
<form method="post" action="proses_edit_rencana.php">
  <input type="hidden" name="id_rencana" value="<?= $data['id_rencana'] ?>">
  Nama Rencana: <input type="text" name="nama_rencana" value="<?= $data['nama_rencana'] ?>"><br>
  Total Anggaran: <input type="number" name="total_anggaran" value="<?= $data['total_anggaran'] ?>"><br>
  Durasi Hari: <input type="number" name="durasi_hari" value="<?= $data['durasi_hari'] ?>"><br>
  Dana Darurat: <input type="number" name="dana_darurat" value="<?= $data['dana_darurat'] ?>"><br>
  Saran Harian: <input type="number" name="saran_harian" value="<?= $data['saran_harian'] ?>"><br>
  <button type="submit">Simpan</button>
</form>
