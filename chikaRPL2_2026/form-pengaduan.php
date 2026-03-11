<?php
session_start();

// ================= CEK LOGIN =================
if (!isset($_SESSION['nis'])) {
    header("Location: index.php");
    exit;
}

// Ambil NIS dari session
$nis = $_SESSION['nis'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Forum Pengaduan Sarana Sekolah</title>

<style>

*{
box-sizing:border-box;
font-family:'Poppins', sans-serif;
}

/* BODY */
body{
background:linear-gradient(to right,#cce7ff,#e6f3ff);
min-height:100vh;
margin:0;
padding:40px;
}

/* JUDUL */
h1{
text-align:center;
color:#2563eb;
margin-bottom:25px;
}

/* FLOWER */
.flower{
text-align:center;
font-size:26px;
margin-bottom:10px;
}

/* FORM BOX */
form{
background:white;
max-width:500px;
margin:auto;
padding:30px;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
border:2px solid #93c5fd;
}

/* FORM GROUP */
form div{
margin-bottom:18px;
}

/* LABEL */
label{
font-weight:600;
color:#1e40af;
}

/* INPUT */
input[type="text"],
select,
textarea{
width:100%;
padding:10px;
margin-top:6px;
border-radius:10px;
border:1px solid #93c5fd;
font-size:14px;
transition:0.3s;
}

/* INPUT FOCUS */
input:focus,
select:focus,
textarea:focus{
outline:none;
border-color:#2563eb;
box-shadow:0 0 6px rgba(37,99,235,0.3);
background:#f0f9ff;
}

textarea{
min-height:100px;
resize:vertical;
}

/* BUTTON */
button{
padding:10px 20px;
border:none;
border-radius:10px;
font-size:14px;
cursor:pointer;
margin-right:10px;
color:white;
transition:0.3s;
}

/* BUTTON KEMBALI */
.btn-kembali{
background:#93c5fd;
}

.btn-kembali:hover{
background:#60a5fa;
}

/* BUTTON KIRIM */
.btn-kirim{
background:#3b82f6;
}

.btn-kirim:hover{
background:#2563eb;
}

</style>

</head>
<body>

<div class="flower">🌸🌼🌸</div>

<h1>Forum Pengaduan Sarana Sekolah</h1>

<form action="proses-pengaduan.php" method="POST">

<div>
<label>NIS</label>
<input type="text" name="nis"
value="<?php echo htmlspecialchars($nis); ?>" readonly>
</div>

<div>
<label>Kategori</label>
<select name="kategori" required>
<option value="">-- Pilih Kategori --</option>
<option value="1">Lingkungan</option>
<option value="2">Fasilitas</option>
</select>
</div>

<div>
<label>Lokasi</label>
<input type="text" name="lokasi" required>
</div>

<div>
<label>Keterangan</label>
<textarea name="keterangan" required></textarea>
</div>

<a href="index.php">
<button type="button" class="btn-kembali">Kembali 🌸</button>
</a>

<button type="submit" class="btn-kirim">Kirim 🌼</button>

<div class="flower">🌼🌸🌼</div>

</form>

</body>
</html>