<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

$role = $_SESSION['role'];
$no = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pengaduan</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #ccecff, #ffffff);
    margin: 0;
    padding: 40px 0;
    display: flex;
    justify-content: center;
}

.container {
    background: #ffffff;
    width: 95%;
    max-width: 1100px;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #66c2ff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f9ff;
}

button {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    color: white;
    font-size: 13px;
}

.detail-btn { background-color: #3498db; }
.edit-btn { background-color: #2ecc71; }
.delete-btn { background-color: #e74c3c; }
.logout-btn { background-color: #95a5a6; }
.back-btn { background-color: #2980b9; }

.button-group {
    margin-top: 25px;
    text-align: center;
}

.button-group a {
    margin: 5px;
    text-decoration: none;
}
</style>

</head>
<body>

<div class="container">

<h2>Data Pengaduan</h2>

<table>
<tr>
    <th>No</th>
    <th>ID Kategori</th>
    <th>Nama Kategori</th>
    <th>Lokasi</th>
    <th>Keterangan</th>
    <th>Status</th>
    <th>Feedback</th>
    <?php if ($role == 'admin') { ?>
        <th>Aksi</th>
    <?php } ?>
</tr>

<?php
$query = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori
        ON input_aspirasi.id_kategori = kategori.id_kategori
");

while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $data['id_kategori']; ?></td>
    <td><?= $data['ket_kategori']; ?></td>
    <td><?= $data['lokasi']; ?></td>
    <td><?= htmlspecialchars($data['ket']); ?></td>
    <td><?= ucfirst($data['status']); ?></td>
    <td><?= ucfirst(htmlspecialchars($data['feedback'] ?? '')); ?></td>

    <?php if ($role == 'admin') { ?>
    <td>
        <a href="detail-pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
            <button class="detail-btn">Detail</button>
        </a>

        <a href="edit-pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
            <button class="edit-btn">Edit</button>
        </a>

        <a href="delete-pengaduan.php?id=<?= $data['id_pelaporan']; ?>"
           onclick="return confirm('Yakin ingin menghapus data ini?')">
            <button class="delete-btn">Delete</button>
        </a>
    </td>
    <?php } ?>
</tr>

<?php } ?>

</table>

<div class="button-group">
    <a href="logout-pengaduan.php">
        <button class="logout-btn">Logout</button>
    </a>

    <a href="index.php">
        <button class="back-btn">Kembali</button>
    </a>
</div>

</div>

</body>
</html>