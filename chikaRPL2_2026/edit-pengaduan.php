<?php
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_chika.sql");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$kolom = ["feedback TEXT", 
          "status VARCHAR(20)", 
          "lokasi VARCHAR(100)", 
          "kategori VARCHAR(100)"];

foreach($kolom as $k){
    $nama = explode(" ",$k)[0];
    $cek = mysqli_query($koneksi,"SHOW COLUMNS FROM user LIKE '$nama'");
    if(mysqli_num_rows($cek)==0){
        mysqli_query($koneksi,"ALTER TABLE user ADD $k");
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

$feedback = $row['feedback'] ?? '';
$status   = $row['status'] ?? '';
$lokasi   = $row['lokasi'] ?? '';
$kategori = $row['kategori'] ?? '';

if (isset($_POST['submit'])) {

    $feedback = $_POST['feedback'] ?? '';
    $status   = $_POST['status'] ?? '';
    $lokasi   = $_POST['lokasi'] ?? '';
    $kategori = $_POST['kategori'] ?? '';

    mysqli_query($koneksi,"
        UPDATE user 
        SET feedback='$feedback',
            status='$status',
            lokasi='$lokasi',
            kategori='$kategori'
        WHERE id='$id'
    ");

    header("Location: tampildata.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pengaduan</title>

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #ccecff, #ffffff);
    margin:0;
    padding:60px 0;
    display:flex;
    justify-content:center;
}

.box{
    width:420px;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    color:#2c3e50;
    margin-bottom:20px;
}

label{
    font-weight:600;
    color:#2c3e50;
}

textarea, select, input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}

textarea{
    resize:none;
}

button{
    padding:10px 15px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
    color:white;
}

.btn-update{
    background:#66c2ff;
}

.btn-update:hover{
    background:#3498db;
}

.btn-back{
    background:#95a5a6;
}

.btn-back:hover{
    background:#7f8c8d;
}

.button-group{
    display:flex;
    justify-content:space-between;
}
</style>

</head>

<body>

<div class="box">

<h2>Update Status Pengaduan</h2>

<form method="POST">

<label>Kategori:</label>
<input type="text" name="kategori" value="<?= htmlspecialchars($kategori); ?>">

<label>Lokasi:</label>
<input type="text" name="lokasi" value="<?= htmlspecialchars($lokasi); ?>">

<label>Feedback:</label>
<textarea name="feedback" rows="4"><?= htmlspecialchars($feedback); ?></textarea>

<label>Status:</label>
<select name="status">
<option value="Menunggu" <?= $status=="Menunggu"?"selected":""; ?>>Menunggu</option>
<option value="Proses" <?= $status=="Proses"?"selected":""; ?>>Proses</option>
<option value="Selesai" <?= $status=="Selesai"?"selected":""; ?>>Selesai</option>
</select>

<div class="button-group">
    <button type="submit" name="submit" class="btn-update">Update</button>
    <a href="tampildata.php">
        <button type="button" class="btn-back">Kembali</button>
    </a>
</div>

</form>

</div>

</body>
</html>