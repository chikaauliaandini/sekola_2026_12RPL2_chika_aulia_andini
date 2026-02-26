<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id'])){
    echo "Anda belum login!";
    exit;
}

$id = $_SESSION['id'];

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$user = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($password)){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE user SET username='$username', password='$password_hash' WHERE id='$id'");
    }else{
        mysqli_query($koneksi, "UPDATE user SET username='$username' WHERE id='$id'");
    }

    $_SESSION['username'] = $username;

    echo "<script>alert('Data berhasil diupdate!'); window.location='editpassword_pengaduan.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Password</title>
<style>
button{
    padding:8px 15px;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.btn-update{
    background-color:#3498db;
    color:white;
}

.btn-kembali{
    background-color:#7f8c8d;
    color:white;
    text-decoration:none;
    padding:8px 15px;
    border-radius:5px;
}
</style>
</head>
<body>

<h2>Edit Username & Password</h2>

<form method="POST">
    <label>Username</label><br>
    <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br><br>

    <label>Password Baru (kosongkan jika tidak diganti)</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit" name="update" class="btn-update">Update</button>
    <a href="index.php" class="btn-kembali">Kembali</a>
</form>

</body>
</html>