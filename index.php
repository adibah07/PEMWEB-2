
<?php
include 'config/database.php';


// Ambil jumlah data dari masing-masing tabel
$jml_dosen = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dosen"));
$jml_prodi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM prodi"));
$jml_kegiatan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kegiatan"));
$jml_penelitian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penelitian"));
$jml_bidang_ilmu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bidang_ilmu"));
$jml_jenis_kegiatan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jenis_kegiatan"));

// Query jumlah dosen berdasarkan tahun masuk
$tahunData = [];
$jumlahDosen = [];
$result = mysqli_query($conn, "SELECT tahun_masuk, COUNT(*) as total FROM dosen GROUP BY tahun_masuk ORDER BY tahun_masuk");
while ($row = mysqli_fetch_assoc($result)) {
    $tahunData[] = $row['tahun_masuk'];
    $jumlahDosen[] = $row['total'];
}
?>



<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>


<link href="css/table.css" rel="stylesheet" />
<!-- Konten halaman di sini -->
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                <div class="card-body"><?= $jml_dosen ?> Dosen</div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                <div class="card-body"><?= $jml_prodi ?> Program Studi</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                <div class="card-body"><?= $jml_kegiatan ?> Kegiatan</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                <div class="card-body"><?= $jml_penelitian ?> Penelitian</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        