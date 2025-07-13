<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM transaksi WHERE id_transaksi=$id")->fetch_assoc();
?>

<h3>Edit Transaksi</h3>
<form method="post" action="proses_edit_transaksi.php">
  <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">
  Jenis: <input type="text" name="jenis" value="<?= $data['jenis'] ?>"><br>
  Jumlah: <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>"><br>
  Kategori: <input type="text" name="kategori" value="<?= $data['kategori'] ?>"><br>
  Keterangan: <input type="text" name="keterangan" value="<?= $data['keterangan'] ?>"><br>
  Tanggal: <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>"><br>
  <button type="submit">Simpan</button>
</form>
