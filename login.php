<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil data pengguna berdasarkan email
    $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $data['password'])) {
            // Set session
            $_SESSION['id_pengguna'] = $data['id_pengguna'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $data['level'];

            // Redirect berdasarkan level
            if ($data['level'] === 'admin') {
                echo "<script>alert('Login Admin berhasil'); window.location='admin/admin_dashboard.php';</script>";
            } else {
                echo "<script>alert('Login berhasil'); window.location='index.php';</script>";
            }
            exit();
        } else {
            echo "<script>alert('Password salah'); window.location='login.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Email tidak ditemukan'); window.location='login.html';</script>";
        exit();
    }
}
?>
