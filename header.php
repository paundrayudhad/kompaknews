<?php
include 'inc/koneksi.php';
include 'inc/fungsi.php';
global $connect;
?>

<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.bootstrapdash.com/world-time/ by HTTrack Website Copier/3.x [XR&CO'2017], Thu, 22 Feb 2024 10:18:05 GMT -->

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title><?= ambilprofilweb('title_site'); ?></title>
  <meta name="description" content="<?= ambilprofilweb('meta_desc'); ?>">
  <meta name="keywords" content="<?= ambilprofilweb('meta_key'); ?>">
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
                      <li class="nav-item">
                        <a class="nav-link" href="./">Home</a>
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
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <div class="content-wrapper">