<?php
session_start();
include ('../inc/koneksi.php');
global $connect;

if (isset($_POST['tambahkategori'])) {

	$kategori = $_POST['kategori'];
	$alias = $_POST['alias'];
	$terbit = $_POST['terbit'];

	$sql = "INSERT INTO kategori (`kategori`, `alias`, `terbit`)  VALUES ('$kategori', '$alias', '$terbit')";

	$result = mysqli_query($connect, $sql);
	if ($result) {
		echo "<script>alert('Kategori Berhasil Di tambahkan'); </script>";
	}
}

if (isset($_GET['act']) && $_GET['act'] == 'edit') {

	$id = $_GET['id'];
	$sql = "SELECT * FROM kategori WHERE ID = '$id' ";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($result);
	$kategori = $row['kategori'];
	$alias = $row['alias'];
	$terbit = $row['terbit'];
}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {

	$id = $_GET['id'];

	$sql = "DELETE FROM kategori WHERE ID = '$id' ";
	$result = mysqli_query($connect, $sql);

	echo "<script> 
			alert('Kategori Berhasil Di Hapus'); 
			document.location.href = 'kategori.php';
		  </script>";
}

include ('layout/header.php');
?>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCat">
  Tambah Kategori
</button>

<!-- Modal -->
<form class="text-left" action="" method="POST">
<div class="modal fade" id="addCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	<div class="form-group">
		<input type="hidden" name="id" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
			echo $id;
		} ?>">
		<label class="form-label">Nama Kategori</label>
		<input type="text" name="kategori" class="form-control col-6" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
			echo $kategori;
		} ?>" required>
		<label class="form-label">Alias</label>
		<input type="text" name="alias" class="form-control col-6" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
			echo $alias;
		} ?>" required>
		<label class="form-label">Tampilkan</label>
		<br>
		<select class="form-select col-1" name="terbit">
			<option value="1" <?php if (isset($_GET['act']) && $_GET['act'] == 'edit' && $terbit == 1) {
				echo 'selected';
			} ?>>
				Yes
			</option>
			<option value="0" <?php if (isset($_GET['act']) && $_GET['act'] == 'edit' && $terbit == 0) {
				echo 'selected';
			} ?>>
				No
			</option>
		</select>
		<br>
		<br>
	</div>
	</fieldset>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="<?= (isset($id) ? 'editkategori' : 'tambahkategori') ?>">
			<?= (isset($id) ? 'EDIT' : 'TAMBAH') ?>
		</button>
      </div>
    </div>
  </div>
</div>
</form>


<br>
<hr>
<h5 class="card-title fw-semibold mb-4">List Kategori</h5>
<div class="form-group">
	<table class="table">
		<thead>
			<tr>
				<th scope="col" class="text-left">Nama Kategori</th>
				<th scope="col">Alias</th>
				<th scope="col">Aksi</th>
			</tr>
		</thead>
		<?php
		$sql = "SELECT * FROM kategori  ORDER BY ID DESC";
		$result = mysqli_query($connect, $sql);
		?>
		<?php while ($row = mysqli_fetch_assoc($result)): ?>
			<tbody>
				<tr>
					<td class="text-left"><?= $row['kategori']; ?></td>
					<td><?= $row['alias']; ?></td>
					<td>
						<a class="btn btn-warning" href="kategori/edit.php?id=<?= $row['ID']; ?>">EDIT</a>
						<a class="btn btn-danger" href="./kategori.php?act=hapus&id=<?= $row['ID']; ?>">HAPUS</a>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<?php
include ('layout/footer.php');
