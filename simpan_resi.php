<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $telepon  = $_POST['telepon'];
    $catatan  = $_POST['catatan'];
    $pesanan  = $_POST['summary'];
    $total    = intval($_POST['total']);

    $stmt = $conn->prepare("INSERT INTO resi (nama, alamat, telepon, catatan, pesanan, total) VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo "ERROR: prepare failed - " . $conn->error;
        exit;
    }

    if (!$stmt->bind_param("sssssi", $nama, $alamat, $telepon, $catatan, $pesanan, $total)) {
        echo "ERROR: bind_param failed - " . $stmt->error;
        exit;
    }

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "ERROR: execute failed - " . $stmt->error;
    }
}
?>
