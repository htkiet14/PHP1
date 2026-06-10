<?php

session_start();

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {

    header('Location: /client/index.php?page=login');
    exit();

} else {

    echo 'Chào mừng ' . $_SESSION['username'] . '!';

}
?>