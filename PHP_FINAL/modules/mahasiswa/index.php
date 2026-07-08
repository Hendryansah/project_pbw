<?php

    session_start();

    if ( ! isset($_SESSION['login']) OR $_SESSION['login'] != true ) {
        header('Location: ../auth/login.php');
        exit;
    }

    require '../../config/koneksi.php';

    $sql = "SELECT * FROM mahasiswa";
    $result = mysqli_query($conn, $sql);

?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<main class="container p-3 pb-5 m-3 mb-5">
    <h2>Daftar Mahasiswa</h2>

    <a href="tambah.php" class="btn btn-sm btn-secondary">Tambah Data Mahasiswa</a>

    <table class="table table-hover align-middle">
        <caption>Daftar Mahasiswa</caption>
        <thead class="table-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Foto</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama</th>
                <th scope="col">Prodi</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
    <?php
        $no = 1;
        while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
                <td><?=$no++?></td>
                <td><img src="/assets/img/<?=$row['foto'] ? $row['foto'] : 'no_image.jpg' ?>" height="50px"></td>
                <td><?=$row['nim']?></td>
                <td><?=$row['nama']?></td>
                <td><?=$row['prodi']?></td>
                <td>
                    <a href="ubah.php?id=<?=$row['id']?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="hapus.php?id=<?=$row['id']?>" 
                        onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
    <?php } ?>
        </tbody>
    </table>
</main>
<?php include '../../includes/footer.php'; ?>