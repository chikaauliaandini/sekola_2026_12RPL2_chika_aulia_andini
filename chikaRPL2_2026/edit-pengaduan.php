<?php
/* ================== KONEKSI DATABASE ================== */
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_chika.sql");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* ================== CEK ID ================== */
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

/* ================== CEK KOLOM ================== */
$cek1 = mysqli_query($koneksi,"SHOW COLUMNS FROM input_aspirasi LIKE 'feedback'");
if(mysqli_num_rows($cek1)==0){
    mysqli_query($koneksi,"ALTER TABLE input_aspirasi ADD feedback TEXT");
}

$cek2 = mysqli_query($koneksi,"SHOW COLUMNS FROM input_aspirasi LIKE 'status'");
if(mysqli_num_rows($cek2)==0){
    mysqli_query($koneksi,"ALTER TABLE input_aspirasi ADD status VARCHAR(20)");
}

$cek3 = mysqli_query($koneksi,"SHOW COLUMNS FROM input_aspirasi LIKE 'lokasi'");
if(mysqli_num_rows($cek3)==0){
    mysqli_query($koneksi,"ALTER TABLE input_aspirasi ADD lokasi VARCHAR(100)");
}

$cek4 = mysqli_query($koneksi,"SHOW COLUMNS FROM input_aspirasi LIKE 'kategori'");
if(mysqli_num_rows($cek4)==0){
    mysqli_query($koneksi,"ALTER TABLE input_aspirasi ADD kategori VARCHAR(100)");
}

/* ================== AMBIL DATA ================== */
$data = mysqli_query($koneksi, "SELECT * FROM input_aspirasi WHERE id_pelaporan='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

/* ================== CEGAH NULL ================== */
$feedback = $row['feedback'] ?? '';
$status   = $row['status'] ?? '';
$lokasi   = $row['lokasi'] ?? '';
$kategori = $row['kategori'] ?? '';

/* ================== UPDATE DATA ================== */
if (isset($_POST['submit'])) {

    $feedback = $_POST['feedback'] ?? '';
    $status   = $_POST['status'] ?? '';
    $lokasi   = $_POST['lokasi'] ?? '';
    $kategori = $_POST['kategori'] ?? '';

    mysqli_query($koneksi,"
        UPDATE input_aspirasi 
        SET feedback='$feedback',
            status='$status',
            lokasi='$lokasi',
            kategori='$kategori'
        WHERE id_pelaporan='$id'
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pengaduan</title>

<style>

/* BODY */
body{
font-family: 'Poppins', sans-serif;
background: linear-gradient(to right, #cce7ff, #e6f3ff);
margin:0;
padding:0;
}

/* BOX FORM */
.box{
width:420px;
background:white;
padding:25px;
margin:110px auto;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
border:2px solid #7cc3ff;
}

/* TITLE */
h2{
text-align:center;
color:#3b82f6;
margin-bottom:20px;
}

/* LABEL */
label{
font-weight:600;
color:#2563eb;
}

/* INPUT */
textarea, select, input{
width:100%;
padding:10px;
margin-top:5px;
border-radius:8px;
border:1px solid #93c5fd;
outline:none;
transition:0.2s;
}

textarea:focus, select:focus, input:focus{
background:#f0f9ff;
border:1px solid #3b82f6;
}

/* BUTTON */
button{
padding:10px 18px;
margin-top:15px;
border:none;
border-radius:8px;
background:#60a5fa;
color:white;
font-weight:bold;
cursor:pointer;
transition:0.2s;
}

button:hover{
background:#3b82f6;
}

a button{
background:#93c5fd;
}

a button:hover{
background:#60a5fa;
}

/* FLOWER DECORATION */
.flower{
text-align:center;
font-size:24px;
margin-bottom:10px;
}

</style>

</head>

<body>

<div class="box">

<div class="flower">🌸🌼🌸</div>

<h2>Update Status Pengaduan</h2>

<form method="POST">

<label>Lokasi</label>
<input type="text" name="lokasi" value="<?= htmlspecialchars($lokasi); ?>">

<br><br>

<label>Kategori</label>
<select name="kategori">
<option value="jalan" <?= $kategori=="jalan"?"selected":""; ?>>Kerusakan Jalan</option>
<option value="lampu" <?= $kategori=="lampu"?"selected":""; ?>>Lampu Jalan</option>
<option value="sampah" <?= $kategori=="sampah"?"selected":""; ?>>Sampah</option>
<option value="lainnya" <?= $kategori=="lainnya"?"selected":""; ?>>Lainnya</option>
</select>

<br><br>

<label>Feedback</label>
<textarea name="feedback" rows="4"><?= htmlspecialchars($feedback); ?></textarea>

<br><br>

<label>Status</label>
<select name="status">
<option value="menunggu" <?= $status=="menunggu"?"selected":""; ?>>Menunggu</option>
<option value="proses" <?= $status=="proses"?"selected":""; ?>>Proses</option>
<option value="selesai" <?= $status=="selesai"?"selected":""; ?>>Selesai</option>
</select>

<br>

<button type="submit" name="submit">Update 🌼</button>
<a href="index.php"><button type="button">Kembali 🌸</button></a>

<div class="flower">🌼🌸🌼</div>

</form>

</div>

</body>
</html>