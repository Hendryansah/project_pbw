<?php
include '../../config/koneksi.php';
if (isset($_POST['submit'])) {
    $id_jenis = $_POST['id_jenis'];
    $nama_barang = $_POST['nama_barang'];
    $kondisi = $_POST['kondisi'];
    $nama_file = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $dirUpload = "../../assets/img/uploads/";
    $ekstensiGambar = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmp_name, $dirUpload . $namaFileBaru);
    $query = "INSERT INTO perangkat (id_jenis, nama_barang, kondisi, foto_kondisi) VALUES ('$id_jenis', '$nama_barang', '$kondisi', '$namaFileBaru')";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
