<?php
// koneksi.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'finanasiku';

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die('Koneksi gagal: ' . $koneksi->connect_error);
}
?>


