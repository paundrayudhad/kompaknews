<!-- Blog Post / Kategori -->

<!-- konfigurasi pagination kategori -->
<?php 
  $catid = (isset($_GET['id']) ? $_GET['id'] : '');
  $ambilCat = mysqli_query($connect, "SELECT * FROM kategori WHERE ID = $catid");
  $getCat = mysqli_fetch_assoc($ambilCat);
  $sqlCat = $getCat['alias'];
  $jumlahDataPerhalaman = 3;
  $dataBerita = mysqli_query($connect, "SELECT * FROM berita WHERE kategori = '$sqlCat'");
  $jumlahData = mysqli_num_rows($dataBerita);
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

  if (isset($_GET['page'])) {
    $halamanAktif = $_GET['page'];
  } else {
    $halamanAktif = 1;
  }

  $awalData = ( $jumlahDataPerhalaman * $halamanAktif ) - $jumlahDataPerhalaman;

?>


<?php 
  $catid = (isset($_GET['id']) ? $_GET['id'] : '');
  $getalias = mysqli_query($connect,"SELECT * FROM kategori WHERE ID = '$catid'" );
  $hasilalias = mysqli_fetch_assoc($getalias);
  $hsl_alias = $hasilalias['alias'];

	$query = "SELECT * FROM berita WHERE terbit = '1' AND kategori = '$hsl_alias' ORDER BY ID DESC LIMIT $awalData,$jumlahDataPerhalaman";
	$result = mysqli_query($connect, $query);
?>
<?php while ( $row = mysqli_fetch_assoc($result) ) : ?>
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
  </div>
</div>
<?php endwhile; ?>

<!-- Pagination -->
<?php 
    $query = "SELECT * FROM kategori WHERE terbit = 1 AND ID = $catid ORDER BY ID ASC LIMIT 0,10";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
?>
<ul class="pagination justify-content-center mb-4">
  <?php if( $halamanAktif > 1) : ?>
  <li class="page-item">
    <a class="page-link" href="?open=cat&id=<?= $row['ID']; ?>&page=<?= $halamanAktif - 1; ?>">&larr; Berita Sebelumnya</a>
  </li>
  <?php endif; ?>
  <?php if( $halamanAktif < $jumlahHalaman) : ?>
  <li class="page-item">
    <a class="page-link" href="?open=cat&id=<?= $row['ID']; ?>&page=<?= $halamanAktif + 1; ?>">Berita Lain &rarr;</a>
  </li>
  <?php endif; ?>
</ul>