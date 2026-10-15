<!-- koneksi.php -->
<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'db_identitas';
$user = 'root';
$pass = '';

try {
    // Buat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Mode exception untuk penanganan error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>