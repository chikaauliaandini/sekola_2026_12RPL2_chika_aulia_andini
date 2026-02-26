<?php
// Ambil input dan sanitasi
$nis        = mysqli_real_escape_string($koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_chika.sql"), $_POST['nis']);
$kategori   = isset($_POST['kategori']) ? intval($_POST['kategori']) : 0; // pastikan integer
$lokasi     = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

// Validasi
if (empty($nis) || $kategori <= 0 || empty($lokasi) || empty($keterangan)) {
    die("Data tidak lengkap. Pastikan semua field diisi dengan benar.");
}

// Masukkan ke database
$sql = "INSERT INTO input_aspirasi 
        (nis, id_kategori, lokasi, ket, status, feedback) 
        VALUES ('$nis', $kategori, '$lokasi', '$keterangan', 'Menunggu', NULL)";

if (mysqli_query($koneksi, $sql)) {
    echo "<h2>Pengaduan berhasil dikirim</h2>";
    echo "NIS: $nis <br>";
    echo "Kategori ID: $kategori <br>";
    echo "Lokasi: $lokasi <br>";
    echo "Keterangan: $keterangan <br><br>";
    echo '<a href="index.php"><button>Kembali</button></a>';
} else {
    echo "Gagal menyimpan pengaduan: " . mysqli_error($koneksi);
}
?>