<!-- Blog Post -->

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

$awalData = ( $jumlahDataPerhalaman * $halamanAktif ) - $jumlahDataPerhalaman;

?>

<!-- konfigurasi Pencarian -->

<?php 
  
  $key = $_GET['key'];

  $key = explode(" ", $key);

  sort($key);

  $stradd = '';

  foreach ($key as $val) {
    if ($stradd != '') {
      $stradd .= " OR isi LIKE '%{$val}%' OR judul LIKE '%{$val}%' ";
    } else {
      $stradd .= " isi LIKE '%{$val}%' OR judul LIKE '%{$val}%' ";
    }
  }

  $sql = mysqli_query($connect, "SELECT * FROM berita WHERE $stradd AND terbit = '1' ORDER BY ID DESC LIMIT $awalData, $jumlahDataPerhalaman");
  $jumlahDataCari = mysqli_num_rows($sql);

 ?>
<?php while ( $row = mysqli_fetch_assoc($sql) ) : ?>
<div class="card mb-4">
  <img class="card-img-top" src="<?= $row['gambar']; ?>" alt="Card image cap">
  <div class="card-body">
    <h2 class="card-title"><?= $row['judul']; ?></h2>
    <p class="card-text"><?= substr(strip_tags($row['isi']),0,200); ?>. . . .</p>
    <a href="./?open=detail&id=<?= $row['ID']; ?>" class="btn btn-primary">Baca Selengkapnya &rarr;</a>
  </div>
  <div class="card-footer text-muted">
  	<?php $date = $row['tanggal'];
  	  $newDate = date("d-F-Y , H:i:s", strtotime($date)); ?>
  	<?= "Posted on ". $newDate; ?>
    <!-- Posted on January 1, 2017 by -->
  </div>
</div>
<?php endwhile; ?>

<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
  <?php if( $halamanAktif > 1) : ?>
  <li class="page-item">
    <a class="page-link" href="?key=<?= $val; ?>&open=cari&halaman=<?= $halamanAktif - 1; ?>">&larr; Berita Sebelumnya</a>
  </li>
  <?php endif; ?>
  <?php if( $halamanAktif < $jumlahDataCari) : ?>
  <li class="page-item">
    <a class="page-link" href="?key=<?= $val; ?>&open=cari&halaman=<?= $halamanAktif + 1; ?>">Berita Lain &rarr;</a>
  </li>
  <?php endif; ?>
</ul>