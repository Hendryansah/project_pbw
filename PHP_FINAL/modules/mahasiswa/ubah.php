<?php

    session_start();

    if ( ! isset($_SESSION['login']) OR $_SESSION['login'] != true ) {
        header('Location: index.php');
        exit;
    }
    
    require '../../config/koneksi.php';

    $id = $_GET['id'];
    if ( empty($id) ) {
        header('Location: index.php');
    }

    $sql = "SELECT * FROM mahasiswa WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ( ! mysqli_num_rows($result) ) {
        header('Location: index.php');
    }
    
    $row = mysqli_fetch_assoc($result);

?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<main class="container p-3 pb-5 m-3 mb-5">
    <h3>Ubah Data Mahasiswa</h3>

    <form action="edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$row['id']?>">
        <div class="row mb-3">
            <label for="inputNim" class="col-sm-2 col-form-label">Nomor Induk Mahasiswa</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNim" name="nim" minlength="13" maxlength="13" required="required" value="<?=$row['nim']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNama" name="nama" maxlength="100" required="required" value="<?=$row['nama']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputProdi" class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-10">
                <select class="form-select" id="inputProdi" name="prodi" required="required">
                    <option disabled selected>Pilih Prodi</option>
                    <option <?=$row['prodi']=="S1 Sistem Informasi" ? 'selected' : ''?> value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                    <option <?=$row['prodi']=="S1 Informatika" ? 'selected' : ''?> value="S1 Informatika">S1 Informatika</option>
                    <option <?=$row['prodi']=="S1 Pendidikan Komputer" ? 'selected' : ''?> value="S1 Pendidikan Komputer">S1 Pendidikan Komputer</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputFoto" class="col-sm-2 col-form-label">File Foto Mahasiswa</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputFoto" name="foto" minlength="13" maxlength="13">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>

</main>
<?php include '../../includes/footer.php'; ?>
