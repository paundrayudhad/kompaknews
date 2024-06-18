<?php

include('koneksi.php');
function ambilprofilweb($tax)
{
	global $connect;

	$sql = "SELECT * FROM konfigurasi WHERE Tax='$tax' ORDER BY ID DESC LIMIT 1";

	$result = mysqli_query($connect, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		return $row['Isi'];
	}
}

 