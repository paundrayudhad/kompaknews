<?php
require_once('../../inc/koneksi.php');
session_start(); // Mulai sesi
global $connect;
include('../layout/header.php');

?>
<a href="create.php" class="btn btn-primary btn-md">Buat Berita</a>
<hr>
<h3 class="w-auto text-left">List Berita</h3>
<table class="table">
	<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">Judul</th>
			<th scope="col">Kategori</th>
			<th scope="col">Tanggal</th>
			<th scope="col">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		$sql = "SELECT * FROM berita ORDER BY ID DESC";
		$result = mysqli_query($connect, $sql);
		?>
		<?php while ($row = mysqli_fetch_assoc($result)) : ?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $row['judul']; ?></td>
				<td><?= $row['kategori']; ?></td>
				<td><?= $row['tanggal']; ?></td>
				<td><a class="btn btn-warning" href="edit.php?id=<?= $row['ID']; ?>">Edit</a>
					<a class="btn btn-danger" href="delete.php?id=<?= $row['ID']; ?>">Delete</a>
				</td>
			</tr>
			<?php $no++; ?>
		<?php endwhile; ?>
	</tbody>
</table>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="SModal" style="border-radius:7%" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" id="SModal-size">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="SModal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="SModal-body"></div>
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
include('../layout/footer.php');
?>