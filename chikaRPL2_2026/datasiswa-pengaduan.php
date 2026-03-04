<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'];
$nis  = $_SESSION['nis'];
$no   = 1;

$query = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori
    ON input_aspirasi.id_kategori = kategori.id_kategori
    WHERE nis='$nis'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pengaduan</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

body {
    background: linear-gradient(to right, #dbeafe, #bfdbfe);
    min-height: 100vh;
    margin: 0;
    padding: 40px;
}

h2 {
    text-align: center;
    color: #1e3a8a;
    margin-bottom: 30px;
}

.table-container {
    max-width: 1000px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(30, 58, 138, 0.15);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background-color: #2563eb;
    color: white;
    padding: 10px;
    font-size: 14px;
}

td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #e5e7eb;
    font-size: 13px;
}

tr:hover {
    background-color: #eff6ff;
}

button {
    padding: 6px 12px;
    border: none;
    border-radius: 8px;
    font-size: 12px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-detail {
    background-color: #3b82f6;
    color: white;
}

.btn-detail:hover {
    background-color: #1d4ed8;
}

.btn-logout {
    background-color: #ef4444;
    color: white;
}

.btn-logout:hover {
    background-color: #dc2626;
}

.btn-kembali {
    background-color: #60a5fa;
    color: white;
}

.btn-kembali:hover {
    background-color: #3b82f6;
}

.button-group {
    text-align: center;
    margin-top: 25px;
}
</style>

</head>
<body>

<h2>Data Pengaduan</h2>

<div class="table-container">
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

<?php while ($data = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $data['id_kategori']; ?></td>
    <td><?= htmlspecialchars($data['ket_kategori']); ?></td>
    <td><?= htmlspecialchars($data['lokasi']); ?></td>
    <td><?= htmlspecialchars($data['ket']); ?></td>
    <td><?= ucfirst($data['status']); ?></td>
    <td><?= !empty($data['feedback']) ? ucfirst(htmlspecialchars($data['feedback'])) : '-'; ?></td>

    <?php if ($role == 'admin') { ?>
    <td>
        <a href="detail-pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
            <button class="btn-detail">Detail</button>
        </a>
    </td>
    <?php } ?>
</tr>
<?php } ?>

</table>
</div>

<div class="button-group">
    <a href="logout_pengaduan.php">
        <button class="btn-logout">Logout</button>
    </a>

    <a href="index.php">
        <button class="btn-kembali">Kembali</button>
    </a>
</div>

</body>
</html>