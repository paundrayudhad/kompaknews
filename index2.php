<?php
include('inc/koneksi.php');

?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.bootstrapdash.com/world-time/ by HTTrack Website Copier/3.x [XR&CO'2017], Thu, 22 Feb 2024 10:18:05 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>World Time</title>
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= $base_url; ?>assets2/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets2/vendors/aos/dist/aos.css/aos.css" />

    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="<?= $base_url; ?>assets2/images/favicon.png" />

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= $base_url; ?>assets2/css/style.css">
    <!-- endinject -->
</head>

<body>
    <div class="container-scroller">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a class="navbar-brand" href="#"><img src="<?= $base_url; ?>image/logo.png" alt="" /></a>
                                </div>
                                <div>
                                    <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                            <li>
                                                <button class="navbar-close">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="index-2.html">Home</a>
                                            </li>
                                            <?php
                                            $jumlahDataPerhalaman = 3;
                                            $dataBerita = mysqli_query($connect, "SELECT * FROM berita");
                                            $jumlahData = mysqli_num_rows($dataBerita);
                                            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

                                            if (isset($_GET['page'])) {
                                                $halamanAktif = $_GET['page'];
                                            } else {
                                                $halamanAktif = 1;
                                            }
                                            $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
                                            ?>
                                            <?php
                                            $query = "SELECT * FROM kategori WHERE terbit = 1 ORDER BY ID ASC LIMIT 0,5";
                                            $result = mysqli_query($connect, $query);
                                            while ($row = mysqli_fetch_assoc($result)) : ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="./?open=cat&id=<?= $row['ID']; ?>"><?= $row['kategori']; ?></a>
                                                </li>
                                            <?php endwhile; ?>
                                            <li class="nav-item">
                                                <a class="btn btn-info" style="font-weight: 500;" href="#" class="nav-link">Login</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>

            <!-- partial -->

            <div class="content-wrapper">
                <div class="container">
                    <div class="row" data-aos="fade-up">
                        <?php
                        $query = "SELECT * FROM berita WHERE terbit = '1' AND tanggal>='" . date('Y-m-d H:i:s', strtotime('-7 days')) . "' ORDER BY viewnum DESC LIMIT 1";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_assoc($result)
                        ?>
                        <div class="col-xl-8 stretch-card grid-margin">
                            <div class="position-relative">
                                <img src="<?= $row['gambar']; ?>" alt="banner" class="img-fluid" />
                                <div class="banner-content">
                                    <div class="badge badge-danger fs-12 font-weight-bold mb-3">
                                        Terpopuler
                                    </div>
                                    <h1 class="mb-0"><?= $row['judul']; ?></h1>
                                    <div class="fs-12">
                                        <span class="mr-2"><?= $row['kategori']; ?> </span><?= $row['tanggal']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 stretch-card grid-margin">
                            <div class="card bg-dark text-white">
                                <div class="card-body">
                                    <h2>Berita Terbaru</h2>
                                    <?php
                                    $query = "SELECT * FROM berita WHERE terbit = '1' ORDER BY ID DESC LIMIT 0,3";
                                    $result = mysqli_query($connect, $query);
                                    while ($row = mysqli_fetch_assoc($result)) :
                                    ?>
                                        <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                                            <div class="pr-3">
                                                <h5 href="./?open=detail&id=<?= $row['ID']; ?>"><?= $row['judul']; ?></h5>
                                                <div class="fs-12">
                                                    <span class="mr-2"><?= $row['kategori']; ?> </span><?= $row['tanggal']; ?>
                                                </div>
                                            </div>
                                            <div class="rotate-img">
                                                <img src="<?= $row['gambar']; ?>" alt="thumb" class="img-fluid img-lg" />
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-lg-3 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Category</h2>
                                    <ul class="vertical-menu">
                                        <?php
                                        $query = "SELECT * FROM kategori WHERE terbit = 1 ORDER BY ID ASC";
                                        $result = mysqli_query($connect, $query);
                                        while ($row = mysqli_fetch_assoc($result)) : ?>
                                            <li><a href="./?open=cat&id=<?= $row['ID']; ?>"><?= $row['kategori']; ?></a></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4 grid-margin">
                                            <div class="position-relative">
                                                <div class="rotate-img">
                                                    <img src="<?= $base_url; ?>assets2/images/dashboard/home_4.jpg" alt="thumb" class="img-fluid" />
                                                </div>
                                                <div class="badge-positioned">
                                                    <span class="badge badge-danger font-weight-bold">Flash news</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8  grid-margin">
                                            <h2 class="mb-2 font-weight-600">
                                                South Korea’s Moon Jae-in sworn in vowing to address
                                                North
                                            </h2>
                                            <div class="fs-13 mb-2">
                                                <span class="mr-2">Photo </span>10 Minutes ago
                                            </div>
                                            <p class="mb-0">
                                                Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4 grid-margin">
                                            <div class="position-relative">
                                                <div class="rotate-img">
                                                    <img src="<?= $base_url; ?>assets2/images/dashboard/home_5.jpg" alt="thumb" class="img-fluid" />
                                                </div>
                                                <div class="badge-positioned">
                                                    <span class="badge badge-danger font-weight-bold">Flash news</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8  grid-margin">
                                            <h2 class="mb-2 font-weight-600">
                                                No charges over 2017 Conservative battle bus cases
                                            </h2>
                                            <div class="fs-13 mb-2">
                                                <span class="mr-2">Photo </span>10 Minutes ago
                                            </div>
                                            <p class="mb-0">
                                                Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="position-relative">
                                                <div class="rotate-img">
                                                    <img src="<?= $base_url; ?>assets2/images/dashboard/home_6.jpg" alt="thumb" class="img-fluid" />
                                                </div>
                                                <div class="badge-positioned">
                                                    <span class="badge badge-danger font-weight-bold">Flash news</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <h2 class="mb-2 font-weight-600">
                                                Kaine: Trump Jr. may have committed treason
                                            </h2>
                                            <div class="fs-13 mb-2">
                                                <span class="mr-2">Photo </span>10 Minutes ago
                                            </div>
                                            <p class="mb-0">
                                                Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
            <!-- container-scroller ends -->

            <!-- partial:partials/_footer.html -->
            <footer>
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= $base_url; ?>assets2/images/logo.svg" class="footer-logo" alt="" />
                                <h5 class="font-weight-normal mt-4 mb-5">
                                    Newspaper is your news, entertainment, music fashion website. We
                                    provide you with the latest breaking news and videos straight from
                                    the entertainment industry.
                                </h5>
                                <ul class="social-media mb-3">
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="font-weight-bold mb-3">RECENT POSTS</h3>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="footer-border-bottom pb-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="<?= $base_url; ?>assets2/images/dashboard/home_1.jpg" alt="thumb" class="img-fluid" />
                                                </div>
                                                <div class="col-9">
                                                    <h5 class="font-weight-600">
                                                        Cotton import from USA to soar was American traders
                                                        predict
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="footer-border-bottom pb-2 pt-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="<?= $base_url; ?>assets2/images/dashboard/home_2.jpg" alt="thumb" class="img-fluid" />
                                                </div>
                                                <div class="col-9">
                                                    <h5 class="font-weight-600">
                                                        Cotton import from USA to soar was American traders
                                                        predict
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="<?= $base_url; ?>assets2/images/dashboard/home_3.jpg" alt="thumb" class="img-fluid" />
                                                </div>
                                                <div class="col-9">
                                                    <h5 class="font-weight-600 mb-3">
                                                        Cotton import from USA to soar was American traders
                                                        predict
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h3 class="font-weight-bold mb-3">CATEGORIES</h3>
                                <div class="footer-border-bottom pb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 font-weight-600">Magazine</h5>
                                        <div class="count">1</div>
                                    </div>
                                </div>
                                <div class="footer-border-bottom pb-2 pt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 font-weight-600">Business</h5>
                                        <div class="count">1</div>
                                    </div>
                                </div>
                                <div class="footer-border-bottom pb-2 pt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 font-weight-600">Sports</h5>
                                        <div class="count">1</div>
                                    </div>
                                </div>
                                <div class="footer-border-bottom pb-2 pt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 font-weight-600">Arts</h5>
                                        <div class="count">1</div>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 font-weight-600">Politics</h5>
                                        <div class="count">1</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="fs-14 font-weight-600">
                                        © 2023 @ BootstrapDash. All rights reserved.
                                    </div>
                                    <div class="fs-14 font-weight-600">
                                        <a href="../../external.html?link=https://www.bootstrapdash.com/" target="_blank" class="text-white">Bootstrap website templates</a> from Bootstrapdash
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- partial -->
        </div>
    </div>
    <!-- inject:js -->
    <script src="<?= $base_url; ?>assets2/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="<?= $base_url; ?>assets2/vendors/aos/dist/aos.js/aos.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="<?= $base_url; ?>assets2/js/demo.js"></script>
    <script src="<?= $base_url; ?>assets2/js/jquery.easeScroll.js"></script>
    <!-- End custom js for this page-->
</body>

<!-- Mirrored from demo.bootstrapdash.com/world-time/ by HTTrack Website Copier/3.x [XR&CO'2017], Thu, 22 Feb 2024 10:18:07 GMT -->

</html>