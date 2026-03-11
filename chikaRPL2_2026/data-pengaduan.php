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
            background: linear-gradient(to right,#FCCCFF,#ffffff);
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 85%;
            margin: 50px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #e4aae5;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending { 
            background: #ffc107; 
            color: black; 
        }
        .proses { 
            background: #e372a9; 
            color: white; 
        }
        .selesai {
            background: #edc1e7; 
            color: white; 
        }

        .btn {
            padding: 7px 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-detail { 
            background: #2196F3; 
            color: white; 
        }
        .btn-detail:hover {
            background: #1976d2; 
        }

        .btn-logout { 
            background: #f4caf4; 
            color: white; 
        }
        .btn-logout:hover { 
            background: #df61eb; 
        }

        .btn-kembali { 
            background: #555; 
            color: white; 
        }
        .btn-kembali:hover { 
            background: #333; 
        }

        .button-group {
            margin-top: 25px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="wrapper">
    <div class="card">

        <h2>Data Pengaduan</h2>

        <table>
            <tr>
                <th>No</th>
                <th>ID Kategori</th>
                <th>Nama Kategori</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Status</th>
                <?php if ($role == 'admin') { ?>
                    <th>Aksi</th>
                <?php } ?>
            </tr>

<?php
$nis = $_SESSION['nis'];

$query = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori
    ON input_aspirasi.id_kategori = kategori.id_kategori
    WHERE nis='$nis'
");

while ($data = mysqli_fetch_assoc($query)) {

    $status = strtolower($data['status']);
?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['id_kategori']; ?></td>
                <td><?= $data['ket_kategori']; ?></td>
                <td><?= $data['lokasi']; ?></td>
                <td><?= $data['ket']; ?></td>
                <td>
                    <span class="status <?= $status ?>">
                        <?= ucfirst($data['status']); ?>
                    </span>
                </td>

                <?php if ($role == 'admin') { ?>
                <td>
                    <a href="detail_pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
                        <button class="btn btn-detail">Detail</button>
                    </a>
                </td>
                <?php } ?>
            </tr>
<?php } ?>

        </table>

        <div class="button-group">
            <a href="logout_pengaduan.php">
                <button class="btn btn-logout">Logout</button>
            </a>

            <a href="index.php">
                <button class="btn btn-kembali">Kembali</button>
            </a>
        </div>

    </div>
</div>

</body>
</html>