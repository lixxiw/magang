<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h2>Selamat datang Admin <?php echo $_SESSION['username']; ?>!</h2>
<a href="logout.php">Logout</a>
</body>
</html>
