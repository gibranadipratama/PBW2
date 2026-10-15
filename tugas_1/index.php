<!-- index.php (READ) -->
<?php
require_once 'koneksi.php';

// Ambil semua data identitas urut dari terbaru
$stmt = $pdo->query("SELECT * FROM identitas ORDER BY id DESC");
$semuaData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Identitas (Read)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-secondary">Manajemen Identitas</h2>
        <!-- Link ke form tambah -->
        <a href="tambah.php" class="btn btn-primary shadow-sm">+ Tambah Data</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">TTL</th>
                        <th class="p-3">L/P</th>
                        <th class="p-3">Agama</th>
                        <th class="p-3">Alamat</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($semuaData) > 0): ?>
                        <?php $no = 1; foreach ($semuaData as $row): ?>
                            <tr>
                                <td class="p-3 text-center"><?= $no++ ?></td>
                                <!-- htmlspecialchars untuk cegah XSS -->
                                <td class="p-3 fw-medium"><?= htmlspecialchars($row['nama']) ?></td>
                                <td class="p-3"><?= htmlspecialchars($row['tempat_lahir']) ?>, <?= date('d-m-Y', strtotime($row['tanggal_lahir'])) ?></td>
                                <td class="p-3"><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                <td class="p-3"><?= htmlspecialchars($row['agama']) ?></td>
                                <td class="p-3 text-truncate" style="max-width: 200px;"><?= htmlspecialchars($row['alamat']) ?></td>
                                <td class="p-3 text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <!-- Tombol Edit bawa parameter id -->
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                        <!-- Tombol Hapus dengan konfirmasi -->
                                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="p-4 text-center text-muted">Data kosong.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>