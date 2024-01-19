<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'account_system';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้: ' . mysqli_connect_error());
}
?>