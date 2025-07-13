<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mulai session untuk ambil id_pengguna
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_pengguna'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href='login.html';</script>";
    exit();
}

// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $jenis      = $_POST['jenis'];
    $jumlah     = $_POST['jumlah'];
    $kategori   = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];
    $tanggal    = $_POST['tanggal'];
    $id_pengguna = $_SESSION['id_pengguna'];

    // Siapkan query untuk simpan data
    $query = "INSERT INTO transaksi (jenis, jumlah, kategori, keterangan, tanggal, id_pengguna) 
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sisssi", $jenis, $jumlah, $kategori, $keterangan, $tanggal, $id_pengguna);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Transaksi berhasil disimpan!'); window.location.href='catat.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
}

$koneksi->close();
?>
