<?php

    session_start();

    if ( ! isset($_SESSION['login']) OR $_SESSION['login'] != true ) {
        header('Location: index.php');
        exit;
    }
    
    require '../../config/koneksi.php';

    $id = $_GET['id'];
    if ( ! empty($id) ) {
        $sql = "DELETE FROM mahasiswa WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        // binding parameter: s = string
        mysqli_stmt_bind_param($stmt, "s", $id);

        if ( ! mysqli_stmt_execute($stmt) ) {
            echo "Gagal hapus data mahasiswa. Error: " . mysqli_stmt_error($stmt);
            die();
        }
        header('Location: index.php');
        mysqli_stmt_close($stmt);
    }
    mysqli_close();
    header('Location: index.php');
?>