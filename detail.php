 <!-- Page Content -->
 <?php

  $id = (isset($_GET['id']) ? $_GET['id'] : '');

  $query = "SELECT * FROM berita WHERE terbit ='1' AND ID = '$id'";
  $result = mysqli_query($connect, $query);
  $updateviewnum = mysqli_query($connect, "UPDATE berita SET viewnum = viewnum+1 WHERE ID = '$id'");
  ?>
 <div class="container">

   <div class="row">
     <div class="card my-4">
       <!-- Post Content Column -->
       <div class="col-lg-12">
         <?php while ($row = mysqli_fetch_assoc($result)) : ?>
           <!-- Title -->
           <h1 class="mt-4"><?= $row['judul']; ?></h1>

           <!-- Author -->
           <p class="lead">
             by
             <b><?= $row['updateby']; ?></b>
           </p>

           <hr>

           <!-- Date/Time -->
           <?php $date = $row['tanggal'];
            $newDate = date("d-F-Y , H:i:s", strtotime($date)); ?>
           <p>Posted on <?= $newDate; ?> WIB</p>

           <hr>

           <!-- Preview Image -->
           <img class="img-fluid rounded col-lg-12" src="<?= $row['gambar']; ?>" alt="<?= $row['judul']; ?>">

           <hr>

           <!-- Post Content -->
           <p><?= nl2br($row['isi']); ?></p>

           <hr>
       </div>
     <?php endwhile; ?>
     </div>
   </div>
 </div>