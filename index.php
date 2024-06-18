<?php

include("header.php");

?>

  <div class="container">
    <div class="row" data-aos="fade-up">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <!-- 1 switch page -->

        <?php
        $open = isset($_GET['open']) ? $_GET['open'] : '';
        switch ($open) {
          case 'detail':
            include("detail.php");
            break;
          case 'cat':
            include("kategori.php");
            break;
          case 'cari':
            include("cari.php");
            break;
          default:
            include("depan.php");
            break;
        }

        ?>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4 mt-1">

        <!-- Categories Widget / Berita Terbaru -->
        <div class="card my-4">
          <h5 class="card-header">Berita Terbaru</h5>
          <?php
          $query = "SELECT * FROM berita WHERE terbit = '1' ORDER BY ID DESC LIMIT 0,5";
          $result = mysqli_query($connect, $query);
          ?>
          <div class="card-body">
            <ul class="list-group">
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-left">
                  <a href="./?open=detail&id=<?= $row['ID']; ?>" style="text-color: black;"><b><?= $row['judul']; ?></b></a>
                  
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-left">
                  <?php
                  $date = $row['tanggal'];
                  $newDate = date("d-M-Y, H:i:s", strtotime($date)); ?>
                  <?= $newDate; ?> |
                  Dilihat : <?= $row['viewnum']; ?>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>

        <!-- Side Widget / Berita Populer -->
        <div class="card my-4">
          <h5 class="card-header">Berita Populer</h5>
          <?php
          $query = "SELECT * FROM berita WHERE terbit = '1' AND tanggal>='" . date('Y-m-d H:i:s', strtotime('-7 days')) . "' ORDER BY viewnum DESC LIMIT 0,5";
          $result = mysqli_query($connect, $query);
          ?>
          <div class="card-body">
            <ul class="list-group">
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-left">
                  <a href="./?open=detail&id=<?= $row['ID']; ?>" class="badge-light" style="text-decoration: none;"><b><?= $row['judul']; ?></b></a>
                  
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-left">
                  <?php
                  $date = $row['tanggal'];
                  $newDate = date("d-M-Y, H:i:s", strtotime($date)); ?>
                  <?= $newDate; ?> |
                  Dilihat : <?= $row['viewnum']; ?>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
  </div>


<?php

include("footer.php");

?>