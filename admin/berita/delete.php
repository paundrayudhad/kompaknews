<?php 
require_once('../../inc/koneksi.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlGambar = mysqli_query($connect, "SELECT * FROM berita WHERE ID= '$id'");
    $result = mysqli_fetch_assoc($sqlGambar);
    $gambar = $result['gambar'];
    if (file_exists('../../photo' . $gambar)) {
    unlink('../' . $gambar);
    }
    $query = "DELETE FROM berita WHERE ID = '$id'";
    $sql = mysqli_query($connect, $query);
    if($sql) {  
    echo "<script> 
                    alert('Berhasil Menghapus Berita');
                  </script>";
                  header("Location: ../admin/berita");
        } else {
            echo "<script> 
                    alert('Gagal Menghapus Berita');
                  </script>";
                  header("Location: ../admin/berita");
        }
    } else {
        echo "<script> 
                alert('Berita tidak ditemukan');
              </script>";
              header("Location: ../admin/berita");
} 