<?php
require_once ("../../inc/koneksi.php");
global $connect;
session_start();

if (isset($_POST['edit'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $isi = $_POST['isi'];
    $teks = $_POST['teks'];
    $tanggal = date("Y-m-d H:i:s");
    $terbit = $_POST['terbit'];

    $sql = "UPDATE berita SET judul = '$judul', kategori = '$kategori', isi = '$isi', tanggal = '$tanggal', terbit = '$terbit' WHERE ID = '$id' ";

    $result = mysqli_query($connect, $sql);

    echo "<script> 
			document.location.href = './berita';
		  </script>";
}

// ambil data berita
if (isset($_GET["id"])) {
    $id2 = $_GET['id'];
    $sql2 = "SELECT * FROM berita WHERE ID = '$id2'";
    $result2 = mysqli_query($connect, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $judul2 = $row2['judul'];
    $kategori2 = $row2['kategori'];
    $isi2 = $row2['isi'];
    $gambar2 = $row2['gambar'];
    $tanggal2 = $row2['tanggal'];
    $updateby2 = $row2['updateby'];
    $terbit2 = $row2['terbit'];
}
include('../layout/header.php'); ?>


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="edit.php" method="POST"">
		<legend class=" w-auto">Tambah Berita</legend>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $id2 ?>">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= $judul2; ?>">

                    <label class="form-label">Kategori</label>
                    <br>
                    <select class="form-select" name="kategori">
                        <option>Pilih Kategori</option>
                        <?php
                        $sql = "SELECT * FROM kategori WHERE terbit = 1 ORDER BY ID DESC";
                        $result = mysqli_query($connect, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $alias = $row['alias'];
                            $kategori1 = $row['kategori'];
                            if ($kategori2 == $alias) {
                                echo "
							<option value='$alias' selected >$kategori1</option>
						";
                            } else {
                                echo "
							<option value='$alias'>$kategori1</option>
						";
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <label class="form-label">Isi Berita</label>
                    <br>
                    <textarea name="isi" class="form-control" id="summernote"><?= $isi2; ?></textarea>
                    <br>
                    <label class="form-label">Gambar</label>
                    <br>
                    <img src='<?= $base_url; ?><?= $gambar2; ?>' width='200'>
                    <br>
                    <br>
                    <label class="form-label">Terbitkan</label>
                    <br>
                    <select class="form-select" name="terbit">
                        <option value="1" <?php if ($terbit2 == 1) {
                                                echo "selected";
                                            } ?>>Yes</option>
                        <option value="0" <?php if ($terbit2 == 0) {
                                                echo "selected";
                                            } ?>>No</option>
                    </select>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
include("../layout/footer.php");
?>