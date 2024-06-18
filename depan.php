<!-- Konfigurasi Pagination -->

<?php

$jumlahDataPerhalaman = 3;
$dataBerita = mysqli_query($connect, "SELECT * FROM berita");
$jumlahData = mysqli_num_rows($dataBerita);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

if (isset($_GET['halaman'])) {
  $halamanAktif = $_GET['halaman'];
} else {
  $halamanAktif = 1;
}

$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

?>

<!-- Blog Post -->
<?php
$query = "SELECT * FROM berita WHERE terbit = '1' ORDER BY ID DESC LIMIT 0, $jumlahDataPerhalaman";
$result = mysqli_query($connect, $query);
?>
<?php while ($row = mysqli_fetch_assoc($result)) : ?>
  <div class="card mb-4" style="margin-top: 32px;">
    <img class="card-img-top" src="<?= $row['gambar']; ?>" alt="Card image cap">
    <div class="card-body">
      <h2 class="card-title"><?= $row['judul']; ?></h2>
      <p class="card-text"><?= substr(strip_tags($row['isi']), 0, 200); ?>. . . .</p>
      <a href="./?open=detail&id=<?= $row['ID']; ?>" class="btn btn-primary">Baca Selengkapnya &rarr;</a>
    </div>
    <div class="card-footer text-muted">
      <?php $date = $row['tanggal'];
      $newDate = date("d-F-Y , H:i:s", strtotime($date)); ?>
      <?= "Posted on " . $newDate; ?>
      <!-- Posted on January 1, 2017 by -->
    </div>
  </div>
<?php endwhile; ?>

<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
  <?php if ($halamanAktif > 1) : ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&larr; Berita Sebelumnya</a>
    </li>
  <?php endif; ?>
  <?php if ($halamanAktif < $jumlahHalaman) : ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Berita Lain &rarr;</a>
    </li>
  <?php endif; ?>
</ul>