<?php 

    session_start();

    if ( ! isset($_SESSION['login']) OR $_SESSION['login'] != true ) {
        header('Location: index.php');
        exit;
    }

?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<main class="container p-3 pb-5 m-3 mb-5">
    <h3>Tambah Data Mahasiswa Baru</h3>

    <form action="simpan.php" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="inputNim" class="col-sm-2 col-form-label">Nomor Induk Mahasiswa</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNim" name="nim" minlength="13" maxlength="13" required="required">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNama" name="nama" maxlength="100" required="required">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputProdi" class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-10">
                <select class="form-select" id="inputProdi" name="prodi" required="required">
                    <option disabled selected>Pilih Prodi</option>
                    <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                    <option value="S1 Informatika">S1 Informatika</option>
                    <option value="S1 Pendidikan Komputer">S1 Pendidikan Komputer</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputFoto" class="col-sm-2 col-form-label">File Foto Mahasiswa</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputFoto" name="foto" minlength="13" maxlength="13" required="required">
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