<?php
session_start();

// CEK LOGIN
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
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

body {
    background: linear-gradient(to right, #dbeafe, #bfdbfe);
    min-height: 100vh;
    margin: 0;
    padding: 40px;
}

h1 {
    text-align: center;
    color: #1e3a8a;
    margin-bottom: 30px;
}

form {
    background: #ffffff;
    max-width: 500px;
    margin: auto;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(30, 58, 138, 0.15);
    border: 1px solid #e0f2fe;
}

form div {
    margin-bottom: 20px;
}

label {
    font-weight: 600;
    color: #1e40af;
}

input[type="text"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border-radius: 10px;
    border: 1px solid #93c5fd;
    font-size: 14px;
    transition: 0.3s ease;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
}

textarea {
    min-height: 100px;
    resize: vertical;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    cursor: pointer;
    margin-right: 10px;
    color: white;
    transition: 0.3s ease;
}

.btn-kembali {
    background-color: #60a5fa;
}

.btn-kembali:hover {
    background-color: #3b82f6;
}

.btn-kirim {
    background-color: #2563eb;
}

.btn-kirim:hover {
    background-color: #1d4ed8;
}
</style>

</head>
<body>

<h1>Forum Pengaduan Sarana Sekolah</h1>

<form action="proses-pengaduan.php" method="POST">

    <div>
        <label>NIS</label>
        <input type="text" name="nis" 
        value="<?php echo htmlspecialchars($nis); ?>" readonly />
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
        <input type="text" name="lokasi" required />
    </div>

    <div>
        <label>Keterangan</label>
        <textarea name="keterangan" required></textarea>
    </div>

    <a href="index.php">
        <button type="button" class="btn-kembali">Kembali</button>
    </a>

    <button type="submit" class="btn-kirim">Kirim</button>

</form>

</body>
</html>