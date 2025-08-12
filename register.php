<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <style>
    .register-container {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background-color: #f7f7f7;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      font-family: Arial, sans-serif;
    }

    .register-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input, select, button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Register</h2>
    <form action="" method="POST">
      <label>Role:</label>
      <select name="role" required>
        <option value="">--Pilih Role--</option>
<option value="</option>
        <option value="user">User</option>
      </select>

      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit">Daftar</button>
       <div class="login-link">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "zenik";

        // Ambil data dengan aman
        $role = isset($_POST['role']) ? $_POST['role'] : null;
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        if (!$role || !$username || !$password) {
            echo "<p style='color:red;'>Semua field wajib diisi.</p>";
        } else {
            // Koneksi DB
            $conn = new mysqli($host, $user, $pass, $db);
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Enkripsi password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert
           $sql = "INSERT INTO login_db (role, username, password) VALUES (?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $role, $username, $hashedPassword);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>Registrasi berhasil. <a href='login.php'>Login di sini</a></p>";
            } else {
                echo "<p style='color:red;'>Gagal registrasi: " . $stmt->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
    }
    ?>
  </div>
</body>
</html>
