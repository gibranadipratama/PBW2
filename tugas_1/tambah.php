<!-- tambah.php -->
<?php
require_once 'koneksi.php';

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];

    // Insert data (Prepared Statement untuk cegah SQL Injection)
    $stmt = $pdo->prepare("INSERT INTO identitas (nama, alamat, tempat_lahir, tanggal_lahir, jenis_kelamin, agama) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $alamat, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama]);
    
    // Redirect ke halaman utama
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Identitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100 py-5">
<div class="container">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 700px;">
        <div class="card-body p-4 p-md-5">
            <h3 class="card-title text-secondary mb-4 text-center">Tambah Identitas</h3>
            <form action="" method="POST" class="row g-3">
                <div class="col-12">
                    <label class="form-label text-muted">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Agama</label>
                    <select name="agama" class="form-select" required>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label text-muted">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="form-control" required></textarea>
                </div>
                <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>