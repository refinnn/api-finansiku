<?php
session_start();           // Mulai session
session_destroy();         // Hapus semua data session
header("Location: login.html"); // Arahkan ke halaman login
exit();
?>
