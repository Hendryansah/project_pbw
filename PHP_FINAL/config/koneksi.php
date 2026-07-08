<?php
$host = "localhost";
$user = "root";
$pass = "";

// PASTIKAN NAMA DATABASE NYA BENAR 👇
$db   = "inventaris_lab";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>