<?php
include 'koneksi.php';

$keyword = "";
$hasil = [];
$statusList = ["menunggu", "proses", "selesai"];

if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $sql = "SELECT * FROM input_aspirasi 
            WHERE nis LIKE '%$keyword%' 
               OR lokasi LIKE '%$keyword%'";
    $query = mysqli_query($koneksi, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $hasil[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cari Pengaduan</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: linear-gradient(to right, #dbeafe, #bfdbfe);
    display: flex;
    justify-content: center;
    padding: 50px 0;
    margin: 0;
}

.container {
    background: #ffffff;
    padding: 40px 30px;
    border-radius: 18px;
    box-shadow: 0 15px 30px rgba(30, 58, 138, 0.15);
    width: 950px;
}

h2 {
    text-align: center;
    color: #1e3a8a;
    margin-bottom: 20px;
}

input[type=text] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: 1px solid #93c5fd;
    font-size: 14px;
}

input[type=text]:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
}

button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: #2563eb;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #1d4ed8;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 25px;
}

th, td {
    padding: 10px;
    text-align: center;
    font-size: 13px;
}

th {
    background: #3b82f6;
    color: white;
}

td {
    border-bottom: 1px solid #e5e7eb;
}

tr:hover {
    background: #eff6ff;
}

.detail-btn {
    background: #60a5fa;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
    transition: 0.3s;
}

.detail-btn:hover {
    background: #3b82f6;
}

.status-select {
    padding: 6px;
    border-radius: 8px;
    border: 1px solid #93c5fd;
    background: #f0f9ff;
}

.back-btn {
    display: block;
    margin-top: 30px;
    text-align: center;
    background: #2563eb;
    color: white;
    padding: 12px;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.3s;
}

.back-btn:hover {
    background: #1d4ed8;
}
</style>
</head>

<body>

<div class="container">
<h2>Cari Pengaduan</h2>

<form method="GET">
    <input type="text" name="keyword" placeholder="Cari NIS atau Lokasi"
           value="<?= htmlspecialchars($keyword); ?>" required>
    <button type="submit" name="cari">Cari</button>
</form>

<?php if (isset($_GET['cari'])) { ?>
<h3 style="margin-top:25px; color:#1e3a8a;">Hasil Pencarian</h3>

<?php if ($hasil) { ?>
<table>
<tr>
    <th>NO</th>
    <th>TANGGAL</th>
    <th>NIS</th>
    <th>KETERANGAN</th>
    <th>LOKASI</th>
    <th>STATUS</th>
    <th>AKSI</th>
</tr>

<?php $no=1; foreach ($hasil as $h) { ?>
<tr>
    <td><?= $no++; ?></td>

    <td><?= date('d-m-Y', strtotime($h['tanggal'])); ?></td>

    <td><?= htmlspecialchars($h['nis']); ?></td>

    <td>
        <?= htmlspecialchars(
            strlen($h['ket']) > 40
            ? substr($h['ket'],0,40).'...'
            : $h['ket']
        ); ?>
    </td>

    <td><?= htmlspecialchars($h['lokasi']); ?></td>

    <td>
        <select class="status-select" disabled>
            <?php foreach ($statusList as $s) { ?>
                <option <?= ($h['status']==$s)?'selected':''; ?>>
                    <?= ucfirst($s); ?>
                </option>
            <?php } ?>
        </select>
    </td>

    <td>
        <a class="detail-btn"
           href="detail-pengaduan.php?id=<?= $h['id_pelaporan']; ?>">
           Detail
        </a>
    </td>
</tr>
<?php } ?>

</table>
<?php } else { ?>
<p style="color:red;text-align:center;margin-top:20px;">Data tidak ditemukan</p>
<?php } } ?>

<a href="index.php" class="back-btn">← Kembali</a>
</div>

</body>
</html>