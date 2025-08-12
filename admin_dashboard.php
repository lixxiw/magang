  <?php
  session_start();
  require 'koneksi.php';

  if (isset($_POST['add'])) {
    $stmt = mysqli_prepare($conn, "INSERT INTO zenik_taylor (nama, harga, gambar) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sis", $_POST['nama'], $_POST['harga'], $_POST['gambar']);
    mysqli_stmt_execute($stmt);
    header("Location: admin_dashboard.php");
    exit;
  }

  if (isset($_POST['update'])) {
    $stmt = mysqli_prepare($conn, "UPDATE zenik_taylor SET harga = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $_POST['harga'], $_POST['id']);
    mysqli_stmt_execute($stmt);
    header("Location: admin_dashboard.php");
    exit;
  }

  if (isset($_GET['hapus'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM zenik_taylor WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $_GET['hapus']);
    mysqli_stmt_execute($stmt);
    header("Location: admin_dashboard.php");
    exit;
  }

  // ambil data produk
  $result = mysqli_query($conn, "SELECT * FROM zenik_taylor ORDER BY id DESC");
  $daftar = mysqli_fetch_all($result, MYSQLI_ASSOC);
  ?>

  <!DOCTYPE html>
  <html lang="id">
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Lora&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        padding: 20px;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }
      table th, table td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
      }
      form input, form select {
        padding: 6px;
        margin: 5px;
      }
      form button {
        padding: 6px 12px;
        background: #6b4f26;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      form button:hover {
        background: #4e3b1a;
      }
    </style>
  </head>
  <body>

  <h1>Dashboard Admin</h1>

  <!-- Form Tambah Produk -->
  <form method="POST">
    <input type="text" name="nama" placeholder="Nama produk" required>
    <input type="number" name="harga" placeholder="Harga" required>
    
    <!-- Gambar dari folder assets -->
    <select name="gambar" required>
      <?php
        $files = glob("assets/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        foreach ($files as $file) {
          $fileName = basename($file);
          echo "<option value='assets/$fileName'>$fileName</option>";
        }
      ?>
    </select>
    
    <button type="submit" name="add">Tambah Produk</button>
  </form>

  <!-- Tabel Produk -->
  <table>
    <tr>
      <th>ID</th><th>Nama</th><th>Harga</th><th>Gambar</th><th>Aksi</th>
    </tr>
    <?php foreach ($daftar as $p): ?>
    <tr>
      <td><?= $p['id'] ?></td>
      <td><?= htmlspecialchars($p['nama']) ?></td>
      <td>
        <form method="POST" style="display:inline">
          <input type="hidden" name="id" value="<?= $p['id'] ?>">
          <input type="number" name="harga" value="<?= $p['harga'] ?>">
          <button type="submit" name="update">Update</button>
        </form>
      </td>
      <td><img src="<?= htmlspecialchars($p['gambar']) ?>" width="60"></td>
      <td><a href="?hapus=<?= $p['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <p><a href="admin_resi.php">Lihat Data Resi</a></p>

  <style>
    body {
        background-color: #FFF6DA;
        font-family: 'Lora', serif;
        padding: 40px;
      }

      h1 {
        font-family: 'Playfair Display', serif;
        color: #004D3f;
        margin-bottom: 30px;
        font-size: 32px;
        text-align: center;
      }

      form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 30px;
      }

      form input,
      form select {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        min-width: 160px;
      }

      form button {
        background-color: #004D3f;
        color: white;
        border: none;
        padding: 10px 16px;
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s ease;
      }

      form button:hover {
        background-color: #00372e;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      }

      table th {
        background-color: #004D3f;
        color: white;
        padding: 12px;
        font-size: 15px;
        text-transform: uppercase;
      }

      table td {
        padding: 12px;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
      }

      table tr:nth-child(even) {
        background-color: #f9f9f9;
      }

      img {
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      }

      a {
        color: #d9534f;
        font-weight: bold;
        text-decoration: none;
      }
  A
      a:hover {
        text-decoration: underline;
      }

      .update-form input[type="number"] {
        width: 80px;
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
      }

      .update-form button {
        background-color: #28a745;
        padding: 6px 12px;
        font-size: 13px;
        margin-left: 5px;
      }

      .update-form button:hover {
        background-color: #218838;
      }
  </style>
  </body>
  </html>
