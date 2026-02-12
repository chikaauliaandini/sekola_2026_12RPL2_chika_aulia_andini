<?php
// Koneksi ke database
$host = "localhost";
$db   = "ujikom_12rpl_chika";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Ambil keyword pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cari Pengaduan</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .search-box { margin-bottom: 20px; }
    </style>
</head>
<body>

<h2>Pencarian Data Pengaduan</h2>

<form method="GET" action="">
    <div class="search-box">
        <input type="text" name="keyword" placeholder="Masukkan kata kunci..." 
               value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit">Cari</button>
    </div>
</form>

<?php
if ($keyword != "") {
    $sql = "SELECT * FROM pengaduan 
            WHERE nama LIKE :keyword 
            OR judul LIKE :keyword 
            OR isi LIKE :keyword
            ORDER BY tanggal DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['keyword' => "%$keyword%"]);

    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr>
                <th>No</th>
                <th>Nama</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal</th>
                <th>Status</th>
              </tr>";

        $no = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>".$no++."</td>
                    <td>".htmlspecialchars($row['nama'])."</td>
                    <td>".htmlspecialchars($row['nomor'])."</td>
                    <td>".htmlspecialchars($row['isi'])."</td>
                    <td>".htmlspecialchars($row['tanggal'])."</td>
                    <td>".htmlspecialchars($row['status'])."</td>
                  </tr>";
        }
        echo "</table>"; 
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }
}
?>

</body>
</html>