<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID pengaduan tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$role = $_SESSION['role'];

if ($role == 'admin' && isset($_POST['simpan'])) {

    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $feedback = mysqli_real_escape_string($koneksi, $_POST['feedback']);

    $update = mysqli_query($koneksi, "
        UPDATE input_aspirasi 
        SET status='$status', feedback='$feedback' 
        WHERE id_pelaporan='$id'
    ");

    if ($update) {
        header("Location: tampildata.php");
        exit;
    } else {
        echo "Gagal menyimpan data!";
        exit;
    }
}

$query = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
    WHERE input_aspirasi.id_pelaporan = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data pengaduan tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Pengaduan</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #ccecff, #ffffff);
    margin: 0;
    padding: 50px 0;
    display: flex;
    justify-content: center;
}

.container {
    background: #ffffff;
    width: 95%;
    max-width: 750px;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 10px;
}

.role {
    text-align: center;
    color: #3498db;
    margin-bottom: 25px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 12px;
    border: 1px solid #ddd;
    vertical-align: top;
}

td b {
    color: #2c3e50;
}

select, textarea {
    width: 100%;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

textarea {
    resize: none;
}

button {
    background-color: #66c2ff;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

button:hover {
    background-color: #3498db;
}

.back-link {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    background-color: #95a5a6;
    color: white;
    padding: 8px 15px;
    border-radius: 6px;
}

.back-link:hover {
    background-color: #7f8c8d;
}
</style>

</head>
<body>

<div class="container">

<h2>Detail Pengaduan</h2>
<p class="role"><b>Role:</b> <?= htmlspecialchars(ucfirst($role)) ?></p>

<form method="POST">

<table>
<tr>
    <td><b>ID Pengaduan</b></td>
    <td><?= htmlspecialchars($data['id_pelaporan']) ?></td>
</tr>
<tr>
    <td><b>Kategori</b></td>
    <td><?= htmlspecialchars($data['ket_kategori'] ?? '-') ?></td>
</tr>
<tr>
    <td><b>Lokasi</b></td>
    <td><?= htmlspecialchars($data['lokasi'] ?? '-') ?></td>
</tr>
<tr>
    <td><b>Keterangan</b></td>
    <td><?= nl2br(htmlspecialchars($data['ket'] ?? '-')) ?></td>
</tr>

<tr>
    <td><b>Status</b></td>
    <td>
        <?php if ($role == 'admin'): ?>
            <select name="status" required>
                <option value="menunggu" <?= ($data['status']=='menunggu') ? 'selected' : '' ?>>Menunggu</option>
                <option value="proses" <?= ($data['status']=='proses') ? 'selected' : '' ?>>Proses</option>
                <option value="selesai" <?= ($data['status']=='selesai') ? 'selected' : '' ?>>Selesai</option>
            </select>
        <?php else: ?>
            <?= htmlspecialchars(ucfirst($data['status'] ?? '-')) ?>
        <?php endif; ?>
    </td>
</tr>

<?php if ($role == 'admin'): ?>
<tr>
    <td><b>Feedback Admin</b></td>
    <td>
        <textarea name="feedback" rows="5"><?= htmlspecialchars($data['feedback'] ?? '') ?></textarea>
    </td>
</tr>
<?php endif; ?>

</table>

<br>

<?php if ($role == 'admin'): ?>
<button type="submit" name="simpan">Simpan Perubahan</button>
<?php endif; ?>

</form>

<a href="tampildata.php" class="back-link">← Kembali</a>

</div>

</body>
</html>