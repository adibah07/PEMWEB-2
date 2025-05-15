<?php
include 'config/database.php';

// Tambah data bidang ilmu
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    mysqli_query($conn, "INSERT INTO bidang_ilmu (nama, deskripsi) VALUES ('$nama', '$deskripsi')");
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM bidang_ilmu WHERE id=$id");
    header("Location: bidang_ilmu.php");
}

// Ambil semua data bidang ilmu
$data = mysqli_query($conn, "SELECT * FROM bidang_ilmu");

// Tambahan: Logika untuk Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $stmt = $conn->prepare("UPDATE bidang_ilmu SET nama=?, deskripsi=? WHERE id=?");
    $stmt->bind_param("ssi", $nama, $deskripsi, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: bidang_ilmu.php");
}

// Tambahan: Ambil data untuk edit
$edit_row = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM bidang_ilmu WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
<div class="container">
    <link href="css/styles2.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />

    <div class="container-fluid px-4">
        <h2>Data Penelitian</h2>

<!-- Tombol untuk membuka modal tambah -->
<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Bidang Ilmu</button>

        <!-- Modal untuk Tambah -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Data Bidang Ilmu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                            <div class="mb-3">
                                <label for="nama bidang ilmu" class="form-label">Bidang Ilmu</label>
                                <input type="text" class="form-control" id="nama bidang ilmu" name="nama bidang ilmu" placeholder="nama bidang ilmu" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required></textarea>
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tampilan data kegiatan (diubah ke tabel) -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($data)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['tanggal_mulai']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_selesai']) ?></td>
                        <td><?= htmlspecialchars($row['tempat']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_nama']) ?></td>
                        <td>
                            <a href="?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</a>
                            <a href="?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                        </td>
                    </tr>
                    <!-- Modal untuk Edit -->
                    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Data Kegiatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div class="mb-3">
                                            <label for="tanggal_mulai<?= $row['id'] ?>" class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="tanggal_mulai<?= $row['id'] ?>" name="tanggal_mulai" value="<?= htmlspecialchars($row['tanggal_mulai']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_selesai<?= $row['id'] ?>" class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="tanggal_selesai<?= $row['id'] ?>" name="tanggal_selesai" value="<?= htmlspecialchars($row['tanggal_selesai']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tempat<?= $row['id'] ?>" class="form-label">Tempat</label>
                                            <input type="text" class="form-control" id="tempat<?= $row['id'] ?>" name="tempat" value="<?= htmlspecialchars($row['tempat']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi<?= $row['id'] ?>" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi<?= $row['id'] ?>" name="deskripsi" required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kegiatan_id<?= $row['id'] ?>" class="form-label">Jenis Kegiatan</label>
                                            <select class="form-control" id="jenis_kegiatan_id<?= $row['id'] ?>" name="jenis_kegiatan_id" required>
                                                <?php 
                                                $jenis = mysqli_query($conn, "SELECT * FROM jenis_kegiatan");
                                                while ($j = mysqli_fetch_assoc($jenis)) { ?>
                                                    <option value="<?= $j['id'] ?>" <?= $row['jenis_kegiatan_id'] == $j['id'] ? 'selected' : '' ?>><?= $j['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <button type="submit" name="update" class="btn btn-primary">Edit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>