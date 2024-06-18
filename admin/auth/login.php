<?php
session_start();
include '../../inc/fungsi.php';

if (isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}


include("../../inc/koneksi.php");

if (isset($_POST['submit'])) {

    global $connect;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM administrator WHERE username = '$username'";

    $result = mysqli_query($connect, $sql);

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if ($row["password"] === $password and $row["username"] === $username) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["nama"] = $row["Nama"];
            header("Location: ../index.php");
        }
    } else {
        echo "<script>alert('Anda gagal login!')</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Kompak News</title>
    <link rel="shortcut icon" type="image/png" href="<?= $base_url; ?>assets-adminassets-admin/images/logos/favicon.png" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets-admin/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="<?= $base_url; ?>assets-admin/images/logos/dark-logo.svg" width="180" alt="">
                                </a>
                                <p class="text-center">Masuk ke Portal</p>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit" name="submit">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= $base_url; ?>assets-admin/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="<?= $base_url; ?>assets-admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function showSwal(title, text, icon) {
          title: title
          text: text
          icon: icon
        }
    </script>
</body>
</html>