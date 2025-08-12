<?php
require 'koneksi.php';
$resi = $conn->query("SELECT * FROM resi ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Resi - Zenik Tailor</title>
  <style>
    body { font-family: Arial; padding: 20px; background: #f9f9f9; }
    h1 { text-align: center; }
    table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background-color: #004D3f; color: white; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    .back { margin-top: 20px; display: block; text-align: center; }
  </style>
</head>
<body>

<h1>Daftar Resi Masuk</h1>

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
  <?php while($r = $resi->fetch_assoc()): ?>
  <tr>
    <td><?= $r['id'] ?></td>
    <td><?= htmlspecialchars($r['nama']) ?></td>
    <td><?= htmlspecialchars($r['alamat']) ?></td>
    <td><?= htmlspecialchars($r['telepon']) ?></td>
    <td><?= htmlspecialchars($r['catatan']) ?></td>
    <td><pre><?= htmlspecialchars($r['pesanan']) ?></pre></td>
    <td>Rp <?= number_format($r['total'], 0, ',', '.') ?></td>
    <td><?= $r['tanggal'] ?></td>
  </tr>
  <?php endwhile; ?>
</table>

<a href="admin_dashboard.php" class="back">← Kembali ke Dashboard</a>

</body>
</html>
