<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['id_pengguna'])) {
  header("Location: login.html");
  exit();
}

$nama     = $_POST['nama_rencana'];
$total    = $_POST['total_anggaran'];
$hari     = $_POST['durasi_hari'];
$darurat  = $_POST['dana_darurat'];
$saran    = $_POST['saran_harian'];
$id_user  = $_SESSION['id_pengguna'];

$stmt = $koneksi->prepare("INSERT INTO perencanaan (nama_rencana, total_anggaran, durasi_hari, dana_darurat, saran_harian, id_pengguna) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiidi", $nama, $total, $hari, $darurat, $saran, $id_user);

if ($stmt->execute()) {
  echo "<script>alert('Rencana berhasil disimpan!'); window.location='rencana.php';</script>";
} else {
  echo "<script>alert('Gagal menyimpan rencana'); window.history.back();</script>";
}
?>
