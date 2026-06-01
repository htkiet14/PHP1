<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__ . "/Model/Database.php");

$db = new Database();
$conn = $db->Connection();

if ($conn) {
    echo "Kết nối thành công!";
}

?>