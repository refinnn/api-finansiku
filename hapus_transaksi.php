<?php
include '../koneksi.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM transaksi WHERE id_transaksi=$id");
header("Location: admin_dashboard.php");
?>
