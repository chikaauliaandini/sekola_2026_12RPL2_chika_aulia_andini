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

    echo "<script>alert('Data berhasil diupdate!'); window.location='editpassword-pengaduan.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Username & Password</title>

<style>
body{
    font-family: 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(to right,#CCECFF,#ffffff);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.box{
    width:380px;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#333;
}

label{
    font-size:14px;
    font-weight:bold;
    color:#555;
}

input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
    outline:none;
    transition:0.3s;
}

input:focus{
    border-color:#3498db;
    box-shadow:0 0 5px rgba(52,152,219,0.5);
}

button{
    padding:10px 15px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.btn-update{
    background-color:#3498db;
    color:white;
}

.btn-update:hover{
    background-color:#2980b9;
}

.btn-kembali{
    background-color:#7f8c8d;
    color:white;
    text-decoration:none;
    padding:10px 15px;
    border-radius:6px;
    margin-left:10px;
}

.btn-kembali:hover{
    background-color:#636e72;
}
</style>

</head>
<body>

<div class="box">

<h2>Edit Username & Password</h2>

<form method="POST">

<label>Username</label>
<input type="text" name="username" value="<?php echo $user['username']; ?>" required>

<label>Password Baru (kosongkan jika tidak diganti)</label>
<input type="password" name="password">

<button type="submit" name="update" class="btn-update">Update</button>
<a href="index.php" class="btn-kembali">Kembali</a>

</form>

</div>

</body>
</html>