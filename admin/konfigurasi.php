<?php

	session_start();
	include('../inc/koneksi.php');
	global $connect;

if (isset($_POST['tambahkonfigurasi'])) {

	$nama = $_POST['nama'];
	$tax = $_POST['tax'];
	$isi = $_POST['isi'];
	$link = $_POST['link'];

	$sql = mysqli_query($connect, "INSERT INTO konfigurasi VALUES ('', '$nama', '$tax', '$isi', '$link', 'konfigurasi')" );
}

if (isset($_POST['editkonfigurasi'])) {

	$count = 0;

	foreach ($_POST['nama'] as $item) {
		$sql = "UPDATE konfigurasi SET Nama='". $_POST['nama'] [$count]."', Tax='". $_POST['tax'] [$count]."', Isi='". $_POST['isi'] [$count]."', Link='". $_POST['link'] [$count]."' WHERE ID='". $_POST['id'] [$count]."' ";

		$result = mysqli_query($connect, $sql);

		$count++;
	}
	echo "<script> 
			alert('Konfigurasi Berhasil Diubah'); 
			document.location.href = './?mod=konfigurasi';
		  </script>";
}


if (isset($_GET['act']) && $_GET['act'] == 'hapus') {
	$id = $_GET['id'];

	$sql = "DELETE  FROM konfigurasi WHERE ID='$id'";

	$result = mysqli_query($connect, $sql);

	echo "<script> 
			alert('Konfigurasi Berhasil Di Hapus'); 
			document.location.href = './?mod=konfigurasi';
		  </script>";
}


// upload logo
if (isset($_POST['uploadlogo'])) {
	$namaFile = $_FILES['logositus']['name'];
	$ukuranFile = $_FILES['logositus']['size'];
	$error = $_FILES['logositus']['error'];
	$tmpName = $_FILES['logositus']['tmp_name'];
	if ($error === 4) {
		echo "<script>
				alert('Pilih gambar terlebih dahulu');
			  </script>";
		return false;
	}

	$ekstensiGambarValid = ['png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('Format Gambar harus png');
			  </script>";
	} else {
		move_uploaded_file($tmpName, '../image/'.'logo.png');
	}
}


// upload icon
if (isset($_POST['uploadicon'])) {
	$namaFile = $_FILES['iconsitus']['name'];
	$ukuranFile = $_FILES['iconsitus']['size'];
	$error = $_FILES['iconsitus']['error'];
	$tmpName = $_FILES['iconsitus']['tmp_name'];
	if ($error === 4) {
		echo "<script>
				alert('Pilih gambar terlebih dahulu');
			  </script>";
		return false;
	}

	$ekstensiGambarValid = ['png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('Format Gambar harus png');
			  </script>";
	} else {
		move_uploaded_file($tmpName, '../'.'icon.png');
	}
}
include('layout/header.php');
?>


<table border="0">
	<tr>
		<td>
		<div>
		<form class="text-left" action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
		<fieldset class="border p-2">
		<legend class="w-auto">Logo Situs</legend>

		<img src="../image/<?php echo 'logo.png'; ?>" width="250">

		<input type="file" name="logositus" class="mt-2">

		<button type="submit" class="btn btn-primary btn-sm" name="uploadlogo">Upload Logo</button>

		</fieldset>
		</form>
		</div>
		</td>
		<td>
		<div>
		<form class="text-left" action="./?mod=konfigurasi" method="POST" enctype="multipart/form-data">
		<fieldset class="border p-2">
		<legend class="w-auto">Icon Situs</legend>

		<img src="../<?php echo 'icon.png'; ?>" width="55" class="mr-auto">

		<input type="file" name="iconsitus" class="mt-2">

		<button type="submit" class="btn btn-primary btn-sm mt-1" name="uploadicon">Upload Icon</button>

		</fieldset>
		</form>
		</div>
		</td>
	</tr>
</table>

<form action="./?mod=konfigurasi" method="POST">
<fieldset class="border p-2 mt-2">
		<legend class="w-auto text-left">Tambah Konfigurasi</legend>
<table class="table table-borderless">
	<tr class="text-left">
      <td>Nama</td>
      <td>Tax</td>
      <td>Isi</td>
      <td>Link</td>
    </tr>
    <tr class="text-left">
    	<div class="input-group">
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="nama" autocomplete="off" required size="30"> </td>
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="tax" required size="10" ></td>
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="isi" required size="20"></td>
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="link" size="34"></td>
      	</div>
    </tr>
    <tr>
    <td class="text-left">
    	<button type="submit" class="btn btn-primary btn-sm" name="tambahkonfigurasi">Tambah</button>
    </td>
    </tr>
</table>
    
</fieldset>
</form>

<form action="./?mod=konfigurasi" method="POST">
<fieldset class="border p-2 mt-2">
		<legend class="w-auto text-left">List Konfigurasi</legend>
		<?php 
			$result = mysqli_query($connect, "SELECT * FROM konfigurasi WHERE Tipe='konfigurasi'");
		 ?>
		 <?php while( $row = mysqli_fetch_assoc($result)) : ?>
<table class="table table-borderless">
	<tr class="text-left">
      <td>Nama</td>
      <td>Tax</td>
      <td>Isi</td>
      <td>Link</td>
    </tr>
    <input type="hidden" name="id[]" value="<?= $row['ID']; ?>">
    <tr class="text-left">
    	<div class="input-group">
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="nama[]" value="<?= $row['Nama']; ?>" autocomplete="off" required size="17"> </td>
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="tax[]" value="<?= $row['Tax']; ?>" autocomplete="off" required size="8" ></td>
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="isi[]" value="<?= $row['Isi']; ?>" autocomplete="off" required size="20"></td>
      <td><input aria-describedby="basic-addon2" class="form-control" type="text" name="link[]" value="<?= $row['Link']; ?>" autocomplete="off" size="25"></td>
  	  <td>
  	  	<a href="./?mod=konfigurasi&act=hapus&id=<?= $row['ID']; ?>" class="badge badge-danger">X</a>
  	  </td>
  		</div>
    </tr>
    <tr>
    <?php endwhile; ?>
    	<td class="text-left">
    		<button type="submit" class="btn btn-primary" name="editkonfigurasi">Edit</button>
    	</td>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
</table>
</fieldset>
</form>
<?php 
include 'layout/footer.php';
?>