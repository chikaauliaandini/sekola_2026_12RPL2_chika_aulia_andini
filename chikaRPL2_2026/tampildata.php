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

/* BACKGROUND */
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #d6f0ff, #f0f9ff);
    margin: 0;
    padding: 40px 0;
    display: flex;
    justify-content: center;
}

/* CONTAINER */
.container {
    background: #ffffff;
    width: 95%;
    max-width: 1100px;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0, 170, 255, 0.2);
    border: 3px solid #b3e5ff;
}

/* JUDUL */
h2 {
    text-align: center;
    color: #4aa3df;
    margin-bottom: 25px;
}

/* TABEL */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border: 1px solid #cceeff;
    text-align: center;
}

th {
    background-color: #66cfff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2fbff;
}

tr:hover {
    background-color: #e6f7ff;
}

/* BUTTON */
button {
    padding: 6px 12px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    color: white;
    font-size: 13px;
    transition: 0.2s;
}

/* WARNA BUTTON */
.detail-btn { background-color: #7cc8ff; }
.edit-btn { background-color: #4fb3ff; }
.delete-btn { background-color: #ff7a7a; }
.logout-btn { background-color: #9bbbd4; }
.back-btn { background-color: #66cfff; }

/* HOVER */
.detail-btn:hover { background-color: #5fb8ff; }
.edit-btn:hover { background-color: #2da3ff; }
.delete-btn:hover { background-color: #ff5252; }
.logout-btn:hover { background-color: #7aa6c2; }
.back-btn:hover { background-color: #3fb6ff; }

/* BUTTON GROUP */
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

<h2>Data Pengaduan 💙</h2>

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

<a href="delete-pengaduan.php?id=<?= $data['id_pelaporan']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">
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