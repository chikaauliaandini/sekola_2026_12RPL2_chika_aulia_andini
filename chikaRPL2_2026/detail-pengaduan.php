<?php
session_start();
include 'koneksi.php';

/* 
Contoh set role (biasanya dari login):
$_SESSION['role'] = 'admin';
$_SESSION['role'] = 'siswa';
*/

if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

// CEK ID PELAPORAN
if (!isset($_GET['id'])) {
    echo "ID pengaduan tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$role = $_SESSION['role'];

// PROSES UPDATE DATA HANYA UNTUK ADMIN
if ($role == 'admin' && isset($_POST['simpan'])) {
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $feedback = mysqli_real_escape_string($koneksi, $_POST['feedback']);

    $update = mysqli_query($koneksi, "
        UPDATE input_aspirasi 
        SET status='$status', feedback='$feedback' 
        WHERE id_pelaporan='$id'
    ");

    
    if ($update) {
        
        // header("location:admin.php");
        header("Location: datasiswa-pengaduan.php");
        exit;
    } else {
        echo "Gagal menyimpan data!";
        exit;
    }
}

// AMBIL DATA PENGADUAN DENGAN JOIN KATEGORI
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
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 700px; margin: auto; }
        table { border-collapse: collapse; width: 100%; }
        td { padding: 10px; border: 1px solid #ccc; vertical-align: top; }
        b { color: #333; }
        select, textarea { width: 100%; padding: 8px; font-size: 14px; }
        button { padding: 10px 20px; background: #2ecc71; color: white; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background: #27ae60; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #2980b9; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>Detail Pengaduan</h2>
<p><b>Role:</b> <?= htmlspecialchars(ucfirst($role)) ?></p>

<form method="POST" action="">
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

<a href="index.php">← Kembali</a>

</body>
</html>