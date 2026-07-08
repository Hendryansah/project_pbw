<?php
include '../../config/koneksi.php';
$id = $_GET['id'];
$query_foto = mysqli_query($conn, "SELECT foto_kondisi FROM perangkat WHERE id_perangkat = '$id'");
$data = mysqli_fetch_assoc($query_foto);
$foto = $data['foto_kondisi'];
if (file_exists("../../assets/img/uploads/" . $foto)) {
    unlink("../../assets/img/uploads/" . $foto);
}
mysqli_query($conn, "DELETE FROM perangkat WHERE id_perangkat = '$id'");
header("Location: index.php");
?>
