<?php
require_once ('../../inc/koneksi.php');
session_start();  // Mulai sesi

global $connect;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addberita'])) {
	$judul = $_POST['judul'];
	$kategori = $_POST['kategori'];
	$isi = $_POST['isi'];
	date_default_timezone_set('Asia/Jakarta');
	$date = date('Y-m-d H:i:s');
	$updateby = $_SESSION['nama'];
	$terbit = $_POST['terbit'];

	$gambar = '';  // Inisialisasi variabel $gambar

	// cek gambar ada atau tidak
	if (isset($_FILES['gambar'])) {
		$errors = array();
		$file_name = $_FILES['gambar']['name'];
		$file_size = $_FILES['gambar']['size'];
		$file_tmp = $_FILES['gambar']['tmp_name'];
		$file_type = $_FILES['gambar']['type'];
		$file_parts = explode('.', $_FILES['gambar']['name']);
		$file_ext = strtolower(end($file_parts));

		$extensions = array('jpeg', 'jpg', 'png');

		if (in_array($file_ext, $extensions) === false) {
			$errors[] = 'extension not allowed, please choose a JPEG or PNG file.';
		}

		if ($file_size > 2097152) {
			$errors[] = 'File size must be exactly 2 MB';
		}

		if (empty($errors) == true) {
			move_uploaded_file($file_tmp, '../../photo/' . $file_name);
			$gambar = 'photo/' . $file_name;
		} else {
			print_r($errors);
		}
	}

	$sql = "INSERT INTO berita (judul, kategori, isi, gambar, tanggal, updateby, viewnum, post_type, terbit) VALUES ('$judul', '$kategori', '$isi', '$gambar', '$date', '$updateby', '0', 'berita', '$terbit')";

	$result = mysqli_query($connect, $sql);
	if ($result) {
		$msg_type = 'success';
		$msg_content = 'Berhasil Menambahkan Berita';
		header('Location: ../berita');
	} else {
		$msg_type = 'error';
		$msg_content = 'Gagal Menambahkan Berita';
		header('Location: ../berita');
	}
}

include ('../layout/header.php');
?>
<form action="" method="POST" enctype="multipart/form-data">
	<legend class=" w-auto">Tambah Berita</legend>
	<div class="form-group">
		<input type="hidden" name="id">
		<label class="form-label">Judul</label>
		<input type="text" name="judul" class="form-control">
		<label class="form-label">Kategori</label>
		<br>
		<select class="form-select" name="kategori">
			<option>Pilih Kategori</option>
			<?php
				$sql = 'SELECT * FROM kategori WHERE terbit = 1 ORDER BY ID DESC';
				$result = mysqli_query($connect, $sql);
				while ($row = mysqli_fetch_assoc($result)) {
					$alias = $row['alias'];
					$kategori1 = $row['kategori'];
					echo "
							<option value='$alias'>$kategori1</option>
						";
				}
			?>
		</select>
		<br>
		<label class="form-label">Isi Berita</label>
		<br>
		<textarea id="summernote" name="isi"></textarea>
		<br>
		<label class="form-label">Gambar</label>
		<br>
		<input type='file' name='gambar'>
		<br>
		<br>
		<label class="form-label">Terbitkan</label>
		<br>
		<select class="form-select" name="terbit">
			<option value="1">Yes</option>
			<option value="0">No</option>
		</select>
		<br>
		<button type="submit" class="btn btn-primary" name="addberita">Tambah</button>
	</div>
</form>
<script>
      $('#summernote').summernote({
        tabsize: 5,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
<?php
include ('../layout/footer.php');
?>