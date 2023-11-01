<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_bellizer';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>