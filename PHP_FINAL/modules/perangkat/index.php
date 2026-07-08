<?php
include '../../config/koneksi.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$keyword = "";
if (isset($_GET['cari'])) {
    $keyword = $_GET['cari'];
    $query = "SELECT p.*, j.nama_jenis FROM perangkat p 
              JOIN jenis_perangkat j ON p.id_jenis = j.id_jenis 
              WHERE p.nama_barang LIKE '%$keyword%' OR j.nama_jenis LIKE '%$keyword%'";
} else {
    $query = "SELECT p.*, j.nama_jenis FROM perangkat p JOIN jenis_perangkat j ON p.id_jenis = j.id_jenis";
}
$result = mysqli_query($conn, $query);
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Inventaris</h2>
        <a href="tambah.php" class="btn btn-primary">+ Tambah Perangkat</a>
    </div>
    <form method="GET" action="index.php" class="mb-3 d-flex">
        <input type="text" name="cari" class="form-control me-2" placeholder="Cari nama barang atau jenis..." value="<?= htmlspecialchars($keyword); ?>">
        <button type="submit" class="btn btn-outline-success">Cari</button>
        <a href="index.php" class="btn btn-outline-secondary ms-2">Reset</a>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th><th>Jenis</th><th>Nama Barang</th><th>Kondisi</th><th>Foto</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama_jenis'] . "</td>";
                    echo "<td>" . $row['nama_barang'] . "</td>";
                    echo "<td>" . $row['kondisi'] . "</td>";
                    echo "<td><img src='../../assets/img/uploads/" . $row['foto_kondisi'] . "' width='80' class='img-thumbnail'></td>";
                    echo "<td>
                            <a href='hapus.php?id=" . $row['id_perangkat'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>
