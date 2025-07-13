<?php
session_start();
include 'koneksi.php';

$id_pengguna = $_SESSION['id_pengguna'];
$query = "SELECT kategori, SUM(jumlah) as total FROM transaksi WHERE jenis = 'pengeluaran' AND id_pengguna = ? GROUP BY kategori";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_pengguna);
$stmt->execute();
$result = $stmt->get_result();

$labels = [];
$values = [];

while ($row = $result->fetch_assoc()) {
  $labels[] = $row['kategori'];
  $values[] = $row['total'];
}

echo json_encode(['labels' => $labels, 'values' => $values]);
?>
