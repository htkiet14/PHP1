<?php

session_start();

if (!empty($_POST)) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "123") {

        $_SESSION['username'] = $username;

        header("Location: index.php");
        exit();
    }

    echo "Sai tài khoản hoặc mật khẩu";
}

?>

<form method="POST">

    <input type="text" name="username" placeholder="Username">

    <input type="password" name="password" placeholder="Password">

    <button type="submit">Đăng nhập</button>

</form>