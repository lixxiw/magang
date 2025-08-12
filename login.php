<?php
session_start();

// Proses login jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "zenik"; // GANTI sesuai nama database kamu

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM login_db WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            // Redirect sesuai role
            if ($user["role"] === "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: galery.php");
            }
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML + CSS dalam satu file -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Zenic Tailor</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 600;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s ease;
        }

        form input:focus {
            border-color: #007bff;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .register-link {
            margin-top: 15px;
            text-align: center;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Form Login</h2>

    <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>

    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>
</div>

</body>
</html>
