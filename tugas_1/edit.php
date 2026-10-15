<!-- edit.php -->
<?php
require_once 'koneksi.php';

// Cek parameter id di URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Ambil data lama berdasarkan id
$stmt = $pdo->prepare("SELECT * FROM identitas WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Cek apakah data ditemukan
if (!$data) {
    header("Location: index.php");
    exit;
}

// Proses update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input form terbaru
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];

    // Update data di database
    $stmtUpdate = $pdo->prepare("UPDATE identitas SET nama=?, alamat=?, tempat_lahir=?, tanggal_lahir=?, jenis_kelamin=?, agama=? WHERE id=?");
    $stmtUpdate->execute([$nama, $alamat, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $id]);
    
    // Redirect ke halaman utama
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Identitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100 py-5">
<div class="container">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 700px;">
        <div class="card-body p-4 p-md-5">
            <h3 class="card-title text-secondary mb-4 text-center">Edit Identitas</h3>
            <form action="" method="POST" class="row g-3">
                <!-- Set value input dengan data lama -->
                <div class="col-12">
                    <label class="form-label text-muted">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($data['tempat_lahir']) ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($data['tanggal_lahir']) ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Jenis Kelamin</label>
                    <!-- Tandai opsi yang terpilih sebelumnya -->
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Agama</label>
                    <select name="agama" class="form-select" required>
                        <?php
                        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                        foreach ($agamaList as $ag) {
                            $selected = ($data['agama'] == $ag) ? 'selected' : '';
                            echo "<option value=\"$ag\" $selected>$ag</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label text-muted">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="form-control" required><?= htmlspecialchars($data['alamat']) ?></textarea>
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