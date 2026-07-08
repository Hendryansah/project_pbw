<?php
    session_start();

    if ( ! isset($_SESSION['login']) OR $_SESSION['login'] != true ) {
        header('Location: index.php');
        exit;
    }
    
    require '../../config/koneksi.php';

    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];

    if ( empty($nim)
        OR empty($nama)
        OR empty($prodi)
        OR mb_strlen($nim) != 13
        OR ! is_numeric($nim)
        OR ! filter_var($nim, FILTER_VALIDATE_INT)
        OR mb_strlen($nama) > 100
        OR mb_strlen($prodi) > 50 ) {
        header('Location: index.php');
        exit;
    }

    $nama_file = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];

    // Validasi 1 - Cek apakah file memang sudah diupload atau enggak
    if ( $error === 0 ) {
        // Validasi 2 - Cek ekstensi file
        $ekstensi_valid = ['jpg', 'jpeg', 'png', 'webp'];
        $ekstensi_file = strtolower( pathinfo($nama_file, PATHINFO_EXTENSION) );
        if ( ! in_array($ekstensi_file, $ekstensi_valid) ) {
            die("Ekstensi file tidak diizinkan!");
        }

        // Validasi 3 - Cek ukuran file (maks. 1MB / 1000000B)
        if ( $ukuran_file > 1000000 ) {
            die("Ukuran file terlalu besar (Maks. 1MB)");
        }

        $nama_baru = 'foto_' . uniqid() . '.' . $ekstensi_file;
        $tujuan = '../../assets/img/' . $nama_baru;
        if ( move_uploaded_file($tmp_name, $tujuan) ) {
            $sql = "UPDATE mahasiswa SET nama=?, nim=?, prodi=?, foto=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);

            // binding parameter: s = string
            mysqli_stmt_bind_param($stmt, "sssss", $nama, $nim, $prodi, $nama_baru, $id);

            if ( ! mysqli_stmt_execute($stmt) ) {
                echo "Gagal tambah data mahasiswa baru. Error: " . mysqli_stmt_error($stmt);
                die();
            }
            header('Location: index.php');
            mysqli_stmt_close($stmt);
        }
    } else {
        $sql = "UPDATE mahasiswa SET nama=?, nim=?, prodi=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        // binding parameter: s = string
        mysqli_stmt_bind_param($stmt, "ssss", $nama, $nim, $prodi, $id);

        if ( ! mysqli_stmt_execute($stmt) ) {
            echo "Gagal tambah data mahasiswa baru. Error: " . mysqli_stmt_error($stmt);
            die();
        }
        header('Location: index.php');
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
?>