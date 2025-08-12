

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Penjualan - Zenik Tailor</title>
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <!-- CSS -->
  <link rel="stylesheet" href="ok.css" />
</head>
<body>
  <!-- HEADER --> 
  <header>
    <a href="#" class="logo">ZENIK TAILOR</a>

    <nav class="home">
      <ul class="nav_links">
        <li><a href="index.php">Home</a></li>
        <li><a href="galery.html">Gallery</a></li>
        <li><a href="detail.html">detail</a></li>
      </ul>y
    </nav>

    <div class="header-button" id="headerButtons">
      <button class="contact" onclick="toggleCart()">
        <span class="icon"><i class="fa-solid fa-cart-shopping"></i></span>
        <span class="text">Cart (<span id="cart-count">0</span>)</span>
      </button>
    </div>
  </header>
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

require 'koneksi.php'; // pastikan ini file koneksi

$result = mysqli_query($conn, "SELECT * FROM zenik_taylor ORDER BY id DESC");

while ($p = mysqli_fetch_assoc($result)) {
  echo "
    <div class='gallery-item'>
      <img src='{$p['gambar']}' alt='{$p['nama']}' />
      <h3>{$p['nama']}</h3>
      <p>Rp " . number_format($p['harga'], 0, ',', '.') . "</p>
      <button onclick='addToCart({$p['id']}, \"{$p['nama']}\", {$p['harga']})'>Beli Sekarang</button>
    </div>
  ";
}


?>
 

  <!-- CART POPUP -->
  <div class="cart-popup" id="cart">
    <h2>Keranjang Belanja</h2>
    <ul id="cart-items"></ul>
    <p>Total: Rp <span id="cart-total">0</span></p>
    <button onclick="checkout()">Checkout</button>
    <button onclick="toggleCart()">Tutup</button>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="main-footer">
      <div class="col">
        <img src="assets/logo 2.png" alt="logo" width="200px" class="logo1" />
        <p class="description">our social media:</p>
        <div class="social-container">
          <a href="https://www.instagram.com/zenichandayani" target="_blank"><div class="social-icons"><i class="fa-brands fa-instagram"></i></div></a>
          <a href="https://www.facebook.com/share/1HPYNPqQZD/" target="_blank"><div class="social-icons"><i class="fa-brands fa-facebook"></i></div></a>
          <a href="https://wa.me/628563030053" target="_blank"><div class="social-icons"><i class="fa-brands fa-whatsapp"></i></div></a>
        </div>
      </div>
      <div class="col">
        <h3>Contact us:</h3>
        <p class="description"><i class="fa-brands fa-whatsapp"></i> +62 856-3030-053</p>
        <p class="description"><i class="fa-solid fa-inbox"></i> zenik.handayani@gmail.com</p>
        <p class="description"><i class="fa-solid fa-location-dot"></i> YKP Pandugo 2 F-7, Kec Rungkut, Surabaya</p>
      </div>
    </div>
    <hr />
    <p class="copyright">Zenik Tailor © 2025 - All rights reserved.</p>
  </footer>

 <script>
  // Load cart dari localStorage saat halaman dimuat
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  let cartCount = document.getElementById('cart-count');
  let cartItems = document.getElementById('cart-items');
  let cartTotal = document.getElementById('cart-total');

  function addToCart(id, name, price) {
    cart.push({ id, name, price });
    localStorage.setItem('cart', JSON.stringify(cart)); // Simpan ke localStorage
    updateCartDisplay();
  }

  function updateCartDisplay() {
    cartItems.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
      let li = document.createElement('li');
      li.textContent = `${item.name} - Rp ${item.price.toLocaleString('id-ID')}`;
      cartItems.appendChild(li);
      total += item.price;
    });

    cartCount.textContent = cart.length;
    cartTotal.textContent = total.toLocaleString('id-ID');
  }

  function toggleCart() {
    const cartPopup = document.getElementById('cart');
    cartPopup.style.display = cartPopup.style.display === 'block' ? 'none' : 'block';
  }

  function checkout() {
    window.location.href = "chechkout.php"; // Pindah ke halaman checkout
  }

  // Saat halaman pertama kali dimuat
  document.addEventListener('DOMContentLoaded', updateCartDisplay);
</script>
<style>
  * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
}

body {
  background-color: #f6f8fa;
  color: #333;
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px 0;
}

.galery-title {
  text-align: center;
  font-size: 2em;
  font-weight: bold;
  margin-bottom: 25px;
  color: #ff5722;
}

/* Produk Grid */
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 20px;
}

.card {
  background-color: white;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  transition: transform 0.2s ease;
}

.card:hover {
  transform: scale(1.02);
}

.card-img {
  width: 100%;
  height: 200px;
  overflow: hidden;
  background-color: #eee;
}

.card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.card-body {
  padding: 15px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.card h3 {
  font-size: 18px;
  margin-bottom: 5px;
  color: #333;
}

.card p {
  color: #666;
  margin-bottom: 10px;
  font-weight: bold;
}

.card button {
  padding: 10px 14px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
}

.card button:hover {
  background-color: #218838;
}

/* Cart popup */
.cart-popup {
  position: fixed;
  top: 80px;
  right: 20px;
  width: 300px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  display: none;
  z-index: 999;
}

.cart-popup h2 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #ff5722;
}

.cart-popup ul {
  list-style: none;
  padding-left: 0;
  max-height: 200px;
  overflow-y: auto;
  margin-bottom: 10px;
}

.cart-popup li {
  padding: 5px 0;
  border-bottom: 1px solid #eee;
  font-size: 14px;
}

.cart-popup button {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border: none;
  border-radius: 6px;
  background-color: #ff5722;
  color: white;
  cursor: pointer;
}

.cart-popup button:hover {
  background-color: #e64a19;
}


</style>
</body>
</html>
