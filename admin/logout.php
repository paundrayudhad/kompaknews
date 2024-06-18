<?php 


session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("Location:".$base_url."/admin/auth/login.php");
exit;
