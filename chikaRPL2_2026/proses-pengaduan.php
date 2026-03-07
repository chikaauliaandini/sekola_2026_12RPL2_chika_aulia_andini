
<?php
// Koneksi database
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_chika.sql");

// Ambil input dan sanitasi
$nis        = mysqli_real_escape_string($koneksi, $_POST['nis']);
$kategori   = isset($_POST['kategori']) ? intval($_POST['kategori']) : 0;
$lokasi     = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

// Validasi
if (empty($nis) || $kategori <= 0 || empty($lokasi) || empty($keterangan)) {
    die("Data tidak lengkap. Pastikan semua field diisi dengan benar.");
}

// Masukkan ke database
$sql = "INSERT INTO input_aspirasi 
        (nis, id_kategori, lokasi, ket, status, feedback) 
        VALUES ('$nis', $kategori, '$lokasi', '$keterangan', 'menunggu', NULL)";

$berhasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Status Pengaduan</title>

<style>

body{
font-family: Arial, sans-serif;
background: linear-gradient(to right, #dbeafe, #bfdbfe);
margin:0;
padding:0;
}

/* BOX */

.box{
width:420px;
background:white;
padding:30px;
margin:120px auto;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
border:2px solid #7284e0;
text-align:center;
}

h2{
color:#6c8ced;
margin-bottom:20px;
}

/* DATA */

.data{
text-align:left;
margin-top:15px;
line-height:1.8;
}

/* BUTTON */

button{
padding:10px 18px;
margin-top:20px;
border:none;
border-radius:6px;
background-color:#60a5fa;
color:white;
font-weight:bold;
cursor:pointer;
}

button:hover{
background-color:#3b82f6;
}

</style>

</head>

<body>

<div class="box">

<?php if($berhasil){ ?>

<h2>Pengaduan Berhasil Dikirim</h2>

<div class="data">
<b>NIS:</b> <?php echo $nis; ?> <br>
<b>Kategori ID:</b> <?php echo $kategori; ?> <br>
<b>Lokasi:</b> <?php echo $lokasi; ?> <br>
<b>Keterangan:</b> <?php echo $keterangan; ?> <br>
</div>

<a href="index.php">
<button>Kembali</button>
</a>

<?php } else { ?>

<h2>Pengaduan Gagal</h2>
<p><?php echo mysqli_error($koneksi); ?></p>

<a href="index.php">
<button>Kembali</button>
</a>

<?php } ?>

</div>

</body>
</html>
```
