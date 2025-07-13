<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id_transaksi'];
  $jenis = $_POST['jenis'];
  $jumlah = $_POST['jumlah'];
  $kategori = $_POST['kategori'];
  $keterangan = $_POST['keterangan'];
  $tanggal = $_POST['tanggal'];

  $q = $koneksi->prepare("UPDATE transaksi SET jenis=?, jumlah=?, kategori=?, keterangan=?, tanggal=? WHERE id_transaksi=?");
  $q->bind_param("sisssi", $jenis, $jumlah, $kategori, $keterangan, $tanggal, $id);
  $q->execute();
}

header("Location: admin_dashboard.php");
