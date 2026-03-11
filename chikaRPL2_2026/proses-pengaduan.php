<?php
// ================= KONEKSI DATABASE =================
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_chika.sql");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ================= AMBIL DATA =================
$nis        = mysqli_real_escape_string($koneksi, $_POST['nis']);
$kategori   = isset($_POST['kategori']) ? intval($_POST['kategori']) : 0;
$lokasi     = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

// ================= VALIDASI =================
if (empty($nis) || $kategori <= 0 || empty($lokasi) || empty($keterangan)) {
    die("Data tidak lengkap. Pastikan semua field diisi dengan benar.");
}

// ================= SIMPAN DATA =================
$sql = "INSERT INTO input_aspirasi 
        (nis, id_kategori, lokasi, ket, status, feedback) 
        VALUES ('$nis','$kategori','$lokasi','$keterangan','menunggu',NULL)";

$berhasil = mysqli_query($koneksi,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Status Pengaduan</title>

<style>

*{
box-sizing:border-box;
font-family:'Poppins', sans-serif;
}

/* BODY */
body{
background:linear-gradient(to right,#cce7ff,#e6f3ff);
margin:0;
padding:0;
}

/* BOX */
.box{
width:420px;
background:white;
padding:30px;
margin:120px auto;
border-radius:16px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
border:2px solid #93c5fd;
text-align:center;
}

/* JUDUL */
h2{
color:#2563eb;
margin-bottom:15px;
}

/* FLOWER */
.flower{
font-size:24px;
margin-bottom:10px;
}

/* DATA */
.data{
text-align:left;
margin-top:15px;
line-height:1.8;
background:#f0f9ff;
padding:12px;
border-radius:10px;
border:1px solid #bfdbfe;
}

/* BUTTON */
button{
padding:10px 18px;
margin-top:20px;
border:none;
border-radius:8px;
background:#60a5fa;
color:white;
font-weight:bold;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#2563eb;
}

</style>

</head>

<body>

<div class="box">

<div class="flower">🌸🌼🌸</div>

<?php if($berhasil){ ?>

<h2>Pengaduan Berhasil Dikirim 🌼</h2>

<div class="data">
<b>NIS:</b> <?php echo htmlspecialchars($nis); ?> <br>
<b>Kategori ID:</b> <?php echo $kategori; ?> <br>
<b>Lokasi:</b> <?php echo htmlspecialchars($lokasi); ?> <br>
<b>Keterangan:</b> <?php echo htmlspecialchars($keterangan); ?> <br>
</div>

<a href="index.php">
<button>Kembali 🌸</button>
</a>

<?php } else { ?>

<h2>Pengaduan Gagal ❌</h2>

<p><?php echo mysqli_error($koneksi); ?></p>

<a href="index.php">
<button>Kembali 🌼</button>
</a>

<?php } ?>

<div class="flower">🌼🌸🌼</div>

</div>

</body>
</html>