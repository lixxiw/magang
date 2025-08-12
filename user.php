<?php
session_start();
// if (!isset($_SESSION['username'])) { header("Location: login.php"); exit; }
require 'koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$daftar = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Produk Zenik</title></head><body>
<h2>Produk Zenik Tailor</h2>
<div class="produk-container">
  <?php foreach($daftar as $p): ?>
    <div class="card">
      <img src="<?= htmlspecialchars($p['gambar']) ?>" width="150"><br>
      <strong><?= htmlspecialchars($p['nama']) ?></strong><br>
      Rp <?= number_format($p['harga'],0,',','.') ?><br>
      <button onclick="addToCart(<?= $p['id'] ?>, '<?= addslashes($p['nama']) ?>', <?= $p['harga'] ?>)">Beli Sekarang</button>
    </div>
  <?php endforeach; ?>
</div>
<script>
let cart = JSON.parse(localStorage.getItem('cart')) || [];
function addToCart(id,name,price){
  cart.push({id,name,price, qty:1});
  localStorage.setItem('cart', JSON.stringify(cart));
  alert(`${name} ditambahkan ke keranjang`);
}
</script>
<a href="checkout.php">Lihat Keranjang</a>
</body></html>
