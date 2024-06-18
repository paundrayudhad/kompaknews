<?php
require_once ("../../inc/koneksi.php");
global $connect;
session_start();
if (isset($_POST['editkategori'])) {

    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $alias = $_POST['alias'];
    $terbit = $_POST['terbit'];

    $sql = "UPDATE kategori SET kategori = '$kategori', alias = '$alias', terbit = '$terbit' WHERE ID = '$id' ";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo "<script>
    alert('Kategori berhasil di update');
    </script>";
        header("Location: ../admin/kategori");
    } else {
        echo "<script>
    alert('Gagal di update');
    </script>";
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM kategori WHERE ID = '$id'";
    $result2 = mysqli_query($connect, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $kategori2 = $row2['kategori'];
    $alias2 = $row2['alias'];
    $terbit2 = $row2['terbit'];

}
include ('../layout/header.php');
?>
<form class="text-left" action="" method="POST">
    <h5 class="card-title fw-semibold mb-4">Tambah Kategori</h5>
    <div class="form-group">
        <input type="hidden" name="id" value="
           <?= $id; ?>
        ">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="kategori" class="form-control col-6" value="<?= $kategori2; ?>" required>
        <label class="form-label">Alias</label>
        <input type="text" name="alias" class="form-control col-6" value="<?= $alias2; ?>" required>
        <label class="form-label">Tampilkan</label>
        <br>
        <select class="form-select col-1" name="terbit">
            <option value="1" <?php if ($terbit2 == 1) {
                echo 'selected';
            } ?>>
                Yes
            </option>
            <option value="0" <?php if ($terbit2 == 0) {
                echo 'selected';
            } ?>>
                No
            </option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary" name="edit_kategori">
            Edit
        </button>
    </div>
    </fieldset>
</form>
<?php
include("../layout/footer.php");
?>