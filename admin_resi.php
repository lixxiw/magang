<?php
session_start();
require 'koneksi.php';

// Cek apakah user sudah login dan role-nya admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}


// Ambil data resi dari database
$query = "SELECT * FROM resi ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Resi - Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Lora&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f4f4f4;
      font-family: 'Lora', serif;
      padding: 40px;
    }

    h1 {
      text-align: center;
      color: #004D3f;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      font-family: 'Montserrat', sans-serif;
      font-size: 14px;
    }

    th {
      background-color: #004D3f;
      color: white;
      text-transform: uppercase;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .logout-link {
      display: block;
      margin-bottom: 20px;
      text-align: right;
    }

    .logout-link a {
      color: #d9534f;
      font-weight: bold;
      text-decoration: none;
    }

    .logout-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="logout-link">
  <a href="admin_dashboard.php">← Kembali ke Dashboard</a>
</div>

<h1>Data Resi Pelanggan</h1>

<table>
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Telepon</th>
    <th>Catatan</th>
    <th>Pesanan</th>
    <th>Total</th>
    <th>Tanggal</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['nama']) ?></td>
    <td><?= nl2br(htmlspecialchars($row['alamat'])) ?></td>
    <td><?= htmlspecialchars($row['telepon']) ?></td>
    <td><?= nl2br(htmlspecialchars($row['catatan'])) ?></td>
    <td><?= nl2br(htmlspecialchars($row['pesanan'])) ?></td>
    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
    <td><?= $row['tanggal'] ?></td>
  </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
