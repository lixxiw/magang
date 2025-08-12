<?php
$servername = "localhost";
$username = "root";
$password = ""; // ganti sesuai
$dbname = "zenik";

// buat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
