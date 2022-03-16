<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "SPPS";

	$con = mysqli_connect($host, $user, $password, $dbname);

	if (!$con){
		die("Sambungan ke pangkalan data gagal.");
	}else{
		#echo "Sambungan ke pangkalan data berjaya"
	}
?>

