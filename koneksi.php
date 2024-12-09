<?php
// Detail koneksi database
$host = "localhost";
$user = "root";
$password = "";
$database = "savory_station";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
