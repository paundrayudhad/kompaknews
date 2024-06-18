<?php
error_reporting(E_ALL);
// Koneksi ke database

$connect = mysqli_connect('localhost', 'root', '', 'kompaknews');
$webmu = 'http://127.0.0.1/portalberita/'; // ubah aja
$base_url = $webmu;

if (!$connect) {
    echo "Gagal koneksi ke Database" . mysqli_connect_error();
}
