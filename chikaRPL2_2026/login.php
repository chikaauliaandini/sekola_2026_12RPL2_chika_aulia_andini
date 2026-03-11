<?php
session_start();

/* =========================
   KONEKSI DATABASE
========================= */
$conn = mysqli_connect("localhost","root","","ujikom_12rpl2_chika.sql");

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* =========================
   LOGOUT
========================= */
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: login.php");
    exit;
}

/* =========================
   PROSES LOGIN
========================= */
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data && password_verify($password,$data['password'])){

        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nis'] = $data['nis'];

        /* LANGSUNG MASUK INDEX */
        header("Location: index.php");
        exit;

    }else{
        echo "<script>alert('Login gagal! Username atau password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>

body{
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    background:#f4f4f4;
    font-family:Arial;
}

.box{
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
    width:320px;
}

input{
    width:100%;
    padding:10px;
    margin:10px 0;
}

button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:5px;
    background:#28a745;
    color:white;
    cursor:pointer;
}

button:hover{
    background:#218838;
}

</style>

</head>
<body>

<div class="box">

<h3>Login</h3>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

</div>

</body>
</html>