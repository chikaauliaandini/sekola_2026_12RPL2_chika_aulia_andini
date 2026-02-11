<?php
session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh login sederhana
    if($username == "admin" && $password == "1234"){
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Login gagal!";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body{
            font-family: Arial;
            background: linear-gradient(to right, #c8dbe2, #a788e0);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box{
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 10px;
            text-align: center;
        }
        input{
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button{
            background: #8882c2;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>
    <form method="POST">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button type="submit" name="login">Login</button>
</form>
</div>

</body>
</html>