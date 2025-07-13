<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tanggal = date('Y-m-d');

    $cek = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar'); window.location='register.html';</script>";
    } else {
        $stmt = $koneksi->prepare("INSERT INTO pengguna (nama, email, password, tanggal_daftar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $password, $tanggal);
        if ($stmt->execute()) {
            echo "<script>alert('Pendaftaran berhasil'); window.location='login.html';</script>";
        } else {
            echo "<script>alert('Gagal mendaftar'); window.history.back();</script>";
            echo "Debug: " . $stmt->error;
        }
    }
}
?>
