<?php
include '../inc/koneksi.php';
session_start();
$jumlahBerita = mysqli_query($connect, "SELECT * FROM berita");
$hitungBerita = mysqli_num_rows($jumlahBerita);
$jumlahCat = mysqli_query($connect, "SELECT * FROM kategori");
$hitungCat = mysqli_num_rows($jumlahCat);
include('layout/header.php');
?>
<div class="alert alert-warning">Selamat Datang <?= $_SESSION['nama']; ?></div>
<div class="row">
    <div class="col-md-6">
<div class="alert alert-info">
        <div class="row align-items-start">
            <div class="col-8">
                <h5 class="card-title mb-9 fw-semibold"> Jumlah Berita </h5>
                <h4 class="fw-semibold mb-3"><?= $hitungBerita; ?></h4>
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-end">
                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-news fs-6"></i>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<div class="col-md-6">
<div class="alert alert-info">
        <div class="row align-items-start">
            <div class="col-8">
                <h5 class="card-title mb-9 fw-semibold"> Jumlah Kategori </h5>
                <h4 class="fw-semibold mb-3"><?= $hitungCat; ?></h4>
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-end">
                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-category fs-6"></i>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
</div>
<?php
include('layout/footer.php')
?>