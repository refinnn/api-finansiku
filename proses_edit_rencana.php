<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id_rencana'];
  $nama = $_POST['nama_rencana'];
  $total = $_POST['total_anggaran'];
  $durasi = $_POST['durasi_hari'];
  $darurat = $_POST['dana_darurat'];
  $harian = $_POST['saran_harian'];

  $q = $koneksi->prepare("UPDATE perencanaan SET nama_rencana=?, total_anggaran=?, durasi_hari=?, dana_darurat=?, saran_harian=? WHERE id_rencana=?");
  $q->bind_param("siiiii", $nama, $total, $durasi, $darurat, $harian, $id);
  $q->execute();
}

header("Location: admin_dashboard.php");
