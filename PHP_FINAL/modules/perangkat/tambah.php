<?php
include '../../config/koneksi.php';
include '../../includes/header.php';
include '../../includes/navbar.php';
?>
<div class="container">
    <div class="card w-50 mx-auto mt-4">
        <div class="card-header bg-primary text-white">Tambah Perangkat Baru</div>
        <div class="card-body">
            <form action="simpan.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Jenis Perangkat:</label>
                    <select name="id_jenis" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <?php
                        $jenis_query = mysqli_query($conn, "SELECT * FROM jenis_perangkat");
                        while ($j = mysqli_fetch_assoc($jenis_query)) {
                            echo "<option value='" . $j['id_jenis'] . "'>" . $j['nama_jenis'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nama Barang / Merk:</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kondisi:</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Foto Kondisi:</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>
