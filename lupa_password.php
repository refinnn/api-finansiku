<?php
include 'koneksi.php';
session_start();

$showResetForm = false;
$email = "";
$sukses = false;

// Proses tahap 1: cek email
if (isset($_POST['cek_email'])) {
    $email = $_POST['email'];
    $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $showResetForm = true;
    } else {
        echo "<script>alert('Email tidak ditemukan');</script>";
    }
}

// Proses tahap 2: simpan password baru
if (isset($_POST['ganti_password'])) {
    $email = $_POST['email'];
    $passwordBaru = $_POST['password'];
    $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);

    $stmt = $koneksi->prepare("UPDATE pengguna SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hash, $email);
    if ($stmt->execute()) {
        $sukses = true;
    } else {
        echo "<script>alert('Gagal mengubah password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow p-4">
          <h4 class="text-center mb-4">Lupa Password</h4>

          <?php if ($sukses): ?>
            <div class="alert alert-success">Password berhasil diubah. <a href="login.html">Login sekarang</a></div>
          <?php elseif (!$showResetForm): ?>
            <!-- Form Cek Email -->
            <form method="POST">
              <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <button type="submit" name="cek_email" class="btn btn-primary w-100">Cek Email</button>
            </form>
          <?php else: ?>
            <!-- Form Ganti Password -->
            <form method="POST">
              <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
              <div class="mb-3">
                <label>Password Baru:</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" name="ganti_password" class="btn btn-success w-100">Simpan Password Baru</button>
            </form>
          <?php endif; ?>

          <div class="mt-3 text-center">
            <a href="login.html">← Kembali ke Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
