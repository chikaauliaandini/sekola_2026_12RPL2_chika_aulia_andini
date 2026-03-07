```php
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

body{
font-family: Arial, sans-serif;
background: linear-gradient(to right, #dbeafe, #bfdbfe);
margin:0;
padding:0;
}

/* BOX FORM */
.box{
width:420px;
background:white;
padding:25px;
margin:120px auto;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
border:2px solid #7284e0;
}

h2{
text-align:center;
color:#6c8ced;
margin-bottom:20px;
}

/* INPUT */
textarea, select, input{
width:100%;
padding:10px;
margin-top:5px;
border-radius:6px;
border:1px solid #6c8ced;
outline:none;
}

textarea:focus, select:focus, input:focus{
background-color:#CCECFF;
}

/* BUTTON */
button{
padding:10px 18px;
margin-top:15px;
border:none;
border-radius:6px;
background-color:#60a5fa;
color:white;
font-weight:bold;
cursor:pointer;
}

button:hover{
background-color:#CCECFF;
}

a button{
background-color:#60a5fa;
}

</style>

</head>

<body>

<div class="box">

<h2>Update Status Pengaduan</h2>

<form method="POST">

Lokasi:<br>
<input type="text" name="lokasi" value="<?= htmlspecialchars($lokasi); ?>">

<br><br>

Kategori:<br>
<select name="kategori">
<option value="jalan" <?= $kategori=="jalan"?"selected":""; ?>>Kerusakan Jalan</option>
<option value="lampu" <?= $kategori=="lampu"?"selected":""; ?>>Lampu Jalan</option>
<option value="sampah" <?= $kategori=="sampah"?"selected":""; ?>>Sampah</option>
<option value="lainnya" <?= $kategori=="lainnya"?"selected":""; ?>>Lainnya</option>
</select>

<br><br>

Feedback:<br>
<textarea name="feedback" rows="4"><?= htmlspecialchars($feedback); ?></textarea>

<br><br>

Status:<br>
<select name="status">
<option value="menunggu" <?= $status=="menunggu"?"selected":""; ?>>Menunggu</option>
<option value="proses" <?= $status=="proses"?"selected":""; ?>>Proses</option>
<option value="selesai" <?= $status=="selesai"?"selected":""; ?>>Selesai</option>
</select>

<br><br>

<button type="submit" name="submit">Update</button>
<a href="index.php"><button type="button">Kembali</button></a>

</form>

</div>

</body>
</html>
```
