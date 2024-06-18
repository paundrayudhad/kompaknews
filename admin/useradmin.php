<?php

session_start();
include('../inc/koneksi.php');
global $connect;

if (isset($_POST['tambahuser'])) {

	$email = $_POST['email'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM administrator WHERE username = '$username' OR email = '$email'";

	$result = mysqli_query($connect, $query);
	$row = mysqli_num_rows($result);

	if ($row > 0) {
		$error = "<div class='alert alert-danger' role='alert'>
  					Username Atau Email Sudah Pernah DIBUATKAN!
				  </div>";
		echo $error;
	} else {
		$sql = mysqli_query($connect, "INSERT INTO administrator (email, Nama, password) VALUES ('$email', '$nama', '$username', '$password')");
		echo "<script> alert('Data Admin Berhasil Ditambahkan'); </script>";
	}
}

if (isset($_POST['edituser'])) {

	$email = $_POST['email'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$id = $_GET['id'];

	$query = "UPDATE administrator SET email= '$email', Nama= '$nama', username= '$username' WHERE ID = '$id'";
	$sql = mysqli_query($connect, $query);

	echo "<script> 
			alert('Data Berhasil Diubah'); 
			document.location.href = '?mod=useradmin';
		  </script>";
}

if (isset($_GET['act']) && $_GET['act'] == 'edit') {

	$id = $_GET['id'];
	$query = "SELECT * FROM administrator WHERE ID = '$id'";
	$sql = mysqli_query($connect, $query);
	$hasil = mysqli_fetch_assoc($sql);
	$email = $hasil['email'];
	$nama = $hasil['Nama'];
	$username = $hasil['username'];
	$password = $hasil['password'];
}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {

	$id = $_GET['id'];
	$query = "DELETE FROM administrator WHERE ID = '$id'";
	$sql = mysqli_query($connect, $query);
	$error = "	<script> 
				alert('Data Berhasil Dihapus'); 
				document.location.href = '?mod=useradmin';
		  		</script>";
	echo $error;
}

include('layout/header.php');
?>
	<form class="text-left" action="" method="POST">
		<input type="hidden" name="userid" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
														echo $id;
													} ?>">
			<legend class="w-auto">TAMBAH DATA</legend>
			<div class="form-group">
				<label class="form-label">Email</label>
				<input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
												echo $email;
											} ?>" name="email" class="form-control col-6" placeholder="Email Address" required>
				<label class="form-label">Nama User</label>
				<input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
												echo $nama;
											} ?>" name="nama" class="form-control col-6" placeholder="Nama Lengkap" required>
				<label class="form-label">Username</label>
				<input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
												echo $username;
											} ?>" name="username" class="form-control col-6" placeholder="Username" required>
				<label class="form-label">Password</label>
				<input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] == 'edit') {
												echo $password;
											} ?>" name="password" class="form-control col-6" placeholder="Password" required>

				<button class="btn btn-lg btn-primary btn-block text-uppercase mt-4 col-2" type="submit" name="<?= (isset($id) ? 'edituser' : 'tambahuser') ?>"> <?= (isset($id) ? 'EDIT' : 'TAMBAH') ?> </button>

			</div>
	</form>

	<fieldset class="border p-2 mt-4">
		<legend class="w-auto text-left">DATA USER</legend>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Email</th>
					<th scope="col">Nama</th>
					<th scope="col">Username</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				$sqlAdmin = "SELECT * FROM administrator ORDER BY ID ASC";
				$result = mysqli_query($connect, $sqlAdmin);
				?>
				<?php while ($row = mysqli_fetch_assoc($result)) : ?>
					<tr>
						<th scope="row"><?php echo $i; ?></th>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['Nama']; ?></td>
						<td><?php echo $row['username']; ?></td>
						<td> <a href="?mod=useradmin&act=edit&id=<?php echo $row['ID']; ?>">Ubah</a> / <a href="?mod=useradmin&act=hapus&id=<?php echo $row['ID']; ?>">Hapus</a></td>
					</tr>
					<?php $i++; ?>
				<?php endwhile; ?>
			</tbody>
		</table>
	</fieldset>
</body>

</html>
<?php
include('layout/footer.php');
?>