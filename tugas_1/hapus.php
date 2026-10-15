<!-- hapus.php -->
<?php
require_once 'koneksi.php';

// Cek parameter id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data berdasarkan id
    $stmt = $pdo->prepare("DELETE FROM identitas WHERE id = ?");
    $stmt->execute([$id]);
}

// Redirect ke halaman utama
header("Location: index.php");
exit;
?>