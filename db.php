<?php
$host = 'localhost'; 
$username = 'root';
$password = ''; 
$dbname = 'savory_station'; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
