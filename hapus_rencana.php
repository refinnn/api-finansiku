<?php
include '../koneksi.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM perencanaan WHERE id_rencana=$id");
header("Location: admin_dashboard.php");
?>
